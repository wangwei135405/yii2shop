<?php

namespace frontend\controllers;

use frontend\models\Address;
use frontend\models\Member;

class AddressController extends \yii\web\Controller
{
    public $layout = 'address';//使用AddressAsset静态资源

    public function actionAdd(){
        $address = Address::find()->all();
        $model = new Address();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->member_id=\Yii::$app->user->getId();
            $model->save();
            return $this->redirect(['address/add']);
        }
        return $this->render('add',['model'=>$model,'address'=>$address]);
    }
    public function actionEdit($id){
        $address = Address::findOne(['id'=>$id]);
        $model = new Address();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->member_id=\Yii::$app->user->getId();
            $model->save();
            return $this->redirect(['address/add']);
        }
        return $this->render('add',['model'=>$model,'address'=>$address]);
    }
}
