<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_class}}`.
 */
class m250607_200915_create_test_class_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test_class}}', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer()->notNull(),
            'class_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_test_class_test',
            '{{%test_class}}',
            'test_id',
            '{{%tests}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_test_class_class',
            '{{%test_class}}',
            'class_id',
            '{{%classes}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%test_class}}');
    }
}
