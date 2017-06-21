<?php $form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'status')->radioList(\backend\models\ArticleCategory::$status_options);
echo $form->field($model,'sort');
echo $form->field($model,'is_help')->radioList(\backend\models\ArticleCategory::$is_help_options);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();