<?php
use yii\helpers\Html;

/** @var $results \common\models\TestResults[] */

$this->title = 'Test Results';
?>

<div class="m-4 card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-0">Yechilgan testlar natijalari</h5>
    </div>
    <div class="card-body">
        <table class="table bordered-table mb-0 dataTable" id="resultsTable" data-page-length="10">
            <thead>
            <tr>
                <th>Test nomi</th>
                <th>O'qituvchi</th>
                <th>Fan nomi</th>
                <th>Natija (%)</th>
                <th>Boshlangan vaqti</th>
                <th>Tugagan vaqti</th>
            </tr>
            </thead>
            <tbody>
           <?php foreach ($results as $r):
               $assignment = $r->assignment ?? null;
               $test = $assignment->test ?? null;
               $teacher = $test->teacher ?? null;
           ?>
               <tr>
                   <td><?= $test->title ?? '---' ?></td>
                   <td><?= $teacher ? ($teacher->first_name . ' ' . $teacher->last_name) : '---' ?></td>
                   <td><?= $test->subject ?? '---' ?></td>
                   <td>
                       <?php
                           if ($r->is_correct === null) {
                               echo '---';
                           } else {
                               echo $r->is_correct ? 'Correct' : 'Incorrect';
                           }
                       ?>
                   </td>
                   <td><?= $r->answered_at ? date('Y-m-d H:i', $r->answered_at) : '---' ?></td>
                   <td>---</td>
               </tr>
           <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>