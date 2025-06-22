<?php
namespace common\models;


use PhpOffice\PhpSpreadsheet\IOFactory;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ExcelImportForm extends Model
{
    public $excelFile;

    public function rules()
    {
        return [
            [['excelFile'], 'file', 'extensions' => 'xls, xlsx', 'maxSize' => 1024 * 1024 * 5],
        ];
    }

    public function uploadAndProcess()
    {
        if ($this->validate()) {
            $filePath = 'uploads/' . $this->excelFile->baseName . '.' . $this->excelFile->extension;
            $this->excelFile->saveAs($filePath);

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            for ($i = 1; $i < count($rows); $i++) {
                $row = $rows[$i];
                $student = new Students();
                $student->user_id = $row[0]; // 0 - user_id
                $student->first_name = $row[1];
                $student->last_name = $row[2];
                $student->middle_name = $row[3];
                $student->birth_date = $row[4];
                $student->birth_place = $row[5];
                $student->address = $row[6];
                $student->father_name = $row[7];
                $student->mother_name = $row[8];
                $student->father_phone = $row[9];
                $student->mother_phone = $row[10];
                $student->father_workplace = $row[11];
                $student->mother_workplace = $row[12];
                $student->father_position = $row[13];
                $student->mother_position = $row[14];
                $student->talents = $row[15];
                $student->activities = $row[16];
                $student->behavior = $row[17];
                $student->health = $row[18];
                $student->special_needs = $row[19];
                $student->admission_date = $row[20];
                $student->photo = $row[21];
                $student->specialization = $row[22];
                $student->emergency_contact = $row[23];
                $student->emergency_phone = $row[24];

                if (!$student->save()) {
                    Yii::error("Xatolik saqlashda (qator: $i): " . json_encode($student->getErrors()), __METHOD__);
                    continue; // Agar xatolik bo‘lsa, keyingi qatorni o‘tkazib yuboramiz
                }
            }

            return true;
        }
        return false;
    }
}