<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%students}}`.
 */
class m250531_141209_add_father_phone_column_to_students_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%students}}', 'father_phone', $this->string(20)->after('mother_phone')); // 'mother_phone' o‘rniga sizdagi oxirgi ustun bo‘lishi mumkin

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%students}}', 'father_phone');
    }
}
