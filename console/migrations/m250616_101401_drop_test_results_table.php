<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%test_results}}`.
 */
class m250616_101401_drop_test_results_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%test_results}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%test_results}}', [
            'id' => $this->primaryKey(),
            'assignment_id' => $this->integer()->notNull(),
            'question_id' => $this->integer()->notNull(),
            'answer_id' => $this->integer()->notNull(),
            'is_correct' => $this->boolean(),
            'answered_at' => $this->integer(),
        ]);
    }
}
