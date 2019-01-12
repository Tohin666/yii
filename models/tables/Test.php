<?php

namespace app\models\tables;

use app\behaviors\MyBehavior;

/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 */
class Test extends \yii\db\ActiveRecord
{
    // задаем флаг события.
    const EVENT_RUN_START = 'run_start';
    const EVENT_RUN_COMPLETE = 'run_complete';

    // переопределяем метод поведения.
    public function behaviors()
    {
        // возвращает массив, где каждым элементом массива является поведение.
        return [
            'someBehaviorName' => [
                'class' => MyBehavior::class,
                'message' => "поведение класса!",
            ]

        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'string', 'max' => 255],
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
            'content' => 'Content',
        ];
    }


    // абстрактный тестовый метод
    public function run()
    {
        // метод триггер выбрасывает событие, доступен во всех классах йии и наследниках.
        $this->trigger(static::EVENT_RUN_START);

        echo "типа событие1";

        // метод триггер выбрасывает событие, доступен во всех классах йии и наследниках.
        $this->trigger(static::EVENT_RUN_COMPLETE);

        echo "типа событие2";
    }
}
