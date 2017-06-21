<?php
$form = \yii\widgets\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'imgFile')->fileInput()->label('');
echo $form->field($model,'goods_category_id')->hiddenInput();
echo ' <ul id="treeDemo" class="ztree"></ul>';
echo $form->field($model,'brand_id')->dropDownList($brand_id);
echo $form->field($model,'market_price');
echo $form->field($model,'shop_price');
echo $form->field($model,'stock');
echo $form->field($model,'is_on_sale')->radioList(['1'=>'正常','0'=>'下架']);
echo $form->field($model,'status')->radioList(['1'=>'正常','0'=>'回收']);
echo $form->field($model,'sort');
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\widgets\ActiveForm::end();
$this->registerCssFile('@web/zTree/css/zTreeStyle/zTreeStyle.css');
$this->registerJsFile('@web/zTree/js/jquery.ztree.core.js',['depends'=>\yii\web\JqueryAsset::className()]);
$zNodes=\yii\helpers\Json::encode($goods_category_id);
$js= new \yii\web\JsExpression(
    <<<JS
 var zTreeObj;
  // zTree 的参数配置，深入使用请参考 API 文档（setting 配置详解）
  var setting = {
    data: {
        simpleData: {
            enable: true,
     idKey: "id",
     pIdKey: "parent_id",
     rootPId: 0
    }
    },
    callback:{
    onClick:function(event, treeId, treeNode){
        //console.log(treeNode.id)
        $('#goods-goods_category_id').val(treeNode.id);
    }
    }

};
  // zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
  var zNodes = {$zNodes};

zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);

JS

);
$this->registerJs($js);
?>
