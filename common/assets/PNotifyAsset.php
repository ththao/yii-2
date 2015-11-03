<?php
/**
 * @author Bryan Tan <bryantan16@gmail.com>
 */

namespace common\assets;

use yii\web\AssetBundle;

class PnotifyAsset extends AssetBundle
{
    public $sourcePath = '@bower/pnotify';
    public $css = [
        'pnotify.core.css',
        'pnotify.buttons.css',
    ];
    public $js = [
        'pnotify.core.js',
        'pnotify.buttons.js',
        'pnotify.confirm.js',
    ];
}