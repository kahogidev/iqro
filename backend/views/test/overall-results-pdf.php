<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>O'quvchi ismi</th>
        <th>Sinf</th>
        <th>O'rtacha ko'rsatkich</th>
    </tr>
    </thead>
    <tbody>
    <?php $sn = 1; ?>
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $sn++ ?></td>
            <td><?= $student['first_name'] ?> <?= $student['last_name'] ?></td>
            <td><?= $student['class'] . '-' . $student['class_name'] ?></td>
            <td><?= round($student['average_percentage'], 2) ?>%</td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
