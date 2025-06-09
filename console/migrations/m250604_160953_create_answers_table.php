<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%answers}}`.
 */
class m250604_160953_create_answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%answers}}', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer()->notNull(),
            'answer_text' => $this->text()->notNull(),
            'is_correct' => $this->boolean()->defaultValue(false),
        ]);
        // Add foreign key for question_id
        $this->addForeignKey('fk_answers_question', '{{%answers}}', 'question_id', '{{%questions}}', 'id', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%answers}}');
    }
}
