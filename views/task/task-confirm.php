<?php

use yii\helpers\Html;

?>

<p>Задача успешно создана:</p>

<ul>
    <li><label>Name</label>: <?= Html::encode($model->name) ?></li>
    <li><label>Description</label>: <?= Html::encode($model->description) ?></li>
    <li><label>Responsible</label>: <?= Html::encode($model->responsible) ?></li>
    <li><label>Status</label>: <?= Html::encode($model->status) ?></li>
    <li><label>Start</label>: <?= Html::encode($model->start) ?></li>
    <li><label>End</label>: <?= Html::encode($model->end) ?></li>
</ul>