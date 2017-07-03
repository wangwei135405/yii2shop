<?php

namespace backend\controllers;

use backend\models\LoginForm;
use backend\models\User;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Request;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $user = User::find()->all();
        return $this->render('index',['user'=>$user]);
    }

    public function actionAdd(){
      //  var_dump(\Yii::$app->user->identity);exit;
        $model = new User(['scenario'=>User::SCENARIO_ADD]);
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->auth_key=\Yii::$app->security->generateRandomString();
                $model->password_hash=\Yii::$app->security->generatePasswordHash($model->password);
                $model->save();
                $model->roles();
                return $this->redirect(['user/index']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionUser()
    {
        $user = \Yii::$app->user;
        var_dump($user->identity);
        var_dump($user->id);
        var_dump($user->isGuest);
    }
    public function actionLogin()
    {

        $model = new LoginForm();
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post());
            if ($model->validate()) {
               // 跳转到登录检测页
                return $this->redirect(['user/index']);
            }
        }
        return $this->render('login', ['model' => $model]);

    }
    public function actionLoginout()
    {
        \Yii::$app->user->logout();

        echo '注销成功';
        return $this->redirect(['user/login']);
    }

    public function actionEdit($id){
        $model = User::findOne(['id'=>$id]);
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                if($model == null){
                    throw new NotFoundHttpException('账户不存在');
                }
                $model->password_hash=\Yii::$app->security->generatePasswordHash($model->password);
                $model->save();
                $model->editroles();
                return $this->redirect(['user/index']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionDel($id){
        $model = User::findOne(['id'=>$id]);
        $model->delete();
        return $this->redirect(['user/index']);
    }

//    public function behaviors(){
//        return [
//            'acf' => [
//                'class' => AccessControl::className(),
//                'only' => ['add', 'index','login','edit'],//该过滤器作用的操作 ，默认是所有操作
//                'rules' => [
//                    [//未认证用户允许执行view操作
//                        'allow' => true,//是否允许执行
//                        'actions' => ['login'],//指定操作
//                        'roles' => ['?'],//角色？表示未认证用户  @表示已认证用户
//                    ],
//                    [//已认证用户允许执行add操作
//                        'allow' => true,//是否允许执行
//                        'actions' => ['add','index','edit'],//指定操作
//                        'roles' => ['@'],//角色？表示未认证用户  @表示已认证用
//
//                    ]
//                ]
//                ]
//            ];
//    }
}
