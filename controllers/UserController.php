<?php

namespace app\controllers;


use app\models\tables\Tasks;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class UserController extends Controller
{
    function actionIndex()
    {
//        var_dump(\Yii::$app->user->id);

        if ($id = \Yii::$app->user->id) {
            // если юзер залогинен
            $dataProvider = new ActiveDataProvider([
                'query' => Tasks::find()->where(['responsible_id' => $id])
            ]);

            // кэшируем датапровайдер, чтобы для каждого юзера кэшировался свой список задач
            \Yii::$app->db->cache(function () use ($dataProvider) {
                // подготавливает данные
                return $dataProvider->prepare();
            });

            return $this->render('index', [
                'dataProvider' => $dataProvider
            ]);

        }

        return $this->redirect(['site/login']);


    }

}