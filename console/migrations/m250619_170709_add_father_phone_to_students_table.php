<?php

use yii\db\Migration;

class m250619_170709_add_father_phone_to_students_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Add father_phone column to students table
        $this->addColumn('{{%students}}', 'father_phone', $this->string(15)->after('father_name')->comment('Father\'s Phone Number'));


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Remove father_phone column from students table
        $this->dropColumn('{{%students}}', 'father_phone');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250619_170709_add_father_phone_to_students_table cannot be reverted.\n";

        return false;
    }
    */
}
