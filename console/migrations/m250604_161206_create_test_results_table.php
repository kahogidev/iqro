<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_results}}`.
 */
class m250604_161206_create_test_results_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test_results}}', [
            'id' => $this->primaryKey(),
            'assignment_id' => $this->integer()->notNull(),
            'question_id' => $this->integer()->notNull(),
            'answer_id' => $this->integer()->notNull(),
            'is_correct' => $this->boolean(),
            'answered_at' => $this->integer(),
        ]);
        $this->addForeignKey('fk_result_assignment', '{{%test_results}}', 'assignment_id', '{{%test_assignments}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_result_question', '{{%test_results}}', 'question_id', '{{%questions}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_result_answer', '{{%test_results}}', 'answer_id', '{{%answers}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%test_results}}');
    }
}
