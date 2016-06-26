<?php
use yii\helpers\Html;
use yii\helpers\Url;
// use app\assets\AdminAsset;

/* @var $this \yii\web\View */
/* @var $content string */

// AdminAsset::register($this);
$this->title = 'sina后台管理系统登录';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <?= Html::csrfMetaTags() ?>
    <title><?php echo  Html::encode($this->title.$this->params['title']); ?></title>
    <?php $this->head() ?>
    <?php include 'header.php'; ?>
</head>
<body class="no-skin">
<?php $this->beginBody() ?>
<!-- #section:basics/navbar.layout -->
<div id="navbar" class="navbar navbar-default">
    <script type="text/javascript">
        try { ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>

    <div class="navbar-container" id="navbar-container">
        <!-- #section:basics/sidebar.mobile.toggle -->
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
            <span class="sr-only">Toggle sidebar</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="<?= Url::to(['default/index']);?>" class="navbar-brand">
                <small>个人微博后台管理</small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <?php // include 'adminMenu.php'; ?>
                <!-- 用户信息显示 -->
                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="/web/Public/assets/avatars/avatar.jpg" alt="Jason's Photo" />
                            <span class="user-info">
                                <small>欢迎登录</small>
                                Admin
                            </span>
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#">
                                <i class="ace-icon fa fa-cog"></i>
                                设置
                            </a>
                        </li>
                        <li>
                            <a href="profile.html">
                                <i class="ace-icon fa fa-user"></i>
                                个人信息
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo Url::to(['default/logout']); ?>">
                                <i class="ace-icon fa fa-power-off"></i>
                                退出
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>

<!-- /section:basics/navbar.layout -->
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>

    <!-- #section:basics/sidebar -->
    <div id="sidebar" class="sidebar                  responsive">
        <script type="text/javascript">
            try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                <button class="btn btn-success">
                    <i class="ace-icon fa fa-signal"></i>
                </button>

                <button class="btn btn-info">
                    <i class="ace-icon fa fa-pencil"></i>
                </button>

                <button class="btn btn-warning">
                    <i class="ace-icon glyphicon glyphicon-user"></i>
                </button>

                <button class="btn btn-danger">
                    <i class="ace-icon fa fa-cogs"></i>
                </button>
            </div>
            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                <span class="btn btn-success"></span>
                <span class="btn btn-info"></span>
                <span class="btn btn-warning"></span>
                <span class="btn btn-danger"></span>
            </div>
        </div>

        <!--左侧导航栏信息-->
        <ul class="nav nav-list">
            <?php if ($this->beginCache('menu', ['duration' => 3600])) : ?>
            <?php foreach ($this->params['arrMenu'] as $key => $value) : ?>
                <li class="<?php echo $value['controller_name'].$value['action_name']; ?>">
                    <a <?php if(!empty($value['controller_name'])) : ?> href="<?php echo Url::to([$value['controller_name'].'/'.$value['action_name']])?>" <?php else : ?> href="#" class="dropdown-toggle"<?php endif; ?>>
                        <?php $arrIcons = explode('-', $value['icons']); ?>
                        <i class="menu-icon <?=$arrIcons[0] ?> <?= $value['icons'] ?>"></i>
                        <span class="menu-text"> <?= $value['menu_name'] ?> </span>
                        <?php if (isset($value['child']) && !empty($value['child'])) : ?>
                            <b class="arrow fa fa-angle-down"></b>
                        <?php endif; ?>
                    </a>
                    <?php if (isset($value['child']) && !empty($value['child'])) : ?>
                        <b class="arrow"></b>
                        <!--第二级别-->
                        <ul class="submenu">
                            <?php foreach ($value['child'] as $k => $val) : ?>
                                <li class="<?= $val['controller_name'] ?><?= $val['action_name'] ?> ">
                                    <a <?php if (!empty($val['controller_name'])) : ?> href="<?php echo  Url::to([$val['controller_name'].'/'.$val['action_name']]); ?>" <?php else : ?> href="#" class="dropdown-toggle"<?php endif; ?> >
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        <?= $val['menu_name'] ?>
                                        <?php if (isset($val['child']) && !empty($val['child'])) : ?>
                                            <b class="arrow fa fa-angle-down"></b>
                                        <?php endif; ?>
                                    </a>
                                    <?php if ( isset($val['child']) && !empty($val['child'])) : ?>
                                        <b class="arrow"></b>
                                        <ul class="submenu">
                                            <?php foreach ($val['child'] as $item) : ?>
                                                <li class="<?= $item['controller_name']?><?=$item['action_name']?>">
                                                    <a href="<?php echo Url::to([$item['controller_name'].'/'.$item['action_name']])?>">
                                                        <i class="menu-icon fa fa-caret-right"></i>
                                                        <?= $item['menu_name']?>
                                                    </a>
                                                    <b class="arrow"></b>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
            <?php $this->endCache(); ?>
            <?php endif; ?>
        </ul>

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>

        <script type="text/javascript">
            try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
        </script>
    </div>

    <!--主要内容信息-->
    <div class="main-content">

        <!--头部可固定导航信息-->
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>

            <!--面包屑信息-->
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo Url::to(['admin/index']); ?>">首页</a>
                </li>
                <li class="active"><?= Html::encode($this->params['title']) ?></li>
            </ul>

            <!--搜索-->
            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="搜索..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div>
        </div>

        <div class="page-content">

            <!--样式设置信息-->
            <div class="ace-settings-container" id="ace-settings-container">
                <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                    <i class="ace-icon fa fa-cog bigger-150"></i>
                </div>


                <div class="ace-settings-box clearfix" id="ace-settings-box">
                    <div class="pull-left width-50">
                        <div class="ace-settings-item">
                            <div class="pull-left">
                                <select id="skin-colorpicker" class="hide">
                                    <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                    <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                    <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                    <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                </select>
                            </div>
                            <span>&nbsp; 选择皮肤 </span>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                            <label class="lbl" for="ace-settings-navbar"> 固定导航栏 </label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                            <label class="lbl" for="ace-settings-sidebar"> 固定侧边栏 </label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                            <label class="lbl" for="ace-settings-breadcrumbs"> 固定的面包屑导航</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                            <label class="lbl" for="ace-settings-rtl"> 从右到左（替换）</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                            <label class="lbl" for="ace-settings-add-container">
                                缩小显示
                            </label>
                        </div>
                    </div>

                    <div class="pull-left width-50">
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
                            <label class="lbl" for="ace-settings-hover"> 菜单收缩</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />
                            <label class="lbl" for="ace-settings-compact"> 简单菜单</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
                            <label class="lbl" for="ace-settings-highlight"> 当前菜单标记变换</label>
                        </div>
                    </div>
                </div>
            </div>

            <!--主要内容信息-->
            <div class="page-content-area">
                <div class="row">
                    <div class="col-xs-12">
                        <?= $content ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--尾部信息-->
    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content">
                <span class="bigger-120">
                    <span class="blue bolder">Sina</span>
                    个人微博项目 &copy; 2016-2018
                </span>
            </div>
        </div>
    </div>
    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
<script type="text/javascript">
    $(function(){
        var select = '.<?php echo \Yii::$app->controller->id.\Yii::$app->controller->action->id; ?>';
        // 导航栏样式装换
        $(select).addClass('active').parentsUntil('ul.nav-list').addClass('active open');
        // 隐藏和显示
        $('a[data-action=close]:first').click(function(){
            $(select).children('a').append('<span class="badge badge-primary tooltip-error" title="显示">显示</span>').bind('click', function (e) {
                e.preventDefault();
                $('div.widget-box:first').fadeIn();
                $(this).unbind('click').find('span:last').remove();
                return false;
            });;
        })
    })
</script>
