<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Tests extends ActiveRecord
{
    public $class_ids = []; // Add this property

    public static function tableName()
    {
        return '{{%tests}}';
    }

    public function rules()
    {
        return [
            [['title', 'created_by', 'duration'], 'required'],
            [['description'], 'string'],
            [['question_limit', 'created_by', 'created_at', 'updated_at', 'duration'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['subject'], 'string', 'max' => 100],
            [['class_ids'], 'each', 'rule' => ['integer']], // Validation for class_ids
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Teachers::class, 'targetAttribute' => ['created_by' => 'id']],
            [['is_imported'], 'boolean'],
        ];
    }

    public function afterFind()
    {
        parent::afterFind();
        // Get class_ids from the pivot table (testAssignments)
        $this->class_ids = $this->getTestAssignments()->select('class_id')->column();
    }

    public function getTestAssignments()
    {
        return $this->hasMany(TestAssignments::class, ['test_id' => 'id']);
    }

    public function getAssignedClasses()
    {
        return $this->hasMany(Classes::class, ['id' => 'class_id'])
            ->via('testAssignments');
    }

    public function saveClassAssignments()
    {
        TestAssignments::deleteAll(['test_id' => $this->id]);
        if (!empty($this->class_ids)) {
            foreach ($this->class_ids as $classId) {
                $assignment = new TestAssignments();
                $assignment->test_id = $this->id;
                $assignment->class_id = $classId;
                $assignment->status = 'pending';
                $assignment->assigned_at = time();
                $assignment->save();
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Test nomi',
            'subject' => 'Fan nomi',
            'description' => 'Tavsif',
            'question_limit' => 'Savollar soni',
            'start_time' => 'Boshlanish vaqti',
            'end_time' => 'Tugash vaqti',
            'duration' => 'Test davomiyligi (minutlarda)',
            'created_by' => 'Yaratgan o\'qituvchi',
            'created_at' => 'Yaratilgan vaqt',
            'updated_at' => 'Yangilangan vaqt',
            'is_imported' => 'Holati',
        ];
    }

    public function getQuestions()
    {
        return $this->hasMany(\common\models\Questions::class, ['test_id' => 'id']);
    }

    public function getClasses()
    {
        return $this->hasMany(Classes::class, ['id' => 'class_id'])
            ->viaTable('test_class', ['test_id' => 'id']);
    }

    public function isAccessibleByStudent($studentId)
    {
        $student = \common\models\Students::findOne($studentId);
        if (!$student) {
            return false;
        }
        return $this->getClasses()->andWhere(['id' => $student->class_id])->exists();
    }
}