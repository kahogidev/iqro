<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Excel import qilish';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="excel-import">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card p-3 radius-12">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'excelFile')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Import qilish', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>