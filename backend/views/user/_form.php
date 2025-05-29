<?php

use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $form yii\widgets\ActiveForm */
/* @var $dynamicForm common\models\StudentForm */

?>

<div class="student-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $this->render('_form', [
        'dynamicForm' => $model, // Pass the model
        'form' => $form,         // Pass the form instance
    ]) ?>
    <?= $form->field($dynamicForm, 'first_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($dynamicForm, 'last_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($dynamicForm, 'middle_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($dynamicForm, 'birth_date')->input('date') ?>
    <?= $form->field($dynamicForm, 'birth_place')->textInput(['maxlength' => true]) ?>
    <?= $form->field($dynamicForm, 'address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($dynamicForm, 'father_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($dynamicForm, 'mother_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($dynamicForm, 'father_phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($dynamicForm, 'mother_phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($dynamicForm, 'father_workplace')->textInput(['maxlength' => true]) ?>
    <?= $form->field($dynamicForm, 'mother_workplace')->textInput(['maxlength' => true]) ?>
    <?= $form->field($dynamicForm, 'father_position')->textInput(['maxlength' => true]) ?>
    <?= $form->field($dynamicForm, 'mother_position')->textInput(['maxlength' => true]) ?>
    <?= $form->field($dynamicForm, 'talents')->textarea(['rows' => 3]) ?>
    <?= $form->field($dynamicForm, 'activities')->textarea(['rows' => 3]) ?>
    <?= $form->field($dynamicForm, 'behavior')->textarea(['rows' => 3]) ?>
    <?= $form->field($dynamicForm, 'health')->textarea(['rows' => 3]) ?>
    <?= $form->field($dynamicForm, 'special_needs')->textarea(['rows' => 3]) ?>
    <?= $form->field($dynamicForm, 'admission_date')->input('date') ?>
    <?= $form->field($dynamicForm, 'photo')->textInput(['maxlength' => true]) ?>
    <?= $form->field($dynamicForm, 'specialization')->dropDownList([1 => 'Specialization 1', 2 => 'Specialization 2'], ['prompt' => 'Select Specialization']) ?>
    <?= $form->field($dynamicForm, 'emergency_contact')->textInput(['maxlength' => true]) ?>
    <?= $form->field($dynamicForm, 'emergency_phone')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
