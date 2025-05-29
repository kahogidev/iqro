<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
	public $css = [
        "css/bootstrap.min.css",
        "css/owl.theme.default.min.css",
        "css/owl.carousel.min.css",
        "css/magnific-popup.min.css",
        "css/animate.min.css",
        "css/boxicons.min.css",
        "css/flaticon.css",
        "css/meanmenu.min.css",
        "css/nice-select.min.css",
        "css/odometer.min.css",
        "css/style.css",
        "css/dark.css",
        "css/responsive.css",
        "img/favicon.png"
    ];
    public $js = [
        "scripts/5c5dd728/cloudflare-static/email-decode.min.js",
        "js/jquery.min.js",
        "js/bootstrap.bundle.min.js",
		"js/meanmenu.min.js",
		"js/owl.carousel.min.js",
        "js/wow.min.js",
		"js/nice-select.min.js",
		"js/magnific-popup.min.js",
		"js/jarallax.min.js",
        "js/appear.min.js",
		"js/odometer.min.js",
		"js/form-validator.min.js",
		"js/contact-form-script.js",
		"js/ajaxchimp.min.js",
		"js/custom.js",


        ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
