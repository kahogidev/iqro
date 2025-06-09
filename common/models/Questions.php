<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%questions}}".
 *
 * @property int $id
 * @property int $test_id
 * @property string $question_text
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Tests $test
 * @property Answers[] $answers
 */
class Questions extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%questions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_id', 'question_text'], 'required'],
            [['test_id', 'created_at', 'updated_at'], 'integer'],
            [['question_text'], 'string'],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tests::class, 'targetAttribute' => ['test_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_id' => 'Test ID',
            'question_text' => 'Question question_text',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for `Test`.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Tests::class, ['id' => 'test_id']);
    }

    /**
     * Gets query for `Answers`.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answers::class, ['question_id' => 'id']);
    }
}