<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Students $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="students-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birth_date')->textInput() ?>

    <?= $form->field($model, 'birth_place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_workplace')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_workplace')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'talents')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'activities')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'behavior')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'health')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'special_needs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'admission_date')->textInput() ?>

    <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direction')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emergency_contact')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emergency_phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
