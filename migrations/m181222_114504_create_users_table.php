<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m181222_114504_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username'=> $this->string(50)->notNull(),
            'password' => $this->string()->notNull(),
            'email' => $this->string(),
            'authKey' => $this->string(),
            'accessToken' => $this->string()
        ]);

        $this->addForeignKey('fk_tasks_users_responsible','tasks','responsible_id',
            'users','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
