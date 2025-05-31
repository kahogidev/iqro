<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%student_group}}`.
 */
class m250529_193724_create_student_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%student_group}}', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->notNull(),
            'student_id' => $this->integer()->notNull(),
            'added_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'added_by' => $this->integer()->notNull(),
        ]);

        // Add foreign key for group_id referencing classes table
        $this->addForeignKey(
            'fk-student_group-group_id',
            '{{%student_group}}',
            'group_id',
            '{{%classes}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Add foreign key for student_id referencing students table
        $this->addForeignKey(
            'fk-student_group-student_id',
            '{{%student_group}}',
            'student_id',
            '{{%students}}',
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
        // Drop foreign keys
        $this->dropForeignKey('fk-student_group-group_id', '{{%student_group}}');
        $this->dropForeignKey('fk-student_group-student_id', '{{%student_group}}');

        // Drop table
        $this->dropTable('{{%student_group}}');
    }
}