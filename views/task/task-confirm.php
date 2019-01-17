<?php /* @var $model \app\models\tables\Tasks */

use yii\helpers\Html;

?>

<p>Задача успешно создана:</p>

<ul>
    <li><label><?= $model->getAttributeLabel('title') ?></label>: <?= Html::encode($model->title) ?></li>
    <li><label><?= $model->getAttributeLabel('description') ?></label>:
        <?= Html::encode($model->description) ?></li>
    <li><label><?= $model->getAttributeLabel('responsible_id') ?></label>:
        <?= Html::encode($model->users->username) ?></li>
    <li><label><?= $model->getAttributeLabel('date') ?></label>: <?= Html::encode($model->date) ?></li>

</ul>