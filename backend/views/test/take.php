<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$endTime = $startTime + $duration;
$form = ActiveForm::begin([
    'id' => 'test-form',
    'action' => ['student/complete-test', 'testId' => $test->id], // Submit to actionCompleteTest
    'method' => 'post',
]);
?>

    <div class="row">
        <div class="col-md-9">
            <div class="col-md-11 m-5" id="questions-list">
                <?php foreach ($questions as $item): ?>
                    <div class="card mb-4 question-card" id="question-<?= $item['question']->id ?>">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0"><?= Html::encode($item['question']->question_text ?? 'Question text not found') ?></h6>
                        </div>
                        <div class="card-body p-24">
                            <?php foreach ($item['shuffledAnswers'] as $answer): ?>
                                <div class="form-check checked-primary mb-2">
                                    <?= Html::radio(
                                        "answers[{$item['question']->id}]",
                                        false,
                                        [
                                            'class' => 'form-check-input answer-radio',
                                            'id' => "radio-{$item['question']->id}-{$answer->id}",
                                            'value' => $answer->id,
                                        ]
                                    ) ?>
                                    <?= Html::label(
                                        Html::encode($answer->answer_text),
                                        "radio-{$item['question']->id}-{$answer->id}",
                                        ['class' => 'form-check-label line-height-1 fw-medium text-secondary-light']
                                    ) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'style' => 'margin-left:50px']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>

<?php
$js = <<<JS
function startCountdown(endTime) {
    function updateTimer() {
        var now = Math.floor(Date.now() / 1000);
        var diff = endTime - now;
        if (diff <= 0) {
            $('#countdown-timer').text('00:00');
            $('#test-form').submit();
            return;
        }
        var min = Math.floor(diff / 60);
        var sec = diff % 60;
        $('#countdown-timer').text(
            (min < 10 ? '0' : '') + min + ':' + (sec < 10 ? '0' : '') + sec
        );
        setTimeout(updateTimer, 1000);
    }
    updateTimer();
}
startCountdown(<?= $endTime ?>);
JS;
$this->registerJs($js);
?>