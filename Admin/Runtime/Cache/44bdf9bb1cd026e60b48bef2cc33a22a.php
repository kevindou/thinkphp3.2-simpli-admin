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
    <!--<li><a href="?m=Image&a=index"><i class="icon-picture"></i><span class="hidden-tablet"> 图片信息 </span></a></li>-->
</ul>
            </div>
        </div>

        <div id="content" class="span10">
<?php if(is_array($arrRowFluid)): foreach($arrRowFluid as $key=>$value): ?><div class="row-fluid <?php echo ($value["class"]); ?>">
    <div class="box span12">
        <!--前面导航信息-->
        <div class="box-header" data-original-title="">
            <h2>
                <i class="icon-desktop"></i>
                <span class="break"></span>
                <?php echo ($value["title"]); ?>
            </h2>
            <div class="box-icon">
                <?php echo ($value["topOperate"]); ?>
            </div>
        </div>
        <div class="box-content">
            <?php if($value["isShowTable"] == true): ?><!--表格数据-->
            <table class="table table-striped table-bordered table-hover" id="showTable">
            </table><?php endif; ?>

            <?php if(is_array($value["content"])): $i = 0; $__LIST__ = $value["content"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div id="<?php echo ($key); ?>" class="<?php echo ($val["class"]); ?>">
                <?php echo ($val["content"]); ?>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div><?php endforeach; endif; ?>

<script type="text/javascript">
    $(function() {
        // 表格
        var table = showDataTable($('#showTable'), <?php echo ($aoColnmns); ?>, 10, '?m=<?php echo (MODULE_NAME); ?>&a=getDatas');
        // 分页样式
        $('#showTable_paginate').addClass('pagination pagination-centered');
        // 去掉搜索placeholder属性(不去掉白色看不见)
        $('input[type=search]').removeAttr('placeholder');
        // 添加搜索信息
        $('#showTable_filter').append('<?php echo ($strSearch); ?>');
        // 执行搜索
        $('.msearch').live('keyup change', function () {
            table.column(parseInt($(this).attr('vid'))).search($(this).val()).draw();
        });

        // 添加时间查询
        $('.datepicker').datepicker({
            showButtonPanel: true,
            dateFormat: 'yy-mm-dd'
        });

        // 表格刷新
        $('#table-refresh').click(function(){
            art.dialog({
                title: '正在刷新...',
                width:300,
                height:100,
                time:0.3,
                lock:true,
                close:function(){
                    table.draw(false);
                }
            })
        });

        // 隐藏内容
        $('.btn-close:first').click(function () {
            $('.main-menu li.active a').append('<span class="label">显示</span>').addClass('isShow').bind('click', function (e) {
                e.preventDefault();
                $('.row-fluid .box:first').fadeIn();
                $('.box:gt(0)').fadeOut();
                $(this).unbind('click').find('span:last').remove();
                return false;
            });
        });

        // 其他方式添加数据
        $('#addOther').click(function () {
            // 编辑框样式
            initEdit();
            fluidChange(':last', 'show');
        });

        // 添加隐藏删除
        $('.btn-close:gt(0)').click(function () {
            fluidChange(':last', 'hide')
        });

        // 数据添加
        $('#updateSub').click(function (e) {
            e.preventDefault();
            var vid = $('#addForm').find('input[type=hidden]').val();
            var isEdit = empty(vid) ? undefined : $('.btn-edit[vid=' + vid + ']');
            return handleEditData($('#addForm'), '?m=<?php echo (MODULE_NAME); ?>&a=update', function () {
            }, true, true, isEdit);
        });

        // 显示DIV
        $('#addData').click(function () {
            $('#addForm')[0].reset();   // 显示之前表单重置
            showDiv($('#addDiv'), '添加<?php echo ($title); ?>', function () {
                // 添加处理
                return handleEditData($('#addForm'), '?m=<?php echo (MODULE_NAME); ?>&a=update', function () {
                }, true);
            });
        });

        // 修改按钮
        $('.btn-edit').live('click', function () {
            var me = $(this), vid = me.attr('vid');
            if (!empty(vid)) {
                // ajax获取数据
                $.ajax({
                    url: '?m=<?php echo (MODULE_NAME); ?>&a=getEditData',
                    type: 'get',
                    data: {'id': vid},
                    dataType: 'json',
                    success: function (json) {
                        if (json.status == 1) {
                            if ($('#addData').length >= 1) {
                                initForm(document.editForm, json.data);
                                showDiv($('#editDiv'), '修改<?php echo ($title); ?>', function () {
                                    // 数据处理
                                    return handleEditData($('#editForm'), '?m=<?php echo (MODULE_NAME); ?>&a=update', function () {
                                    }, true, undefined, me);
                                });
                            }
                            else {
                                initEdit(json.data.content);            // 初始化编辑器信息
                                initForm(document.addForm, json.data);  // 初始化表单
                                fluidChange(':last', 'show');           // 转换布局内容
                                return false;
                            }

                            return false;
                        }

                        warning(json.msg)
                    },
                    error: function () {
                        warning();
                    }
                })

                return false;
            }

            warning('修改数据信息错误');
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
                                $('.btn-delete[vid='+vid+']').parent().parent().remove();
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

        // 数据导入
        $('#importData').click(function(){
            showDiv($('#importDiv'), '导入数据信息', function(){
                return handleEditData($('#importForm'), '?m=<?php echo (MODULE_NAME); ?>&a=import', function(){
                    return false;
                }, true);
            });
        });

        // 显示详情
        $('.btn-success').live('click', function () {
            var me = $(this), vid = me.attr('vid');
            if (!empty(vid)) {
                // ajax获取数据
                $.ajax({
                    url: '?m=<?php echo (MODULE_NAME); ?>&a=getEditData',
                    type: 'get',
                    data: {'id': vid, 'handle':1},
                    dataType: 'json',
                    success: function (json) {
                        if (json.status == 1)
                        {
                            initTable(json.data);
                            fluidChange(':eq(1)', 'show');
                            return false;
                        }

                        warning(json.msg)
                    },
                    error:function(){
                        warning();
                    }
                });
            }
        });

        // 导入用户信息的联动(平台和服务器信息联动)
        $('#m-agentId').change(function(){
            $('#m-serverId').html('<option>请选择</option>');
            var aId = this.value;
            // 数据请求查询服务器信息
            if (!empty(aId))
            {
                $.ajax({
                    url:'?m=<?php echo (MODULE_NAME); ?>&a=getLinkAge',
                    type:'get',
                    data:{id:aId},
                    dataType:'json',
                    success:function(json){
                        if (json.status == 1)
                        {
                            $('.importForm_error').html('').hide();
                            var module_name = '<?php echo (MODULE_NAME); ?>';
                            if (module_name == 'Server')
                                initForm($('#importForm')[0], json.data, false); // 表单赋值
                            else
                                $('#m-serverId').html(json.data);
                            return true;
                        }

                        $('.importForm_error').html(json.msg).show();
                    },
                    error:function(){
                        $('.importForm_error').html('服务器繁忙,请稍候再试...').show();
                    }
                })
            }
        });

        // 用户数据联动
        $('#m-serverId').change(function(){
            var sId = this.value,aId = $('#m-agentId').val();
            // 数据请求查询服务器信息
            if (!empty(sId) && ! empty(aId))
            {
                $.ajax({
                    url:'?m=<?php echo (MODULE_NAME); ?>&a=getServer',
                    type:'get',
                    data:{'sid':sId,'aid':aId},
                    dataType:'json',
                    success:function(json){
                        if (json.status == 1)
                        {
                            $('#importForm').find('input[name=mongohost]').val(json.data.mongoHost);
                            $('#importForm').find('input[name=mongoport]').val(json.data.mongoPort);
                            $('#importForm').find('input[name=mongoname]').val(json.data.mongoName);
                            return true;
                        }

                        $('.importForm_error').html(json.msg).show();
                    },
                    error:function(){
                        $('.importForm_error').html('服务器繁忙,请稍候再试...').show();
                    }
                })
            }
        });

        // 图片上传
        $('.fileUpload').fileupload({
            dataType: 'json',
            url: '?m=Image&a=fileUpload',
            // 上传之前的操作
            beforeSend:function(e, data){
                var arr = verifyUpload(data, 20000000, undefined , $('.fileUpload').val());
                // 上传存在错误
                if ( ! arr[0])
                {
                    $('.fileUpload').next('span:first').html('未选择文件');
                    warning(arr[1]);
                    return false;
                }
            },
            // 上传成功
            success: function(json)
            {
                if (json.status == 1)
                {
                    success(json.msg, function(){
                        $('.fileUpload').next('span:first').html(json.data.fileName);
                        $('.fileUpload').parent().prev('input[type=hidden]').val(json.data.fileUrl);
                    });
                    return false;
                }

                warning(json.msg);
            }
        });
    });
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