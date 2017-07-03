<div style="clear:both;"></div>
<!-- 页面头部 start -->
<div class="header w990 bc mt15">
    <div class="logo w990">
        <h2 class="fl"><a href="index.html"><?=\yii\helpers\Html::img('@web/images/logo.png')?></a></h2>
        <div class="flow fr flow2">
            <ul>
                <li>1.我的购物车</li>
                <li class="cur">2.填写核对订单信息</li>
                <li>3.成功提交订单</li>
            </ul>
        </div>
    </div>
</div>
<!-- 页面头部 end -->
<form action="<?=\yii\helpers\Url::to(['shouye/flow2'])?>" method="post">
<!-- 主体部分 start -->
<div class="fillin w990 bc mt15">
    <div class="fillin_hd">
        <h2>填写并核对订单信息</h2>
    </div>
    <div class="fillin_bd">
        <!-- 收货人信息  start-->
        <div class="address">
            <h3>收货人信息</h3>
            <div class="address_info">
                <?php foreach($address as $ad):?>
                <p><input type="radio" value="<?=$ad->id?>" name="address_id" checked="checked" />
                    <?=$ad['name']?>
                    <?=$ad['provice']?>
                    <?=$ad['city']?>
                    <?=$ad['area']?>
                    <?=$ad['address']?>
                </p>
                <?php endforeach;?>
            </div>


        </div>
        <!-- 收货人信息  end-->

        <!-- 配送方式 start -->
        <div class="delivery">
            <h3>送货方式 </h3>


            <div class="delivery_select">
                <table>
                    <thead>
                    <tr>
                        <th class="col1">送货方式</th>
                        <th class="col2">运费</th>
                        <th class="col3">运费标准</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach(\frontend\models\Order::$delivery as $k=>$deliverys):?>
                    <tr class="cur">
                        <td>
                            <input type="radio" name="delivery_id" value="<?=$deliverys['id']?>" <?=$k ? '': 'checked="checked"' ?>/><?=$deliverys['name']?>
                        </td>
                        <td><?=$deliverys['price']?></td>
                        <td><?=$deliverys['info']?></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>

            </div>
        </div>
        <!-- 配送方式 end -->

        <!-- 支付方式  start-->
        <div class="pay">
            <h3>支付方式 </h3>


            <div class="pay_select">
                <table>
                    <?php foreach(\frontend\models\Order::$payment as $pay):?>
                    <tr class="cur">
                        <td class="col1"><input type="radio" name="payment_id" checked="checked" value="<?=$pay['id']?>"/><?=$pay['name']?>
                        </td></td>
                    <td class="col2"><?=$pay['info']?>
                    </td></td>
                    </tr>
                <?php endforeach;?>
                </table>

            </div>
        </div>
        <!-- 支付方式  end-->
        <!-- 商品清单 start -->
        <div class="goods">
            <h3>商品清单</h3>
            <table>
                <thead>
                <tr>
                    <th class="col1">商品</th>
                    <th class="col3">价格</th>
                    <th class="col4">数量</th>
                    <th class="col5">小计</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($models as $model):?>
                <tr>
                    <td class="col1"><a href=""><img src="<?=$model['logo']?>"/></a><strong><a href=""><?=$model['name']?></a></strong></td>
                    <td class="col3">￥<?=$model['market_price']?></td>
                    <td class="col4"> <?=$model['amount']?></td>
                    <td class="col5"><span><strong>￥<?=$model['market_price']*$model['amount'].'.00'?><span id="total"></span></strong></span></td>
                </tr>
                <?php endforeach;?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        <ul>
                            <li>
                                <span>4 件商品，总商品金额：</span>
                                <em>￥<?=$model['market_price']*$model['amount'].'.00'?></em>
                            </li>
                            <li>
                                <span>返现：</span>
                                <em>0</em>
                            </li>
                            <li>
                                <span>运费：</span>
                                <em>￥<?=$deliverys['price']?></em>
                            </li>
                            <li>
                                <span>应付总额：</span>
                                <em class="total">￥<?=$model['market_price']*$model['amount'].'.00'+$deliverys['price'].'.00'?></em>t
                                <input type="hidden" name="total" value="<?=$model['market_price']*$model['amount'].'.00'+$deliverys['price'].'.00'?>"/>
                            </li>
                        </ul>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- 商品清单 end -->

    </div>

    <div class="fillin_ft">
        <input type="hidden" name="_csrf-frontend" value="<?=Yii::$app->request->csrfToken?>" />
        <p>应付总额：<strong>￥<?=$model['market_price']*$model['amount'].'.00'+$deliverys['price'].'.00'?>元</strong></p>
        <span><input type="submit" value="提交订单"></span>
    </div>
</div>
<!-- 主体部分 end -->

</form>