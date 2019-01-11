<?php

use yii\db\Migration;

/**
 * Handles adding created_at to table `tasks`.
 */
class m190112_141400_add_created_at_column_to_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tasks', 'created_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tasks', 'created_at');
    }
}
