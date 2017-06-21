<?php
//使用表单组件创建表单
$from = \yii\bootstrap\ActiveForm::begin();//表单开始
//姓名  $from->field(（表单）模型,'字段名')->textInput() <input type='text'
echo $from->field($model,'username')->textInput()/*->label('')*/;
echo $from->field($model,'password')->passwordInput()/*->label('')*/;
echo $from->field($model,'remember')->checkbox();
//echo $from->field($model,'code')->widget(\yii\captcha\Captcha::className(),[
//    'template'=>'<div class="row"><div class="col-lg-2">{input}</div><div class="col-lg-1">{image}</div></div>'
//])->label('');
echo \yii\bootstrap\Html::submitInput('登录',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();//表单结束