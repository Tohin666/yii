<?php /* @var $model \app\models\tables\Tasks */ ?>

<div class="task-container col-md-9">
    <div class="bg-info task-preview" style="
            /*background: #f5f5f5;*/
            border-radius: 10px;
            margin: 10px;
            padding: 20px 50px;
            /*max-width: 350px*/
    ">
        <h2><?= Yii::t("main", "TaskTitle") . $model->title ?></h2><br>
        <p><?= Yii::t("main", "TaskDescription") . $model->description ?></p><br>
        <h3><?= Yii::t("main", "TaskDate") . $model->date ?></h3>
        <h4><?= Yii::t("main", "TaskResponsible") . $model->users->username ?></h4><br>
        <h3><?= Yii::t("main", "TaskComments") ?></h3><br>
        <?php foreach ($model->comments as $comment): ?>
            <p>
                <i><?= $comment->created_at ?></i><br>
                <?= $comment->comment ?><br>
                <?php if ($comment->photo): ?>
                    <?= \yii\helpers\Html::a(
                        \yii\helpers\Html::img(\yii\helpers\Url::to(
                            "@web/img/small/" . $comment->photo, true)),
                        \yii\helpers\Url::to("@web/img/" . $comment->photo, true)
                    ) ?>
                <?php endif; ?>
            </p><br>
        <?php endforeach; ?>
        <br>
        <p>
            <?= \yii\helpers\Html::a(Yii::t("main", "TaskAddComment"),
                ['add-comment', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        </p>

    </div>

</div>


