<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Teachers $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="teachers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'full_name',
            'passport_series_number',
            'birth_date',
            'gender',
            'nationality',
            'marital_status',
            'permanent_address',
            'current_address',
            'registered_address',
            'photo',
            'personal_phone',
            'additional_phone',
            'contact_info',
            'hire_date',
            'position',
            'department',
            'specialization',
            'experience_years',
            'academic_degree',
            'certificates:ntext',
            'diploma:ntext',
            'weekly_hours',
            'subjects:ntext',
            'classes:ntext',
            'passport_image',
            'diploma_image',
            'certificate_image:ntext',
            'hire_order_image',
            'contract_pdf',
        ],
    ]) ?>

</div>
