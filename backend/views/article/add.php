<?php
$form = \yii\widgets\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'article_category_id')->dropDownList(\backend\models\Article::cate_id(),['prompt'=>'=请选择分类=']);
echo $form->field($model,'sort');
echo $form->field($model,'status')->radioList(['1'=>'正常','0'=>'隐藏']);
echo $form->field($model,'create_time');
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\widgets\ActiveForm::end();