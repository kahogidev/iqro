<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
"images/favicon.png",
  "css/remixicon.css",
  "css/lib/bootstrap.min.css",
  "css/lib/apexcharts.css",
  "css/lib/dataTables.min.css",
  "css/lib/editor-katex.min.css",
  "css/lib/editor.atom-one-dark.min.css",
  "css/lib/editor.quill.snow.css",
  "css/lib/flatpickr.min.css",
  "css/lib/full-calendar.css",
  "css/lib/jquery-jvectormap-2.0.5.css",
  "css/lib/magnific-popup.css",
  "css/lib/slick.css",
  "css/lib/prism.css",
  "css/lib/file-upload.css",
  "css/lib/audioplayer.css",
  "css/style.css",
    ];
    public $js = [
"js/lib/jquery-3.7.1.min.js",
  "js/lib/bootstrap.bundle.min.js",
  "js/lib/apexcharts.min.js",
  "js/lib/dataTables.min.js",
  "js/lib/iconify-icon.min.js",
  "js/lib/jquery-ui.min.js",
  "js/lib/jquery-jvectormap-2.0.5.min.js",
  "js/lib/jquery-jvectormap-world-mill-en.js",
  "js/lib/magnifc-popup.min.js",
  "js/lib/slick.min.js",
  "js/lib/prism.js",
  "js/lib/file-upload.js",
  "js/lib/audioplayer.js",

  "js/app.js",

"js/homeOneChart.js",

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
