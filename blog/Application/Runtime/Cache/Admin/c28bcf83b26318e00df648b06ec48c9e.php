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
<!-- 头部导航栏 start : -->
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
                <a class="brand span2" href="index.html"><span>个人博客后台管理</span></a>
            </div>
            <!-- start: Header Menu -->
            <div class="nav-no-collapse header-nav">
                <ul class="nav pull-right">
                    <!-- start: User Dropdown -->
                    <li class="dropdown">
                        <a class="btn account dropdown-toggle" data-toggle="dropdown" href="#">
                            <div class="avatar"><img src="/Public/img/avatar.jpg" alt="Avatar" /></div>
                            <div class="user">
                                <span class="hello">欢迎登录!</span>
                                <span class="name"><?php echo ($_SESSION['my_admin']['username']); ?></span>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu-title"></li>
                            <!--<li><a href="#"><i class="icon-user"></i> Profile</a></li>
                            <li><a href="#"><i class="icon-cog"></i> Settings</a></li>
                            <li><a href="#"><i class="icon-envelope"></i> Messages</a></li>-->
                            <li><a href="<?php echo U('Index/logout');?>"><i class="icon-off"></i> 退出</a></li>
                        </ul>
                    </li>
                    <!-- end: User Dropdown -->
                </ul>
            </div>
            <!-- end: Header Menu -->
        </div>
    </div>
