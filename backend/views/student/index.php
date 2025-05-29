<?php

use common\models\Students;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\StudentsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Students', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'first_name',
            'last_name',
            'middle_name',
            //'birth_date',
            //'birth_place',
            //'address',
            //'father_name',
            //'mother_name',
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
            //'direction',
            //'emergency_contact',
            //'emergency_phone',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Students $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
