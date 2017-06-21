<?php $form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($article,'name');
echo $form->field($article,'article_category_id')->dropDownList(\backend\models\Article::getCategoryOptions(),['prompt'=>'=请选择分类=']);
echo $form->field($article,'intro')->textarea();
echo $form->field($article,'status')->radioList(\backend\models\Article::$status_options);
echo $form->field($article,'sort');

echo $form->field($article_detail,'content')->textarea();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();