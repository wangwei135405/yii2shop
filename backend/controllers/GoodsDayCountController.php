<?php

namespace backend\controllers;

use backend\models\GoodsDayCount;
use yii\web\Request;

class GoodsDayCountController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $goodsdaycount=GoodsDayCount::find()->all();
        return $this->render('index',['goodsdaycount'=>$goodsdaycount]);
    }
    public function actionAdd(){
        $model = new GoodsDayCount();
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
            if($request->post()){
              $model->save();
            }
        }
        return $this->render('add',['model'=>$model]);
    }
}
