<?php
namespace frontend\controllers;


use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsIntro;
use frontend\models\Address;
use frontend\models\Flow;
use frontend\models\Order;
use frontend\models\Ordergoods;
use yii\BaseYii;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\Cookie;
use Yii;
use yii\web\NotFoundHttpException;

class ShouyeController extends Controller
{

    public function actionIndex()
    {
        $this->layout = 'index';
        $categories = GoodsCategory::findAll(['parent_id' => 0]);
        return $this->render('index', ['categories' => $categories]);
    }

    public function actionList()
    {
        $this->layout = 'list';
        $lists = Goods::find()->all();
        return $this->render('list', ['lists' => $lists]);
    }

    public function actionGoods($id)
    {
        $this->layout = 'goods';
        $goods = Goods::findOne(['id' => $id]);
        return $this->render('goods', ['goods' => $goods]);
    }

    public function actionTest($id)
    {
        echo $id;
    }

//    public function actionFlow()
//    {
//        $this->layout = 'flow';
//        return $this->render('flow');
//    }

    //添加到购物车
    public function actionAdd()
    {
        $goods_id = Yii::$app->request->post('goods_id');
        $amount = Yii::$app->request->post('amount');
        $goods = Goods::findOne(['id' => $goods_id]);
        if ($goods == null) {
            throw new NotFoundHttpException('商品不存在');
        }
        if (Yii::$app->user->isGuest) {
            //未登录
            //先获取cookie中的购物车数据
            $cookies = Yii::$app->request->cookies;
            $cookie = $cookies->get('flow');
            if ($cookie == null) {
                //cookie中没有购物车数据
                $flow = [];
            } else {
                $flow = unserialize($cookie->value);
                //$flow = [2=>10];
            }


            //将商品id和数量存到cookie   id=2 amount=10  id=1 amount=3
            $cookies = Yii::$app->response->cookies;
            /*$flow=[
                ['id'=>2,'amount'=>10],['id'=>1,'amount'=>3]
            ];*/
            //检查购物车中是否有该商品,有，数量累加
            if (key_exists($goods->id, $flow)) {
                $flow[$goods_id] += $amount;
            } else {
                $flow[$goods_id] = $amount;
            }
//            $flow = [$goods_id=>$amount];
            $cookie = new Cookie([
                'name' => 'flow', 'value' => serialize($flow)
            ]);
            $cookies->add($cookie);


        } else {

            //已登录 操作数据库
            $goods = Flow::findOne(['member_id' => Yii::$app->user->getId(), 'goods_id' => $goods_id]);
            if ($goods) {
                $goods->amount += $amount;
                $goods->save();
            } else {
                $model = new Flow();
                $model->member_id = Yii::$app->user->getId();
                $model->goods_id = $goods_id;
                $model->amount = $amount;
                $model->save();
            }
        }
        return $this->redirect(['shouye/flow']);
    }

    //购物车
    public function actionFlow()
    {
        $this->layout = 'flow';
        if (Yii::$app->user->isGuest) {
            //取出cookie中的商品id和数量
            $cookies = Yii::$app->request->cookies;
            $cookie = $cookies->get('flow');
            if ($cookie == null) {
                //cookie中没有购物车数据
                $flow = [];
            } else {
                $flow = unserialize($cookie->value);
            }
            $models = [];
            foreach ($flow as $good_id => $amount) {
                $goods = Goods::findOne(['id' => $good_id])->attributes;
                $goods['amount'] = $amount;
                $models[] = $goods;
            }
            //var_dump($models);exit;

        } else {

            //从数据库获取购物车数据
            $cookies = Yii::$app->request->cookies;
            $cookie = $cookies->get('flow');
            if (!$cookie) {
                //cookie中没有购物车数据
                $flow = [];
                $member_carts = Flow::findAll(['member_id' => Yii::$app->user->getId()]);
                foreach ($member_carts as $member_cart) {
                    $flow[$member_cart->goods_id] = $member_cart->amount;
                }
            } else {
                $flow = unserialize($cookie->value);
                //$flow['12'] =3;

                foreach ($flow as $good_id => $amount) {
                    $goods = Flow::findOne(['member_id' => Yii::$app->user->getId(), 'goods_id' => $good_id]);
                    if ($goods) {
                        $goods->amount += $amount;
                        $goods->save();
                    } else {
                        $model = new Flow();
                        $model->member_id = Yii::$app->user->getId();
                        $model->goods_id = $good_id;
                        $model->amount = $amount;
                        $model->save();
                    }

                }
                $member_carts = Flow::findAll(['member_id' => Yii::$app->user->getId()]);
                foreach ($member_carts as $member_cart) {
                    $flow[$member_cart->goods_id] = $member_cart->amount;
                }
            }
            $models = [];
            foreach ($flow as $good_id => $amount) {
                $goods = Goods::findOne(['id' => $good_id])->attributes;
                $goods['amount'] = $amount;
                $models[] = $goods;
            }
            //保存到数据库成功删除cookie
            \yii::$app->response->cookies->remove('flow');
        }
        return $this->render('flow', ['models' => $models]);
    }

