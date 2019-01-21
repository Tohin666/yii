<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attachments`.
 */
class m190121_110356_create_attachments_table extends Migration
{
    protected $attachmentsTable = 'task_attachments';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->attachmentsTable, [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(),
            'path' => $this->string(),
        ]);

        $this->addForeignKey('fk_attachments_tasks', $this->attachmentsTable,'task_id',
            \app\models\tables\Tasks::tableName(), 'id');

        $this->addColumn(\app\models\tables\Comments::tableName(), 'user_id', $this->integer());

        $this->addForeignKey('fk_comments_users', \app\models\tables\Comments::tableName(), 'user_id',
            \app\models\tables\Users::tableName(), 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->attachmentsTable);

        $this->dropForeignKey('fk_comments_users', \app\models\tables\Comments::tableName());

        $this->dropColumn(\app\models\tables\Comments::tableName(), 'user_id');
    }
}
