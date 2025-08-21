<?php

namespace common\models;

use PhpOffice\PhpWord\IOFactory;
use yii\base\Model;
use common\models\Questions;
use common\models\Answers;
use DOMDocument;
use DOMXPath;

class TestImportForm extends Model
{
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'doc, docx'],
        ];
    }

    public function importQuestions($testId, $filePath)
    {
        $test = \common\models\Tests::findOne($testId);
        if (!$test) {
            throw new \Exception('Test topilmadi.');
        }

        $phpWord = IOFactory::load($filePath);
        $sections = $phpWord->getSections();
        $currentQuestion = null;
        $currentAnswers = [];

        foreach ($sections as $section) {
            foreach ($section->getElements() as $element) {
                if (method_exists($element, 'getElements')) {
                    foreach ($element->getElements() as $subElement) {
                        if (method_exists($subElement, 'getText')) {
                            $text = trim($subElement->getText());
                        } elseif (method_exists($subElement, 'getContent')) {
                            $text = trim($subElement->getContent());
                        } else {
                            continue;
                        }

                        // MathML formulani aniqlash va textga aylantirish
                        if (stripos($text, '<m:oMath') !== false) {
                            $text = $this->parseMathML($text);
                        }

                        if (preg_match('/^Q\s*:?\s*(.+)$/ui', $text, $matches)) {
                            if ($currentQuestion && !empty($currentAnswers)) {
                                $this->saveQuestion($test->id, $currentQuestion, $currentAnswers);
                            }
                            $currentQuestion = $matches[1];
                            $currentAnswers = [];
                        } elseif (preg_match('/^=\s*(.+)$/', $text, $matches)) {
                            $currentAnswers[] = [
                                'text' => $matches[1],
                                'is_correct' => 1,
                            ];
                        } elseif (!empty($text)) {
                            $currentAnswers[] = [
                                'text' => $text,
                                'is_correct' => 0,
                            ];
                        }
                    }
                }
            }
        }

        if ($currentQuestion && !empty($currentAnswers)) {
            $this->saveQuestion($test->id, $currentQuestion, $currentAnswers);
        }
    }

    protected function saveQuestion($testId, $questionText, $answers)
    {
        $question = new Questions();
        $question->test_id = $testId;
        $question->question_text = $questionText;
        $question->save(false);

        foreach ($answers as $ans) {
            $answer = new Answers();
            $answer->question_id = $question->id;
            $answer->answer_text = $ans['text'];
            $answer->is_correct = $ans['is_correct'];
            $answer->save(false);
        }
    }


    protected function parseMathML($xml)
    {
        // MathML namespace aniqlanganligini tekshirish
        if (strpos($xml, 'xmlns:m=') === false) {
            $xml = str_replace(
                '<m:oMath',
                '<m:oMath xmlns:m="http://schemas.openxmlformats.org/officeDocument/2006/math"',
                $xml
            );
        }

        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        if (!$doc->loadXML($xml)) {
            return '[FORMULA ERROR]';
        }

        $xpath = new DOMXPath($doc);
        $xpath->registerNamespace("m", "http://schemas.openxmlformats.org/officeDocument/2006/math");

        if ($xpath->query('//m:f')->length) {
            $num = $xpath->query('//m:f/m:num//m:t')->item(0)->nodeValue ?? '?';
            $den = $xpath->query('//m:f/m:den//m:t')->item(0)->nodeValue ?? '?';
            return "$num/$den";
        }

        if ($xpath->query('//m:sup')->length) {
            $base = $xpath->query('//m:sup/m:e//m:t')->item(0)->nodeValue ?? '?';
            $exp = $xpath->query('//m:sup/m:sup//m:t')->item(0)->nodeValue ?? '?';
            return "$base^$exp";
        }

        if ($xpath->query('//m:rad')->length) {
            $deg = $xpath->query('//m:rad/m:deg//m:t')->item(0)->nodeValue ?? '';
            $val = $xpath->query('//m:rad/m:e//m:t')->item(0)->nodeValue ?? '?';
            return $deg ? "{$deg}√{$val}" : "√$val";
        }

        return strip_tags($xml);
    }}

