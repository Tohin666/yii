<?php

namespace app\controllers;

use yii\web\Controller;

class HelloController extends Controller
{

    public function actionIndex($message = 'Привет, Юзер!')
    {
        return $this->render('index', ['message' => $message]);
    }
}