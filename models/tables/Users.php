<?php

namespace app\models\tables;

use Yii;

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


}
