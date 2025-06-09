<?php

use yii\db\Migration;

class m250605_054300_add_is_imported_to_tests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tests', 'is_imported', $this->boolean()->defaultValue(0));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tests', 'is_imported');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250605_054300_add_is_imported_to_tests_table cannot be reverted.\n";

        return false;
    }
    */
}
