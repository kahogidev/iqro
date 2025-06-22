<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_results}}`.
 */
class m250616_102920_create_test_results_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%test_results}}', [
            'id' => $this->primaryKey(),
            'student_id' => $this->integer()->notNull()->comment('Student ID'),
            'test_id' => $this->integer()->notNull()->comment('Test ID'),
            'teacher_id' => $this->integer()->notNull()->comment('Teacher ID'),
            'correct_answers' => $this->integer()->notNull()->comment('Correct Answers'),
            'percentage' => $this->float()->notNull()->comment('Percentage'),
            'created_at' => $this->integer()->notNull()->comment('Created At'),
        ]);
        $this->addForeignKey('fk_test_results_student', '{{%test_results}}', 'student_id', '{{%students}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_test_results_test', '{{%test_results}}', 'test_id', '{{%tests}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_test_results_teacher', '{{%test_results}}', 'teacher_id', '{{%teachers}}', 'id', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_test_results_student', '{{%test_results}}');
        $this->dropForeignKey('fk_test_results_test', '{{%test_results}}');
        $this->dropForeignKey('fk_test_results_teacher', '{{%test_results}}');
        $this->dropTable('{{%test_results}}');    }
}
