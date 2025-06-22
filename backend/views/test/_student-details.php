<?php
/** @var array $results */
?>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Test Name</th>
        <th>Subject</th>
        <th>Correct Answers</th>
        <th>Percentage</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($results as $result): ?>
        <tr>
            <td><?= $result->test->title ?></td>
            <td><?= $result->test->subject ?></td>
            <td><?= $result->correct_answers ?></td>
            <td><?= $result->percentage ?>%</td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>