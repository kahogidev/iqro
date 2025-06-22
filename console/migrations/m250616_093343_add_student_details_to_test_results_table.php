<?php

use yii\db\Migration;

class m250616_093343_add_student_details_to_test_results_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%test_results}}', 'student_name', $this->string()->notNull()->comment('Student Name'));
        $this->addColumn('{{%test_results}}', 'student_class', $this->string()->notNull()->comment('Student Class'));
        $this->addColumn('{{%test_results}}', 'test_name', $this->string()->notNull()->comment('Test Name'));
        $this->addColumn('{{%test_results}}', 'subject', $this->string()->notNull()->comment('Subject'));
        $this->addColumn('{{%test_results}}', 'teacher_name', $this->string()->notNull()->comment('Assigned Teacher'));
        $this->addColumn('{{%test_results}}', 'correct_answers', $this->integer()->notNull()->comment('Correct Answers'));
        $this->addColumn('{{%test_results}}', 'percentage', $this->float()->notNull()->comment('Percentage'));
        $this->addColumn('{{%test_results}}', 'time_taken', $this->integer()->notNull()->comment('Time Taken (seconds)'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%test_results}}', 'student_name');
        $this->dropColumn('{{%test_results}}', 'student_class');
        $this->dropColumn('{{%test_results}}', 'test_name');
        $this->dropColumn('{{%test_results}}', 'subject');
        $this->dropColumn('{{%test_results}}', 'teacher_name');
        $this->dropColumn('{{%test_results}}', 'correct_answers');
        $this->dropColumn('{{%test_results}}', 'percentage');
        $this->dropColumn('{{%test_results}}', 'time_taken');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250616_093343_add_student_details_to_test_results_table cannot be reverted.\n";

        return false;
    }
    */
}
