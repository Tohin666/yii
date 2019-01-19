<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 */
class m190119_051422_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'comment' => $this->text()->notNull(),
            'photo' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('fk_tasks_comments',
            'comments', 'task_id', 'tasks', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comments');
    }
}
