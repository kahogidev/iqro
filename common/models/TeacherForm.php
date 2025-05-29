<?php

namespace common\models;

use yii\base\Model;

class TeacherForm extends Model
{
    public $subject;
    public $experience_years;

    public function rules()
    {
        return [
            [['subject', 'experience_years'], 'required'],
            [['subject'], 'string', 'max' => 255],
            [['experience_years'], 'integer', 'min' => 0],
        ];
    }
}