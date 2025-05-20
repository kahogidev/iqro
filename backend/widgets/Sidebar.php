<?php

namespace backend\widgets;

class Sidebar extends \yii\base\Widget
{
    public function run()
    {
        return $this->render('sidebar');
    }
}