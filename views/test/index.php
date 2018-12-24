<?php
/** @var \app\models\tables\Test $model */

$form = \yii\widgets\ActiveForm::begin(['id' => 'testForm']);
echo $form->field($model, 'title')->textInput();
echo $form->field($model, 'content')->textarea();
echo \yii\helpers\Html::submitButton("Go", ['class' => ['btn btn-success']]);
\yii\widgets\ActiveForm::end();