<?php

namespace app\controllers;

use app\models\ContactForm;
use yii\web\Controller;

class TaskController extends Controller
{

    public function actionIndex()
    {
//        \Yii::$app->request->get('id');

//        $model = new ContactForm();
//        $model->name = 5;
//
//        var_dump($model->validate());
//        var_dump($model->getErrors());
//        exit;

        return $this->render('index', [
            'title' => 'Yii2',
            'text' => 'Hell word!'
        ]);
    }
}