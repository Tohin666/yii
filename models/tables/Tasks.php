<?php

namespace app\models\tables;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property string $date
 * @property string $description
 * @property int $responsible_id
 * @property int $status
 *
 * @property Test $test
 * @property Users $users
 * @property Comments[] $comments
 * @property TaskAttachments[] $taskAttachments
 * @property TaskStatuses $statusName
 */
class Tasks extends ActiveRecord
{
    // добавляем поведение для добавления временных меток в таблицу при изменении или создании записи.
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime (для MySQL):
                'value' => new Expression('NOW()'),
            ],
        ];
    }


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
            [['date'], 'safe'],
            [['description'], 'string'],
            [['responsible_id', 'status'], 'integer'],
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
            'title' => Yii::t("main", "TaskTitle"),
            'date' => Yii::t("main", "TaskDate"),
            'description' => Yii::t("main", "TaskDescription"),
            'responsible_id' => Yii::t("main", "TaskResponsible"),
            'status' => Yii::t("main", "TaskStatus"),
        ];
    }


    public function getTest() // test прописали вверху
    {
        // hasOne - связь "один к одному", hasAll - "один ко многим", а "многие ко многим" через via
        return $this->hasOne(Test::class, ["id" => "responsible_id"]); // у казываем класс с которым свзязываем
        // и по каким параметрам. (типа форынки)
    }


    // геттер. при запросе ответственного привяжет его имя по айди. название метода немного не правильное?.
    public function getUsers()
    {
        return $this->hasOne(Users::class, ["id" => "responsible_id"]);

    }


    public function getComments()
    {
        return $this->hasMany(Comments::class, ["task_id" => "id"]); // ключ - куда ссылается, значение - атрибут
        // текущего класса
    }

    public function getTaskAttachments()
    {
        return $this->hasMany(TaskAttachments::class, ["task_id" => "id"]); // ключ - куда ссылается, значение - атрибут
        // текущего класса
    }

    public function getStatus()
    {
        return $this->hasOne(TaskStatuses::class, ["id" => "status"]); // ключ - куда ссылается, значение - атрибут
        // текущего класса
    }
}
