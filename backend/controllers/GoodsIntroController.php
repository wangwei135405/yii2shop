<?php

namespace backend\controllers;

use backend\models\GoodsIntro;

class GoodsIntroController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $goodsintro = GoodsIntro::findOne();
        return $this->render('index',['goodsintro'=>$goodsintro]);
    }

}
