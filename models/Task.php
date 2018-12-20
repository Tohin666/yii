<?php
/**
 * Created by PhpStorm.
 * User: tohin
 * Date: 20-Dec-18
 * Time: 8:03 AM
 */

namespace app\models;


class Task extends \yii\base\BaseObject
{
    public $id;
    public $name;
    public $description;
    public $responsible;
    public $status;
    public $start;
    public $end;
}