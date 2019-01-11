<?php

namespace app\models\tables;

use Yii;

/**
 * This is the model class for table "roles".
 *
 * @property int $id
 * @property string $name
 *
 * @property Users[] $users
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['role_id' => 'id']);
    }


    public static function getRoles()
    {
        // Метод find объекта ActiveQuery подготавливает запрос. select делает выборку по колонкам role_id и id.
        // indexBy сопоставляет индексы массива, который вернул селект, с индетификаторами колонки id.
        // column выбирает только первую колонку.
        return static::find()->select(['name', 'id'])->indexBy('id')->column();

    }
}
