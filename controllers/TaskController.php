<?php

namespace app\controllers;

use app\models\ContactForm;
use yii\web\Controller;

class TaskController extends Controller
{

    public function actionIndex()
    {
//        \Yii::$app->request->get('id');

        $model = new ContactForm();

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

        return $this->render('index', [
            'title' => 'Yii2',
            'text' => 'Hell word!'
        ]);
    }
}