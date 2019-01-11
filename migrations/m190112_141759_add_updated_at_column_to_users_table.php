<?php

use yii\db\Migration;

/**
 * Handles adding updated_at to table `users`.
 */
class m190112_141759_add_updated_at_column_to_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'updated_at');
    }
}
