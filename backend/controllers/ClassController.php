<?php

namespace backend\controllers;

use common\models\Classes;
use common\models\search\ClassesSearch;
use common\models\StudentGroup;
use common\models\Students;
use common\models\TeacherClass;
use common\models\Teachers;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Mpdf\Mpdf;
use yii\web\NotFoundHttpException;

/**
 * ClassController implements the CRUD actions for Classes model.
 */
class ClassController extends Controller
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
                        'update' => ['GET','POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Classes models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ClassesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Classes model.
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
     * Creates a new Classes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Classes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Classes model.
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
     * Deletes an existing Classes model.
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

    /**
     * Finds the Classes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Classes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Classes::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAssignTeachers($id)
    {
        $group = Classes::findOne($id);
        $teacherIds = Yii::$app->request->post('teacher_ids', []);
        foreach ($teacherIds as $teacherId) {
            if (!TeacherClass::find()->where(['class_id' => $id, 'teacher_id' => $teacherId])->exists()) {
                $link = new TeacherClass(); // bu oraliq jadval modeli
                $link->class_id = $id;
                $link->teacher_id = $teacherId;
                $link->save();
            }
        }

        return $this->redirect(['assign-students', 'id' => $id]); // yoki kerakli sahifa
    }



    public function actionAssignStudents($id)
    {
        $emptyProvider = new ArrayDataProvider([
            'allModels' => [],
            'pagination' => false,
        ]);

        $query = Students::find()
            ->alias('s')
            ->innerJoin('student_group sg', 'sg.student_id = s.id')
            ->where(['sg.group_id' => $id]);

        Yii::info("ASSIGNED query: " . $query->createCommand()->getRawSql(), __METHOD__);

        $assignedDataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 20],
        ]);
        if ($assignedDataProvider->getCount() === 0) {
            $assignedDataProvider = $emptyProvider; // Agar hech qanday o'quvchi bo'lmasa, bo'sh provider
        }



        $teachers = Teachers::find()->limit(20)->all(); // ← faqat sinov uchun

        $unassignedStudents = Students::find()
            ->where(['NOT IN', 'id', StudentGroup::find()->select('student_id')])

            ->all();

        if (Yii::$app->request->isPost) {
            $selected = Yii::$app->request->post('student_ids', []);
            foreach ($selected as $studentId) {
                $group = new StudentGroup();
                $group->group_id = $id;
                $group->student_id = $studentId;
                $group->added_by = Yii::$app->user->id;
                if (!$group->save()) {
                    Yii::error('StudentGroup save error: ' . json_encode($group->errors), __METHOD__);
                }
            }
            Yii::$app->session->setFlash('success', 'O‘quvchilar biriktirildi!');
            return $this->redirect(['assign-students', 'id' => $id]);
        }


        return $this->render('assign-students', [
            'assignedDataProvider' => $assignedDataProvider,
            'unassignedStudents' => $unassignedStudents,
            'teachers' => $teachers,
            'id' => $id,
        ]);
    }


public function actionRemoveStudent($student_id, $class_id)
{
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $deleted = Yii::$app->db->createCommand()
        ->delete('student_group', [
            'student_id' => $student_id,
            'group_id' => $class_id,
        ])
        ->execute();

    if ($deleted) {
        Yii::$app->session->setFlash('success', 'O‘quvchi sinfdan chiqarildi.');
    } else {
        Yii::$app->session->setFlash('error', 'O‘chirishda xatolik yuz berdi.');
    }

    return $this->redirect(['class/assign-students', 'id' => $class_id]);
}

    public function actionExportAssignedStudents($id)
    {
        $group = Classes::findOne($id);
        if (!$group) {
            throw new NotFoundHttpException("Sinf topilmadi.");
        }

        $students = Students::find()
            ->alias('s')
            ->innerJoin('student_group sg', 'sg.student_id = s.id')
            ->where(['sg.group_id' => $id])
            ->all();

        $html = $this->renderPartial('export-assigned-students', [
            'group' => $group,
            'students' => $students,
        ]);

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output("assigned_students_class_{$id}.pdf", 'D'); // 'D' = download, 'I' = inline view
    }

}
