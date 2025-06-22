<?php
use yii\helpers\Html;

/** @var $tests \common\models\Tests[] */

$this->title = 'Available Tests';
?>

    <div class="d-flex flex-wrap align-items-center m-20 justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0"></h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium"></li>
            <li>-</li>
        </ul>
    </div>
    <div class="m-4 card basic-data-table">
        <div class="card-header">
            <h5 class="card-title mb-0">Biriktirlgan testlar</h5>
        </div>
        <div class="card-body">
            <table class="table bordered-table mb-0 dataTable" id="dataTable" data-page-length="10">
                <thead>
                <tr>
                    <th>Nomi</th>
                    <th>O'qituvchi</th>
                    <th>Fan nomi</th>
                    <th>Boshlanish vaqti</th>
                    <th>Tugash vaqti</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tests as $i => $t): ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="/assets/images/user-list/user-list<?= ($i % 10) + 1 ?>.png" alt="" class="flex-shrink-0 me-12 radius-8">
                                <h6 class="text-md mb-0 fw-medium flex-grow-1"><?= Html::encode($t->title) ?></h6>
                            </div>
                        </td>
                        <td>
                            <?= Html::encode($t->teacher ? $t->teacher->first_name . ' ' . $t->teacher->last_name : '---') ?>
                        </td>
                        <td>
                            <?= Html::encode($t->subject ? $t->subject : '---') ?>
                        </td>
                        <td><?= Html::encode($t->start_time) ?></td>
                        <td><?= Html::encode($t->end_time) ?></td>
                        <td>
                            <button type="button"
                                    class="btn btn-primary start-test-btn"
                                    data-test-url="<?= Html::encode(Yii::$app->urlManager->createUrl(['/test/take', 'id' => $t->id])) ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#startTestModal">
                                Boshlash
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="startTestModal" tabindex="-1" aria-labelledby="startTestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="startTestModalLabel">Testni boshlash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
                <div class="modal-body">
                    Siz rostdan ham testni boshlamoqchimisiz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yo'q</button>
                    <a href="#" class="btn btn-primary" id="confirmStartTestBtn">Ha</a>
                </div>
            </div>
        </div>
    </div>

<?php
$js = <<<JS
    document.querySelectorAll('.start-test-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const testUrl = this.getAttribute('data-test-url');
            document.getElementById('confirmStartTestBtn').setAttribute('href', testUrl);
        });
    });
JS;
$this->registerJs($js);
?>