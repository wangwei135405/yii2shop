<?php

namespace frontend\controllers;


use frontend\models\Member;


class MemberController extends \yii\web\Controller
{
    public $layout = 'login';

    public function actionRegister(){
        $model = new Member();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            //$model->chuli();
            $model->auth_key=\Yii::$app->security->generateRandomString();
            $model->password_hash=\Yii::$app->security->generatePasswordHash($model->password);
            $model->save();
            var_dump($model);
            return $this->redirect(['member/index']);
        }
        return $this->render('register',['model'=>$model]);
    }
    public function actionLogin(){
        $model = new Member();
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post());
            if ($model->denglu()) {
                // 跳转到登录检测页
                return $this->redirect(['member/index']);
            }
        }
        return $this->render('login', ['model' => $model]);

    }
    public function actionIndex()
    {

        return $this->render('index');
    }

}
