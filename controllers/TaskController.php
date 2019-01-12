<?php

namespace app\controllers;

use app\models\tables\Tasks;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class TaskController extends Controller
{

    public function actionIndex()
    {

//        $model = new Task();
//
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//
//            return $this->render('task-confirm', ['model' => $model]);
//
//        } else {
//            // либо страница отображается первый раз, либо есть ошибка в данных
//            return $this->render('index', ['model' => $model]);
//        }


        // подготавливаем датапровайдер для списка тасков (листвью)
        $dataProvider = new ActiveDataProvider([
            'query' => Tasks::find()
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);


//        return $this->render('index', [
//            'title' => 'Tasks',
//            'text' => 'Hell word!'
//        ]);

//        \Yii::$app->request->get('id');

//        // Каждый объект можно проинициализировать передав в конструктор массив с именами атрибутов и значениями.
//        $model = new ContactForm([
//            'name' => 'namedfadsdf',
//            'email' => 'emailsdfasdf',
//            'subject' => 'subgasdfasdf'
//        ]);
//        // тоже самое можно сделать после. Массив должен строго совпадать.
//        $model->setAttributes([
//            'name' => 'namedfadsdf',
//            'email' => 'emailsdfasdf',
//            'subject' => 'subgasdfasdf'
//        ]);
//        // тоже самое, только ищет и подставляем совпадения в указанном объекте. Массив может быть любым. Будут
//        // загружены только те атрибуты, на которые назначена валидация. Если надо загрузить атрибут без валидатора,
//        // то надо на него назначить валидатор safe.
//        $model->load([
//           'ContactForm' =>
//               [
//                   'name' => 'namedfadsdf',
//                   'email' => 'emailsdfasdf',
//                   'subject' => 'subgasdfasdf'
//               ],
//            'SomeOtherForm' => ['someData']
//        ]);


    }


    public function actionView($id)
    {
        $model = Tasks::findOne($id);

        return $this->render('view', ['model' => $model]);
    }

}