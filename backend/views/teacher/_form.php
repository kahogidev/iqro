<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Classes;
/** @var yii\web\View $this */
/** @var common\models\Teachers $model */
/** @var yii\widgets\ActiveForm $form */
$classes = Classes::find()->select(['class', 'id'])->indexBy('id')->column(); // Fetch classes

?>

<div class="teachers-form">
    <div class="dashboard-main-body" style="margin: 30px;">
        <div class="card h-100 p-0 radius-12 p-5">

            <?php $form = ActiveForm::begin([
                'fieldConfig' => [
                    'options' => ['class' => 'form-group'],
                    'template' => "{label}\n{input}\n<div class='invalid-feedback'>{error}</div>",
                    'inputOptions' => ['class' => 'form-control'],
                    'errorOptions' => ['class' => 'invalid-feedback']
                ]
            ]); ?>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
                </div>


                <div class="col-md-4">
                    <?= $form->field($model, 'passport_series_number')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'birth_date')->textInput(['type' => 'date']) ?>                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'marital_status')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'permanent_address')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'current_address')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'registered_address')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'contact_info')->textInput(['maxlength' => true]) ?>

                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'personal_phone')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'additional_phone')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'hire_date')->textInput(['type'=>'date']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'department')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'specialization')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'experience_years')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'academic_degree')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'certificates')->textarea(['rows' => 1]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'diploma')->textarea(['rows' => 1]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'weekly_hours')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'subjects')->textarea(['rows' => 1]) ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'passport_image')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'diploma_image')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'certificate_image')->textInput([  'maxlength'=> true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'hire_order_image')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'contract_pdf')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Saqlash', ['class' => 'btn btn-primary', 'style' => 'margin-top:20px']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>