<?php
use common\models\User;

$user = Yii::$app->user->identity;
?>
<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="#" class="sidebar-logo">
            <img src="/images/logo-admin.jpg" alt="site logo" class="light-logo">
            <img src="/images/logo-dark.png" alt="site logo" class="dark-logo">
            <img src="/images/mahorat.png" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <?php if ($user->role != User::ROLE_STUDENT): ?>
                <li>
                    <a href="<?= \yii\helpers\Url::to(['/student']) ?>">
                        <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                        <span>Barcha O'quvchilar</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::to(['/class']) ?>">
                        <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                        <span>Sinflar</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::to(['/teacher']) ?>">
                        <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                        <span>O'qituvchilar</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::to(['/test']) ?>">
                        <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                        <span>Testlar</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::to(['/test/overall-results']) ?>">
                        <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                        <span>Test natijalari</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($user->role == User::ROLE_STUDENT): ?>
                <li>
                    <a href="<?= \yii\helpers\Url::to(['student/dashboard']) ?>">
                        <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                        <span>Profil</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::to(['student/test']) ?>">
                        <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                        <span>Mening testlarim</span>
                    </a>
                </li>

                <li>
                    <a href="<?= \yii\helpers\Url::to(['student/history']) ?>">
                        <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                        <span>Mening natijalarim</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</aside>