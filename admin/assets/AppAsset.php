<?php

namespace admin\assets;

use yii\web\AssetBundle;

/**
 * Main admin application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/myStyle.css',

        'css/adminLTE/fontawesome-free/css/all.min.css',
        'css/adminLTE/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
        'css/adminLTE/icheck-bootstrap/icheck-bootstrap.min.css',
        'css/adminLTE/jqvmap/jqvmap.min.css',
        'css/adminLTE/dist/css/adminlte.min.css',
        'css/adminLTE/overlayScrollbars/css/OverlayScrollbars.min.css',
        'css/adminLTE/daterangepicker/daterangepicker.css',
        'css/adminLTE/summernote/summernote-bs4.min.css',

    ];
    public $js = [
        'css/adminLTE/bootstrap/js/bootstrap.bundle.min.js',
        'css/adminLTE/chart.js/Chart.min.js',
        'css/adminLTE/sparklines/sparkline.js',
        'css/adminLTE/jqvmap/jquery.vmap.min.js',
        'css/adminLTE/jqvmap/maps/jquery.vmap.usa.js',
        'css/adminLTE/jquery-knob/jquery.knob.min.js',
        'css/adminLTE/moment/moment.min.js',
        'css/adminLTE/daterangepicker/daterangepicker.js',
        'css/adminLTE/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
        'css/adminLTE/summernote/summernote-bs4.min.js',
        'css/adminLTE/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        'css/adminLTE/dist/js/adminlte.js',
        // Demo Purpose
        // 'css/adminLTE/dist/js/demo.js',
        'css/adminLTE/dist/js/pages/dashboard.js'


    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap4\BootstrapAsset',
    ];
}
