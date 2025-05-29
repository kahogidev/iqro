<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Students $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="students-view">

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
            'first_name',
            'last_name',
            'middle_name',
            'birth_date',
            'birth_place',
            'address',
            'father_name',
            'mother_name',
            'mother_phone',
            'father_workplace',
            'mother_workplace',
            'father_position',
            'mother_position',
            'talents:ntext',
            'activities:ntext',
            'behavior:ntext',
            'health:ntext',
            'special_needs:ntext',
            'admission_date',
            'photo',
            'direction',
            'emergency_contact',
            'emergency_phone',
        ],
    ]) ?>

</div>
