<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<h2> <?= Html::encode("Sinfga biriktirilgan o‘quvchilar") ?> </h2>
<div class="card h-100 p-3 radius-12 m-3">

<div class="card-body p-24">
    <div class="table-responsive  scroll-sm">

        <button type="button" style="max-width: 300px" class="btn btn-primary mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#addStudentModal">
            Yangi o‘quvchi biriktirish
        </button>
        <button type="button" style="max-width: 300px" class="btn btn-secondary mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#addTeacherModal">
            O‘qituvchi biriktirish
        </button>

        <?= GridView::widget([
    'dataProvider' => $assignedDataProvider,
    'tableOptions' => ['class' => 'table bordered-table sm-table mb-0'],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'class' => 'yii\grid\CheckboxColumn',
            'checkboxOptions' => function ($model) {
                return ['value' => $model->id];
            },
            'name' => 'assigned_ids[]', // Tanlanganlar array holatda yuboriladi
        ],

        'first_name',
        'last_name',
        'class',
        'father_phone',

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{remove}',
            'buttons' => [
                'remove' => function ($url, $model) use ($id) {
                    $url = Url::to(['remove-student', 'group_id' => $id, 'student_id' => $model->id]);
                    return Html::a('<iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>', $url, [
                        'title' => 'O‘quvchini sinfdan olib tashlash',
                        'data-method' => 'post',
                        'data-confirm' => 'Haqiqatan ham olib tashlamoqchimisiz?',
                        'class' => 'remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle'
                    ]);
                }
            ]
        ],
    ],
]); ?>
    </div>
</div>

    <!-- Biriktirish uchun tugma -->

</div>

<!-- O‘qituvchi biriktirish modali -->
<div class="modal fade" id="addTeacherModal" tabindex="-1" aria-labelledby="addTeacherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sinfga o‘qituvchi biriktirish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <div class="modal-body">

                <?php $form = \yii\widgets\ActiveForm::begin([
                    'action' => ['assign-teachers', 'id' => $id], // Controller action
                    'method' => 'post',
                ]); ?>

                <table class="table bordered-table sm-table mb-0">
                    <thead>
                    <tr>
                        <th scope="col">
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input radius-4 border" type="checkbox" id="selectAllTeachers">
                            </div>
                            S.L
                        </th>
                        <th scope="col">Ism</th>
                        <th scope="col">Familiya</th>
                        <th scope="col">Telefon</th>
                        <th scope="col" class="text-center">Holat</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($teachers as $i => $teacher): ?>
                        <tr>
                            <td>
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input teacher-checkbox" type="checkbox" name="teacher_ids[]" value="<?= $teacher->id ?>">
                                </div>
                                <?= sprintf('%02d', $i + 1) ?>
                            </td>
                            <td><?= Html::encode($teacher->first_name) ?></td>
                            <td><?= Html::encode($teacher->last_name) ?></td>
                            <td><?= Html::encode($teacher->personal_phone) ?></td>
                            <td class="text-center">
                                <span class="bg-info-focus text-info-600 border px-24 py-4 radius-4 fw-medium text-sm">Yangi</span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="modal-footer mt-3">
                    <?= Html::submitButton('Biriktirish', ['class' => 'btn btn-primary']) ?>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                </div>

                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs("
    $('#selectAllTeachers').click(function() {
        $('.teacher-checkbox').prop('checked', this.checked);
    });
");
?>


<!-- Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yangi o‘quvchi biriktirish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <div class="modal-body">

                <?php $form = \yii\widgets\ActiveForm::begin([
                    'action' => ['assign-students', 'id' => $id],
                    'method' => 'post',
                ]); ?>

                <table class="table bordered-table sm-table mb-0">
                    <thead>
                    <tr>
                        <th scope="col">
                            <div class="d-flex align-items-center gap-10">
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input radius-4 border input-form-dark" type="checkbox" id="selectAll">
                                </div>
                                S.L
                            </div>
                        </th>
                        <th scope="col">Ism</th>
                        <th scope="col">Familiya</th>
                        <th scope="col">Telefon</th>
                        <th scope="col" class="text-center">Holat</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($unassignedStudents as $i => $student): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-10">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400 student-checkbox"
                                               type="checkbox"
                                               name="student_ids[]"
                                               value="<?= $student->id ?>">
                                    </div>
                                    <?= sprintf('%02d', $i + 1) ?>
                                </div>
                            </td>
                            <td>
                                <span class="text-md mb-0 fw-normal text-secondary-light"><?= Html::encode($student->first_name) ?></span>
                            </td>
                            <td>
                                <span class="text-md mb-0 fw-normal text-secondary-light"><?= Html::encode($student->last_name) ?></span>
                            </td>
                            <td>
                                <span class="text-md mb-0 fw-normal text-secondary-light"><?= Html::encode($student->father_phone) ?></span>
                            </td>
                            <td class="text-center">
                                <span class="bg-warning-focus text-warning-600 border border-warning-main px-24 py-4 radius-4 fw-medium text-sm">Yangi</span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="modal-footer mt-3">
                    <?= Html::submitButton('Biriktirish', ['class' => 'btn btn-primary']) ?>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                </div>

                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
