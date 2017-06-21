<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'label');
echo $form->field($model,'url');
echo $form->field($model,'parent_id')->dropDownList(\backend\models\Menu::options(),['prompt'=>'=请选择分类=']);;
echo $form->field($model,'sort');
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();