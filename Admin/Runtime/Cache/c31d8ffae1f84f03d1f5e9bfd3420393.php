<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>死神-weby-后台管理</title>
    <meta name="description" content="死神-weby" />
    <meta name="author" content="liujx" />
    <meta name="keyword" content="死神-weby" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="./Public/Admin/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./Public/Admin/css/bootstrap-responsive.min.css" rel="stylesheet" />
    <link href="./Public/Admin/css/style.min.css" rel="stylesheet" />
    <link href="./Public/Admin/css/style-responsive.min.css" rel="stylesheet" />
    <link href="./Public/Admin/css/retina.css" rel="stylesheet" />
    <link href="./Public/css/dialog-default.css" rel="stylesheet" />
    <link href="./Public/Admin/css/jquery.datetimepicker.css" rel="stylesheet" />
    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link id="ie-style" href="css/ie.css" rel="stylesheet">
    <![endif]-->
    <!--[if IE 9]>
    <link id="ie9style" href="css/ie9.css" rel="stylesheet">
    <![endif]-->
    <link href="./Public/Admin/css/common.css" rel="stylesheet" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--加载JS-->
    <script src="./Public/Admin/js/jquery-1.10.2.min.js"></script>
    <script src="./Public/Admin/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="./Public/Admin/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="./Public/Admin/js/jquery.ui.touch-punch.js"></script>
    <script src="./Public/Admin/js/modernizr.js"></script>
    <script src="./Public/Admin/js/bootstrap.min.js"></script>
    <script src="./Public/Admin/js/jquery.cookie.js"></script>
    <script src='./Public/Admin/js/fullcalendar.min.js'></script>
    <script src='./Public/Admin/js/jquery.dataTables.min.js'></script>
    <script src="./Public/Admin/js/excanvas.js"></script>
    <script src="./Public/Admin/js/jquery.flot.js"></script>
    <script src="./Public/Admin/js/jquery.flot.pie.js"></script>
    <script src="./Public/Admin/js/jquery.flot.stack.js"></script>
    <script src="./Public/Admin/js/jquery.flot.resize.min.js"></script>
    <script src="./Public/Admin/js/jquery.flot.time.js"></script>
    <script src="./Public/Admin/js/jquery.chosen.min.js"></script>
    <script src="./Public/Admin/js/jquery.uniform.min.js"></script>
    <script src="./Public/Admin/js/jquery.cleditor.min.js"></script>
    <script src="./Public/Admin/js/jquery.noty.js"></script>
    <script src="./Public/Admin/js/jquery.elfinder.min.js"></script>
    <script src="./Public/Admin/js/jquery.raty.min.js"></script>
    <script src="./Public/Admin/js/jquery.iphone.toggle.js"></script>

    <!--文件上传-->
    <script src="./Public/Admin/js/jquery.uploadify-3.1.min.js"></script>
    <script src="./Public/Admin/js/jquery.ui.widget.js"></script>
    <script src="./Public/Admin/js/jquery.iframe-transport.js"></script>
    <script src="./Public/Admin/js/jquery.fileupload.js"></script>

    <script src="./Public/Admin/js/jquery.gritter.min.js"></script>
    <script src="./Public/Admin/js/jquery.imagesloaded.js"></script>
    <script src="./Public/Admin/js/jquery.masonry.min.js"></script>
    <script src="./Public/Admin/js/jquery.knob.modified.js"></script>
    <script src="./Public/Admin/js/jquery.sparkline.min.js"></script>
    <script src="./Public/Admin/js/counter.min.js"></script>
    <script src="./Public/Admin/js/raphael.2.1.0.min.js"></script>
    <script src="./Public/Admin/js/justgage.1.0.1.min.js"></script>
    <script src="./Public/Admin/js/jquery.autosize.min.js"></script>
    <script src="./Public/Admin/js/retina.js"></script>
    <script src="./Public/Admin/js/jquery.placeholder.min.js"></script>
    <script src="./Public/Admin/js/wizard.min.js"></script>
    <script src="./Public/Admin/js/core.min.js"></script>
    <script src="./Public/Admin/js/charts.min.js"></script>
    <script src="./Public/Admin/js/custom.min.js"></script>
    <script src="./Public/Admin/js/jquery.datetimepicker.full.js"></script>
    <script src="./Public/Admin/js/datepicker.zh-CN.js"></script>
    <script src="./Public/js/artDialog.js"></script>
    <script src="./Public/js/jquery.validate.min.js"></script>
    <script src="./Public/js/validate.message.js"></script>
    <script src="./Public/Admin/js/comm.func.js"></script>
