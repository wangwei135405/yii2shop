<?php

namespace backend\controllers;


use backend\models\ArticleCategory;


class ArticleCategoryController extends \yii\web\Controller
{
    /*
     * 文章分类列表
     */
    public function actionIndex()
    {
        $models = ArticleCategory::find()->all();
        return $this->render('index',['models'=>$models]);
    }


    public function actionAdd()
    {
        $model = new ArticleCategory();
        if($model->load(\Yii::$app->request->post()) && $model->save()){
            \Yii::$app->session->setFlash('文章分类添加成功');
            return $this->redirect(['index']);
        }
        return $this->render('add',['model'=>$model]);
    }

}

