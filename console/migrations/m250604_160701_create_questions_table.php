<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%questions}}`.
 */
class m250604_160701_create_questions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%questions}}', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer()->notNull(),
            'question_text' => $this->text()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);


        // Add foreign key for test_id
        $this->addForeignKey(
            'fk_questions_test',
            '{{%questions}}',
            'test_id',
            '{{%tests}}',
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
        $this->dropTable('{{%questions}}');
    }
}
