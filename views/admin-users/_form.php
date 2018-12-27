<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Users */
/* @var $form yii\widgets\ActiveForm */

//var_dump($model);
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authKey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accessToken')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role_id')->dropDownList(
            // Метод find объекта ActiveQuery подготавливает запрос. select делает выборку по колонкам role_id и id.
            // indexBy сопоставляет индексы массива, который вернул селект, с индетификаторами колонки id.
            // column выбирает только первую колонку.
            \app\models\tables\Roles::find()->select(['name', 'id'])->indexBy('id')->column(),
            ['prompt' => 'Select Role']
    ) ?>

<!--    --><?//= $form->field($model, 'role_id')->dropDownList(
//    // Метод find объекта ActiveQuery подготавливает запрос. select делает выборку по колонкам role_id и id.
//    // indexBy сопоставляет индексы массива, который вернул селект, с индетификаторами колонки id.
//    // column выбирает только первую колонку.
//        \app\models\tables\Roles::find()->select(['name', 'id'])->indexBy('id')->column(),
//        ['prompt' => 'Select Role']
//    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
