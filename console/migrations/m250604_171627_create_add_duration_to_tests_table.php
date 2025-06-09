<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%add_duration_to_tests}}`.
 */
class m250604_171627_create_add_duration_to_tests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%tests}}', 'duration', $this->integer()->notNull()->defaultValue(0)->comment('Duration in minutes'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%tests}}', 'duration');
    }
}
