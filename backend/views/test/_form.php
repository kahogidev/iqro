<?php

use common\models\Classes;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Tests $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tests-form">
    <div class="dashboard-main-body" style="margin: 30px;">
        <div class="card h-100 p-0 radius-12 p-5">

            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-4">
                    <?= $form->field($model, 'title')->textInput(['type' => 'text', 'maxlength' => true]) ?>
                </div>
                <div class="col-4">
                    <?= $form->field($model, 'subject')->textInput(['type' => 'text', 'maxlength' => true]) ?>
                </div>
                <div class="col-4">
                    <?= $form->field($model, 'question_limit')->textInput(['type' => 'number', 'min' => 1, 'placeholder' => 'Enter question limit']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <?= $form->field($model, 'start_time')->textInput(['type' => 'datetime-local', 'id' => 'start-time']) ?>
                </div>
                <div class="col-4">
                    <?= $form->field($model, 'duration')->textInput(['type' => 'number', 'id' => 'duration', 'min' => 1, 'placeholder' => 'Enter duration in minutes']) ?>
                </div>
                <div class="col-4">
                    <?= $form->field($model, 'end_time')->textInput(['type' => 'datetime-local', 'id' => 'end-time', 'readonly' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <?= $form->field($model, 'teacher_id')->dropDownList(
                        \yii\helpers\ArrayHelper::map(
                            \common\models\Teachers::find()->all(),
                            'id',
                            function ($teacher) {
                                return $teacher->first_name . ' ' . $teacher->last_name;
                            }
                        ),
                        ['prompt' => 'Select a teacher']
                    ) ?>
                </div>
            </div>

            <div class="col-4">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary px-18 py-11 dropdown-toggle toggle-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Classes
                    </button>
                    <ul class="dropdown-menu" style="max-height: 300px; overflow-y: auto;">
                        <?php
                        echo $form->field($model, 'class_ids')->checkboxList(
                            \yii\helpers\ArrayHelper::map(
                                \common\models\Classes::find()->all(),
                                'id',
                                function($model) {
                                    return $model->class . ' ' . $model->class_name;
                                }
                            ),
                            [
                                'item' => function($index, $label, $name, $checked, $value) {
                                    return '<div class="form-check style-check d-flex align-items-center">'
                                        . '<input class="form-check-input" type="checkbox" name="' . $name . '" value="' . $value . '"' . ($checked ? ' checked' : '') . ' id="class_' . $value . '">'
                                        . '<label class="form-check-label" for="class_' . $value . '">' . $label . '</label>'
                                        . '</div>';
                                }
                            ]
                        );
                        ?>
                    </ul>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

            <script>
                document.getElementById('start-time').addEventListener('change', updateEndTime);
                document.getElementById('duration').addEventListener('input', updateEndTime);

                function updateEndTime() {
                    const startTime = document.getElementById('start-time').value;
                    const duration = parseInt(document.getElementById('duration').value, 10);

                    if (startTime && duration > 0) {
                        const startDate = new Date(startTime);
                        startDate.setMinutes(startDate.getMinutes() + duration);
                        const endTime = startDate.toISOString().slice(0, 16); // Format as 'YYYY-MM-DDTHH:mm'
                        document.getElementById('end-time').value = endTime;
                    } else {
                        document.getElementById('end-time').value = '';
                    }
                }
            </script>

        </div>
    </div>
</div>