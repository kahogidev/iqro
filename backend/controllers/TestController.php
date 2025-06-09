<?php

namespace backend\controllers;

use common\models\Questions;
use common\models\Tests;
use common\models\search\TestsSearch;
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
// backend/controllers/TestController.php
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
     * Displays a single Tests model.
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
     * Creates a new Tests model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    public function actionCreate()
    {
        $model = new Tests();

        // In your TestController.php, after saving the $model
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->saveClassAssignments(); // This will fill test_assignments
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionUpdate($id)
    {
        $model = Tests::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->saveClassAssignments(); // Update class associations
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing Tests model.
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
     * Finds the Tests model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
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
    public function actionStartTest($id)
    {
        $test = \common\models\Tests::findOne($id);

        if ($test) {
            $test->start_time = date('Y-m-d H:i:s'); // Set current timestamp
            if ($test->save()) {
                return $this->redirect(['test/view', 'id' => $test->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Failed to start the test.');
            }
        } else {
            throw new \yii\web\NotFoundHttpException('Test not found.');
        }
    }
    public function getQuestions()
    {
        return $this->hasMany(Questions::class, ['test_id' => 'id']);
    }


}
