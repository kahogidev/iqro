<?php

use common\models\Teachers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\TeachersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'O\'qituvchilar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-index">
    <h1 style="font-size: 30px!important; margin: 10px"><?= $this->title ?></h1>
    <div class="card h-100 p-3 radius-12 m-3">

    <p>
        <?= Html::a('O\'qituvchi yaratish', ['create'], ['class' => 'btn btn-primary']) ?>
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
            'first_name',

            'passport_series_number',
//            'birth_date',
            //'gender',
            //'nationality',
            //'marital_status',
            //'permanent_address',
            //'current_address',
            //'registered_address',
            //'photo',
            'personal_phone',
            //'additional_phone',
            //'contact_info',
            //'hire_date',
            //'position',
            //'department',
            //'specialization',
            //'experience_years',
            //'academic_degree',
            //'certificates:ntext',
            //'diploma:ntext',
            //'weekly_hours',
            'subjects:ntext',
            //'classes:ntext',
            //'passport_image',
            //'diploma_image',
            //'certificate_image:ntext',
            //'hire_order_image',
            //'contract_pdf',
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
                </div>
BUTTONS;
                        return $code;
                    }
                ],
            ],
        ],
    ]); ?>


</div>
