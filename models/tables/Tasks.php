<?php

namespace app\models\tables;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property string $date
 * @property string $description
 * @property int $responsible_id
 *
 * @property Test $test
 * @property Users $users
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'date'], 'required'],
            [['description', 'date'], 'string'],
            [['responsible_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'date' => 'Date',
            'description' => 'Description',
            'responsible_id' => 'Responsible ID',
        ];
    }


    public function getTest() // test прописали вверху
    {
        // hasOne - связь "один к одному", hasAll - "один ко многим", а "многие ко многим" через via
        return $this->hasOne(Test::class, ["id" => "responsible_id"]); // у казываем класс с которым свзязываем
        // и по каким параметрам. (типа форынки)
    }


    public function getUsers()
    {
        return $this->hasOne(Users::class, ["id" => "responsible_id"]);

    }
}
