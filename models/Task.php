<?php

namespace app\models;

use app\components\validators\MyValidator;
use yii\base\Model;

class Task extends Model
{
    public $id;
    public $name;
    public $description;
    public $responsible;
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
            [['name', 'responsible', 'start',], 'required'],
            [['name', 'description', 'responsible', 'status'], 'string'],
            ['status', 'default', 'value' => 'New'],
//            [['start', 'end'], 'app\components\validators\MyValidator']
            [['start', 'end'], MyValidator::class]
//            // it's my validation. На js проверки не будет.
//            ['name', 'myValidate'],
//            [['start', 'end'], 'safe']
        ];

    }
}