<?php /* @var $model \app\models\tables\Tasks */ ?>

<div class="task-container col-md-9">


        <div class="bg-info task-preview" style="
            /*background: #f5f5f5;*/
            border-radius: 10px;
            margin: 10px;
            padding: 20px 50px;
            /*max-width: 350px*/
    ">
            <h2>Задача: <?= $model->title ?></h2><br>
            <p>Описание: <?= $model->description ?></p><br>
            <h3>Дата: <?= $model->date ?></h3>
            <h4>Ответственный: <?= $model->users->username ?></h4><br>
        </div>

</div>


