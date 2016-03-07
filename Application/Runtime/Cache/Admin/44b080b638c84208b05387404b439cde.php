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
    <?php if(is_array($menu)): foreach($menu as $key=>$value): ?><li class="<?php echo ($value["controller_name"]); echo ($value["action_name"]); ?>">
        <a <?php if(!empty($value['controller_name'])): ?>href="<?php echo U($value['controller_name'].'/'.$value['action_name']);?>" <?php else: ?> href="#" class="dropdown-toggle"<?php endif; ?>>
            <?php $arrIcons = explode('-', $value['icons']); ?>
            <i class="menu-icon <?php echo ($arrIcons[0]); ?> <?php echo ($value["icons"]); ?>"></i>
            <span class="menu-text"> <?php echo ($value["menu_name"]); ?> </span>
            <?php if(isset($value['child']) && !empty($value['child'])): ?><b class="arrow fa fa-angle-down"></b><?php endif; ?>
        </a>
        <?php if(isset($value['child']) && !empty($value['child'])): ?><b class="arrow"></b>
        <!--第二级别-->
        <ul class="submenu">
            <?php if(is_array($value["child"])): foreach($value["child"] as $key=>$val): ?><li class="<?php echo ($val["controller_name"]); echo ($val["action_name"]); ?>">
                <a <?php if(!empty($val['controller_name'])): ?>href="<?php echo U($val['controller_name'].'/'.$val['action_name']);?>" <?php else: ?> href="#" class="dropdown-toggle"<?php endif; ?> >
                    <i class="menu-icon fa fa-caret-right"></i>
                    <?php echo ($val["menu_name"]); ?>
                    <?php if(isset($val['child']) && !empty($val['child'])): ?><b class="arrow fa fa-angle-down"></b><?php endif; ?>
                </a>
                <?php if(isset($val['child']) && !empty($val['child'])): ?><b class="arrow"></b>
                <ul class="submenu">
                    <?php if(is_array($val["child"])): foreach($val["child"] as $key=>$item): ?><li class="<?php echo ($item["controller_name"]); echo ($item["action_name"]); ?>">
                        <a href="<?php echo U($item['controller_name'].'/'.$item['action_name']);?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            <?php echo ($item["menu_name"]); ?>
                        </a>
                        <b class="arrow"></b>
                    </li><?php endforeach; endif; ?>
                </ul><?php endif; ?>
            </li><?php endforeach; endif; ?>
        </ul><?php endif; ?>
    </li><?php endforeach; endif; ?>
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
								<h3 class="header smaller lighter blue"><?php echo ($title); ?></h3>
