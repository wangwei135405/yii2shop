<?php

namespace backend\controllers;

use backend\models\GoodsCategory;
use yii\helpers\ArrayHelper;
use yii\web\Request;

class GoodsCategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $goodscategory=GoodsCategory::find()->all();
        return $this->render('index',['goodscategory'=>$goodscategory]);
    }
//    public function actionTest(){
//        //一级分类
//        $jjj = new GoodsCategory();
//        $jjj->name='家用电器';
//        $jjj->parent_id=0;
//        $jjj->tree=1;
//        var_dump($jjj->makeRoot());
//        //二级分类
//    }

    public function actionZtree(){
        $categories = GoodsCategory::find()->asArray()->all();
        return $this->renderPartial('ztree',['categories'=>$categories]);
    }

    public function actionAdd(){
        $model = new GoodsCategory();
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                if($model->parent_id){
                    $parent=GoodsCategory::findOne(['id'=>$model->parent_id]);
                    $model->prependTo($parent);
                }else{
                    $model->makeRoot();
                }
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['goods-category/index']);

            }
        }
        $options =ArrayHelper::merge([['id'=>0,'name'=>'顶级分类','parent_id'=>0]],GoodsCategory::find()->asArray()->all());
        return $this->render('add',['model'=>$model,'options'=>$options]);
    }
}
