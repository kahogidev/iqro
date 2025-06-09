<?php
namespace common\models;

use yii\base\Model;

class TestImportForm extends Model
{
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => ['doc', 'docx'], 'skipOnEmpty' => false],
        ];
    }
}
