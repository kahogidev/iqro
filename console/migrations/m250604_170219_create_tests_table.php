<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tests}}`.
 */
class m250604_170219_create_tests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tests}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'subject' => $this->string(100),
            'description' => $this->text(),
            'question_limit' => $this->integer(),
            'start_time' => $this->dateTime(),
            'end_time' => $this->dateTime(),
            'created_by' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // Add foreign key for `created_by` referencing `Teachers` table
        $this->addForeignKey(
            'fk-tests-created_by',
            '{{%tests}}',
            'created_by',
            '{{%teachers}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-tests-created_by', '{{%tests}}');
        $this->dropTable('{{%tests}}');
    }
}
