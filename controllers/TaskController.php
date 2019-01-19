<?php

namespace app\controllers;

use app\models\tables\Comments;
use app\models\tables\Tasks;
use app\models\tables\Users;
use app\models\Task;
use app\models\Upload;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;

class TaskController extends Controller
{

    public function actionIndex()
    {

        if ($post = \Yii::$app->request->post()) {
            // если делаем фильтр по месяцам
            $query = Tasks::find()->where(['YEAR(date)' => $post['year'], 'MONTH(date)' => $post['month']]);
//            $query = Tasks::find()->where(['like', 'date', $post['year'] . '-' . $post['month']]);
        } else {
            $query = Tasks::find();
        }

        // подготавливаем датапровайдер для списка тасков (листвью)
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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

//        $task = Tasks::findOne($id);
//        $comments = Comments::find()->where(['task_id' => $id])->all();
//        var_dump($comments);exit;
//
//        return $this->render('view', ['model' => $model]);
    }


    public function actionAddComment()
    {
        $taskId = \Yii::$app->request->get('id');

        $model = new Comments();

//        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->task_id]);
//        }

        if ($model->load(\Yii::$app->request->post())) {

            if ($file = UploadedFile::getInstance($model, 'photo')) {
                $uploadModel = new Upload();
                $uploadModel->file = $file;
                $filename = $uploadModel->upload();
                $model->photo = $filename;
            }

                $model->save();


            return $this->redirect(['view', 'id' => $model->task_id]);
        }



        return $this->render('add-comment', ['model' => $model, 'taskId' => $taskId]);
    }


    public function actionCreate()
    {
        $model = new Tasks();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {

            // если отправлены данные и они успешно приняты, то перенаправляем на страницу успешного подтверждения.
            return $this->render('task-confirm', ['model' => $model]);

        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('create', [
                'model' => $model,
                'userList' => Users::getUsersList(), // получаем и передаем дополнительно наш список пользователей в шаблон
                // create,а там еще раз передаем в шаблон _form
            ]);
        }
    }

}