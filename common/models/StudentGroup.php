<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%student_group}}".
 *
 * @property int $id
 * @property int $group_id
 * @property int $student_id
 * @property string $added_at
 * @property int $added_by
 *
 * @property Classes $group
 * @property Students $student
 */
class StudentGroup extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%student_group}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'student_id'], 'required'],
            [['group_id', 'student_id', 'added_by'], 'integer'],
            [['added_at'], 'safe'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Classes::class, 'targetAttribute' => ['group_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::class, 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'student_id' => 'Student ID',
            'added_at' => 'Added At',
            'added_by' => 'Added By',
        ];
    }

    /**
     * Gets query for `Classes`.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Classes::class, ['id' => 'group_id']);
    }

    /**
     * Gets query for `Students`.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Students::class, ['id' => 'student_id']);
    }
}