<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\StudentsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="students-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'middle_name') ?>

    <?php // echo $form->field($model, 'birth_date') ?>

    <?php // echo $form->field($model, 'birth_place') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'father_name') ?>

    <?php // echo $form->field($model, 'mother_name') ?>

    <?php // echo $form->field($model, 'mother_phone') ?>

    <?php // echo $form->field($model, 'father_workplace') ?>

    <?php // echo $form->field($model, 'mother_workplace') ?>

    <?php // echo $form->field($model, 'father_position') ?>

    <?php // echo $form->field($model, 'mother_position') ?>

    <?php // echo $form->field($model, 'talents') ?>

    <?php // echo $form->field($model, 'activities') ?>

    <?php // echo $form->field($model, 'behavior') ?>

    <?php // echo $form->field($model, 'health') ?>

    <?php // echo $form->field($model, 'special_needs') ?>

    <?php // echo $form->field($model, 'admission_date') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'direction') ?>

    <?php // echo $form->field($model, 'emergency_contact') ?>

    <?php // echo $form->field($model, 'emergency_phone') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
