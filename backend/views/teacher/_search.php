<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\TeachersSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="teachers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'passport_series_number') ?>

    <?= $form->field($model, 'birth_date') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'marital_status') ?>

    <?php // echo $form->field($model, 'permanent_address') ?>

    <?php // echo $form->field($model, 'current_address') ?>

    <?php // echo $form->field($model, 'registered_address') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'personal_phone') ?>

    <?php // echo $form->field($model, 'additional_phone') ?>

    <?php // echo $form->field($model, 'contact_info') ?>

    <?php // echo $form->field($model, 'hire_date') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'department') ?>

    <?php // echo $form->field($model, 'specialization') ?>

    <?php // echo $form->field($model, 'experience_years') ?>

    <?php // echo $form->field($model, 'academic_degree') ?>

    <?php // echo $form->field($model, 'certificates') ?>

    <?php // echo $form->field($model, 'diploma') ?>

    <?php // echo $form->field($model, 'weekly_hours') ?>

    <?php // echo $form->field($model, 'subjects') ?>

    <?php // echo $form->field($model, 'classes') ?>

    <?php // echo $form->field($model, 'passport_image') ?>

    <?php // echo $form->field($model, 'diploma_image') ?>

    <?php // echo $form->field($model, 'certificate_image') ?>

    <?php // echo $form->field($model, 'hire_order_image') ?>

    <?php // echo $form->field($model, 'contract_pdf') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
