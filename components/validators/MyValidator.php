<?php

namespace app\components\validators;

use yii\validators\Validator;

class MyValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if ($model->$attribute <= 0) {
            $this->addError($model, $attribute, 'Дата должна быть больше нуля');
        }

    }

}