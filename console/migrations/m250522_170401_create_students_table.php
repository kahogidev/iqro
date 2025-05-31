<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%students}}`.
 */
class m250522_170401_create_students_table extends Migration
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

        $this->createTable('{{%students}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(), // Foreign key to user table
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'middle_name' => $this->string(),
            'birth_date' => $this->date()->notNull(),
            'birth_place' => $this->string(),
            'address' => $this->string(),
            'father_name' => $this->string(),
            'mother_name' => $this->string(),
            'mother_phone' => $this->string(15),
            'father_workplace' => $this->string(),
            'mother_workplace' => $this->string(),
            'father_position' => $this->string(),
            'mother_position' => $this->string(),
            'talents' => $this->text(),
            'activities' => $this->text(),
            'behavior' => $this->text(),
            'health' => $this->text(),
            'special_needs' => $this->text(),
            'admission_date' => $this->date(),
            'photo' => $this->string(),
            'specialization' => $this->integer(),
            'emergency_contact' => $this->string(),
            'emergency_phone' => $this->string(15),
        ], $tableOptions);

        // Add foreign key for user_id
        $this->addForeignKey(
            'fk-students-user_id',
            '{{%students}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropForeignKey('fk-students-user_id', '{{%students}}');
        $this->dropTable('{{%students}}');
    }
}
