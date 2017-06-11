<?php

namespace backend\controllers;

use backend\models\Article;
use yii\web\Request;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $article =Article::find()->all();
        return $this->render('index',['article'=>$article]);
    }
     public function actionAdd(){
         $model = new Article();
         $request = new Request();
         if($request->isPost){
             $model->load($request->post());
             if($model->validate()){
                 $model->save();
                 return $this->redirect(['article/index']);
             }else{
                 var_dump($model->getErrors());exit;
             }
         }
         return $this->render('add',['model'=>$model]);
     }

}
