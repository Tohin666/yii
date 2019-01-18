<?php
/** @var \app\models\Upload $model */

$form = \yii\widgets\ActiveForm::begin();
echo $form->field($model, 'title')->textInput();
echo $form->field($model, 'content')->textInput();
// если есть поле fileInput, то он сам добавляет enctype="multipart/form-data
echo $form->field($model, 'file')->fileInput();
echo \yii\helpers\Html::submitButton('Send');
\yii\widgets\ActiveForm::end();