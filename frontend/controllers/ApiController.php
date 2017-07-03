<?php
namespace frontend\controllers;

use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\Goods;
use backend\models\GoodsCategory;
use frontend\models\Address;
use frontend\models\Flow;
use frontend\models\Member;
use frontend\models\Order;
use yii\console\Request;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;

class ApiController extends Controller
{
    public $enableCsrfValidation = false;

    public function init()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;//\Yii::$app->response->format = Response::FORMAT_JSON;
        parent::init();//parent::init();
    }

    public function actionGetGoodsCategory()
    {
        if ($Goods_category_id = \Yii::$app->request->get('Goods_category_id')) {
            $goods = Goods::find()->where(['Goods_category_id' => $Goods_category_id])->asArray()->all();
            return ['status' => 1, 'msg' => '', 'data' => $goods];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }

    public function actionGetGoodsBrand()
    {
        if ($brand_id = \Yii::$app->request->get('brand_id')) {
            $goods = Goods::find()->where(['brand_id' => $brand_id])->asArray()->all();
            return ['status' => 1, 'msg' => '', 'data' => $goods];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }

    public function actionUserRegister()
    {
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $member = new Member();
            $member->username = $request->post('username');
            $member->password = $request->post('password');
//                $member->email = $request->post('email');
            $member->repassword = $request->post('repassword');
//                $member->tel = $request->post('tel');
            $member->auth_key = \Yii::$app->security->generateRandomString();
            $member->password_hash = \Yii::$app->security->generatePasswordHash($member->password);
            if ($member->validate()) {
                $member->save();
                return ['status' => '1', 'msg' => '', 'data' => $member->toArray()];
            }
            //验证失败
            return ['status' => '-1', 'msg' => $member->getErrors()];
        }
        return ['status' => '-1', 'msg' => '请使用post请求'];
    }

    public function actionUserLogin()
    {
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $user = Member::findOne(['username' => $request->post('username')]);
            if ($user && \Yii::$app->security->validatePassword($request->post('password'), $user->password_hash)) {
                \Yii::$app->user->login($user);
                return ['status' => '1', 'msg' => '登录成功'];
            }
            return ['status' => '-1', 'msg' => '账号或密码错误'];
        }
        return ['status' => '-1', 'msg' => '请使用post请求'];
    }

    public function actionUserMessage()
    {
        $request = \Yii::$app->request;
        if (\Yii::$app->user->isGuest) {
            return ['status' => '-1', 'msg' => '请先登录'];
        }
        return ['status' => '1', 'msg' => '', 'data' => \Yii::$app->user->identity->toArray()];

    }

    public function actionAddAddress()
    {
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $address = new Address();
            $address->name = $request->post('name');
            $address->address = $request->post('address');
            $address->tel = $request->post('tel');
            $address->member_id = $request->post('member_id');
            $address->provice = $request->post('provice');
            $address->city = $request->post('city');
            $address->area = $request->post('area');
            if ($address->validate()) {
                $address->save();
                return ['status' => '1', 'msg' => '', 'data' => $address->toArray()];
            }
            //验证失败
            return ['status' => '-1', 'msg' => $address->getErrors()];
        }
        return ['status' => '-1', 'msg' => '请使用post请求'];
    }

    public function actionEditAddress()
    {
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $address = Address::findOne(['id' => \Yii::$app->request->get('id')]);
            $address->name = $request->post('name');
            $address->address = $request->post('address');
            $address->tel = $request->post('tel');
            $address->member_id = $request->post('member_id');
            $address->provice = $request->post('provice');
            $address->city = $request->post('city');
            $address->area = $request->post('area');
            if ($address->validate()) {
                $address->save();
                return ['status' => '1', 'msg' => '', 'data' => $address->toArray()];
            }
            return ['status' => '-1', 'msg' => $address->getErrors()];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }

    public function actionDelAddress()
    {
        $request = \Yii::$app->request;
        if ($request->isGet) {
            $address = Address::findOne(['id' => \Yii::$app->request->get('id')]);
            $address->delete();
            return ['status' => '1', 'msg' => '删除成功'];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }

    public function actionUserAddress()
    {
        if ($member_id = \Yii::$app->request->get('member_id')) {
            $address = Address::find()->where(['member_id' => $member_id])->asArray()->all();
            return ['status' => 1, 'msg' => '', 'data' => $address];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }

    public function actionGoodsCategorys()
    {
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $goodscategory = GoodsCategory::find()->asArray()->all();
            return ['status' => 1, 'msg' => '', 'data' => $goodscategory];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }

    public function actionGoodsCategoryson()
    {
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $goodcategory = GoodsCategory::find()->where(['parent_id' => \Yii::$app->request->get('parent_id')])->asArray()->all();
            return ['status' => 1, 'msg' => '', 'data' => $goodcategory];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }

    public function actionGoodsCategoryparent()
    {
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $goodcategory = GoodsCategory::find()->where(['parent_id' => \Yii::$app->request->get('id')])->asArray()->all();
            return ['status' => 1, 'msg' => '', 'data' => $goodcategory];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }
    public function actionGetArticleCategory(){
        $request = \Yii::$app->request;
        if($request->isGet){
            $articlecategory = ArticleCategory::find()->asArray()->all();
            return ['status' => 1, 'msg' => '', 'data' => $articlecategory];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }
    public function actionGetArticle()
    {
        $request = \Yii::$app->request;
        if ($request->isGet) {
            $article = Article::find()->where(['article_category_id' => \Yii::$app->request->get('article_category_id')])->asArray()->all();
            return ['status' => 1, 'msg' => '', 'data' => $article];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }

    public function actionGetCategory()
    {
        $request = \Yii::$app->request;
        if ($request->isGet) {
            $article = Article::find()->where(['id' => \Yii::$app->request->get('id')])->asArray()->all();
            return ['status' => 1, 'msg' => '', 'data' => $article];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }
    public function actionAddFlow()
    {
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $flow = new Flow();
            $flow->id = \Yii::$app->request->post('id');
            $flow->member_id = \Yii::$app->request->post('member_id');
            $flow->goods_id = \Yii::$app->request->post('goods_id');
            $flow->amount = \Yii::$app->request->post('amount');
            if($flow->validate()){
                $flow->save();
                return ['status' => '1', 'msg' => '添加成功', 'data' => $flow->toArray()];
            }
            return ['status' => 1, 'msg' => '修改成功', 'data' => $flow];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }
    public function actionEditFlow(){
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $flow = Flow::findOne(['id'=>\Yii::$app->request->get('id')]);
            $flow->amount = \Yii::$app->request->post('amount');
            if($flow->validate()){
                $flow->save();
                return ['status' => '1', 'msg' => '', 'data' => $flow->toArray()];
            }
            return ['status' => 1, 'msg' => '', 'data' => $flow];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }
    public function actionDelFlow(){
        $request = \Yii::$app->request;
        if ($request->isGet) {
            $flow = Flow::findOne(['id'=>\Yii::$app->request->get('id')]);
            $flow->delete();
            return ['status' => 1, 'msg' => '删除成功', 'data' => $flow];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }
    public function actionDelAllFlow(){
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $flow = new Flow();
            $flow->deleteAll();
            return ['status' => 1, 'msg' => '删除成功', 'data' => $flow];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }
    public function actionGetFlow(){
        $request = \Yii::$app->request;
        if ($request->isGet) {
            $flow = Flow::find()->asArray()->all();
            return ['status' => 1, 'msg' => '获取成功', 'data' => $flow];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
        }
    public function actionGetPayment(){
        $request = \Yii::$app->request;
        if($request->isGet){
            $order = Order::find()->where(['payment_id'=>\Yii::$app->request->get('payment_id')])->asArray()->all();
            return ['status' => 1, 'msg' => '获取成功', 'data' => $order];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
        }
    public function actionGetDelivery(){
        $request = \Yii::$app->request;
        if($request->isGet){
            $order = Order::find()->where(['delivery_id'=>\Yii::$app->request->get('delivery_id')])->asArray()->all();
            return ['status' => 1, 'msg' => '获取成功', 'data' => $order];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }
    public function actionSubmitOrder(){
        $request = \Yii::$app->request;
        if($request->isPost){
            $order = new Order();
            $order->id=\Yii::$app->request->get('id');
            $order->member_id=\Yii::$app->request->get('member_id');
            $order->address=\Yii::$app->request->get('address');
            $order->tel=\Yii::$app->request->get('tel');
            $order->delivery_id=\Yii::$app->request->get('delivery_id');
            $order->payment_id=\Yii::$app->request->get('payment_id');
            $order->total=\Yii::$app->request->get('total');
            $order->status=\Yii::$app->request->get('status');
            if($order->validate()){
                $order->save();
                return ['status' => '1', 'msg' => '', 'data' => $order->toArray()];
            }
            return ['status' => 1, 'msg' => '提交成功', 'data' => $order];
        }
            return ['status' => -1, 'msg' => '参数不正确'];
    }
    public function actionGetOrderMember(){
        $request = \Yii::$app->request;
        if($request->isGet){
            $order = Order::find()->where(['member_id'=>\Yii::$app->request->get('member_id')])->asArray()->all();
            return ['status'=>'1','msg'=>'','data'=>$order];
        }
        return ['status' => -1, 'msg' => '参数不正确'];
    }
}