<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class ShopAsset extends AssetBundle
{
    public $publishOptions = ['forceCopy' => true];
    public $sourcePath = '@frontend/web/source/';

    public $css = [
        'sass/vendor/zoomOnHover.css',
        'sass/vendor/owl.carousel.min.css',
        'styles/css-min/main.min.css',
        'styles/css-min/custom.min.css',
    ];
    public $js = [
        'js/zoomOnHover.js',
        'js/owl.carousel.min.js',
        'js/build/dist/build.js',
        //'js/template.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
