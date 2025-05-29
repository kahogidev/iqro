<?php

/* @var $form yii\widgets\ActiveForm */
/* @var $dynamicForm yii\base\Model */

foreach ($dynamicForm->attributes as $attribute => $value) {
    echo $form->field($dynamicForm, $attribute)->textInput();
}