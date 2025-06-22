<?php

use yii\db\Migration;

class m250616_085706_add_status_to_tests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tests', 'status', $this->integer()->defaultValue(0)->notNull()->comment('Test Status'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tests', 'status');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250616_085706_add_status_to_tests_table cannot be reverted.\n";

        return false;
    }
    */
}
