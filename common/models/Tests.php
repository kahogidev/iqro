<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Tests extends ActiveRecord
{
    public $class_ids = []; // Add this property
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_COMPLETED = 2;

    public static function tableName()
    {
        return '{{%tests}}';
    }

    public function rules()
    {
        return [
            [['title',  'duration'], 'required'],
            [['description'], 'string'],
            [['teacher_id'], 'integer'],
            [['question_limit', 'created_by', 'created_at', 'updated_at', 'duration'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
            [['status'], 'default', 'value' => self::STATUS_INACTIVE],
            [['status'], 'in', 'range' => [self::STATUS_INACTIVE, self::STATUS_ACTIVE, self::STATUS_COMPLETED]],
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
        // Remove old assignments
        \Yii::$app->db->createCommand()
            ->delete('test_class', ['test_id' => $this->id])
            ->execute();

        // Insert new assignments
        if (!empty($this->class_ids)) {
            $rows = [];
            foreach ($this->class_ids as $classId) {
                $rows[] = [$this->id, $classId];
            }
            \Yii::$app->db->createCommand()
                ->batchInsert('test_class', ['test_id', 'class_id'], $rows)
                ->execute();
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
    public function getTeacher()
    {
        return $this->hasOne(Teachers::class, ['id' => 'teacher_id']);
    }

    public function isAccessibleByStudent($studentId)
    {
        $student = \common\models\Students::findOne($studentId);
        if (!$student) {
            return false;
        }
        return $this->getClasses()->andWhere(['id' => $student->class_id])->exists();
    }
    public function getTestResults()
    {
        return $this->hasMany(TestResults::class, ['test_id' => 'id']);
    }
}