<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl  = '@web';
    public $css      = [
        'dist/css/font-awesome.min.css',
        'dist/css/ionicons.min.css',
        'dist/css/admin.min.css',
        'dist/css/skins/skin-blue-light.min.css',
        'dist/css/site.css',
        'dist/css/all.min.css'
    ];
    public $js       = [
        'plugins/fastclick/fastclick.min.js',
        'dist/js/app.min.js',
        'plugins/slimScroll/jquery.slimscroll.min.js',
        'dist/js/all.min.js'
    ];
    public $depends  = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    	'common\assets\PNotifyAsset'
    ];

}
