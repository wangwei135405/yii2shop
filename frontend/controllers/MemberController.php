<?php

namespace frontend\controllers;


use frontend\models\LoginForm;
use frontend\models\Member;
use yii\web\Request;

use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Flc\Alidayu\Requests\IRequest;
class MemberController extends \yii\web\Controller
{
    public $layout = 'login';

    public function actionRegister(){
        $model = new Member();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->auth_key=\Yii::$app->security->generateRandomString();
            $model->password_hash=\Yii::$app->security->generatePasswordHash($this->password);
            $model->create_at=time();
            $model->save();
            return $this->redirect(['member/login']);

        }
        return $this->render('register',['model'=>$model]);
    }
    public function actionUser(){
        var_dump(\Yii::$app->user->isGuest);
        var_dump(\Yii::$app->user->id);
    }
    public function actionLogin(){
        $model = new LoginForm();
        $request =new Request();
        if ($request->isPost) {
            $model->load($request->post());
            if($model->validate()){

                // 跳转到登录检测页
//                var_dump(\Yii::$app->user->);
                return $this->redirect(['shouye/flow']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        return $this->render('login', ['model' => $model]);

    }
    public function actionLogout(){
        \Yii::$app->user->logout();
        return $this->redirect(['member/login']);
    }

    public function actionSend(){
        $config = [
            'app_key'    => '24479301',
            'app_secret' => '3ffb7d272a888ea024be2d3374c4a200',
            //'sandbox'    => true,  // 是否为沙箱环境，默认false
        ];
// 使用方法一
        $client = new Client(new App($config));
        $req    = new AlibabaAliqinFcSmsNumSend;

        $req->setRecNum('18228333641')
            ->setSmsParam([
                'code' => rand(100000, 999999)
            ])
            ->setSmsFreeSignName('王威网站')
            ->setSmsTemplateCode('SMS_71515148');

        $resp = $client->execute($req);
        var_dump($resp);
    }


    public function actionIndex()
    {
//        var_dump(\Yii::$app->user->getIdentity());
        return $this->render('index');
    }

}
