<?php
use yii\helpers\Html;

$this->title = 'Testni tahlil qilish';
?>

<h3><?= Html::encode($this->title) ?></h3>

<div class="card p-3">
    <?php foreach ($questions as $index => $question): ?>
        <div class="mb-4 border p-3 rounded">
            <strong><?= ($index + 1) ?>. <?= Html::encode($question->text) ?></strong>

            <?php foreach ($question->answers as $answer): ?>
                <?php
                $selectedId = $selectedAnswers[$question->id] ?? null;
                $isCorrect = $answer->is_correct;
                $isSelected = $selectedId == $answer->id;

                $class = '';
                if ($isSelected && $isCorrect) {
                    $class = 'text-success fw-bold'; // to‘g‘ri tanlangan
                } elseif ($isSelected && !$isCorrect) {
                    $class = 'text-danger'; // noto‘g‘ri tanlangan
                } elseif ($isCorrect) {
                    $class = 'text-success'; // asl to‘g‘ri javob
                }
                ?>
                <div class="<?= $class ?>">
                    <?= $isSelected ? '👉 ' : '' ?><?= Html::encode($answer->text) ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>
