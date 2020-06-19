<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * AlphaThemeAsset
 *
 * Alpha theme is default bootstrap skeleton theme for Sprava CMS application
 *
 */
class AdminAsset extends AssetBundle
{
    public $sourcePath = '@backend/assets/public';


    public function init()
    {
        $this->css = [
            'css/webfont.css',
            'css/climacons-font.css',
            'css/font-awesome.css',
            'css/card.css',
            'css/sli.css',
            'css/animate.css',
            'css/app.css',
            'css/app.skins.css',
        ];
    }
    public $js = [
        'js/helpers/modernizr.js',
        'js/helpers/smartresize.js',
        'js/constants.js',
        'js/perfect-scrollbar.jquery.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
