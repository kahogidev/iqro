<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%teacher_class}}".
 *
 * @property int $id
 * @property int $teacher_id
 * @property int $class_id
 * @property string $subject
 *
 * @property Teachers $teacher
 * @property Classes $class
 */
class TeacherClass extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%teacher_class}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teacher_id', 'class_id'], 'required'],
            [['teacher_id', 'class_id'], 'integer'],
            [['subject'], 'default', 'value' => 'Default Subject'], // Set a default value
            [['subject'], 'string', 'max' => 255],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teachers::class, 'targetAttribute' => ['teacher_id' => 'id']],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => Classes::class, 'targetAttribute' => ['class_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'teacher_id' => 'Teacher ID',
            'class_id' => 'Class ID',
            'subject' => 'Subject',
        ];
    }

    /**
     * Gets query for `Teacher`.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teachers::class, ['id' => 'teacher_id']);
    }

    /**
     * Gets query for `Class`.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(Classes::class, ['id' => 'class_id']);
    }
}