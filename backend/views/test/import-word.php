<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\TestImportForm $importModel */
/** @var common\models\Tests $model */

$this->title = 'Test faylini import qilish: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-import-form">
    <div class="card-body p-24">
        <div class="table-responsive  scroll-sm">
            <div class="card">
                <div class="card-body">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <p>Test: <b><?= Html::encode($model->title) ?></b></p>
                    <?php $form = ActiveForm::begin([
                        'options' => ['enctype' => 'multipart/form-data'],
                    ]); ?>
                    <label for="file-upload-name" class="mb-16 border border-neutral-600 fw-medium text-secondary-light px-16 py-12 radius-12 d-inline-flex align-items-center gap-2 bg-hover-neutral-200">
                        <iconify-icon icon="solar:upload-linear" class="text-xl"></iconify-icon>

                    <?= $form->field($importModel, 'file')->fileInput(['accept' => '.doc,.docx', ]) ?>
                    </label>
                    <div class="form-group">
                        <?= Html::submitButton('Import', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>

</div>