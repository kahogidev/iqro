<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Students $model */

$user = $model->user; // Assuming relation exists: get user's email, etc.
$photo = $model->photo ? $model->photo : 'assets/images/user-grid/user-grid-img14.png';
?>
<div class="col-lg-8 m-90" >
    <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100 mt-20" >
        <img src="<?= Yii::getAlias('@web/assets/images/user-grid/user-grid-bg1.png') ?>" alt="" class="w-100 object-fit-cover">
        <div class="pb-24 ms-16 mb-24 me-16  mt-100">
            <div class="text-center border border-top-0 border-start-0 border-end-0">
                <img src="<?= Yii::getAlias('@web/' . $photo) ?>" alt="" class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover">
                <h6 class="mb-0 mt-16"><?= Html::encode($model->first_name . ' ' . $model->last_name) ?></h6>
                <span class="text-secondary-light mb-16"><?= Html::encode($user ? $user->email : '') ?></span>
            </div>
            <div class="mt-24">
                <h6 class="text-xl mb-16">Shaxsiy ma'lumotlar</h6>
                <ul>
                    <li class="d-flex align-items-center gap-1 mb-12">
                        <span class="w-30 text-md fw-semibold text-primary-light">F.I.O</span>
                        <span class="w-70 text-secondary-light fw-medium">: <?= Html::encode($model->first_name . ' ' . $model->last_name.' '.$model->middle_name) ?></span>
                    </li>
                    <li class="d-flex align-items-center gap-1 mb-12">
                        <span class="w-30 text-md fw-semibold text-primary-light">Elektron pochtasi</span>
                        <span class="w-70 text-secondary-light fw-medium">: <?= Html::encode($user ? $user->email : '') ?></span>
                    </li>
                    <li class="d-flex align-items-center gap-1 mb-12">
                        <span class="w-30 text-md fw-semibold text-primary-light">Otasining Telefon raqami</span>
                        <span class="w-70 text-secondary-light fw-medium">: <?= Html::encode($model->father_phone) ?></span>
                    </li>
                    <li class="d-flex align-items-center gap-1 mb-12">
                        <span class="w-30 text-md fw-semibold text-primary-light">Onasining Telefon raqami</span>
                        <span class="w-70 text-secondary-light fw-medium">: <?= Html::encode($model->mother_phone) ?></span>
                    </li>
                    <li class="d-flex align-items-center gap-1 mb-12">
                        <span class="w-30 text-md fw-semibold text-primary-light">Otasining F.I.O</span>
                        <span class="w-70 text-secondary-light fw-medium">: <?= Html::encode($model->father_name) ?></span>
                    </li>
                    <li class="d-flex align-items-center gap-1 mb-12">
                        <span class="w-30 text-md fw-semibold text-primary-light">Otasining Ish joyi</span>
                        <span class="w-70 text-secondary-light fw-medium">: <?= Html::encode($model->father_workplace) ?></span>
                    </li>
                    <li class="d-flex align-items-center gap-1 mb-12">
                        <span class="w-30 text-md fw-semibold text-primary-light">Otasining mansabi</span>
                        <span class="w-70 text-secondary-light fw-medium">: <?= Html::encode($model->father_position) ?></span>
                    </li>
                    <li class="d-flex align-items-center gap-1 mb-12">
                        <span class="w-30 text-md fw-semibold text-primary-light">Onasining F.I.O</span>
                        <span class="w-70 text-secondary-light fw-medium">: <?= Html::encode($model->mother_name) ?></span>
                    </li>
                    <li class="d-flex align-items-center gap-1 mb-12">
                        <span class="w-30 text-md fw-semibold text-primary-light">Onasining ish joyi</span>
                        <span class="w-70 text-secondary-light fw-medium">: <?= Html::encode($model->mother_workplace) ?></span>
                    </li>
                    <li class="d-flex align-items-center gap-1 mb-12">
                        <span class="w-30 text-md fw-semibold text-primary-light">Onasining mansabi</span>
                        <span class="w-70 text-secondary-light fw-medium">: <?= Html::encode($model->mother_position) ?></span>
                    </li>
<!--                    <li class="d-flex align-items-center gap-1 mb-12">-->
<!--                        <span class="w-30 text-md fw-semibold text-primary-light">Department</span>-->
<!--<!--                        <span class="w-70 text-secondary-light fw-medium">: --><?php ////= Html::encode($model->direction) ?><!--<!--</span>-->
<!--                    </li>-->
                    <li class="d-flex align-items-center gap-1 mb-12">
                        <span class="w-30 text-md fw-semibold text-primary-light">Tug'ilgan sanasi</span>
                        <span class="w-70 text-secondary-light fw-medium">: <?= Html::encode($model->birth_date) ?></span>
                    </li>
                    <li class="d-flex align-items-center gap-1 mb-12">
                        <span class="w-30 text-md fw-semibold text-primary-light">Tug'ilgan joyi</span>
                        <span class="w-70 text-secondary-light fw-medium">: <?= Html::encode($model->birth_place) ?></span>
                    </li>
                    <li class="d-flex align-items-center gap-1">
                        <span class="w-30 text-md fw-semibold text-primary-light">Talantlari</span>
                        <span class="w-70 text-secondary-light fw-medium">: <?= Html::encode($model->talents) ?></span>
                    </li>
                    <li class="d-flex align-items-center gap-1">
                        <span class="w-30 text-md fw-semibold text-primary-light">Darsdan tashqari mashg'ulotlari</span>
                        <span class="w-70 text-secondary-light fw-medium">: <?= Html::encode($model->activities) ?></span>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>