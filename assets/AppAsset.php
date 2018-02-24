<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'eventone/stylesheet.css',
        'eventone/font-awesome/css/font-awesome.min.css',
        'owl-carousel/owl.carousel.css',
        'owl-carousel/owl.transitions.css',
        'owl-carousel/owl.theme.css',
        // 'css/site.css',
    ];
    public $js = [
        // 'eventone/javascript/jquery/jquery-2.1.1.min.js',
        'js/common.js',
        'owl-carousel/owl.carousel.min.js',
        // 'ckeditor/ckeditor.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
