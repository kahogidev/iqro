<?php

namespace backend\controllers;

use common\models\ExcelImportForm;
use common\models\Students;
use common\models\search\StudentsSearch;
use common\models\Tests;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * StudentController implements the CRUD actions for Students model.
 */
class StudentController extends Controller
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
                        'update' => ['GET', 'POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Students models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StudentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Students model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Students model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Students();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $user = new \common\models\User();
            $user->username = $model->first_name . $model->last_name;
            $user->email = $model->first_name . '.' . $model->last_name . '@example.com';
            $user->role = \common\models\User::ROLE_STUDENT;
            $password = $model->first_name . $model->last_name;
            $user->setPassword($password);
            $user->generateAuthKey();
            $user->status = \common\models\User::STATUS_ACTIVE;
            if ($user->save()) {
                $model->user_id = $user->id;
                if ($model->save()) {
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Students model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Students model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    // In StudentController.php
    // In backend/controllers/StudentController.php


    public function actionDashboard()
    {
        $student = \common\models\Students::findOne(['user_id' => Yii::$app->user->id]);
        return $this->render('dashboard', [
            'model' => $student,
        ]);
    }

    public function actionTest($id = null)
    {
        $student = \common\models\Students::findOne(['user_id' => Yii::$app->user->id]);
        $tests = [];

        if ($student) {
            $groupIds = \common\models\StudentGroup::find()
                ->select('group_id')
                ->where(['student_id' => $student->id])
                ->column();

            if (!empty($groupIds)) {
                $tests = \common\models\Tests::find()
                    ->joinWith('classes') // adjust relation name if needed
                    ->where(['classes.id' => $groupIds])
                    ->all();
            }
        }

        // If $id is provided, find the specific test
        $test = null;
        if ($id) {
            $test = \common\models\Tests::findOne($id);
            if (!$test) {
                throw new \yii\web\NotFoundHttpException('Test not found');
            }
        }

        return $this->render('student-tests', [
            'tests' => $tests,
            'test' => $test,
            'student' => $student,
            // 'questions' => $questions, // Load as needed
        ]);
    }

    public function actionCompleteTest($testId)
    {
        $test = \common\models\Tests::findOne($testId);
        if (!$test) {
            throw new \yii\web\NotFoundHttpException('Test not found.');
        }

        $questions = $test->questions;
        if (empty($questions)) {
            throw new \yii\web\NotFoundHttpException('No questions found for this test.');
        }

        if (Yii::$app->request->isPost) {
            $answers = Yii::$app->request->post('answers', []);
            $correct = 0;

            foreach ($questions as $question) {
                if (isset($answers[$question->id])) {
                    $selectedAnswer = \common\models\Answers::findOne($answers[$question->id]);
                    if ($selectedAnswer && $selectedAnswer->is_correct) {
                        $correct++;
                    }
                }
            }

                $totalQuestions = $test->question_limit;
            $percentage = $totalQuestions ? round(($correct / $totalQuestions) * 100, 2) : 0;

            // ⚠️ Avvalo user_id orqali student topiladi
            $student = \common\models\Students::find()->where(['user_id' => Yii::$app->user->id])->one();
            if (!$student) {
                throw new \yii\web\NotFoundHttpException('Talaba profili topilmadi.');
            }

            $result = new \common\models\TestResults();
            $result->student_id = $student->id; // ✅ To‘g‘ri student_id
            $result->test_id = $test->id;
            $result->teacher_id = $test->created_by;
            $result->correct_answers = $correct;
            $result->percentage = $percentage;
            $result->created_at = time();

            if (!$result->save()) {
                Yii::error($result->getErrors(), __METHOD__);
                throw new \yii\web\ServerErrorHttpException('Test natijalari saqlanmadi.');
            }

            return $this->redirect(['history']);
        }

        return $this->render('take', [
            'test' => $test,
            'questions' => $questions,
        ]);
    }
    public function actionHistory()
    {
        $student = \common\models\Students::findOne(['user_id' => Yii::$app->user->id]);
        $results = [];

        if ($student) {
            $results = \common\models\TestResults::find()
                ->where(['student_id' => $student->id])
                ->orderBy(['created_at' => SORT_DESC])
                ->all();
        }

        return $this->render('history', [
            'results' => $results,
            'student' => $student,
        ]);
    }


    /**
     * Finds the Students model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Students the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Students::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionImport()
    {
        $model = new ExcelImportForm();

        if (Yii::$app->request->isPost) {
            $model->excelFile = UploadedFile::getInstance($model, 'excelFile');
            if ($model->uploadAndProcess()) {
                Yii::$app->session->setFlash('success', 'O‘quvchilar muvaffaqiyatli import qilindi.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('import', ['model' => $model]);
    }
    public function actionExportPdf()
    {
        $students = Students::find()->all();

        $mpdf = new Mpdf();
        $html = '<h1>Students List</h1>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0">';
        $html .= '<tr>
                <th>#</th>
                <th>Ism</th>
                <th>Familiya</th>
                <th>Otasining ismi</th>
                <th>Otasining telefon raqami</th>
                <th>Onasining telefon raqami</th>
              </tr>';

        $counter = 1; // Initialize counter for serial numbers
        foreach ($students as $student) {
            $html .= '<tr>
                    <td>' . $counter . '</td>
                    <td>' . $student->first_name . '</td>
                    <td>' . $student->last_name . '</td>
                    <td>' . $student->middle_name . '</td>
                    <td>' . $student->father_phone . '</td>
                    <td>' . $student->mother_phone . '</td>
                  </tr>';
            $counter++; // Increment counter
        }

        $html .= '</table>';
        $mpdf->WriteHTML($html);

        $fileName = 'students.pdf';
        $filePath = Yii::getAlias('@webroot') . '/exports/' . $fileName;
        $mpdf->Output($filePath, \Mpdf\Output\Destination::FILE);

        return Yii::$app->response->sendFile($filePath);
    }
public function actionTestReviewTemp()
{
    $answers = Yii::$app->session->get('selected_answers');
    $testId = Yii::$app->session->get('review_test_id');

    if (!$answers || !$testId) {
        throw new NotFoundHttpException('Ma’lumot topilmadi yoki sessiya muddati tugagan.');
    }

    $test = Tests::findOne($testId);
    if (!$test) {
        throw new NotFoundHttpException('Test topilmadi.');
    }

    $questions = $test->questions;

    // Savollar va javoblarni tayyorlash
    $reviewData = [];
    foreach ($questions as $question) {
        $allAnswers = $question->answers;
        $selectedAnswerId = $answers[$question->id] ?? null;
        $selectedAnswer = $selectedAnswerId ? \common\models\Answers::findOne($selectedAnswerId) : null;
        $correctAnswer = null;
        foreach ($allAnswers as $ans) {
            if ($ans->is_correct) {
                $correctAnswer = $ans;
                break;
            }
        }

        $reviewData[] = [
            'question' => $question,
            'selectedAnswer' => $selectedAnswer,
            'correctAnswer' => $correctAnswer,
            'isCorrect' => $selectedAnswer && $selectedAnswer->is_correct,
        ];
    }

    return $this->render('test-review-temp', [
        'test' => $test,
        'reviewData' => $reviewData,
    ]);
}


    

}
