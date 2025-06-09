<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%test_assignments}}".
 *
 * @property int $id
 * @property int $test_id
 * @property int $class_id
 * @property int $student_id
 * @property string|null $status
 * @property int|null $assigned_at
 *
 * @property Tests $test
 * @property Classes $class
 * @property Students $student
 */
class TestAssignments extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%test_assignments}}';
    }

    public function rules()
    {
        return [
            [['test_id', 'class_id', 'student_id'], 'required'],
            [['test_id', 'class_id', 'student_id', 'assigned_at'], 'integer'],
            [['status'], 'string', 'max' => 20],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tests::class, 'targetAttribute' => ['test_id' => 'id']],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => Classes::class, 'targetAttribute' => ['class_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::class, 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_id' => 'Test ID',
            'class_id' => 'Class ID',
            'student_id' => 'Student ID',
            'status' => 'Status',
            'assigned_at' => 'Assigned At',
        ];
    }

    public function getTest()
    {
        return $this->hasOne(Tests::class, ['id' => 'test_id']);
    }

    public function getClass()
    {
        return $this->hasOne(Classes::class, ['id' => 'class_id']);
    }

    public function getStudent()
    {
        return $this->hasOne(Students::class, ['id' => 'student_id']);
    }
}