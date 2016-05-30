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
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web/web/Public/';

    // 加载CSS
    public $css = [
        'assets/css/bootstrap.min.css',
        'assets/css/font-awesome.min.css',
        'assets/css/jquery-ui.min.css',
        'assets/css/datepicker.css',
        'assets/css/ui.jqgrid.css',
        'assets/css/ace-fonts.css',
        'assets/css/ace.min.css',
        'assets/css/ace-skins.min.css',
        'assets/css/ace-rtl.min.css',
        'Admin/css/base.css'
    ];

    // 加载JS
    public $js = [
        'assets/js/ace-extra.min.js',
        'assets/js/bootstrap.min.js',
        'assets/js/excanvas.min.js',
        'assets/js/jquery-ui.min.js',
        'assets/js/jquery-ui.custom.min.js',
        'assets/js/jquery.ui.touch-punch.min.js',
        'assets/js/ace-elements.min.js',
        'assets/js/ace.min.js',
        'assets/js/jquery.easypiechart.min.js',
        'assets/js/jquery.sparkline.min.js',
        'assets/js/flot/jquery.flot.min.js',
        'assets/js/flot/jquery.flot.pie.min.js',
        'assets/js/flot/jquery.flot.resize.min.js',
        'assets/js/jquery.dataTables.min.js',
        'assets/js/jquery.dataTables.bootstrap.js',
        'assets/js/date-time/bootstrap-datepicker.min.js',
        'assets/js/jqGrid/jquery.jqGrid.min.js',
        'assets/js/jquery.validate.min.js',
        'assets/js/jqGrid/i18n/grid.locale-cn.js',
        'assets/js/date-time/locales/bootstrap-datepicker.zh-CN.js',
        'assets/js/language/jquery.validate.zh-CN.js',
        'Admin/js/comm.func.js',
        'Admin/js/dialog-min.js',
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
