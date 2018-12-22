<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Country;

class DbController extends Controller
{
    function actionIndex()
    {
//        \Yii::$app->db->createCommand("
//            INSERT INTO test (title, content) VALUES ('newtitle', 'newcont')
//            ")->execute();

//        $result = \Yii::$app->db->createCommand("
//            SELECT * FROM test WHERE id = :id
//        ")->bindValue(":id", 2)->queryOne();

//

//        $result = \Yii::$app->db->createCommand("
//            SELECT COUNT(*) FROM test
//        ")->queryScalar();


//        // получаем все строки из таблицы "country" и сортируем их по "name"
//        $countries = Country::find()->orderBy('name')->all();
//
//        // получаем строку с первичным ключом "US"
//        $country = Country::findOne('US');
//
//        // отобразит "United States"
//        echo $country->name;

//        // меняем имя страны на "U.S.A." и сохраняем в базу данных
//        $country->name = 'U.S.A.';
//        $country->save();

//        var_dump($countries);exit;


        $query = Country::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);



    }

}