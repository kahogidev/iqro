<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%teachers}}`.
 */
class m250601_123724_create_teachers_table extends Migration
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

        $this->createTable('{{%teachers}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(), // Foreign key to user table
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'middle_name' => $this->string()->notNull(),
            'passport_series_number' => $this->string()->notNull(),
            'birth_date' => $this->date()->notNull(),
            'gender' => $this->string(10)->notNull(),
            'nationality' => $this->string()->notNull(),
            'marital_status' => $this->string()->notNull(),
            'permanent_address' => $this->string()->notNull(),
            'current_address' => $this->string()->notNull(),
            'registered_address' => $this->string()->notNull(),
            'photo' => $this->string()->notNull(),
            'personal_phone' => $this->string(15)->notNull(),
            'additional_phone' => $this->string(15),
            'contact_info' => $this->string()->notNull(), // Telegram / Email
            'hire_date' => $this->date()->notNull(),
            'position' => $this->string()->notNull(),
            'department' => $this->string()->notNull(),
            'specialization' => $this->string()->notNull(),
            'experience_years' => $this->integer()->notNull(),
            'academic_degree' => $this->string(),
            'certificates' => $this->text(), // JSON or serialized data for certificates
            'diploma' => $this->text(), // JSON or serialized data for diploma
            'weekly_hours' => $this->integer()->notNull(),
            'subjects' => $this->text(), // JSON or serialized data for subjects
            'classes' => $this->text(), // JSON or serialized data for classes
            'passport_image' => $this->string()->notNull(),
            'diploma_image' => $this->string()->notNull(),
            'certificate_image' => $this->text(), // JSON or serialized data for certificate scans
            'hire_order_image' => $this->string()->notNull(),
            'contract_pdf' => $this->string()->notNull(),
        ], $tableOptions);

        // Add foreign key for user_id
        $this->addForeignKey(
            'fk-teachers-user_id',
            '{{%teachers}}',
            'user_id',
            '{{%user}}',
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
        $this->dropForeignKey('fk-teachers-user_id', '{{%teachers}}');
        $this->dropTable('{{%teachers}}');
    }
}
