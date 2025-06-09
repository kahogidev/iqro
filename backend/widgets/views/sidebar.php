<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="index.html" class="sidebar-logo">
            <img src="/images/logo.png" alt="site logo" class="light-logo">
            <img src="/images/logo-light.png" alt="site logo" class="dark-logo">
            <img src="/images/logo-icon.png" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">

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

        </ul>
    </div>
</aside>