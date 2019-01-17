<?php

namespace app\models;

use app\components\validators\MyValidator;
use yii\base\Model;

class Task extends Model
{
    public $id;
    public $title;
    public $description;
    public $responsible_id;
    public $date;
//    public $status;
//    public $start;
//    public $end;

    public function getId()
    {
        return $this->id;
    }

    public function rules()
    {
        return [
            [['title', 'responsible_id', 'date',], 'required'],
            [['title', 'description', 'date'], 'string'],
            ['responsible_id', 'number', 'min' => 0],
            ['title', 'default', 'value' => 'New Task'],
//            [['start', 'end'], 'app\components\validators\MyValidator']
//            [['start', 'end'], MyValidator::class]
//            // it's my validation. На js проверки не будет.
//            ['name', 'myValidate'],
//            [['start', 'end'], 'safe']
        ];

    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название задачи',
            'description' => 'Описание',
            'responsible_id' => 'Ответственный',
            'status' => 'Статус',
            'start' => 'Начало',
            'end' => 'Окончание'
        ];
    }

}