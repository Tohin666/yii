<?php

namespace app\controllers;

use app\models\tables\Test;
use yii\web\Controller;

class TestController extends Controller
{

    public function actionIndex()
    {
        $model = new Test();
        return $this->render('index', ['model' => $model]);
    }
}