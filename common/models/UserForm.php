<?php

namespace common\models;

use Yii;
use yii\base\Model;

class UserForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $role; // Role: 'student' or 'teacher'
    public $dynamicForm; // Holds either StudentForm or TeacherForm

    public function rules()
    {
        return [
            [['username', 'email', 'password', 'role'], 'required'],
            [['username', 'email'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['role'], 'in', 'range' => ['student', 'teacher']],
        ];
    }

    public function loadDynamicForm($data)
    {
        if ($this->role === 'student') {
            $this->dynamicForm = new StudentForm();
        } elseif ($this->role === 'teacher') {
            $this->dynamicForm = new TeacherForm();
        }

        if ($this->dynamicForm) {
            $this->dynamicForm->load($data);
        }
    }

    public function validateDynamicForm()
    {
        return $this->dynamicForm && $this->dynamicForm->validate();
    }
}