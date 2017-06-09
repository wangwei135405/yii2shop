<?php
$form = \yii\widgets\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'imgFile')->fileInput()->label('上传logo图片');
echo $form->field($model,'sort');
echo $form->field($model,'status')->radioList(['1'=>'正常','0'=>'隐藏']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\widgets\ActiveForm::end();