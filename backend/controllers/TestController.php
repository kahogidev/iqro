<?php

namespace backend\controllers;

use common\models\Questions;
use common\models\Tests;
use common\models\search\TestsSearch;
use Mpdf\Mpdf;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\TestImportForm;

/**
 * TestController implements the CRUD actions for Tests model.
 */
class TestController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Tests models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TestsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $importModel = new \common\models\TestImportForm();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'importModel' => $importModel,
        ]);
    }

    /**
     * Import questions from a Word file.
     *
     * @param int $id Test ID
     * @return string|\yii\web\Response
     */
    public function actionImportWord($id)
    {
        $model = $this->findModel($id);
        $importModel = new \common\models\TestImportForm();

        if (Yii::$app->request->isPost) {
            $importModel->file = \yii\web\UploadedFile::getInstance($importModel, 'file');
            if ($importModel->validate()) {
                $uploadDir = Yii::getAlias('@backend/web/uploads/' . $model->id . '/');
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = 'test.' . $importModel->file->extension;
                $path = $uploadDir . $fileName;
                $importModel->file->saveAs($path);

                // Parse and save questions
                $importModel->importQuestions($model->id, $path);

                $model->is_imported = 1;
                $model->save(false);
                return $this->redirect(['index']);
            }
        }

        return $this->render('import-word', [
            'model' => $model,
            'importModel' => $importModel,
        ]);
    }

    /**
     * Take a test.
     *
     * @param int $id Test ID
     * @return string|\yii\web\Response
     */
    public function actionTake($id)
    {
        $test = Tests::findOne($id);
        if (!$test) {
            throw new \yii\web\NotFoundHttpException('Test not found.');
        }

        $questions = $test->questions;
        $questionLimit = $test->question_limit; // Assuming `question_limit` is a property of the test

        // Shuffle and limit questions if necessary
        if ($questionLimit && count($questions) > $questionLimit) {
            shuffle($questions); // Randomize the order of questions
            $questions = array_slice($questions, 0, $questionLimit); // Select only the limited number of questions
        }

        $shuffledQuestions = [];
        foreach ($questions as $question) {
            $answers = $question->answers instanceof \yii\db\ActiveQuery ? $question->answers->all() : $question->answers;
            shuffle($answers); // Shuffle the answers
            $shuffledQuestions[] = [
                'question' => $question,
                'shuffledAnswers' => $answers,
            ];
        }

        if (Yii::$app->request->isPost) {
            $answers = Yii::$app->request->post('answers', []);
            $correct = 0;
            foreach ($shuffledQuestions as $item) {
                if (isset($answers[$item['question']->id])) {
                    $selectedAnswer = \common\models\Answers::findOne($answers[$item['question']->id]);
                    if ($selectedAnswer && $selectedAnswer->is_correct) {
                        $correct++;
                    }
                }
            }

            // Calculate percentage based on the question limit
            $total = 6; // Use question limit if set
            $percent = $total ? round($correct / $total * 100) : 0;
            $timeTaken = time() - Yii::$app->session->get('test_start_time', time());
            return $this->render('result', [
                'correct' => $correct,
                'total' => $total,
                'percent' => $percent,
                'timeTaken' => $timeTaken,
            ]);
        }

        Yii::$app->session->set('test_start_time', time());
        return $this->render('take', [
            'test' => $test,
            'questions' => $shuffledQuestions, // Pass shuffled questions to the view
        ]);
    }    /**
     * Activate tests at their start time.
     */
    public function actionActivateTests()
    {
        date_default_timezone_set('Asia/Tashkent');
        $currentTime = time();
        $tests = Tests::find()
            ->where(['status' => Tests::STATUS_INACTIVE])
            ->andWhere(['<=', 'start_time', $currentTime])
            ->all();

        foreach ($tests as $test) {
            $test->status = Tests::STATUS_ACTIVE;
            $test->save(false);
        }
    }

    /**
     * End tests after their duration expires.
     */
    public function actionEndTests()
    {
        date_default_timezone_set('Asia/Tashkent');
        $currentTime = time();
        $tests = Tests::find()
            ->where(['status' => Tests::STATUS_ACTIVE])
            ->andWhere(['<=', 'start_time + duration * 60', $currentTime])
            ->all();

        foreach ($tests as $test) {
            $test->status = Tests::STATUS_COMPLETED;
            $test->save(false);
        }
    }

    /**
     * Creates a new Tests model.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tests();
        $model->created_by = Yii::$app->user->id; // <-- shart!

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->saveClassAssignments();
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tests model.
     *
     * @param int $id Test ID
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = Tests::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->saveClassAssignments();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tests model.
     *
     * @param int $id Test ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionOverallResults()
    {
        $class = Yii::$app->request->get('class', null);
        $sortOrder = Yii::$app->request->get('sort_order', 'DESC');

        // Faqat ASC yoki DESC bo'lishiga ishonch hosil qilamiz
        if (!in_array($sortOrder, ['ASC', 'DESC'])) {
            $sortOrder = 'DESC';
        }

        $query = \common\models\TestResults::find()
            ->alias('test_results')
            ->select([
                'test_results.student_id',
                'AVG(test_results.percentage) AS average_percentage',
                'students.first_name',
                'students.last_name',
                'classes.class',
                'classes.class_name'
            ])
            ->joinWith(['student students'])
            ->leftJoin('student_group sg', 'students.id = sg.student_id')
            ->leftJoin('classes classes', 'sg.group_id = classes.id')
            ->groupBy([
                'test_results.student_id',
                'students.first_name',
                'students.last_name',
                'classes.class',
                'classes.class_name'
            ])
            ->orderBy(['average_percentage' => $sortOrder === 'DESC' ? SORT_DESC : SORT_ASC])
            ->asArray();

        if ($class) {
            $query->andWhere(['classes.class' => $class]);
        }

        $students = $query->all();

        return $this->render('overall-results', [
            'students' => $students,
            'class' => $class,
            'sortOrder' => $sortOrder,
        ]);
    }


    public function actionOverallResultsPdf($class = null, $sort_order = 'DESC')
    {
        $query = \common\models\TestResults::find()
            ->alias('test_results')
            ->select([
                'test_results.student_id',
                'AVG(test_results.percentage) as average_percentage',
                's.first_name',
                's.last_name',
                'c.class',
                'c.class_name',
            ])
            ->innerJoin('students s', 's.id = test_results.student_id')
            ->innerJoin('student_group sg', 'sg.student_id = s.id')
            ->innerJoin('classes c', 'c.id = sg.group_id')
            ->groupBy([
                'test_results.student_id',
                's.first_name',
                's.last_name',
                'c.class',
                'c.class_name',
            ]);

        if ($class) {
            $query->andWhere(['c.class' => $class]);
        }

        $query->orderBy(['average_percentage' => ($sort_order == 'ASC' ? SORT_ASC : SORT_DESC)]);

        $students = $query->asArray()->all();

        // View faylni chaqiramiz
        $html = $this->renderPartial('overall-results-pdf', [
            'students' => $students
        ]);

        // Mpdf ni ishga tushiramiz
        $mpdf = new Mpdf();
        $mpdf->SetTitle('Test natijalari');
        $mpdf->SetHeader('Test natijalari');
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->WriteHTML($html);

        // PDF ni brauzerda ochish
        return $mpdf->Output('test-natijalari.pdf', \Mpdf\Output\Destination::INLINE);
    }


    public function actionStudentDetails($studentId)
    {
        $results = \common\models\TestResults::find()
            ->where(['student_id' => $studentId])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        return $this->renderAjax('_student-details', [
            'results' => $results,
        ]);
    }


    /**
     * Finds the Tests model based on its primary key value.
     *
     * @param int $id Test ID
     * @return Tests the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tests::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}