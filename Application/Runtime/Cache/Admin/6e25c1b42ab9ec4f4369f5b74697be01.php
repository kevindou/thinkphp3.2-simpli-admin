<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title> Sina微博项目后台 </title>
    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="/Public/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Public/assets/css/font-awesome.min.css" />
    <!-- page specific plugin styles -->

    <link rel="stylesheet" href="/Public/assets/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="/Public/assets/css/datepicker.css" />
    <link rel="stylesheet" href="/Public/assets/css/ui.jqgrid.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="/Public/assets/css/ace-fonts.css" />
    <!-- ace styles -->
    <link rel="stylesheet" href="/Public/assets/css/ace.min.css" id="main-ace-style" />
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="/Public/assets/css/ace-part2.min.css" />
    <![endif]-->
    <link rel="stylesheet" href="/Public/assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="/Public/assets/css/ace-rtl.min.css" />
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="/Public/assets/css/ace-ie.min.css" />
    <![endif]-->
    <link rel="stylesheet" href="/Public/Admin/css/base.css" />
    <!-- inline styles related to this page -->
    <!-- ace settings handler -->
    <script src="/Public/assets/js/ace-extra.min.js"></script>
    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
    <!--[if lte IE 8]>
    <script src="/Public/assets/js/html5shiv.min.js"></script>
    <script src="/Public/assets/js/respond.min.js"></script>
    <![endif]-->

    <!-- 公共的JS文件 -->
    <!--[if !IE]> -->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='/Public/assets/js/jquery.min.js'>"+"<"+"/script>");
    </script>
    <!-- <![endif]-->
    <!--[if IE]>
    <script type="text/javascript">
        window.jQuery || document.write("<script src='/Public/assets/js/jquery1x.min.js'>"+"<"+"/script>");
    </script>
    <![endif]-->
    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='/Public/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    <script src="/Public/assets/js/bootstrap.min.js"></script>
    <!--[if lte IE 8]>
    <script src="/Public/assets/js/excanvas.min.js"></script>
    <![endif]-->
    <script src="/Public/assets/js/jquery-ui.min.js"></script>
    <script src="/Public/assets/js/jquery-ui.custom.min.js"></script>
    <script src="/Public/assets/js/jquery.ui.touch-punch.min.js"></script>

    <script src="/Public/assets/js/ace-elements.min.js"></script>
    <script src="/Public/assets/js/ace.min.js"></script>

    <script src="/Public/assets/js/jquery.easypiechart.min.js"></script>
    <script src="/Public/assets/js/jquery.sparkline.min.js"></script>

    <script src="/Public/assets/js/flot/jquery.flot.min.js"></script>
    <script src="/Public/assets/js/flot/jquery.flot.pie.min.js"></script>
    <script src="/Public/assets/js/flot/jquery.flot.resize.min.js"></script>


    <!--jquery.dataTable-->
    <script src="/Public/assets/js/jquery.dataTables.min.js"></script>
    <script src="/Public/assets/js/jquery.dataTables.bootstrap.js"></script>

    <!-- jquery.jqGrid -->
    <script src="/Public/assets/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="/Public/assets/js/jqGrid/jquery.jqGrid.min.js"></script>
    <script src="/Public/assets/js/jquery.validate.min.js"></script>

    <!--加载语言版本-->
    <script src="/Public/assets/js/jqGrid/i18n/grid.locale-cn.js"></script>
    <script src="/Public/assets/js/date-time/locales/bootstrap-datepicker.zh-CN.js"></script>
    <script src="/Public/assets/js/language/jquery.validate.zh-CN.js"></script>

    <!--我的js文件-->
    <script src="/Public/Admin/js/comm.func.js"></script>
    <script src="/Public/Admin/js/dialog-min.js"></script>