    public function actionUpdateFlow()
    {
        $goods_id = Yii::$app->request->post('goods_id');
        $amount = Yii::$app->request->post('amount');
        $goods = Goods::findOne(['id' => $goods_id]);
        if ($goods == null) {
            throw new NotFoundHttpException('商品不存在');
        }
        if (Yii::$app->user->isGuest) {
            //未登录
            //先获取cookie中的购物车数据
            $cookies = Yii::$app->request->cookies;
            $cookie = $cookies->get('flow');
            if ($cookie == null) {
                //cookie中没有购物车数据
                $flow = [];
            } else {
                $flow = unserialize($cookie->value);
                //$flow = [2=>10];
            }


            //将商品id和数量存到cookie   id=2 amount=10  id=1 amount=3
            $cookies = Yii::$app->response->cookies;
            /*$flow=[
                ['id'=>2,'amount'=>10],['id'=>1,'amount'=>3]
            ];*/
            //检查购物车中是否有该商品,有，数量累加
            /*if(key_exists($goods->id,$flow)){
                $flow[$goods_id] += $amount;
            }else{
                $flow[$goods_id] = $amount;
            }*/
            if ($amount) {
                $flow[$goods_id] = $amount;
            } else {
                if (key_exists($goods['id'], $flow)) unset($flow[$goods_id]);
            }

//            $flow = [$goods_id=>$amount];
            $cookie = new Cookie([
                'name' => 'flow', 'value' => serialize($flow)
            ]);
            $cookies->add($cookie);


        } else {
            //已登录  修改数据库里面的购物车数据
            $model = Flow::findOne(['member_id' => Yii::$app->user->getId(), 'goods_id' => $goods_id]);
            if ($amount) {
                $model->amount = $amount;
                $model->save();
            } else {
                $model->delete();
            }
        }

    }

    public function actionFlow1()
    {
        $this->layout = 'flow1';
        $flows = Flow::findAll(['member_id' => Yii::$app->user->id]);
        $address = Address::find()->where(['member_id'=>Yii::$app->user->id])->all();
        if (Yii::$app->user->isGuest) {
        return $this->redirect(['member/login']);
         }
        $models = [];
        foreach ($flows as $flow) {
            $goods = Goods::findOne(['id' => $flow->goods_id])->attributes;
            $goods['amount'] = $flow->amount;
            $models[] = $goods;
        }
        return $this->render('flow1', ['address' => $address, 'models' => $models]);

    }
    public function actionFlow2()
    {
        $this->layout = 'flow1';
        $this->layout ='flow2';
        if (\Yii::$app->request->isPost) {
            $address_id = \Yii::$app->request->post('address_id') - 0;
            //查询收货信息
            $address_info = Address::findOne(['id' => $address_id, 'member_id' => Yii::$app->user->id]);//查询出详细地址出来
            $order = new Order();
            $order->member_id = Yii::$app->user->id;
            $order->address = $address_info['address'];
            $order->tel = $address_info['tel']-0;
//            $order->delivery_id=1;
//            $order->payment_id=1;
//        $order->total=1000;
            //查询配送方式
            $delivery_id = \Yii::$app->request->post('delivery_id') - 0;
            $order->delivery_id = $delivery_id;
            $payment_id = \Yii::$app->request->post('payment_id') - 0;
            $order->payment_id = $payment_id;
//          foreach (Order::$delivery as $v){
//          if(($v['id']) == $delivery_id){
//                    $order->delivery_id = $v['id'];
////                  $order->delivery_price = $v['price'];
//                }
//            }
            //支付方式
//            $order->payment_id = $payment_id;
//            foreach (Order::$payment as $v){
//                if($v['id'] == $payment_id){
//                    $order->payment_id = $v['id'];
//                }
//            }
//            $total_decimal=\Yii::$app->request->post('total_decimal');
            //总额
            $total = \Yii::$app->request->post('total');
            $order->total = $total;
//            var_dump($order);
            //默认状态为待付款
            $order->status = 1;
//            //创建时间
            $order->create_time = time();
//            $order->save();
            $trancaction = \Yii::$app->db->beginTransaction();
            try{
                $order->save();
                //提交
                $id = \Yii::$app->user->id;
                $carts = Flow::find()->where(['member_id'=>$id])->all();
                foreach ($carts as $cart){
                    $goods = Goods::findOne(['id'=>$cart->goods_id,'status'=>1]);
                    if($goods==null){
                        throw  new Exception('商品不存在');
                    }
                    //如果需要的数量大于库存]
                    if ($cart->amount > $goods->stock){
                        throw new Exception('商品的数量不够');
                    }
                    $model = new Ordergoods();
                    $model->goods_id = $cart->goods_id;
                    $model->goods_name = $cart->goodsinfo->name;
                    $model->amount = $cart->amount;
                    $model->logo = $cart->goodsinfo->logo;
                    $model->price = $cart->goodsinfo->shop_price;
                    $model->total = $cart->amount*$cart->goodsinfo->shop_price;
                    $model->order_id = $order->id;
                    $model->save();
                }

                $trancaction->commit();
            }catch (Exception $e){
                $trancaction->rollBack();
                //回滚
            }
            return $this->redirect(['shouye/flow2']);
        }
        return $this->render('flow2');
    }
}