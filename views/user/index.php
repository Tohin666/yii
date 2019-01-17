<?php

use yii\helpers\Html;

?>

<h1>Мои задачи:</h1>



<?= \yii\widgets\ListView::widget([
    // коллекция моделей (тасков)
    'dataProvider' => $dataProvider,
    // каждую модель отдельно передает во вьюху
//    'itemView' => 'view',
    'itemView' => function ($model) { // модель на каждый таск приходит из датапровайдера
        return \app\widgets\TaskWidget::widget(['model' => $model]);
    },
    'summary' => false,
//    'options' => [
//            'class' => 'col-md-4'
//    ]

]); ?>





<?php
// Так кэшировать нельзя, потому что кэш должен быть разный для каждого юзера.

//$key = 'userTasks';
//
//if ($this->beginCache($key, [
//'duration' => 200, // по умолчанию 60 секунд
//'dependency' => [
//'class' => '\yii\caching\DbDependency',
//'sql' => 'SELECT MAX(updated_at) FROM tasks',
//],
//])) {
//
//echo \yii\widgets\ListView::widget([
//// коллекция моделей (тасков)
//'dataProvider' => $dataProvider,
//// каждую модель отдельно передает во вьюху
////    'itemView' => 'view',
//'itemView' => function ($model) { // модель на каждый таск приходит из датапровайдера
//return \app\widgets\TaskWidget::widget(['model' => $model]);
//},
//'summary' => false,
////    'options' => [
////            'class' => 'col-md-4'
////    ]
//
//]);
//
//$this->endCache();
//}

//?>