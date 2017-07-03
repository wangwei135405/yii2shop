<!-- 页面主体 start -->
<div class="main w1210 bc mt10">
    <div class="crumb w1210">
        <h2><strong>我的XX </strong><span>> 我的订单</span></h2>
    </div>

    <!-- 左侧导航菜单 start -->
    <div class="menu fl">
        <h3>我的XX</h3>
        <div class="menu_wrap">
            <dl>
                <dt>订单中心 <b></b></dt>
                <dd><b>.</b><a href="">我的订单</a></dd>
                <dd><b>.</b><a href="">我的关注</a></dd>
                <dd><b>.</b><a href="">浏览历史</a></dd>
                <dd><b>.</b><a href="">我的团购</a></dd>
            </dl>

            <dl>
                <dt>账户中心 <b></b></dt>
                <dd class="cur"><b>.</b><a href="">账户信息</a></dd>
                <dd><b>.</b><a href="">账户余额</a></dd>
                <dd><b>.</b><a href="">消费记录</a></dd>
                <dd><b>.</b><a href="">我的积分</a></dd>
                <dd><b>.</b><a href="">收货地址</a></dd>
            </dl>

            <dl>
                <dt>订单中心 <b></b></dt>
                <dd><b>.</b><a href="">返修/退换货</a></dd>
                <dd><b>.</b><a href="">取消订单记录</a></dd>
                <dd><b>.</b><a href="">我的投诉</a></dd>
            </dl>
        </div>
    </div>
    <!-- 左侧导航菜单 end -->

    <!-- 右侧内容区域 start -->
    <div class="content fl ml10">
        <div class="address_hd">
            <h3>收货地址薄</h3>
            <dl>
                <?php foreach($address as $r):?>
                <dt><?=$r->id?> <?=$r->name?> <?=$r->provice?><?=$r->city?><?=$r->area?> <?=$r->member_id?></dt>
                <dd>
                    <a href="<?=\yii\helpers\Url::to(['edit','id'=>$r->id])?>">修改</a>
                    <a href="">删除</a>
                    <a href="">设为默认地址</a>
                </dd>
                <?php endforeach;?>
            </dl>
<!--            <dl class="last"> <!-- 最后一个dl 加类last -->
<!--                <dt>2.许坤 四川省 成都市 高新区 仙人跳大街 17002810530 </dt>-->
<!--                <dd>-->
<!--                    <a href="">修改</a>-->
<!--                    <a href="">删除</a>-->
<!--                    <a href="">设为默认地址</a>-->
<!--                </dd>-->
<!--            </dl>-->

        </div>

        <div class="address_bd mt10">
            <h4>新增收货地址</h4>
            <?php $form = \yii\widgets\ActiveForm::begin(['fieldConfig'=>[
                'options'=>[
                    'tag'=>'li',
                ],
                'errorOptions'=>[
                    'tag'=>'p'
                ]
            ]])?>
            <ul>
                <?=$form->field($model,'name')->textInput(['class'=>'txt']);?>
                <li><label for="">所在地区：</label>
                    <?=$form->field($model,'provice',['template' => "{input}",'options'=>['tag'=>false]])->dropDownList([''=>'=选择省=']);?>
                    <?=$form->field($model,'city',['template' => "{input}",'options'=>['tag'=>false]])->dropDownList([''=>'=选择市=']);?>
                    <?=$form->field($model,'area',['template' => "{input}",'options'=>['tag'=>false]])->dropDownList([''=>'=选择县=']);?>
                </li>

                <?=$form->field($model,'address')->textInput(['class'=>'txt']);?>
                <?=$form->field($model,'tel')->textInput(['class'=>'txt']);?>
                <?=$form->field($model,'status')->checkbox();?>
                <li>
                    <label for="">&nbsp;</label>
                    <input type="submit" name="" class="btn" value="保存" />
                </li>
            </ul>

            <?php \yii\widgets\ActiveForm::end();?>
