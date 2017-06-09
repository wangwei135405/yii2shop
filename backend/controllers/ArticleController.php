<?php

namespace backend\controllers;

use backend\models\Article;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $article =Article::find()->all();
        return $this->render('index',['article'=>$article]);
    }

}
