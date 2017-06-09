<?php

namespace backend\controllers;

use backend\models\Articlecategory;
use yii\web\Request;


class ArticlecategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $article = Articlecategory::find()->all();
        return $this->render('index',['article'=>$article]);
    }
    public function actionAdd()
    {
        $model = new Articlecategory();
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                return $this->redirect(['articlecategory/index']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionDel($id)
    {
        $model = Articlecategory::findOne(['id'=>$id]);
        $model->delete($id);
        return $this->redirect(['articlecategory/index']);
    }
    public function actionEdit($id)
    {
        $model = Articlecategory::findOne(['id'=>$id]);
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                return $this->redirect(['articlecategory/index']);
            }else{
                var_dump($model->getErrors());exit;
            }
        }
        return $this->render('add',['model'=>$model]);
    }
}
