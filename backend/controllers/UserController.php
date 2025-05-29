<?php

namespace backend\controllers;

use common\models\StudentForm;
use common\models\Students;
use common\models\User;
use common\models\search\UserSearch;
use common\models\UserForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new UserForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->loadDynamicForm(Yii::$app->request->post());

            if ($model->validateDynamicForm()) {
                $user = new User();
                $user->username = $model->username;
                $user->email = $model->email;
                $user->password = Yii::$app->security->generatePasswordHash($model->password);
                $user->role = $model->role;

                if ($user->save()) {
                    if ($model->role === 'student') {
                        $student = new Students();
                        $student->user_id = $user->id;
                        $student->attributes = $model->dynamicForm->attributes;
                        $student->save();
                    }
//                    elseif ($model->role === 'teacher') {
//                        $teacher = new Teachers();
//                        $teacher->user_id = $user->id;
//                        $teacher->attributes = $model->dynamicForm->attributes;
//                        $teacher->save();
//                    }

                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $user = User::findOne($id);
        $model = new UserForm();
        $model->username = $user->username;
        $model->email = $user->email;
        $model->role = $user->role;

        if ($model->role === 'student') {
            $student = Students::findOne(['user_id' => $id]);
            $model->dynamicForm = new StudentForm();
            $model->dynamicForm->attributes = $student->attributes;
        }
//        elseif ($model->role === 'teacher') {
//            $teacher = Teachers::findOne(['user_id' => $id]);
//            $model->dynamicForm = new TeacherForm();
//            $model->dynamicForm->attributes = $teacher->attributes;
//        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->loadDynamicForm(Yii::$app->request->post());

            if ($model->validateDynamicForm()) {
                $user->username = $model->username;
                $user->email = $model->email;
                $user->role = $model->role;

                if ($user->save()) {
                    if ($model->role === 'student') {
                        $student->attributes = $model->dynamicForm->attributes;
                        $student->save();
                    }
//                    elseif ($model->role === 'teacher') {
//                        $teacher->attributes = $model->dynamicForm->attributes;
//                        $teacher->save();
//                    }

                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */


    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