</head>
<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a id="main-menu-toggle" class="hidden-phone open"><i class="icon-reorder"></i></a>
            <div class="row-fluid">
                <a class="brand span2" href="index.html"><span>死神WEB</span></a>
            </div>

            <!-- start: Header Menu -->
            <div class="nav-no-collapse header-nav">
                <ul class="nav pull-right">
                    <!-- start: User Dropdown -->
                    <li class="dropdown">
                        <a class="btn account dropdown-toggle" data-toggle="dropdown" href="#">
                            <div class="avatar"><img src="/Public/Admin/img/avatar.jpg" alt="Avatar" /></div>
                            <div class="user">
                                <span class="hello">欢迎登录后台!</span>
                                <span class="name"><?php echo ($_SESSION['gt_adminuser']['username']); ?></span>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu-title"></li>
                            <!--<li><a href="#"><i class="icon-user"></i> Profile</a></li>-->
                            <!--<li><a href="#"><i class="icon-cog"></i> Settings</a></li>-->
                            <!--<li><a href="#"><i class="icon-envelope"></i> Messages</a></li>-->
                            <li><a href="?m=Index&a=logout"><i class="icon-off"></i> 退出登录</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid-full">
    <div class="row-fluid">
        <div id="sidebar-left" class="span2">
            <div class="nav-collapse sidebar-nav">
                <!--左侧导航信息-->
<ul class="nav nav-tabs nav-stacked main-menu">
    <li><a href="?m=Users&a=index"><i class="icon-user"></i><span class="hidden-tablet"> 用户管理 </span></a></li>
    <li><a href="?m=Agent&a=index"><i class="icon-desktop"></i><span class="hidden-tablet"> 平台管理 </span></a></li>
    <li><a href="?m=Server&a=index"><i class="icon-laptop"></i><span class="hidden-tablet"> 服务器管理 </span></a></li>
    <li><a href="?m=Order&a=index"><i class="icon-list-alt"></i><span class="hidden-tablet"> 订单信息 </span></a></li>
    <li><a href="?m=Order&a=count"><i class="icon-bar-chart"></i><span class="hidden-tablet"> 订单统计 </span></a></li>
    <li><a href="?m=Category&a=index"><i class="icon-list"></i><span class="hidden-tablet"> 文章分类 </span></a></li>
    <li><a href="?m=Article&a=index"><i class="icon-align-justify"></i><span class="hidden-tablet"> 文章信息 </span></a></li>
    <li><a href="?m=Account&a=index"><i class="icon-gift"></i><span class="hidden-tablet"> 积分记录 </span></a></li>
    <li><a href="?m=Image&a=index"><i class="icon-align-justify"></i><span class="hidden-tablet"> 图片管理 </span></a></li>
</ul>
            </div>
        </div>

        <div id="content" class="span10">
<div class="row-fluid">
	<div ondesktop="span3" ontablet="span6" class="span3 smallstat box mobileHalf noMargin">
		<i class="icon-shopping-cart green"></i>
		<span class="title">订单数</span>
		<span class="value" id="count-total"><?php echo (($count)?($count):"0"); ?></span>
	</div>
	<div ondesktop="span3" ontablet="span6" class="span3 smallstat box mobileHalf noMargin">
		<i class="icon-credit-card yellow"></i>
		<span class="title">充值金额</span>
		<span class="value" id="money-total"><?php echo (($money)?($money):"0"); ?></span>
	</div>
	<div ondesktop="span3" ontablet="span6" class="span3 smallstat mobileHalf box">
		<i class="icon-money orange"></i>
		<span class="title">充值金币数</span>
		<span class="value" id="gold-total"><?php echo (($gold)?($gold):"0"); ?></span>
	</div>
</div>
<div class="row-fluid">
	<div class="box span12">
		<div class="box-header">
			<h2>
				<i class="icon-edit"></i>
				订单统计查询
			</h2>
			<div class="box-icon">
				<a id="toggle-fullscreen" class="hidden-phone hidden-tablet" title="全屏" href="#"> 
                    <i class="icon-fullscreen"></i>
                </a>
				<a class="btn-minimize" title="隐藏" href="#"> 
                    <i class="icon-chevron-up"></i>
                </a>
                <a class="btn-close" title="删除" href="#">
                    <i class="icon-remove"></i>
                </a>
			</div>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered table-hover" id="showTable">
            </table>
		</div>
	</div>
</div>
<style type="text/css">
	#showTable_filter label input, #showTable_filter label select {margin-top:6px;}
