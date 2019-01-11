<?php

namespace app\actions;

use yii\base\Action;

class HelloAction extends Action
{
    // переопределяем ран
    public function run()
    {
        echo "Hello world!!";
    }

}