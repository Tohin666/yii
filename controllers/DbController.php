<?php

namespace app\controllers;

use app\models\tables\Tasks;
use app\models\tables\Users;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Country;

class DbController extends Controller
{
    public function actionIndex()
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

    public function actionAr()
    {
//        $model = new Tasks();
//        $model->title = 'Task2';
//        $model->description = 'This other desc';
//        $model->date = date("Y-m-d");
//        $model->responsible_id = 2;
//        $model->save();


//        $model = Tasks::findOne(2); // ищет по праймарики
//        $model = Tasks::findOne(['title' => 'Task1']);
//        var_dump($model);
//        var_dump(Tasks::findAll([1,2,4])); // работатет только так
//        var_dump(Tasks::find()->all()); // а так выбрать все


//        $model = new Users();
//        $model->username = 'Petya';
//        $model->password = 'parol';
//        $model->save();

    }

    public function actionFind()
    {
//        $tasks = Tasks::findOne(2);
//        var_dump($tasks->test); // связь по test прописали в классе Tasks

//        // присоединит данные из test
//        $tasks = Tasks::find()
//            ->with("test")
//            ->all();

        $tasks = Tasks::find()
            ->with("users")
            ->all();
        var_dump($tasks);
    }




}