</head>
	<body class="no-skin">
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
					<a href="/Admin" class="navbar-brand">
						<small>个人微博后台管理</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
                        
						<!-- 用户信息显示 -->
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="/Public/assets/avatars/avatar.jpg" alt="Jason's Photo" />
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
									<a href="<?php echo U('Index/logout');?>">
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

    <!--单个导航信息-->
    <li <?php if(MODULE_NAME == 'Admin'): ?>class="active"<?php endif; ?>>
        <a href="<?php echo U('Admin/index');?>">
            <i class="menu-icon glyphicon glyphicon-user"></i>
            <span class="menu-text"> 管理员信息 </span>
        </a>
        <b class="arrow"></b>
    </li>
    <li <?php if(MODULE_NAME == 'Category'): ?>class="active"<?php endif; ?>>
        <a href="<?php echo U('Category/index');?>">
            <i class="menu-icon glyphicon glyphicon-list"></i>
            <span class="menu-text"> 文章分类信息 </span>
        </a>
        <b class="arrow"></b>
    </li>
    <li <?php if(MODULE_NAME == 'Article'): ?>class="active"<?php endif; ?>>
        <a href="<?php echo U('Article/index');?>">
            <i class="menu-icon glyphicon glyphicon-align-justify"></i>
            <span class="menu-text"> 文章信息 </span>
        </a>
        <b class="arrow"></b>
    </li>

    <!--三级菜单-->
    <li class="">
        <!--第一级-->
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-desktop"></i>
            <span class="menu-text"> UI界面 &amp; 元素 </span>
            <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <!--第二级别-->
        <ul class="submenu">
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-caret-right"></i>
                    布局
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="top-menu.html">
                            <i class="menu-icon fa fa-caret-right"></i>
                            头部导航
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="mobile-menu-1.html">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Default Mobile Menu
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="mobile-menu-2.html">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Mobile Menu 2
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="mobile-menu-3.html">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Mobile Menu 3
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

    <li class="">
        <a href="calendar.html">
            <i class="menu-icon fa fa-calendar"></i>
            <span class="menu-text">
                日历
                <span class="badge badge-transparent tooltip-error" title="2个重要事件">
                    <i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
                </span>
            </span>
        </a>
        <b class="arrow"></b>
    </li>

    <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-file-o"></i>
            <span class="menu-text " title="5">
                其他页面
                <span class="badge badge-primary" title="5">5</span>
            </span>
            <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
            <li class="">
                <a href="faq.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    FAQ
                </a>
                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="error-404.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Error 404
                </a>
                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="error-500.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Error 500
                </a>
                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="grid.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Grid
                </a>
                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="blank.html">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Blank Page
                </a>
                <b class="arrow"></b>
            </li>
        </ul>
    </li>
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
							<a href="">首页</a>
						</li>
						<li class="active"><?php echo ($title); ?></li>
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
                                <h3 class="header smaller lighter blue">
									<?php echo ($title); ?>
								</h3>
								<div class="widget-box widget-color-blue ui-sortable-handle">
    <div class="widget-header">
        <h5 class="widget-title bigger lighter">
            <i class="ace-icon fa fa-desktop"></i>
            <?php echo ($title); ?>
        </h5>

        <!--颜色选择-->
        <div class="widget-toolbar widget-toolbar-light no-border">
            <select id="simple-colorpicker-1" class="hide">
                <option selected="" data-class="blue" value="#307ECC">#307ECC</option>
                <option data-class="blue2" value="#5090C1">#5090C1</option>
                <option data-class="blue3" value="#6379AA">#6379AA</option>
                <option data-class="green" value="#82AF6F">#82AF6F</option>
                <option data-class="green2" value="#2E8965">#2E8965</option>
                <option data-class="green3" value="#5FBC47">#5FBC47</option>
                <option data-class="red" value="#E2755F">#E2755F</option>
                <option data-class="red2" value="#E04141">#E04141</option>
                <option data-class="red3" value="#D15B47">#D15B47</option>
                <option data-class="orange" value="#FFC657">#FFC657</option>
                <option data-class="purple" value="#7E6EB0">#7E6EB0</option>
                <option data-class="pink" value="#CE6F9E">#CE6F9E</option>
                <option data-class="dark" value="#404040">#404040</option>
                <option data-class="grey" value="#848484">#848484</option>
                <option data-class="default" value="#EEE">#EEE</option>
            </select>
        </div>

        <!-- 默认操作按钮 -->
        <div class="widget-toolbar no-border">
            <a data-action="settings" href="#" class="add-data">
                <i class="ace-icon fa fa-plus"></i>
            </a>

            <a class="orange2" data-action="fullscreen" href="#">
                <i class="ace-icon fa fa-expand"></i>
            </a>
            <a data-action="reload" href="#" class="reload">
                <i class="ace-icon fa fa-refresh"></i>
            </a>
            <a data-action="collapse" href="#">
                <i class="ace-icon fa fa-chevron-up"></i>
            </a>
            <a data-action="close" href="#">
                <i class="ace-icon fa fa-times"></i>
            </a>
        </div>
    </div>

    <!--主要显示信息-->
    <div class="widget-body">
        <div class="widget-main no-padding">
            <div class="row">
                <div class="col-xs-12">
                    <table id="showTable" class="table table-striped table-bordered table-hover">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo ($addForm); ?>