</div>
<!-- 头部导航栏 end :  -->
<div class="container-fluid-full">
    <div class="row-fluid">
        <!-- start: 主要导航栏 -->
        <div id="sidebar-left" class="span2">
            导航栏搜索
            <div class="row-fluid actions">
                <input type="text" class="search span12" placeholder="搜索栏目" />
            </div>

            <div class="nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    <?php if(is_array($menus)): foreach($menus as $key=>$value): ?><li>
                        <a <?php if((0 < count($value['child']))): ?>class="dropmenu" href="#" <?php else: ?> href="<?php echo U($value['url']);?>"<?php endif; ?> >
                            <i class="<?php echo ($value["icons"]); ?>"></i>
                            <span class="hidden-tablet"> <?php echo ($value["menu_name"]); ?></span>
                            <?php if((0 < count($value['child']))): ?><span class="label"><?php echo (count($value["child"])); ?></span><?php endif; ?>
                        </a>
                        <?php if((0 < count($value['child']))): ?><ul>
                            <?php if(is_array($value["child"])): foreach($value["child"] as $key=>$val): ?><li>
                                <a class="submenu" href="<?php echo U($val['url']);?>">
                                    <i class="<?php echo ($val["icons"]); ?>"></i>
                                    <span class="hidden-tablet"><?php echo ($val["menu_name"]); ?></span>
                                </a>
                            </li><?php endforeach; endif; ?>
                        </ul><?php endif; ?>
                    </li><?php endforeach; endif; ?>
                </ul>
            </div>
        </div>
        <!-- end: 主要导航栏 -->

        <!-- start: 主要内容 -->
        <div id="content" class="span10">
            <div class="row-fluid">
    <div class="box span12">
        <!--前面导航信息-->
        <div class="box-header" data-original-title="">
            <h2>
                <i class="icon-desktop"></i>
                <span class="break"></span>
            </h2>
            <div class="box-icon">
                <a title="添加" href="javascript:myTable.insert()">
                    <i class="icon-plus"></i>
                </a>
                <a id="table-refresh" title="刷新" href="#" onclick="return myTable.search();">
                    <i class="icon-refresh"></i>
                </a>
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
            <!--表格数据-->
            <table class="table table-striped table-bordered table-hover" id="showTable">
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" src="/Public/js/layer/extend/layer.ext.js"></script>
<script type="text/javascript">
    var myTable = new MeTable({
        tableId:"showTable",
        baseUrl:"<?php echo U('Article/update');?>",
        formOptions:{"enctype":"multipart/form-data"},
    },{
        "aoColumns":[
            {"data":"id", "title":"ID", "sName":"id", "edit":{"type":"hidden"}, "search":{"type":"text"}},
            {"data":"title", "sName":"title", "title":"文章标题", "edit":{"type":"text","options":{"required":1,"rangelength":"[2, 50]"}}, "search":{"type":"text"}, 'createdCell':function(td, data, rowdata, row, col){
                var str = ! empty(rowdata) ? '<a class="quick-button-small span" onclick="myTable.seeTitle(' + row + ', this)">'+data.substr(0, 5)+'...</a>': data;
                $(td).html(str);
            }},
            {"data":"content", "sName":"content","title":"文章内容", "edit":{"type":"textarea", "options":{"required":1, "rangelength":"[2,200]"}}, 'createdCell':function(td, data, rowdata, row, col){
                var str = '<a class="quick-button-small span" onclick="myTable.seeContent(' + row + ', this)"><i class="icon-comments-alt blue"></i>'+data.substr(0, 10)+'...<span class="notification green">' + data.length + '</span></a>';
                $(td).html(str);
            }},
            {"data":"img", "sName":"img", "title":"文章导图", "edit":{"type":"file", "options":{"rangelength":"[1,50]"}}, "createdCell":stringToImage},
            {"data":"status", "sName":"status","title":"状态","value":{"1":"启用", "0":"停用"}, "createdCell":statusToString, "edit":{"type":"radio","default": 1, "options":{"required":1, "number":1}}, "search":{"type":"select"}},
            {"data":"recommend", "sName":"recommend","title":"推荐","value":{"1":"推荐", "0":"不推荐"}, "createdCell":recommendToString, "edit":{"type":"radio","default": 0, "options":{"required":1, "number":1}}, "search":{"type":"select"}},
            {"data":"see_num","sName":"see_num", "title":"浏览量"},
            {"data":"comment_num","sName":"comment_num", "title":"评论量"},
            {"data":"create_time", "sName":"create_time","title":"创建时间", "createdCell":dateTimeString},
            {"data":"update_time", "sName":"update_time", "title":"修改时间", "createdCell":dateTimeString},
            {"data": null, "title":"操作", "bSortable":false, "createdCell":setOperate},
        ],
    });

    // 查看标题
    myTable.seeTitle = function(row, obj){
        var data = this.table.data()[row];
        layer.tips(data.title, obj, {tips: [3, '#78BA32']});
    };

    // 查看内容
    myTable.seeContent = function(row){
        var data = this.table.data()[row];
        var index = layer.open({
            type: 1,
            title:data.title + ' 内容详情',
            content: data.content,
            area: ['50%', '50%'],
            shadeClose:true,
            maxmin: true
        });

        if (data.content.length > 1000) layer.full(index);
    }

    // 查看图片
    myTable.seeImage = function(row) {
        var data = this.table.data()[row];
        layer.photos({
            photos: {
                "title": data.Title,    // 相册标题
                "id": 1,                // 相册id
                "start": 0,             // 初始显示的图片序号，默认0
                "data": [               //  相册包含的图片，数组格式
                    {
                        "alt": data.title,
                        "pid": data.id,     // 图片id
                        "src": data.img,    // 原图地址
                        "thumb": data.img  // 缩略图地址
                    }
                ]
            }
        });
    }
</script>
            <div class="isHide" id="data-info"></div>
        </div>
        <!-- end: 主要内容 -->
    </div>

    <!-- 隐藏的model -->
    <div class="modal hide fade" id="myModal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3>温馨提醒</h3>
        </div>
        <div class="modal-body">
            <p>Here settings can be configured...</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">取消</a>
            <a href="#" onclick="return myTable.saveData()" class="btn btn-primary">确定</a>
        </div>
    </div>

    <div class="clearfix"></div>

    <footer>
        <p>
            <span class="ms-footer">Copyright &copy; 2016.Company name All rights reserved. <a href="#">我的个人博客后台管理</a></span>
        </p>
    </footer>
</div>
</body>
</html>
<script type="text/javascript" >
    $(function(){
        // 定义标题
        var title = $("li.active a").text(),icons = $("li.active a i").attr("class");
        $("div.box-header h2").append(title).find("i").attr("class", icons);

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

        // 表单初始化
        if (myTable != undefined) myTable.init();

        // 图片上传
        FileUpload("<?php echo U(CONTROLLER_NAME.'/fileUpload');?>", '.fileUpload', undefined, 200000000);
    })
</script>