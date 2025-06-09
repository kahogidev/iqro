<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%classes}}".
 *
 * @property int $id
 * @property string $class
 * @property string $class_name
 * @property string $created_at
 * @property string $updated_at
 */
class Classes extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%classes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class', 'class_name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['class'], 'string', 'max' => 50],
            [['class_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class' => 'Sinflar',
            'class_name' => 'Sinf Nomi',
            'created_at' => 'Yaratilgan sana',
            'updated_at' => 'Yangilangan sana',
        ];
    }
    public function getTests()
    {
        return $this->hasMany(Tests::class, ['id' => 'test_id'])
            ->viaTable('test_class', ['class_id' => 'id']);
    }
}