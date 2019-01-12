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
    public $status;
    public $start;
    public $end;

    public function getId()
    {
        return $this->id;
    }

    public function rules()
    {
        return [
            [['title', 'responsible_id', 'start',], 'required'],
            [['title', 'description', 'status'], 'string'],
            ['responsible_id', 'number', 'min' => 0],
            ['status', 'default', 'value' => 'New'],
//            [['start', 'end'], 'app\components\validators\MyValidator']
            [['start', 'end'], MyValidator::class]
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