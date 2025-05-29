<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%students}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $middle_name
 * @property string $birth_date
 * @property string|null $birth_place
 * @property string|null $address
 * @property string|null $father_name
 * @property string|null $mother_name
 * @property string|null $mother_phone
 * @property string|null $father_workplace
 * @property string|null $mother_workplace
 * @property string|null $father_position
 * @property string|null $mother_position
 * @property string|null $talents
 * @property string|null $activities
 * @property string|null $behavior
 * @property string|null $health
 * @property string|null $special_needs
 * @property string|null $admission_date
 * @property string|null $photo
 * @property string|null $direction
 * @property string|null $emergency_contact
 * @property string|null $emergency_phone
 *
 * @property User $user
 */
class Students extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%students}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name', 'birth_date'], 'required'],
            [['user_id'], 'integer'],
            [['birth_date', 'admission_date'], 'safe'],
            [['talents', 'activities', 'behavior', 'health', 'special_needs'], 'string'],
            [['first_name', 'last_name', 'middle_name', 'birth_place', 'address', 'father_name', 'mother_name', 'father_workplace', 'mother_workplace', 'father_position', 'mother_position', 'photo', 'direction', 'emergency_contact'], 'string', 'max' => 255],
            [['mother_phone', 'emergency_phone'], 'string', 'max' => 15],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'birth_date' => 'Birth Date',
            'birth_place' => 'Birth Place',
            'address' => 'Address',
            'father_name' => 'Father Name',
            'mother_name' => 'Mother Name',
            'mother_phone' => 'Mother Phone',
            'father_workplace' => 'Father Workplace',
            'mother_workplace' => 'Mother Workplace',
            'father_position' => 'Father Position',
            'mother_position' => 'Mother Position',
            'talents' => 'Talents',
            'activities' => 'Activities',
            'behavior' => 'Behavior',
            'health' => 'Health',
            'special_needs' => 'Special Needs',
            'admission_date' => 'Admission Date',
            'photo' => 'Photo',
            'specialization' => 'Yo\'nalishi',
            'emergency_contact' => 'Emergency Contact',
            'emergency_phone' => 'Emergency Phone',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}