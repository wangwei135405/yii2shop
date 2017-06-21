<?php

namespace backend\controllers;

use backend\models\Menu;

class MenuController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $menus = Menu::find()->all();
        return $this->render('index',['menus'=>$menus]);
    }
    public function actionAdd(){
        $model = new Menu();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            if($model->parent_id == null){
                $model->parent_id=0;
            }
            $model->save();
            return $this->redirect(['menu/index']);
        }
        return $this->render('add',['model'=>$model]);

    }
    public function actionDel($id){
        $model = Menu::findOne(['id'=>$id]);
        $model->delete();
        return $this->redirect(['menu/index']);
    }
    public function actionEdit($id){
        $model = Menu::findOne(['id'=>$id]);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->save();
            return $this->redirect(['menu/index']);
        }
        return $this->render('add',['model'=>$model]);

    }

}
