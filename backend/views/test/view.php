<?php
use yii\helpers\Html;

/** @var $model common\models\Tests */
/** @var $questions common\models\Questions[] */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Add Question', ['question/create', 'test_id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Import from Word', ['test/import-word', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
</p>

<h3>Questions</h3>
<ul>
    <?php foreach ($model->questions as $question): ?>
        <li>
            <b><?= Html::encode($question->text) ?></b>
            <ul>
                <?php foreach ($question->answers as $answer): ?>
                    <li>
                        <?= $answer->is_correct ? '<b>=</b>' : '' ?>
                        <?= Html::encode($answer->text) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?= Html::a('Edit', ['question/update', 'id' => $question->id], ['class' => 'btn btn-sm btn-info']) ?>
        </li>
    <?php endforeach; ?>
</ul>