<?php echo ($dataInfo); ?>
<script type="text/javascript">
    $(window).ready(function(){
        // 初始化表格信息
        var table = initDataTables('#showTable', {
            aoColumns:<?php echo ($aoColumns); ?>,
            bServerSide:true,
            sAjaxSource:'<?php echo U(CONTROLLER_NAME."/getDatas");?>',
        });

        // 添加搜索信息
        $('#showTable_filter').append('<?php echo ($strSearch); ?>');

        // 执行搜索
        $('.me-search').bind('keyup change', function () {
            table.column(parseInt($(this).attr('index'))).search($(this).val()).draw();
        });

        // 处理搜索信息
        $('#showTable_wrapper div.row div.col-xs-6:first').removeClass('col-xs-6').addClass('col-xs-2');
        $('#showTable_wrapper div.row div.col-xs-6:first').removeClass('col-xs-6').addClass('col-xs-10');

        // 页面刷新
        $('.reload').click(function(){
            table.draw(false);
        });

        // 表单验证
        $('.update-form').validate({
            highlight: function (e) {
                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
            },
            success: function (e) {
                $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                $(e).remove();
            },
            errorPlacement: function (error, element) {
                if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                    var controls = element.closest('div[class*="col-"]');
                    if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                    else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                }
                else if(element.is('.select2')) {
                    error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                }
                else if(element.is('.chosen-select')) {
                    error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
                }
                else error.insertAfter(element.parent());
            },
        });

        // dialog美化
        $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
            _title: function(title) {
                var $title = this.options.title || '&nbsp;'
                if( ("title_html" in this.options) && this.options.title_html == true )
                    title.html($title);
                else title.text($title);
            }
        }));

        // 添加
        $('.add-data').click(function(){
            $('.update-form-error').hide();
            initForm('.update-form');
            initDialog('.update-form', '添加<?php echo ($title); ?>', function(){
                // 添加处理
                formSubmit('.update-form', '<?php echo U(CONTROLLER_NAME."/update");?>', function(json, objMe){
                    $('.update-form').dialog('close');
                    $('#showTable tbody').prepend('<tr>'+initTd(json.data)+'</tr>');
                });
            });
        });

        // 编辑
        $('#showTable tbody').on('click', '.me-edit', function(){
            // 获取数据
            var data = table.row($(this).parents('tr')).data();
            initForm('.update-form', data);

            $('.update-form-error').hide();
            initDialog('.update-form', '修改<?php echo ($title); ?>', function(){
                // 添加处理
                formSubmit('.update-form', '<?php echo U(CONTROLLER_NAME."/update");?>', function(json, objMe){
                    $('.update-form').dialog('close');
                    $('#showTable tbody').prepend('<tr>'+initTd(json.data)+'</tr>');
                });
            });
        });

        // 删除数据
        $('#showTable tbody').on('click', '.me-delete', function(){
           // 获取数据
            var tr = $(this).parents('tr'), data = table.row(tr).data();
            initAjax('<?php echo U(CONTROLLER_NAME."/delete");?>', data, function(json){
                alert(json.msg);
                if (json.status == 1)
                {
                   tr.empty();
                }
            }, function(){
                alert('服务器繁忙,请稍候再试...');
            });
        });

        // 查看详情
        $('#showTable tbody').on('click', '.me-info', function(){
            var tr = $(this).parents(tr), data = table.row(tr).data();
            for (var i in data) $('.data-info').find('.info-' + i).html(data[i]);
            initDialog('.data-info', '查看<?php echo ($title); ?>', function(){
                $('.data-info').dialog('close');
            })
        });
    });
</script>
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
	</body>
</html>
<script type="text/javascript">
    $(function(){
        // 表格样式转换
        $('#simple-colorpicker-1').ace_colorpicker({pull_right:true}).on('change', function(){
            var color_class = $(this).find('option:selected').data('class');
            var new_class = 'widget-box';
            if(color_class != 'default')  new_class += ' widget-color-'+color_class;
            $(this).closest('.widget-box').attr('class', new_class);
        });
    })
</script>