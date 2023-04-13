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
        'css/site.css',
        'css/main.min.css',
        'css/main.css',
        'css/fonts.css',
        'css/sun.css',
        'css/o-boot.css?v=0.0.1'
        //'css/fc.css'
    ];
    public $js = [
        'js/main.js',
        'js/sun.js?v=0.0.1',
        'js/air-datepicker.js',
		'js/jquery.maskMoney.js',
		'js/jquery.inputmask.bundle.js',
        'js/fc.js',
        'js/locales-all.js',
		'js/jquery.maskedinput.min.js',
		'js/jquery-ui.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
