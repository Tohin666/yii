<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput(['value' => '2018-12-22 09:36:03']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'responsible_id')->dropDownList($userList,
        ['prompt' => 'Select Responsible']
    ) ?>

    <!--    --><? //= $form->field($model, 'responsible_id')->dropDownList(
    //        \app\models\tables\Users::find()->select(['username', 'id'])->indexBy('id')->column(),
    //        ['prompt' => 'Select Responsible']
    //    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
