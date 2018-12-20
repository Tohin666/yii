<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

    <h1>Создать новую задачу:</h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'description') ?>
<?= $form->field($model, 'responsible') ?>
<?= $form->field($model, 'status') ?>
<?= $form->field($model, 'start') ?>
<?= $form->field($model, 'end') ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>