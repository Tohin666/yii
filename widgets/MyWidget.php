<?php

namespace app\widgets;

use yii\base\Widget;

class MyWidget extends Widget
{
    public $label = 'Виджет!';

    // метод ран вызывается когда вызывается widget или end
    public function run()
    {
        return $this->render('my', ['label' => $this->label]);
    }


}