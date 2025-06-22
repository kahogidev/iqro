<?php

use yii\helpers\Url;

?>

<div class="card h-100 p-3 radius-12 m-3">

    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <form method="get" action="<?= Url::to(['test/overall-results']) ?>">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="class">Sinf bo'yicha filtrlash</label>
                        <select name="class" id="class" class="form-control">
                            <option value="">Barcha sinflar</option>
                            <?php foreach (\common\models\Classes::find()->select(['class'])->distinct()->all() as $class): ?>
                                <option value="<?= $class->class ?>" <?= $class == $class->class ? 'selected' : '' ?>>
                                    <?= $class->class ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="sort_order">Natijasi bo'yicha saralash</label>
                        <select name="sort_order" id="sort_order" class="form-control">
                            <option value="DESC" <?= isset($sortOrder) && $sortOrder == 'DESC' ? 'selected' : '' ?>>Yuqoridan pastga</option>
                            <option value="ASC" <?= isset($sortOrder) && $sortOrder == 'ASC' ? 'selected' : '' ?>>Pastdan yuqoriga</option>
                        </select>
                    </div>
                    <div class="col-md-3" style="margin-top: 15px;">
                        <button type="submit"  class="btn btn-primary mt-10">Filtrlash</button>
                    </div>
                    <div class="col-md-3" style="margin-top: 15px;">
                        <a href="<?= Url::to(['test/overall-results-pdf', 'class' => Yii::$app->request->get('class'), 'sort_order' => Yii::$app->request->get('sort_order', 'DESC')]) ?>"
                           class="btn btn-success mt-10 ms-2" target="_blank">
                            PDFga eksport
                        </a>
                    </div>
                </div>
            </form>
            <!-- Results Table -->
            <table class="table bordered-table sm-table mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>O'quvchi ismi</th>
                    <th>Sinf</th>
                    <th>O'rtacha ko'rsatkich</th>
                    <th>Amallar</th>
                </tr>
                </thead>
                <tbody>
                <?php $serialNumber = 1; ?>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= $serialNumber++ ?></td>
                        <td><?= $student['first_name'] ?> <?= $student['last_name'] ?></td>
                        <td><?= $student['class'].'-'.$student['class_name'] ?></td>
                        <td><?= round($student['average_percentage'], 2) ?>%</td>
                        <td>
                            <button class="btn btn-primary btn-sm view-details" data-student-id="<?= $student['student_id'] ?>">
                                Batafsil
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="studentDetailsModal" tabindex="-1" aria-labelledby="studentDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="studentDetailsModalLabel">Student Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="modal-content"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.querySelectorAll('.view-details').forEach(button => {
                button.addEventListener('click', function () {
                    const studentId = this.dataset.studentId;
                    const modalContent = document.getElementById('modal-content');

                    fetch('<?= Url::to(['test/student-details']) ?>?studentId=' + studentId)
                        .then(response => response.text())
                        .then(html => {
                            modalContent.innerHTML = html;
                            const modal = new bootstrap.Modal(document.getElementById('studentDetailsModal'));
                            modal.show();
                        });
                });
            });
        </script>