<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $model common\models\Questions */
/** @var $answers common\models\Answers[] */

$form = ActiveForm::begin();
?>

<?= $form->field($model, 'question_text')->textInput(['maxlength' => true]) ?>

<div id="answers-container">
    <?php foreach ($answers as $i => $answer): ?>
        <div class="answer-item">
            <?= $form->field($answer, "[$i]answer_text")->textInput(['maxlength' => true]) ?>
            <?= $form->field($answer, "[$i]is_correct")->checkbox() ?>
        </div>
    <?php endforeach; ?>
</div>

<button type="button" id="add-answer" class="btn btn-secondary">Add Answer</button>

<div class="form-group" style="margin-top: 20px;">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

<script>
    document.getElementById('add-answer').addEventListener('click', function () {
        const container = document.getElementById('answers-container');
        const items = container.getElementsByClassName('answer-item');
        const lastIndex = items.length ? items.length : 0;

        // Create a new answer item
        const newItem = document.createElement('div');
        newItem.className = 'answer-item';
        newItem.innerHTML = `
        <div class="form-group field-answers-${lastIndex}-text">
            <label class="control-label" for="answers-${lastIndex}-text">Answer Text</label>
            <input type="text" id="answers-${lastIndex}-text" class="form-control" name="Answers[${lastIndex}][text]" maxlength="255">
        </div>
        <div class="form-group field-answers-${lastIndex}-is_correct">
            <input type="hidden" name="Answers[${lastIndex}][is_correct]" value="0">
            <label>
                <input type="checkbox" id="answers-${lastIndex}-is_correct" name="Answers[${lastIndex}][is_correct]" value="1"> Is Correct
            </label>
        </div>
    `;
        container.appendChild(newItem);
    });
</script>