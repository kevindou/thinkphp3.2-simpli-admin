<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>我的个人微博后台管理</title>
    <meta name="description"    content="我的个人微博后台管理" />
    <meta name="author"         content="liujx" />
    <meta name="keyword"        content="我的个人微博后台管理" />
    <meta name="viewport"       content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- 加载CSS -->
    <link rel="stylesheet" href="/Public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Public/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="/Public/css/style.min.css" />
    <link rel="stylesheet" href="/Public/css/style-responsive.min.css" />
    <link rel="stylesheet" href="/Public/css/retina.css" />
    <link rel="stylesheet" href="/Public/css/jquery.datetimepicker.css" />

    <!-- 判断IE的CSS -->
    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link id="ie-style" href="css/ie.css" rel="stylesheet">
    <![endif]-->
    <!--[if IE 9]>
    <link id="ie9style" href="/Public/css/ie9.css" rel="stylesheet">
    <![endif]-->
    <script type="text/javascript" src="/Public/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.ui.touch-punch.js"></script>
    <script type="text/javascript" src="/Public/js/modernizr.js"></script>
    <script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.cookie.js"></script>
    <script type="text/javascript" src='/Public/js/fullcalendar.min.js'></script>
    <script type="text/javascript" src='/Public/js/jquery.dataTables.min.js'></script>
    <script type="text/javascript" src="/Public/js/excanvas.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.flot.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.flot.stack.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.flot.resize.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.flot.time.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.chosen.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.cleditor.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.noty.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.elfinder.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.raty.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.iphone.toggle.js"></script>

    <!--文件上传-->
    <script type="text/javascript" src="/Public/js/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.iframe-transport.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.fileupload.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.uploadify-3.1.min.js"></script>

    <script type="text/javascript" src="/Public/js/jquery.gritter.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.imagesloaded.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.masonry.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.knob.modified.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="/Public/js/counter.min.js"></script>
    <script type="text/javascript" src="/Public/js/raphael.2.1.0.min.js"></script>
    <script type="text/javascript" src="/Public/js/justgage.1.0.1.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.autosize.min.js"></script>
    <script type="text/javascript" src="/Public/js/retina.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.placeholder.min.js"></script>
    <script type="text/javascript" src="/Public/js/wizard.min.js"></script>
    <script type="text/javascript" src="/Public/js/core.min.js"></script>
    <script type="text/javascript" src="/Public/js/charts.min.js"></script>
    <script type="text/javascript" src="/Public/js/custom.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.datetimepicker.full.js"></script>
    <script type="text/javascript" src="/Public/js/datepicker.zh-CN.js"></script>
    <script type="text/javascript" src="/Public/js/layer/layer.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/Public/js/validate.message.js"></script>
    <script type="text/javascript" src="/Public/js/base.js"></script>
    <script type="text/javascript" src="/Public/js/dataTable.js"></script>
</head>
<body>
<div class="container-fluid-full">
	<div class="row-fluid">
		<div class="login-box">
			<h2>用户登录:</h2>
			<form class="form-horizontal login" name="login" action="#" method="post">
				<fieldset>
					<input class="input-large span12" name="username" id="username" type="text" placeholder="用户名" required="true" rangelength="[2,20]" />
					<input class="input-large span12" name="password" id="password" type="password" placeholder="密码" required="true" rangelength="[6,15]" />
					<div class="clearfix"></div>
					<button type="submit" class="btn btn-primary span12">登录</button>
				</fieldset>	
			</form>	
		</div>
	</div>	
</div>
</body>
</html>
<script type="text/javascript">
	$(function(){
		// 登录验证
		$('.login').submit(function(){
			// 验证通过
			if ($(this).validate().form())
			{
				var intLoad = layer.load();
				// ajax请求登录
				$.ajax({
					"url": "<?php echo U('Index/login');?>",
					"type": "POST",
					"data": $(this).serialize(),
					"dataType": "json", 
					"success": function(json) {
						layer.close(intLoad);
						var color = json.status == 1 ? "#78BA32" : "";
						layer.tips(json.msg, ".btn-primary", {tips: [3, color], time:1000})
						if (json.status == 1) window.location.href = "<?php echo U('Admin/login');?>";
					},
					"error": function() {
						layer.close(intLoad);
						layer.msg("服务器繁忙，请稍候再试...", {time:800})
					}
				})
			}

			return false;
		});
	});
</script>