<?php

namespace app\controllers;


use yii\web\Controller;

class CacheController extends Controller
{
    public function actionIndex()
    {
        // получаем доступ к компоненту
        $cache = \Yii::$app->cache;
        // ключ по которому данные будут лежать в кэше
        $key = 'number';

        // получаем данные по ключу, если они там есть
        if ($cache->exists($key)){
            $number = $cache->get($key);
        } else {
            // если данных в кэше нет, то генерируем их и сохраняем в кэш
            $number = rand();
            $cache->set($key, $number, 10);
        }



        var_dump($number);
        exit;
    }

}