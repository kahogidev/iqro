<?php

use yii\db\Migration;

class m250617_111307_add_teacher_id_to_tests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%tests}}', 'teacher_id', $this->integer()->notNull());
        $this->addForeignKey(
            'fk-tests-teacher_id',
            '{{%tests}}',
            'teacher_id',
            '{{%teachers}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-tests-teacher_id', '{{%tests}}');

        // Remove the teacher_id column
        $this->dropColumn('{{%tests}}', 'teacher_id');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250617_111307_add_teacher_id_to_tests_table cannot be reverted.\n";

        return false;
    }
    */
}
