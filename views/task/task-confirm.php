<?php

use yii\helpers\Html;

?>

<p>Задача успешно создана:</p>

<ul>
    <li><label><?= $model->getAttributeLabel('title') ?></label>: <?= Html::encode($model->title) ?></li>
    <li><label><?= $model->getAttributeLabel('description') ?></label>:
        <?= Html::encode($model->description) ?></li>
    <li><label><?= $model->getAttributeLabel('responsible_id') ?></label>:
        <?= Html::encode($model->responsible_id) ?></li>
    <li><label><?= $model->getAttributeLabel('status') ?></label>: <?= Html::encode($model->status) ?></li>
    <li><label><?= $model->getAttributeLabel('start') ?></label>: <?= Html::encode($model->start) ?></li>
    <li><label><?= $model->getAttributeLabel('end') ?></label>: <?= Html::encode($model->end) ?></li>
</ul>