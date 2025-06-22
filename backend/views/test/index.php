`<?php

use common\models\Tests;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\TestsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var common\models\TestImportForm $importModel */
$this->title = 'Testlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tests-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="card h-100 p-1 radius-12 m-3">

    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
    <p>
        <?= Html::a('Test yaratish', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table bordered-table sm-table mb-0'],
        'rowOptions' => function ($model) {
            return [
                'style' => 'cursor:pointer;',
                'data-id' => $model->id, // Optional: pass id for AJAX
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            ['attribute'=>'subject',
                'contentOptions' => ['style' => 'width: 100px;'],
                ],

            [
                    'attribute' => 'title',
                    'contentOptions' => ['style' => 'width: 150px;'],
            ],
//            'description:ntext',
            [
                    'attribute' => 'question_limit',
                    'contentOptions' => ['style' => 'width: 100px;'],

            ],


            ['attribute'=>'start_time',
                'contentOptions' => ['style' => 'width: 150px;'],
            ],
            //'end_time',

            [
                'attribute' => 'assignedClasses',
                'label' => 'Assigned Classes',
                'value' => function ($model) {
                    return implode(', ', array_map(function ($class) {
                        return $class->class . ' ' . $class->class_name;
                    }, $model->classes));
                },
                'contentOptions' => ['style' => 'max-width: 100px;'],

            ],

            //'created_at',
            //'updated_at',
            [
                'attribute' => 'is_imported',
                'label' => 'Yuklangan',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->is_imported ? '<span class="bg-success-focus text-success-600 border border-success-main px-24 py-4 radius-4 fw-medium text-sm">Yuklangan</span>' : '';
                },
                'contentOptions' => ['style' => 'width:100px'],
            ],
            [
                'class' => ActionColumn::className(),
                'header' => 'Amallar',
                'headerOptions' => ['style' => 'text-align:center'],
                'template' => '{buttons}',
                'contentOptions' => [
                    'style' => 'min-width:150px;max-width:150px;width:150px',
                    'class' => 'v-align-middle'
                ],
                'buttons' => [
                    'buttons' => function ($url, $model) {
                        $controller = Yii::$app->controller->id;
                        $deleteUrl = Url::to(["$controller/delete", 'id' => $model->id]);

                        $csrfInput = Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken());
                        $importUrl = Url::to(["$controller/import-word", 'id' => $model->id]);

                        $code = <<<BUTTONS
                <div class="d-flex align-items-center gap-10 justify-content-center">
                    <a href="{$controller}/update?id={$model->id}" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"> 
                        <iconify-icon  icon="lucide:edit" class="menu-icon"></iconify-icon>
                    </a>
                    <form method="post" action="{$deleteUrl}" style="display:inline;" onsubmit="return confirm('Haqiqatan ham o‘chirmoqchimisiz?')">
                        {$csrfInput}
                        <button type="submit" class="border-0 bg-transparent remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                            <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                        </button>
                    </form>
                    <a href="{$importUrl}" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                     <iconify-icon  icon="lucide:upload" class="menu-icon"></iconify-icon>
                    </a>
                </div>
BUTTONS;
                        return $code;
                    }
                ],
            ],
        ],
    ]); ?>
        </div>
    </div>



</div>
`