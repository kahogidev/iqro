<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Teachers $model */

$this->title = 'Yangi o\'qituvchi yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-create">

    <h1 style="font-size: 30px!important; margin: 30px"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
