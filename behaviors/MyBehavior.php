<?php

namespace app\behaviors;

use yii\base\Behavior;

class MyBehavior extends Behavior
{

    public $message = "Сообщение по умолчанию!";

    public function foo()
    {
        echo $this->message;
    }
}