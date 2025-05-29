<?php

namespace common\models;

use yii\base\Model;

class StudentForm extends Model
{
    public $first_name;
    public $last_name;
    public $middle_name;
    public $birth_date;
    public $birth_place;
    public $address;
    public $father_name;
    public $mother_name;
    public $father_phone;
    public $mother_phone;
    public $father_workplace;
    public $mother_workplace;
    public $father_position;
    public $mother_position;
    public $talents;
    public $activities;
    public $behavior;
    public $health;
    public $special_needs;
    public $admission_date;
    public $photo;
    public $specialization;
    public $emergency_contact;
    public $emergency_phone;

    public function rules()
    {
        return [
            [['first_name', 'last_name', 'birth_date'], 'required'],
            [['birth_date', 'admission_date'], 'date', 'format' => 'php:Y-m-d'],
            [['talents', 'activities', 'behavior', 'health', 'special_needs'], 'string'],
            [['specialization'], 'integer'],
            [['first_name', 'last_name', 'middle_name', 'birth_place', 'address', 'father_name', 'mother_name', 'father_workplace', 'mother_workplace', 'father_position', 'mother_position', 'photo', 'emergency_contact'], 'string', 'max' => 255],
            [['father_phone', 'mother_phone', 'emergency_phone'], 'string', 'max' => 15],
        ];
    }
    public function attributeLabels()
    {
        return [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
            'birth_date' => 'Birth Date',
            'birth_place' => 'Birth Place',
            'address' => 'Address',
            'father_name' => 'Father\'s Name',
            'mother_name' => 'Mother\'s Name',
            'father_phone' => 'Father\'s Phone',
            'mother_phone' => 'Mother\'s Phone',
            'father_workplace' => 'Father\'s Workplace',
            'mother_workplace' => 'Mother\'s Workplace',
            'father_position' => 'Father\'s Position',
            'mother_position' => 'Mother\'s Position',
            'talents' => 'Talents',
            'activities' => 'Activities',
            'behavior' => 'Behavior',
            'health' => 'Health Issues',
            'special_needs' => 'Special Needs',
            'admission_date' => 'Admission Date',
            'photo' => 'Photo',
            'specialization' => 'Specialization',
            'emergency_contact' => 'Emergency Contact',
            'emergency_phone' => 'Emergency Phone'
        ];
    }
}