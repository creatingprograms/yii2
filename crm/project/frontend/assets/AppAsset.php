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
        //'css/site.css',
        'css/styles.css',
        //'css/slick.css',
        //'css/bootstrap.min.css',
        //'css/common.css',
        //'css/mebel.css',
        'css/template_styles.css',
        'css/lightslider.css',
        'css/geo.css',
        'css/media.css',
        'css/fonts.css'
    ];
    public $js = [
        //'js/jquery-2.2.4.min.js',
        'js/slick.js',
        'js/jquery.scrollme.min.js',
        'js/masonry.pkgd.min.js',
        'js/jquery.matchHeight.js',
        'js/jquery.mCustomScrollbar.concat.min.js',
        'js/dropzone.js',
        'js/jquery.magnific-popup.min.js',
        'js/ScrollMagic.js',
        'js/animation.gsap.min.js',
        'js/TweenMax.min.js',
        'js/sun-js.js',
        'js/main.js',
		'//api-maps.yandex.ru/2.1/?lang=ru_RU&amp',
		'js/jquery.maskedinput.min.js',
		'js/lightslider.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}
