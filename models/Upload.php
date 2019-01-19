<?php

namespace app\models;

use yii\base\Model;
use yii\imagine\Image;
use yii\web\UploadedFile;

class Upload extends Model
{

    public $title;
    public $content;
    /** @var UploadedFile */
    public $file; // атрибут в который мы будем подгружать данные о загруженном файле (это будет экземпляр UploadedFile)

    public function rules()
    {
        return [
            [['title', 'content'], 'safe'],
            [['file'], 'file', 'extensions' => 'png, jpg']
        ];
    }

    public function upload()
    {
        // проверяем что соответствует правилам указанным выше
        if ($this->validate()) {
            // формируем имя файла
            $filename = $this->file->getBaseName() . "." . $this->file->getExtension();
            $filenameWithPath = \Yii::getAlias("@img/{$filename}");
            // и сохраняем в папке с картинками
            $this->file->saveAs($filenameWithPath);

            // чтобы создать уменьшенную копию обращаемся к классу имедж именно из yii\imagine
            Image::thumbnail($filenameWithPath, 100, 100)
                ->save(\Yii::getAlias("@img/small/{$filename}"));

            return $filename;
        }


    }
}