<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<h3><?= Html::encode("Sinfga biriktirilgan o‘quvchilar") ?></h3>

<div class="card h-100 p-3 radius-12 m-3">
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">

            <button type="button" style="max-width: 300px" class="btn btn-primary mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                Yangi o‘quvchi biriktirish
            </button>
            <button type="button" style="max-width: 300px" class="btn btn-secondary mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#addTeacherModal">
                O‘qituvchi biriktirish
            </button>
            <?= Html::a('Export to PDF', ['class/export-assigned-students', 'id' => $id], [
                'class' => 'btn btn-success mt-3 mb-4',
                'target' => '_blank',
                'data-pjax' => '0',
            ]) ?>

            <?= GridView::widget([
                'dataProvider' => $assignedDataProvider,
                  'tableOptions' => ['class' => 'table bordered-table sm-table mb-0'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'first_name',
                    'last_name',
                    'father_phone',
                    [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{remove}',
    'buttons' => [
        'remove' => function ($url, $model, $key) use ($id) {
            return Html::a(
                'Chiqarish',
                ['class/remove-student', 'student_id' => $model->id, 'class_id' => $id],
                [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => 'Rostdan ham bu o‘quvchini sinfdan chiqarishni istaysizmi?',
                        'method' => 'post',
                    ],
                ]
            );
        },
    ],
],

                ],
            ]) ?>
        </div>
    </div>
</div>

<!-- Modal: O‘quvchi biriktirish -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yangi o‘quvchi biriktirish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <div class="modal-body">

                <!-- Qidiruv inputlari -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="searchFirstName" placeholder="Ism bo‘yicha qidirish">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="searchLastName" placeholder="Familiya bo‘yicha qidirish">
                    </div>
                </div>

                <?php $form = ActiveForm::begin([
                    'action' => ['assign-students', 'id' => $id],
                    'method' => 'post',
                ]); ?>

                <table class="table bordered-table sm-table mb-0">
                    <thead>
                    <tr>
                        <th>
                            <div class="d-flex align-items-center gap-10">
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input radius-4 border" type="checkbox" id="selectAll">
                                </div>
                                S.L
                            </div>
                        </th>
                        <th>Ism</th>
                        <th>Familiya</th>
                        <th>Telefon</th>
                        <th class="text-center">Holat</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($unassignedStudents as $i => $student): ?>
                        <tr data-first-name="<?= strtolower($student->first_name) ?>" data-last-name="<?= strtolower($student->last_name) ?>">
                            <td>
                                <div class="d-flex align-items-center gap-10">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input student-checkbox"
                                               type="checkbox"
                                               name="student_ids[]"
                                               value="<?= $student->id ?>">
                                    </div>
                                    <?= sprintf('%02d', $i + 1) ?>
                                </div>
                            </td>
                            <td><?= Html::encode($student->first_name) ?></td>
                            <td><?= Html::encode($student->last_name) ?></td>
                            <td><?= Html::encode($student->father_phone) ?></td>
                            <td class="text-center">
                                <span class="bg-warning-focus text-warning-600 border px-24 py-4 radius-4 fw-medium text-sm">Yangi</span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="modal-footer mt-3">
                    <?= Html::submitButton('Biriktirish', ['class' => 'btn btn-primary']) ?>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<!-- JS: SelectAll va Qidiruv -->
<?php
$this->registerJs(<<<JS
    // "Select All" checkbox
    $('#selectAll').click(function() {
        $('.student-checkbox').prop('checked', this.checked);
    });

    // Qidiruv funksiyasi
    function filterStudents() {
        var firstName = $('#searchFirstName').val().toLowerCase();
        var lastName = $('#searchLastName').val().toLowerCase();

        $('#addStudentModal tbody tr').each(function() {
            var row = $(this);
            var fName = row.data('first-name') || '';
            var lName = row.data('last-name') || '';

            if ((fName.includes(firstName) || firstName === '') &&
                (lName.includes(lastName) || lastName === '')) {
                row.show();
            } else {
                row.hide();
            }
        });
    }

    // Qidiruv inputlariga voqea biriktirish
    $('#searchFirstName, #searchLastName').on('input', filterStudents);
JS);
?>
