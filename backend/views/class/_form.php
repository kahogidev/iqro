<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Classes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="classes-form">
    <div class="dashboard-main-body" style="margin: 30px;">
        <div class="card h-100 p-0 radius-12 p-5">

    <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'class')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'class_name')->textInput(['maxlength' => true]) ?>
                </div>


    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-primary', 'style'=>'margin-top:20px']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
