<?php
$form = \yii\widgets\ActiveForm::begin();
echo $form->field($model,'username');
echo $form->field($model,'password')->passwordInput();
echo $form->field($model,'roles')->checkboxList(\backend\models\User::getroleoptions());
//echo $form->field($model,'sort');
echo $form->field($model,'status')->radioList(['1'=>'在线','0'=>'下线']);
echo $form->field($model,'email');
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\widgets\ActiveForm::end();