<?php
namespace common\models;

use Yii;
use yii\base\Model;
use PhpOffice\PhpWord\IOFactory;

class TestImportForm extends Model
{
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => ['doc', 'docx'], 'skipOnEmpty' => false],
        ];
    }


    public function importQuestions($testId, $filePath)
    {
        // Get the test model
        $test = \common\models\Tests::findOne($testId);
        if (!$test) {
            throw new \Exception('Test not found.');
        }

        // Read text from Word file
        $phpWord = IOFactory::load($filePath);
        $text = '';
        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if (method_exists($element, 'getText')) {
                    $text .= $element->getText() . "\n";
                }
            }
        }

        // Parse questions
        $blocks = preg_split('/(Q:|Question:)/i', $text, -1, PREG_SPLIT_NO_EMPTY);
        $parsedQuestions = [];
        foreach ($blocks as $block) {
            $lines = array_filter(array_map('trim', explode("\n", $block)));
            if (count($lines) < 2) continue;
            $questionText = array_shift($lines);
            $answers = [];
            foreach ($lines as $opt) {
                $isCorrect = false;
                if (strpos($opt, '=') === 0) {
                    $optText = ltrim($opt, '=');
                    $isCorrect = true;
                } else {
                    $optText = $opt;
                }
                if ($optText !== '') {
                    $answers[] = [
                        'answer_text' => $optText,
                        'is_correct' => $isCorrect,
                    ];
                }
            }
            if (count($answers) > 0) {
                $parsedQuestions[] = [
                    'question_text' => $questionText,
                    'answers' => $answers,
                ];
            }
        }

        if (empty($parsedQuestions)) {
            throw new \Exception('No questions found. Please check the file format.');
        }

        // Update or add questions and answers
        foreach ($parsedQuestions as $qData) {
            $question = \common\models\Questions::findOne([
                'test_id' => $testId,
                'question_text' => $qData['question_text'],
            ]);

            if (!$question) {
                // Create new question
                $question = new \common\models\Questions();
                $question->test_id = $testId;
                $question->question_text = $qData['question_text'];
                $question->save(false);
            } else {
                // Update existing question
                \common\models\Answers::deleteAll(['question_id' => $question->id]); // Remove old answers
            }

            // Save answers
            foreach ($qData['answers'] as $aData) {
                $answer = new \common\models\Answers();
                $answer->question_id = $question->id;
                $answer->answer_text = $aData['answer_text'];
                $answer->is_correct = $aData['is_correct'];
                $answer->save(false);
            }
        }
    }
}