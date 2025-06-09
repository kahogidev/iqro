<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%teacher_class}}`.
 */
class m250602_184700_create_teacher_class_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%teacher_class}}', [
            'id' => $this->primaryKey(),
            'teacher_id' => $this->integer()->notNull(), // Foreign key to teachers table
            'class_id' => $this->integer()->notNull(), // Foreign key to classes table
            'subject' => $this->string()->notNull(), // Subject being taught
        ], $tableOptions);

        // Add foreign key for teacher_id
        $this->addForeignKey(
            'fk-teacher_class-teacher_id',
            '{{%teacher_class}}',
            'teacher_id',
            '{{%teachers}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Add foreign key for class_id
        $this->addForeignKey(
            'fk-teacher_class-class_id',
            '{{%teacher_class}}',
            'class_id',
            '{{%classes}}',
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
        $this->dropForeignKey('fk-teacher_class-teacher_id', '{{%teacher_class}}');
        $this->dropForeignKey('fk-teacher_class-class_id', '{{%teacher_class}}');
        $this->dropTable('{{%teacher_class}}');
    }
}
