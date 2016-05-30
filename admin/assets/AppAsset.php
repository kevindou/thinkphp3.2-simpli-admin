<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web/web';

    // 加载CSS
    public $css = [
        'Public/assets/css/bootstrap.min.css',
        'Public/Home/css/base.css',
        'Public/Home/css/index.css',
    ];

    // 加载JS
    public $js = [
        'Public/assets/js/jquery.min.js',
        'Public/assets/js/bootstrap.min.js'
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
