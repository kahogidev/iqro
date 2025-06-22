<?php

namespace common\models;

use Yii;

class TestResults extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%test_results}}';
    }

    public function rules()
    {
        return [
            [['student_id', 'test_id', 'teacher_id', 'correct_answers', 'percentage', 'created_at'], 'required'],
            [['student_id', 'test_id', 'teacher_id', 'correct_answers', 'created_at'], 'integer'],
            [['percentage'], 'number'],
        ];
    }

    public function getStudent()
    {
        return $this->hasOne(Students::class, ['id' => 'student_id']);
    }

    public function getTest()
    {
        return $this->hasOne(Tests::class, ['id' => 'test_id']);
    }

    public function getTeacher()
    {
        return $this->hasOne(Teachers::class, ['id' => 'teacher_id']);
    }
    public function getTestResults()
    {
        return $this->hasMany(TestResults::class, ['test_id' => 'id']);
    }

}