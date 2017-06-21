<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsDayCount;
use backend\models\GoodsIntro;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Request;
use yii\web\UploadedFile;

class GoodsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Goods::find();
        if($keyword=\Yii::$app->request->get('keyword')){
            $query->where(['like','name',$keyword]);
        }
        //分页 ，每页显示2条
        //获取所有分类


        //总条数  每页显示几条  当前第几页
        $total = $query->count();
        $page = new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>1,
        ]);

        //  limit 0,2 ===》 offset0 limit2  第一页，从0开始获取2条数据
        $goods = $query->offset($page->offset)->limit($page->limit)->all();

        return $this->render('index', ['goods' => $goods,'page'=>$page]);

    }

    public function actionAdd()
    {
        $model = new Goods();
        $request = new Request();
        if ($request->isPost) {
            $model->load($request->post());
            $model->imgFile = UploadedFile::getInstance($model, 'imgFile');
            if ($model->validate()) {
                if ($model->imgFile) {
                    $fileName = '/images/goods/' . uniqid() . '.' . $model->imgFile->extension;
                    $model->imgFile->saveAs(\Yii::getAlias('@webroot') . $fileName, false);
                    $model->logo = $fileName;
                }
                /*
                * 处理sn
                * 自动生成sn,规则为年月日+今天的第几个商品,比如201704010001
                *
                */
                $day = date('Y-m-d');
                $goodsCount = GoodsDayCount::findOne(['day'=>$day]);
                if($goodsCount==null){
                    $goodsCount = new GoodsDayCount();
                    $goodsCount->day = $day;
                    $goodsCount->count = 0;
                    $goodsCount->save();
                }
                //$goodsCount;
                //字符串长度补全
                //substr('000'.($goodsCount->count+1),-4,4);
                $model->sn = date('Ymd').sprintf("%04d",$goodsCount->count+1);
                $model->create_time = time();
                GoodsDayCount::updateAllCounters(['count'=>1],['day'=>$day]);
                $model->save();
                \Yii::$app->session->setFlash('success', '添加成功');
                return $this->redirect(['goods/index']);
            } else {
                var_dump($model->getErrors());
                exit;
            }
        }

        $brand_id = ArrayHelper::map(Brand::find()->asArray()->all(), 'id', 'name');
        $goods_category_id = ArrayHelper::merge([['id' => 0, 'name' => '顶级分类', 'parent_id' => 0]], GoodsCategory::find()->asArray()->all());
        return $this->render('add', ['model' => $model, 'brand_id' => $brand_id, 'goods_category_id' => $goods_category_id]);
    }

    public function actionDel($id)
    {
        $model = Goods::findOne(['id' => $id]);
        $model->delete();
        return $this->redirect(['goods/index']);
    }

    public function actionEdit($id)
    {
        $model = Goods::findOne(['id' => $id]);
        $request = new Request();
        if ($request->isPost) {
            $model->load($request->post());
            $model->imgFile = UploadedFile::getInstance($model, 'imgFile');
            if ($model->validate()) {
                if ($model->imgFile) {
                    $fileName = '/images/goods/' . uniqid() . '.' . $model->imgFile->extension;
                    $model->imgFile->saveAs(\Yii::getAlias('@webroot') . $fileName, false);
                    $model->logo = $fileName;
                }
                $model->create_time = time();
                $model->save();

                \Yii::$app->session->setFlash('success', '添加成功');

                return $this->redirect(['goods/index']);
            } else {
                var_dump($model->getErrors());
                exit;
            }
        }
        $brand_id = ArrayHelper::map(Brand::find()->asArray()->all(), 'id', 'name');
        $goods_category_id = ArrayHelper::merge([['id' => 0, 'name' => '顶级分类', 'parent_id' => 0]], GoodsCategory::find()->asArray()->all());
        return $this->render('add', ['model' => $model, 'brand_id' => $brand_id, 'goods_category_id' => $goods_category_id]);

    }

    public function actionIntro($id)
    {
        $goodsintro = GoodsIntro::findOne(['goods_id'=>$id]);//GoodsIntro::findOne(['good_id'=>$id]);
        $goods = Goods::findOne(['id'=>$id]);
        return $this->render('indexx',['goodsintro'=>$goodsintro,'goods'=>$goods]);
    }



//    public function actionUser()
//    {
//        $user = \Yii::$app->user;
//        var_dump($user->identity);
//        var_dump($user->id);
//        var_dump($user->isGuest);
//    }
//    public function actionLogin()
//    {
//        $model = new LoginForm();
//        $request = \Yii::$app->request;
//        if ($request->isPost) {
//            $model->load($request->post());
//            if ($model->validate()) {
//                //跳转到登录检测页
//
//                return $this->redirect(['goods/index']);
//
//            }
//        }
//
//
//        return $this->render('login', ['model' => $model]);
//
//    }
}
