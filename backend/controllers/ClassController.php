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
use yii\filters\VerbFilter;
use yii\web\Controller;
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
        $class = Classes::findOne($id);

        $assignedDataProvider = new ActiveDataProvider([
            'query' => Students::find()
                ->alias('s')
                ->innerJoin('student_group sg', 'sg.student_id = s.id')
                ->where(['sg.group_id' => $id]),
            'pagination' => ['pageSize' => 10],
        ]);

        $unassignedStudents = Students::find()
            ->where(['NOT IN', 'id', StudentGroup::find()->select('student_id')->where(['group_id' => $id])])
            ->all();

        if (Yii::$app->request->isPost) {
            $selected = Yii::$app->request->post('student_ids', []);
            foreach ($selected as $studentId) {
                $group = new StudentGroup();
                $group->group_id = $id;
                $group->student_id = $studentId;
                $group->added_by = Yii::$app->user->id;
                $group->save();
            }
            Yii::$app->session->setFlash('success', 'O‘quvchilar biriktirildi!');
            return $this->redirect(['assign-students', 'id' => $id]);
        }
        $teachers = Teachers::find()->all();

        return $this->render('assign-students', [
            'id' => $id,
            'assignedDataProvider' => $assignedDataProvider,
            'unassignedStudents' => $unassignedStudents,
            'teachers' => $teachers,
        ]);
    }

    public function actionRemoveStudent($group_id, $student_id)
    {
        $relation = StudentGroup::findOne(['group_id' => $group_id, 'student_id' => $student_id]);

        if ($relation) {
            $relation->delete();
            Yii::$app->session->setFlash('success', 'O‘quvchi sinfdan olib tashlandi.');
        } else {
            Yii::$app->session->setFlash('error', 'Bunday biriktirish topilmadi.');
        }

        return $this->redirect(['assign-students', 'id' => $group_id]);
    }


}
