<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tests $model */

$this->title = 'Test yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tests-create">

    <h1 style="font-size: 30px!important; margin: 30px"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
