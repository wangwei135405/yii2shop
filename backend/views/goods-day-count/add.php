<?php
$form = \yii\widgets\ActiveForm::begin();
echo $form->field($model,'day');
echo $form->field($model,'count');
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\widgets\ActiveForm::end();