<!--            <form action="" name="address_form">-->
<!--                <ul>-->
<!--                    <li>-->
<!--                        <label for=""><span>*</span>收 货 人：</label>-->
<!--                        <input type="text" name="" class="txt" />-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <label for=""><span>*</span>所在地区：</label>-->
<!--                        <select name="" id="">-->
<!--                            <option value="">请选择</option>-->
<!--                            <option value="">北京</option>-->
<!--                            <option value="">上海</option>-->
<!--                            <option value="">天津</option>-->
<!--                            <option value="">重庆</option>-->
<!--                            <option value="">武汉</option>-->
<!--                        </select>-->
<!---->
<!--                        <select name="" id="">-->
<!--                            <option value="">请选择</option>-->
<!--                            <option value="">朝阳区</option>-->
<!--                            <option value="">东城区</option>-->
<!--                            <option value="">西城区</option>-->
<!--                            <option value="">海淀区</option>-->
<!--                            <option value="">昌平区</option>-->
<!--                        </select>-->
<!---->
<!--                        <select name="" id="">-->
<!--                            <option value="">请选择</option>-->
<!--                            <option value="">西二旗</option>-->
<!--                            <option value="">西三旗</option>-->
<!--                            <option value="">三环以内</option>-->
<!--                        </select>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <label for=""><span>*</span>详细地址：</label>-->
<!--                        <input type="text" name="" class="txt address"  />-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <label for=""><span>*</span>手机号码：</label>-->
<!--                        <input type="text" name="" class="txt" />-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <label for="">&nbsp;</label>-->
<!--                        <input type="checkbox" name="" class="check" />设为默认地址-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <label for="">&nbsp;</label>-->
<!--                        <input type="submit" name="" class="btn" value="保存" />-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </form>-->
        </div>

    </div>
    <!-- 右侧内容区域 end -->
</div>
<!-- 页面主体 end-->
<?php
/**
 * @var $this \yii\web\View
 */
$this->registerCssFile('@web/style/address.css');
$this->registerJsFile('@web/js/address.js');
$this->registerJs(new \yii\web\JsExpression(
    <<<JS
    //填充省的数据
    $(address).each(function(){
        //console.log(this.name);
        var option = '<option value="'+this.name+'">'+this.name+'</option>';
        $("#address-provice").append(option);
    });
    //切换（选中）省，读取该省对应的市，更新到市下拉框
    $("#address-provice").change(function(){
        var provice = $(this).val();//获取当前选中的省
        //console.log(province);
        //获取当前省对应的市 数据
        $(address).each(function(){
            if(this.name == provice){
                var option = '<option value="">=请选择市=</option>';
                $(this.city).each(function(){
                    option += '<option value="'+this.name+'">'+this.name+'</option>';
                });
                $("#address-city").html(option);
            }
        });
        //将县的下拉框数据清空
        $("#address-area").html('<option value="">=请选择县=</option>');
    });
    //切换（选中）市，读取该市 对应的县，更新到县下拉框
    $("#address-city").change(function(){
        var city = $(this).val();//当前选中的城市
        $(address).each(function(){
            if(this.name == $("#address-provice").val()){
                $(this.city).each(function(){
                    if(this.name == city){
                        //遍历到当前选中的城市了
                        var option = '<option value="">=请选择县=</option>';
                        $(this.area).each(function(i,v){
                            option += '<option value="'+v+'">'+v+'</option>';
                        });
                        $("#address-area").html(option);
                    }
                });
            }
        });
    });
JS

));
$js = '';
if($model->provice){
    $js .= '$("#address-province").val("'.$model->provice.'");';
}
if($model->city){
    $js .= '$("#address-province").change();$("#address-city").val("'.$model->city.'");';
}
if($model->area){
    $js .= '$("#address-city").change();$("#address-county").val("'.$model->area.'");';
}
$this->registerJs($js);