</style>
<script type="text/javascript">

	// 刷新统计数据
	function setCounts()
	{
		$.ajax({
        		url:'?m=Order&a=setCounts',
        		type:'get',
        		data:{
        			'sSearch':$('#showTable_filter input[type=search]').val(),
        			'sSearch_2':$('#m-agentId').val(),
        			'sSearch_3':$('#m-serverId').val(),
        			'sSearch_4':$('#date-start').val(),
        			'sSearch_5':$('#date-end').val(),
        		},
        		dataType:'json',
        		success:function(json)
        		{
        			for (var i in json) $('#'+i+'-total').html(json[i]);
        		},
        		error:function()
        		{
        			warning();
        		}
        	})
	}

	$(function(){
		// 表格初始化
		var table = showDataTable($('#showTable'), <?php echo ($aoColnmns); ?>, 100, '?m=Order&a=getCounts', {bLengthChange:false, 'order':[[8,'desc']]});
        // 分页样式
        $('#showTable_paginate').addClass('pagination pagination-centered');
        // 去掉搜索placeholder属性(不去掉白色看不见)
        $('input[type=search]').removeAttr('placeholder').on('keyup change', function(){
			setCounts();
        });

        // 添加搜索信息
        $('#showTable_filter').append('<?php echo ($strSearch); ?> <label> 开始时间: <input type="text" class="msearch time" vid="4" id="date-start" /></label>  <label> 结束时间: <input type="text" vid="5" class="msearch time" id="date-end" /></label> <label>');

        // 执行搜索
        $('.msearch').live('keyup change', function () {
        	// 之前处理查询的总数信息
        	setCounts();
            table.column(parseInt($(this).attr('vid'))).search($(this).val()).draw();
        });

		jQuery.datetimepicker.setLocale('ch');
		// 时间查询
		var mTime = {defaultTime:'00:00', onSelectDate:function(){
			$(this).hide();}};
		// 开始时间
		$('.time:first').datetimepicker(mTime);
		// 结束时间
		mTime.defaultTime = '23:59';
		$('.time:last').datetimepicker(mTime);

        // 隐藏内容
        $('.btn-close:first').click(function () {
            $('.main-menu li.active a').append('<span class="label">显示</span>').addClass('isShow').bind('click', function (e) {
                e.preventDefault();
                $('.row-fluid .box:last').fadeIn();
                $(this).unbind('click').find('span:last').remove();
                return false;
            });
        });

		// 游戏平台和服务器联动)
		$('#m-agentId').on('change', function(){
			$('#m-serverId').html('<option value="0"> 请选择 </option>');
			var aId = this.value;
			// 数据请求查询服务器信息
			if (!empty(aId))
			{
				$.ajax({
					url:'?m=Users&a=getLinkAge',
					type:'get',
					data:{id:aId},
					dataType:'json',
					success:function(json){
						if (json.status == 1)$('#m-serverId').html(json.data);
					},
					error:function(){
						$('.importForm_error').html('服务器繁忙,请稍候再试...').show();
					}
				})
			}
		});

		// 关闭清除数据
        $('#myModal').on('hidden.bs.modal', function(e){
            $(this).find('div.modal-body p').removeAttr('vid');
        });

        // 点击触发
        $('.delete-close').click(function(){
            var vid = $('#myModal').find('div.modal-body p').attr('vid');
            if (!empty(vid))
            {
                $.ajax({
                    url: '?m=<?php echo (MODULE_NAME); ?>&a=delete',
                    type: 'get',
                    dataType: 'json',
                    data: {id: vid},
                    success: function (json) {
                        if (json.status == 1)
                        {
                            $("#myModal").modal('hide');
                            success(json.msg, function(){
                                setCounts();
                                table.draw(false);
                            });

                            return false;
                        }

                        $('.modal-body p').html('<span style="color:red">'+json.msg+'</span>');;
                    },
                    error: function () {
                        $('.modal-body p').html('<span style="color:red">服务器繁忙,请稍候再试...</span>');
                    }
                });
            }
        });

        // 删除按钮
        $('.btn-delete').live('click', function () {
            var me = $(this), vid = me.attr('vid');
            if (!empty(vid))
            {
                $('.modal-body p').html('您确定需要删除这条数据吗?').attr('vid', vid);
                $("#myModal").modal().show();
                return false;
            }

            warning('删除数据不存在');
        });
	})
</script>
</div>
</div>
<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>温馨提醒</h3>
    </div>
    <div class="modal-body">
        <p>Here settings can be configured...</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal"> 取消 </a>
        <a href="#" class="btn btn-primary delete-close"> 确定 </a>
    </div>
</div>
<div class="clearfix"></div>
<footer>
    <p>
        <span style="text-align:left;float:left">Copyright &copy; 2015.Company name All rights reserved.<a href="<?php echo U('index/index');?>">死神web</a></span>
    </p>
</footer>
</div>
</body>
</html>