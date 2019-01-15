<?php

use yii\db\Migration;

/**
 * Handles adding datetime to table `users`.
 */
class m190114_183055_add_datetime_columns_to_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'created_at', $this->dateTime());
        $this->addColumn('users', 'updated_at', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'created_at');
        $this->dropColumn('users', 'updated_at');
    }
}
