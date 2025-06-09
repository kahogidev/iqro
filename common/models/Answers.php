<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%answers}}".
 *
 * @property int $id
 * @property int $question_id
 * @property string $text
 * @property bool $is_correct
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Questions $question
 */
class Answers extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%answers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'text'], 'required'],
            [['question_id', 'created_at', 'updated_at'], 'integer'],
            [['text'], 'string'],
            [['is_correct'], 'boolean'],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::class, 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Question ID',
            'text' => 'Answer Text',
            'is_correct' => 'Is Correct',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for `Question`.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Questions::class, ['id' => 'question_id']);
    }
}