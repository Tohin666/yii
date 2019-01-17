<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

    <h1>Создать новую задачу:</h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'date')->textInput(['value' => '2019-01-16 09:36:03']) ?>

<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'responsible_id')->dropDownList($userList,
    ['prompt' => 'Select Responsible']
) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>