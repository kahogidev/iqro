<?php
/** @var array $results */
use yii\helpers\Url;
?>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Test nomi</th>
        <th>Fan</th>
        <th>To‘g‘ri javoblar</th>
        <th>Foiz</th>
        <th>Amal</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($results as $result): ?>
        <tr>
            <td><?= $result->test->title ?></td>
            <td><?= $result->test->subject ?></td>
            <td><?= $result->correct_answers ?></td>
            <td><?= $result->percentage ?>%</td>
            <td>
                <a href="<?= Url::to(['test/delete-one-result', 'id' => $result->id]) ?>" class="btn btn-danger btn-sm">
                    O‘chirish
                </a>
            </td>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
