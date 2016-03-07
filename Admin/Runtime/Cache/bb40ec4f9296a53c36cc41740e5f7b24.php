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
<div class="container-fluid-full">
		<div class="row-fluid">
			<div class="row-fluid">
				<div class="login-box">
					<h2>登录</h2>
					<form class="form-horizontal" action="<?php echo U('index/login');?>" method="post" id="login">
						<fieldset>
							<input class="input-large span12" name="username" id="username" type="text" placeholder="登录账号" />
							<input class="input-large span12" name="password" id="password" type="password" placeholder="登录密码" />
							<div class="clearfix"></div>
							<button type="submit" class="btn btn-primary span12">登录</button>
                            <label  class="m_error" style="display:none">页面没有响应</label>
						</fieldset>
					</form>
				</div>
			</div>
        </div>
	    </div>
</body>
</html>
<style type="text/css">
    label.error, label.m_error {color:red}
</style>
<script type="text/javascript">
    $(window).ready(function(){
        $('#login').validate({
            debug: false,
            rules:{
                username:{
                    required:true,
                    minlength:2,
                    maxlength:10
                },
                password:{
                    required:true,
                    minlength:6,
                    maxlength:12
                }
            },
            messages:{
                username:{
                    required:'登录账号不能为空',
                    minlength:'登录账号不能小于2位',
                    maxlength:'登录账号不能大于10位'
                },
                password:{
                    required:'登录密码不能为空',
                    minlength:'登录密码不能小于6位',
                    maxlength:'登录密码不能大于12位'
                }
            }
        });

        // 表单提交
        $('#login').submit(function(){
            if ($(this).validate().form())
            {
               // ajax提交
                $.ajax({
                    url:'?m=Index&a=login',
                    data:{
                        'username':$('#username').val(),
                        'password':$('#password').val()
                    },
                    type:'post',
                    dataType:'json',
                    success:function(json)
                    {
                        if (json.status == 0)
                        {
                            $('.m_error').html(json.msg).show();
                        }
                        else
                        {
                            $('.m_error').html('登录成功！正在跳转...').show();
                            window.location.href = '?m=Index&a=index';
                        }
                    },
                })
            }

            return false;
        });
    });

</script>