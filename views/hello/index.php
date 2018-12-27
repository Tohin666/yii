<?php

use yii\helpers\Html;
use app\widgets\HelloWidget;

/* @var $message \app\controllers\HelloController */

?>
<?= \app\widgets\HelloWidget::widget(['message' => $message]) ?>

<?//= HelloWidget::begin() ?>
<!--<h1>Hell word!</h1>-->
<?//= HelloWidget::end() ?>

<?//= Html::encode($message) ?>