<?php

use common\models\Classes;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var \common\models\search\ClassesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sinflar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classes-index">

    <h1 style="font-size: 30px!important; margin: 10px"><?= $this->title ?></h1>
    <div class="card h-100 p-3 radius-12 m-3">

        <p>
            <?= Html::a('Sinf yaratish', ['create'], ['class' => 'btn btn-primary']) ?>
        </p>

        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table bordered-table sm-table mb-0'],
                    'rowOptions' => function ($model) {
                        return [
                            'style' => 'cursor:pointer;',
                            'onclick' => "window.location='" . Url::to(['assign-students', 'id' => $model->id]) . "'",
                        ];
                    },
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'class',
                        'class_name',
                        'created_at',
                        'updated_at',
                        [
                            'class' => ActionColumn::className(),
                            'header' => 'Amallar',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'template' => '{buttons}',
                            'contentOptions' => [
                                'style' => 'min-width:180px;max-width:180px;width:180px',
                                'class' => 'v-align-middle'
                            ],
                            'buttons' => [
                                'buttons' => function ($url, $model) {
                                    $controller = Yii::$app->controller->id;
                                    $deleteUrl = Url::to(["$controller/delete", 'id' => $model->id]);
                                    $assignUrl = Url::to(["$controller/assign-students", 'id' => $model->id]);
                                    $csrfInput = Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken());

                                    $code = <<<BUTTONS
<div class="d-flex align-items-center gap-10 justify-content-center">

    <!-- Assign Students Button -->
    <a href="{$assignUrl}" onclick="event.stopPropagation();" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" title="O‘quvchi biriktirish"> 
        <iconify-icon icon="mdi:account-multiple-plus-outline" class="menu-icon"></iconify-icon>
    </a>

    <!-- Edit Button -->
    <a href="update?id={$model->id}" onclick="event.stopPropagation();" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" title="Tahrirlash"> 
        <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
    </a>

    <!-- Delete Form -->
    <form method="post" action="{$deleteUrl}" onclick="event.stopPropagation();" style="display:inline;" onsubmit="return confirm('Haqiqatan ham o‘chirmoqchimisiz?')">
        {$csrfInput}
        <button type="submit" class="border-0 bg-transparent remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" title="O‘chirish">
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

<?php
// Bu JS kod faqatgina agar formada bosilgan bo‘lsa, satrga yo‘naltirilmasligini ta'minlaydi
$this->registerJs("
    $('.classes-index').on('click', 'a, button, form', function(e) {
        e.stopPropagation();
    });
");
?>
