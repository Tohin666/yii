<?php

namespace app\models\tables;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 *
 * @property string $email
 * @property string $role_id
 */
class Users extends \yii\db\ActiveRecord
{
    const SCENARIO_AUTH = 'auth';


//    // добавляем поведение для добавления временных меток в таблицу при изменении или создании записи.
//    public function behaviors()
//    {
//        return [
//            [
//                'class' => TimestampBehavior::class,
//                'attributes' => [
//                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
//                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
//                ],
//            ],
//        ];
//    }

    // тут попробовал по другому
    public function behaviors()
    {
       return [
           TimestampBehavior::class,
       ];
    }




    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password', 'authKey', 'accessToken'], 'string', 'max' => 255],
            ['email', 'email'],
            ['role_id', 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'role_id' => 'Role',
        ];
    }


//    // Можно переопределить метод fields чтобы указать какие поля при использовании toArray попадут в массив (в классе
//    // User). Также можно задавать алиасы, напр. 'login' => 'username' - свойство username будет возвращаться под
//    // ключом login
//    public function fields()
//    {
//        return [
//            'id',
//            'username',
////            'name' => 'username',
//            'password',
//
//        ];
//    }

    public function fields()
    {
        // Мы назначили константу SCENARIO_AUTH. Если в классе User сработает этот сценарий, то передадутся эти поля:
        if ($this->scenario == self::SCENARIO_AUTH){
            return [
                'id',
                'username',
                'password',
            ];
        }

        // В противном случае пойдет по дефолтному сценарию, родительский метод fields передаст все поля.
        return parent::fields();

    }


    public static function getUsersList()
    {
        $users = static::find() // выбираем юзеров из таблицы юзерс
        ->select(['id', 'username']) // выбираем только айди и имя
        ->asArray() // получаем в виде массива
        ->all();

        // в качестве индексов массива юзерс проставляем айдишники, а в качестве значений юзернейм.
        return ArrayHelper::map($users, 'id', 'username');

//        // можно и так:
//        return static::find()->select(['username', 'id'])->indexBy('id')->column();

    }

}
