<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%teachers}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $passport_series_number
 * @property string $birth_date
 * @property string $gender
 * @property string $nationality
 * @property string $marital_status
 * @property string $permanent_address
 * @property string $current_address
 * @property string $registered_address
 * @property string $photo
 * @property string $personal_phone
 * @property string|null $additional_phone
 * @property string $contact_info
 * @property string $hire_date
 * @property string $position
 * @property string $department
 * @property string $specialization
 * @property int $experience_years
 * @property string|null $academic_degree
 * @property string|null $certificates
 * @property string|null $diploma
 * @property int $weekly_hours
 * @property string|null $subjects
 * @property string|null $classes
 * @property string $passport_image
 * @property string $diploma_image
 * @property string|null $certificate_image
 * @property string $hire_order_image
 * @property string $contract_pdf
 *
 * @property User $user
 */
class Teachers extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%teachers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name','last_name','middle_name', 'passport_series_number', 'birth_date', 'gender', 'nationality', 'marital_status', 'permanent_address', 'current_address', 'registered_address', 'photo', 'personal_phone', 'contact_info', 'hire_date', 'position', 'department', 'specialization', 'experience_years', 'weekly_hours', 'passport_image', 'diploma_image', 'hire_order_image', 'contract_pdf'], 'required'],
            [['user_id', 'experience_years', 'weekly_hours'], 'integer'],
            [['birth_date', 'hire_date'], 'safe'],
            [['certificates', 'diploma', 'subjects',  'certificate_image'], 'string'],
            [['first_name','last_name','middle_name', 'passport_series_number', 'gender', 'nationality', 'marital_status', 'permanent_address', 'current_address', 'registered_address', 'photo', 'personal_phone', 'additional_phone', 'contact_info', 'position', 'department', 'specialization', 'academic_degree', 'passport_image', 'diploma_image', 'hire_order_image', 'contract_pdf'], 'string', 'max' => 255],
            [['photo', 'passport_image', 'diploma_image', 'hire_order_image', 'contract_pdf'], 'safe'],

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
            'first_name' => 'Ism',
            'last_name' => 'Familiya',
            'middle_name' => 'Otasining ismi',
            'passport_series_number' => 'Passport seriyasi va raqami',
            'birth_date' => 'Tug\'ilgan sana',
            'gender' => 'Jinsi',
            'nationality' => 'Millati',
            'marital_status' => 'Oilaviy holati',
            'permanent_address' => 'Doimiy manzil',
            'current_address' => 'Hozirgi manzil',
            'registered_address' => 'Ro\'yxatdan o\'tgan manzil',
            'photo' => 'Rasm',
            'personal_phone' => 'Shaxsiy telefon',
            'additional_phone' => 'Qo\'shimcha telefon',
            'contact_info' => 'Kontakt ma\'lumotlar (Telegram / Email)',
            'hire_date' => 'Ishga qabul sanasi',
            'position' => 'Lavozim',
            'department' => 'Bo\'lim',
            'specialization' => 'Mutaxassislik',
            'experience_years' => 'Tajribasi (yil)',
            'academic_degree' => 'Ilmiy darajasi',
            'certificates' => 'Sertifikatlar',
            'diploma' => 'Diplom',
            'weekly_hours' => 'Haftalik ish soatlari',
            'subjects' => 'Fanlar',
            'passport_image' => 'Passport rasmi',
            'diploma_image' => 'Diplom rasmi',
            'certificate_image' => 'Sertifikat rasmi',
            'hire_order_image' => 'Ishga qabul buyruq rasmi',
            'contract_pdf' => 'Mehnat shartnomasi PDF',
        ];
    }

    /**
     * Gets query for `User`.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}