<?php

use common\models\Students;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use kartik\export\ExportMenu;


/** @var yii\web\View $this */
/** @var common\models\search\StudentsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'O\'quvchilar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-index">

    <h1 style="font-size: 30px!important; margin: 10px"><?= $this->title ?></h1>
    <div class="card h-100 p-3 radius-12 m-3">
        <p>
            <?= Html::a('O\'quvchi yaratish', ['create'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Excel import qilish', ['import'], ['class' => 'btn btn-success']) ?>
            <?php


            /* Add Export PDF Button */
            echo Html::a('Yuklab olish', ['student/export-pdf'], [
                'class' => 'btn btn-primary',
                'target' => '_blank', // Optional: Opens in a new tab
                'data-pjax' => '0',   // Prevents PJAX interference
            ]);
            ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <div class="card-body p-24">
            <div class="table-responsive  scroll-sm">


                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table bordered-table sm-table mb-0'],

                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

//            'id',

//            'user_id',
                        [
                                'attribute'=>'first_name',
                                'contentOptions' => ['style' => 'min-width: 150px; max-width: 250px; width: 200px'],

                            ],
                        [
                            'attribute'=>'last_name',
                            'contentOptions' => ['style' => 'min-width: 150px; max-width: 250px; width: 200px'],

                        ],
                        [
                            'attribute'=>'middle_name',
                            'contentOptions' => ['style' => 'min-width: 150px; max-width: 250px; width: 200px'],

                        ],
                        [
                            'attribute'=>'birth_date',
                            'contentOptions' => ['style' => 'min-width: 150px; max-width: 250px; width: 200px'],

                        ],
                        //'birth_place',
                        //'address',
                        'father_name',
                        'mother_name',
                        //'mother_phone',
                        //'father_workplace',
                        //'mother_workplace',
                        //'father_position',
                        //'mother_position',
                        //'talents:ntext',
                        //'activities:ntext',
                        //'behavior:ntext',
                        //'health:ntext',
                        //'special_needs:ntext',
                        //'admission_date',
                        //'photo',
//            'direction',
                        //'emergency_contact',
                        //'emergency_phone',
                        [
                            'class' => ActionColumn::className(),
                            'header' => 'Amallar',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'template' => '{buttons}',
                            'contentOptions' => [
                                'style' => 'min-width:150px;max-width:250px;width:150px',
                                'class' => 'v-align-middle'
                            ],
                            'buttons' => [
                                'buttons' => function ($url, $model) {
                                    $controller = Yii::$app->controller->id;
                                    $deleteUrl = Url::to(["$controller/delete", 'id' => $model->id]);

                                    $csrfInput = Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken());

                                    $code = <<<BUTTONS
                <div class="d-flex align-items-center gap-10 justify-content-center">
                    <a href="{$controller}/view?id={$model->id}" class="bg-primary-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"> 
                        <iconify-icon  icon="lucide:eye" class="menu-icon"></iconify-icon>
                    </a>
                    <a href="{$controller}/update?id={$model->id}" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"> 
                        <iconify-icon  icon="lucide:edit" class="menu-icon"></iconify-icon>
                    </a>
                    <form method="post" action="{$deleteUrl}" style="display:inline;" onsubmit="return confirm('Haqiqatan ham o‘chirmoqchimisiz?')">
                        {$csrfInput}
                        <button type="submit" class="border-0 bg-transparent remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                            <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                        </button>
                    </form>
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

</div>
