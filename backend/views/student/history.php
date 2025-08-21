<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \common\models\TestResults[] $results */

$this->title = 'Mening test natijalarim';
?>

<h3><?= Html::encode($this->title) ?></h3>
<div class="card-body p-24">
    <div class="table-responsive  scroll-sm">

<table class="table bordered-table sm-table mb-0">
    <thead>
    <tr>
        <th>Test nomi</th>
        <th>Fan</th>
        <th>O'qituvchi</th>
        <th>To'g'ri javoblar</th>
        <th>Foizda</th>
        <th>Sana</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($results)): ?>
        <?php foreach ($results as $result): ?>
            <tr>
                <td><?= Html::encode($result->test->title ?? 'N/A') ?></td>
                <td><?= Html::encode($result->test->subject ?? 'N/A') ?></td>
                <td><?= Html::encode($result->teacher->first_name . ' ' . $result->teacher->last_name ?? 'N/A') ?></td>
                <td><?= Html::encode($result->correct_answers) ?></td>
                <td><?= Html::encode($result->percentage) ?>%</td>
                <td><?= Html::encode(Yii::$app->formatter->asDatetime($result->created_at)) ?></td>
              <td><?php if (Yii::$app->session->has('selected_answers')): ?>
    <?= Html::a('Ko‘rish', ['student/test-review-temp'], ['class' => 'btn btn-info btn-sm']) ?>
<?php endif; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No results found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>