<table id="grid-table"></table>
<div id="grid-pager"></div>
<script type="text/javascript">
    $(function($) {
        // 初始化定义
        var grid_selector  = "#grid-table"; // 定义选择信息表格
        var pager_selector = "#grid-pager"; // 定义分页信息

        // 窗口改变大小
        $(window).on('resize.jqGrid', function () {
            $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        });

        // 调整在侧边栏折叠/展开
        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
            if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
                // 及时调整大小
                setTimeout(function() {
                    $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
                }, 0);
            }
        });

        // 提交验证
        function beforeValidate(postdata, form)
        {
            return [form.validate().form(), '请正确填写表单'];
        }

        // 提交数据成功
        function afterSuccess(response, postdata)
        {
            var json   = $.parseJSON(response.responseText),
                isTrue = json.status == 1 ? true : false;
            return [isTrue, json.msg];
        }

        var mcolNames = <?php echo ($colNames); ?>;
        var mcolModel = <?php echo ($colModel); ?>;

        // 重新赋值
        mcolModel[0].formatoptions.delOptions.beforeShowForm = beforeDeleteCallback;
        mcolModel[0].formatoptions.delOptions.afterSubmit    = afterSuccess;

        // 初始化表格
        jQuery(grid_selector).jqGrid({
            caption: '<?php echo ($title); ?>列表',                                         // 表格名称
            url:'<?php echo U(CONTROLLER_NAME."/getData");?>',                         // 获取数据的URL
            datatype: 'json',                                               // 数据类型
            editurl: "<?php echo U(CONTROLLER_NAME.'/update');?>",                     // 修改的连接信息
            height: '80%',                                                  // 高度
            colNames:mcolNames,                                             // 显示的列信息
            colModel:mcolModel,                                             // 字段信息
            subGrid : true,                                                 // 是否运行查看详情
            subGridOptions : {                                              // 按钮信息
                plusicon : "ace-icon fa fa-plus center bigger-110 blue",    // 查看
                minusicon: "ace-icon fa fa-minus center bigger-110 blue",   // 修改
                openicon : "ace-icon fa fa-chevron-right center orange"     // 删除
            },

            // 服务器返回信息
            jsonReader:{
                root:'rows',        // 数据字段名
                page:'page',        // 当前页
                total:'total',      // 总页数
                records:'records',  // 查询出的记录数
                id:'id',            // 行ID
                cell:'data',        // 行数据
            },

            // 详情信息
            subGridRowExpanded: function (subgridDivId, rowId) {
                var subgridTableId = subgridDivId + "_t";
                $("#" + subgridDivId).html("<table id='" + subgridTableId + "'></table>");
                $("#" + subgridTableId).jqGrid({
                    url:'/Admin/Index/getDetail.html?id='+rowId,
                    datatype: 'json',
                    colNames: <?php echo ((isset($detailColNames) && ($detailColNames !== ""))?($detailColNames):'[]'); ?>,
                    colModel: <?php echo ((isset($detailColModel) && ($detailColModel !== ""))?($detailColModel):'[]'); ?>,
                });
            },

            viewrecords : true,
            rowNum:10,
            rowList:[10,20,30],
            pager : pager_selector,
            altRows: true,
            multiselect: true,      // 可以多选
            multiboxonly: true,
            loadComplete : function() {
                var table = this;
                setTimeout(function(){
                    updatePagerIcons(table);
                    enableTooltips(table);
                }, 0);
            },
        });

        $(window).triggerHandler('resize.jqGrid');

        // 选择框
        function aceSwitch(cellvalue, options, cell ){
            setTimeout(function(){
                $(cell) .find('input[type=checkbox]')
                        .addClass('ace ace-switch ace-switch-5')
                        .after('<span class="lbl"></span>');
            }, 0);
        }

        // 处理时间
        function pickDate( cellvalue, options, cell ) {
            setTimeout(function(){
                $(cell) .find('input[type=text]')
                        .datepicker({
                            format:'yyyy-mm-dd' ,
                            autoclose:true,
                            language: 'zh-CN',
                            todayBtn:'linked',
                        });
            }, 0);
        }

        // 按钮信息
        jQuery(grid_selector).jqGrid('navGrid',pager_selector,
        { 	//navbar options
            edit: true,
            editicon : 'ace-icon fa fa-pencil blue',
            add: true,
            addicon : 'ace-icon fa fa-plus-circle purple',
            del: true,
            delicon : 'ace-icon fa fa-trash-o red',
            search: true,
            searchicon : 'ace-icon fa fa-search orange',
            refresh: true,
            refreshicon : 'ace-icon fa fa-refresh green',
            view: true,
            viewicon : 'ace-icon fa fa-search-plus grey',
        },
        {
            width: 'auto',
            recreateForm: true,
            // 显示表单之前
            beforeShowForm : function(e) {
                var form = $(e[0]);
                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                style_edit_form(form);
            },

            // 提交表单之前(数据信息, 表单信息)数据的验证
            beforeSubmit:beforeValidate,
            afterSubmit:afterSuccess,
        },
            {
                // 新增数据
                closeAfterAdd: true,
                recreateForm: true,
                viewPagerButtons: false,
                beforeShowForm : function(e) {
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
                            .wrapInner('<div class="widget-header" />')
                    style_edit_form(form);
                },

                // 提交之前验证
                beforeSubmit:beforeValidate,
                // 数据提交之后
                afterSubmit:afterSuccess,
            },
            {
                // 删除
                recreateForm: true,
                beforeShowForm : function(e) {
                    var form = $(e[0]);
                    if(form.data('styled')) return false;
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                    style_delete_form(form);
                    form.data('styled', true);
                },
                afterSubmit:afterSuccess,
            },
            {
                recreateForm: true,
                afterShowSearch: function(e){
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                    style_search_form(form);
                },
                afterRedraw: function(){
                    style_search_filters($(this));
                }
                ,
                multipleSearch: true,
            },
            {
                recreateForm: true,
                beforeShowForm: function(e){
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                }
            }
        )


        // 修改数据
        function style_edit_form(form)
        {
            // 初始化信息
            form.find('input[name=createTime]').datepicker({format:'yyyy-mm-dd' , autoclose:true})
                    .end().find('input[name=status]')
                    .addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');

            // 表单信息
            var buttons = form.next().find('.EditButton .fm-button');
            buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
            buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
            buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')

            buttons = form.next().find('.navButton a');
            buttons.find('.ui-icon').hide();
            buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
            buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');
        }

        // 删除数据
        function style_delete_form(form) {
            var buttons = form.next().find('.EditButton .fm-button');
            buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
            buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
            buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
        }

        // 查询信息
        function style_search_filters(form) {
            form.find('.delete-rule').val('X');
            form.find('.add-rule').addClass('btn btn-xs btn-primary');
            form.find('.add-group').addClass('btn btn-xs btn-success');
            form.find('.delete-group').addClass('btn btn-xs btn-danger');
        }

        // 执行查询
        function style_search_form(form) {
            var dialog = form.closest('.ui-jqdialog');
            var buttons = dialog.find('.EditTable')
            buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
            buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
            buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
        }

        // 删除之前执行函数
        function beforeDeleteCallback(e)
        {
            var form = $(e[0]);
            if(form.data('styled')) return false;
            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
            style_delete_form(form);
            form.data('styled', true);
        }

        // 分页设置信息
        function updatePagerIcons(table) {
            var replacement =
            {
                'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
                'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
                'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
                'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
            };

            $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
                var icon = $(this);
                var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
                if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
            })
        }

        function enableTooltips(table) {
            $('.navtable .ui-pg-button').tooltip({container:'body'});
            $(table).find('.ui-pg-div').tooltip({container:'body'});
        }

        $(document).on('ajaxloadstart', function(e) {
            $(grid_selector).jqGrid('GridUnload');
            $('.ui-jqdialog').remove();
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
		var select = '.<?php echo (CONTROLLER_NAME); echo (ACTION_NAME); ?>';
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