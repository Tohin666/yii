<?php

use yii\db\Migration;

/**
 * Handles adding created_at to table `users`.
 */
class m190112_141733_add_created_at_column_to_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'created_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'created_at');
    }
}
