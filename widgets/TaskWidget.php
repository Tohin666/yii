<?php

namespace app\widgets;

use yii\base\Widget;

class TaskWidget extends Widget
{
    public $label = 'Виджет!';
    public $model;

    // метод ран вызывается когда вызывается widget или end
    public function run()    {

        return $this->render('task', ['model' => $this->model]);
    }


}