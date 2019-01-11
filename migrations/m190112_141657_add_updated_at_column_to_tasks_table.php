<?php

use yii\db\Migration;

/**
 * Handles adding updated_at to table `tasks`.
 */
class m190112_141657_add_updated_at_column_to_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tasks', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tasks', 'updated_at');
    }
}
