<?php

namespace app\controllers;

use app\models\Upload;
use yii\web\Controller;
use yii\web\UploadedFile;

class FileController extends Controller
{

    public function actionIndex()
    {
        $model = new Upload();

        // файлы через лоад не загружаются
        if ($model->load(\Yii::$app->request->post())) {
            // getInstance создает объект класса UploadedFile в котором будет содержаться информация о загруженном
            // файле, который пока находится во временной директории. По сути UploadedFile - это объектно-
            // ориентированное представление массива $_FILES
            // в методе  гетинстанс указываем модель и ее атрибут, к которому мы привязывались, и он сам по этой
            // привязке сформирует имя и найдет файл по этому имени (также как и метод field у ActiveForm)
            $model->file = UploadedFile::getInstance($model, 'file');
            // вызываем созданный нами метод upload в объекте Upload
            $model->upload();
        }

        return $this->render('index', ['model' => $model]);

    }


    public function actionI18n() {
        \Yii::$app->language = "ru";
//        echo \Yii::t("main", "error", ['number' => 404]);
        echo \Yii::t("main", 'cats', ['n' => 5]);
    }
}