<?php
namespace backend\widgets;


class Header extends \yii\base\Widget
{
    public function run()
    {
        $user = \Yii::$app->user->identity; // Get logged-in user

        return $this->render('header');
    }
}