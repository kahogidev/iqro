<?php
use yii\helpers\Html;
?>
<h2>Sinf: <?= Html::encode($group->class.'-'.$group->class_name) ?></h2>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>Ism</th>
        <th>Familiya</th>
        <th>Login</th>
        <th>Parol</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($students as $index => $student): ?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= Html::encode($student->first_name) ?></td>
            <td><?= Html::encode($student->last_name) ?></td>
            <td><?= Html::encode($student->first_name.$student->last_name) ?></td>
            <td><?= Html::encode($student->first_name.$student->last_name) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
