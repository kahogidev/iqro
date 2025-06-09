<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_assignments}}`.
 */
class m250609_041557_create_test_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test_assignments}}', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer()->notNull(),
            'class_id'=> $this->integer()->notNull(),
            'student_id' => $this->integer()->notNull(),
            'status' => $this->string(20)->defaultValue('pending'), // pending, started, finished
            'assigned_at' => $this->integer(),
        ]);
        $this->addForeignKey('fk_assignment_test', '{{%test_assignments}}', 'test_id', '{{%tests}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_assignment_student', '{{%test_assignments}}', 'student_id', '{{%students}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_assignment_class', '{{%test_assignments}}', 'class_id', '{{%classes}}', 'id', 'CASCADE'); // Yangi foreign key

    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%test_assignments}}');
    }
}
