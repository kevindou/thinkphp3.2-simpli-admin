<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>【死神狂潮官网】- 死神Web</title>
    <meta name="description" content="" />
    <!--加载css-->
    <?php if(in_array(MODULE_NAME, array('Index', 'Article'))): ?><link rel="stylesheet" type="text/css" href="__PUBLIC__/Index/css/common.css" /><?php endif; ?>

    <link rel="stylesheet" href="__PUBLIC__/Index/css/footer.css" type="text/css" />
    <?php if(!in_array(MODULE_NAME, array('Index', 'Article'))): ?><link rel="stylesheet" href="__PUBLIC__/Index/css/top.css" type="text/css" /><?php endif; ?>

    <link rel="stylesheet" type="text/css" href="__PUBLIC__/Index/css/jquery.fancybox-1.3.4.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/dialog-default.css"/>
    <script src="__PUBLIC__/js/jquery-1.8.3.min.js"></script>
    <script src="__PUBLIC__/js/jquery.cookie.js"></script>
</head>
<body>
    <!--悬浮窗口-->
    <div class="nav_header">
        <div class="nav_content">
            <div class="menu le">
                <span class="le col_red m_b">网页导航：</span>
                <a href="/" >首页</a>
                <a href="?m=Article&a=index&pid=1">新闻公告</a>
                <a href="?m=Article&a=index&pid=2">游戏资料</a>
                <a href="?m=Article&a=index&pid=3">游戏攻略</a>
                <a href="" >游戏论坛</a>
                <a href="?m=About" <?php if(MODULE_NAME == 'About'): ?>class="active"<?php endif; ?> >关于我们</a>
            </div>
            <div class="menu re">
                    <span class="le noneLogin">
                        <a href="javascript:;" class="isLogin">登录</a>
                        <a href="javascript:;" class="user_register">注册</a>
                    </span>
                    <span class="le haveLogin">
                        <span class="le">欢迎回来:</span>
                        <span class="le col_red my_name"><?php echo ($_SESSION['gt_uname']); ?></span>
                        <a href="/index.php?m=Member&a=index" class="isLogin <?php if(MODULE_NAME == 'Member'): ?>active<?php endif; ?>">个人中心</a>
                        <a href="javascript:;" onclick="logout();">退出</a>
                    </span>
                <a href="?m=Agent&a=index&pid=1" class="<?php if(in_array(MODULE_NAME  , array('Agent', 'Game'))): ?>active<?php endif; ?>">游戏中心</a>
                <a href="/index.php?m=Pay&pitch=pay" class="col_red m_b isLogin <?php if($_GET['pitch'] == 'pay'): ?>active<?php endif; ?>">账号充值</a>
            </div>
        </div>
    </div>
    <div class="nav_fixed"></div>

    <?php if(in_array(MODULE_NAME, array('Index', 'Article'))): ?><!--首页导航-->
    <div class="hread">
        <div class="top_nva">
            <a class="nav_a" rel="nofollow" href="/">死神狂潮</a>
            <a class="nav_b" href="?m=Article&a=index&pid=1">新闻公告</a>
            <a class="nav_c" href="?m=Article&a=index&pid=2">游戏资料</a>
            <h1 class="logo"><a title="死神狂潮" href="?m=Agent&a=index&pid=3">死神狂潮</a></h1>
            <a class="nav_d" href="?m=Article&a=index&pid=3">死神狂潮攻略</a>
            <a class="nav_e" href="#">死神狂潮论坛</a>
            <a class="nav_f" rel="nofollow" href="?m=About">联系我们</a>
        </div>
        <div class="h_bj">
            <div class="hot_ser">
                <div class="hot_sBox" id="newGames">
                    <?php if(!empty($arrRecommend)): ?><a target="_blank" class="isLogin" href="?m=Server&aid=<?php echo ($arrRecommend[0]["agentid"]); ?>&server_id=<?php echo ($arrRecommend[0]["id"]); ?>"><?php echo ($arrRecommend[0]["serverName"]); ?> 火爆</a>
                    <strong>12-20 10:00开启</strong><?php endif; ?>
                </div>
            </div>
        </div>
    </div><?php endif; ?>
<link href="/Public/Index/css/list.css" rel="stylesheet" type="text/css" />
<div class="warp">
    <div class="content">
        <div class="head1 rel">
            <div class="nbnj">
                <h1><a href="/">死神狂潮</a></h1>
            </div>
            <div class="btn_box1 abs">
                <a href="/" class="btn_xztb">下载桌面图标</a>
                <a href="javascript:addBookmark('http://bmmigrant.gametrees.com/index.php?m=Agent&a=index&pid=1','死神狂潮官网-服务器列表');" class="btn_sc tc">收藏本页</a>
            </div>
        </div>
        <div class="head2">
            <div class="back b">
                <span>
                    <label class="le">
                        <a href="/index.php?m=Agent&a=index&pid=1" class="fhgw1">平台列表</a>
                    </label>
                    <a href="javascript:;" class="isLogin noneLogin" >登&nbsp;&nbsp;录</a>
                    <a href="javascript:;" class="user_register noneLogin">注&nbsp;&nbsp;册</a>
                    <label class="le">
                        <a href="?m=Pay&pitch=pay" class="isLogin" target="_blank">充值中心</a>
                        <a href="/" class="fhgw">返回官网</a>
                    </label>
                </span>
            </div>
            <div class="box">
<div class="left">
    <div class="lbg">
        <div class="but">
            <a href="?m=Article&a=index&pid=3" class="but1">死神狂潮攻略</a>
            <a href="#" class="but2">死神狂潮论坛</a>
        </div>
        <div class="gg_box">
            <div class="gg">
                <a href="#">
                    <img src="/Public/Index/images/img201412192123090.jpg" width="140" height="170"/>
                </a>
                <a href="?m=Article&a=index&pid=6">
                    <img src="/Public/Index/images/img201401141826520.jpg" width="140" height="170"/>
                </a>
            </div>
        </div>
        <p>
            <span>抵制不良游戏</span>
            <span>拒绝盗版游戏</span>
            <span>注意自我保护</span>
            <span>谨防受骗上当</span>
        </p>
        <p>
            <span>适度游戏益脑</span>
            <span>沉迷游戏伤身</span>
            <span>合理安排时间</span>
            <span>享受健康生活</span>
        </p>
    </div>
</div>
<div class="right">
    <div class="rbg">
        <div class="tj">
            <div class="login">
                <span class="tjfwq">推荐服务器</span>
                <div class="dlh tr xs haveLogin" id="regLogTab1">
                    <span id="username"></span>
                    欢迎您登录死神WEB平台!
                    <a href="javascript:logout();">退出</a>
                </div>
            </div>
            <div class="tjbg">
                <div class="hot">
                    <div class="hot1 b">
                        <?php if(!empty($recommend)): ?><a  href="?m=Server&aid=<?php echo ($recommend["agentid"]); ?>&server_id=<?php echo ($recommend["id"]); ?>"  target="_blank" class="hot">
                            <?php echo (date("m-d H:i",$recommend["open_time"])); ?> <?php echo ($recommend["serverName"]); ?>
                            <span>火爆</span>
                        </a><?php endif; ?>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="mine">
            <div class="search"> <span>我的服务器</span>
                <ul>
                    <li>输入服务器：</li>
                    <li class="i_s"><input type="text" id="leftServer" value="127" class="login_inpt"/></li>
                    <li><a href="javascript:;" id="login_games">进入</a></li>
                </ul>
            </div>
            <div class="s">
                <ul class="lbox clearfix" id="last_game_info">
                    <?php if(is_array($islastServer)): $k = 0; $__LIST__ = $islastServer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="i">
                            <a  href="?m=Server&aid=<?php echo ($vo["agentid"]); ?>&server_id=<?php echo ($vo["id"]); ?>" target="_blank" class="isLogin">
                                <i></i><?php echo ($vo["serverName"]); ?>
                            </a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
        <div class="all">
            <div class="state">
                <span>所有服务器</span>
                <label>
                    <img src="/Public/Index/images/f.png" width="11" height="11" /> 畅通
                    <img src="/Public/Index/images/c.png" width="11" height="11" /> 拥挤
                    <img src="/Public/Index/images/h.png" width="11" height="11" /> 繁忙
                    <img src="/Public/Index/images/m.png" width="11" height="11" /> 维护
                </label>
            </div>
            <div class="fw_tab">
                <ul class="tab_list" id="server_ban">
                </ul>
            </div>
            <div class="alllist" id="server_all">
                <ul class="lbox">
                    <?php if(is_array($all_server)): $k = 0; $__LIST__ = $all_server;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="i">
                            <a class="loginGames_<?php echo ($vo["id"]); ?> isLogin" target="_blank" href="?m=Server&aid=<?php echo ($vo["agentid"]); ?>&server_id=<?php echo ($vo["id"]); ?>">
                                <i></i><?php echo ($vo["serverName"]); ?>
                            </a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
        <div class="list_f"></div>
    </div>
</div>
    <div id="m_artdialog">
    <form class="regform">
        <table class="u_register">
            <tr>
                <td class="label">游戏平台：</td>
                <td>
                    <select name="agentid" required="1">
                        <option value="">请选择游戏平台</option>
                        <?php if(is_array($arrAgents)): foreach($arrAgents as $key=>$value): ?><option value="<?php echo ($value["id"]); ?>"><?php echo ($value["cn_name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">用户名：</td>
                <td>
                   <input type="text" name="username" class="text" required="1" rangelength="[4, 20]"/>
                </td>
            </tr>
            <tr>
                <td class="label">密码：</td>
                <td>
                    <input type="password" name="password" class="text" required="1" rangelength="[5, 20]" checkPass="true" />
                </td>
            </tr>
            <tr>
                <td class="label">确认密码：</td>
                <td>
                    <input type="password" name="truepass" class="text" required="1" rangelength="[5, 20]" checkPass="true" equalTo="input[name=password]:first" />
                </td>
            </tr>
            <tr>
                <td class="label">验证码：</td>
                <td class="verify_img">
                    <img id="reg_verify" src="?m=Index&a=verify" onclick="this.src='?m=Index&a=verify&rdm='+Math.random()"  title="点击刷新验证码" class="checkcode" />
                    <input type="text" name="verify" class="text verify" required="true" number="true" minlength="5" maxlength="5" />
                    <label class="h_error"></label>
                </td>
            </tr>
        </table>
    </form>
    </div>
    <div id="m_artLogin">
        <form class="mLogin">
            <table class="u_register u_login">
                <tr>
                    <td class="label">用户名：</td>
                    <td>
                        <input type="text" name="username" class="text" rangelength="[2,25]" required="1" data-msg-required="需要输入登录用户名" data-msg-rangelength="用户名不能小于4位或者大于20位" />
                    </td>
                </tr>
                <tr>
                    <td class="label">密码：</td>
                    <td>
                        <input type="password" name="password" class="text" rangelength="[2,25]" required="1" data-msg-required="需要输入登录密码" data-msg-rangelength="登录密码不能小于5位或者大于20位"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">验证码：</td>
                    <td class="verify_img">
                        <img src="?m=Index&a=verify" onclick="this.src='?m=Index&a=verify&rdm='+Math.random()"  title="点击刷新验证码" class="checkcode" />
                        <input type="text" name="verify" class="text verify mverify" minlength="5"  maxlength="5" required="1" number="true" data-msg-required="验证码不能为空" data-msg-minlength="验证码最小为5位"/>
                        <label class="h_error"></label>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="cle m_h_28"></div>
    <div id="pfoot_91">
        <div class="pwarning">
            <div class="pyouth">
                <div class="pcont">
                    <div class="pytxt pti9">健康游戏中告：抵制不良游戏，拒绝盗版游戏。注意自我保护，谨防受骗上当。适度游戏益脑，沉迷游戏伤身。合理安排时间，享受健康生活！</div>
                </div>
            </div>
            <div class="pbottom">
                <div class="pcont">
                    <ul>
                        <li>
                            <a href="/" rel="nofollow" >首页</a>
                            <em>|</em>
                            <a href="/index.php?m=Article&pid=1" rel="nofollow">新闻公告</a>
                            <em>|</em>
                            <a href="/index.php?m=Article&pid=2"  rel="nofollow">游戏资料</a>
                            <em>|</em>
                            <a href="/index.php?m=Article&pid=3"  rel="nofollow">游戏攻略</a>
                            <em>|</em>
                            <a href="?m=About" rel="nofollow">联系我们</a>
                            <em>|</em>
                            <a href="?m=Jobs">招贤纳士</a>
                        </li>
                    </ul>
                    <p class="pclear">
                        <a href="/">死神狂潮</a>
                        软著登字第0610770号 沪新出科教[2013]614号
                        <a href="http://www.miitbeian.gov.cn" target="_blank" rel="nofollow">沪ICP备09070928号</a>
                        <br />
                        文化部网络游戏举报网站：
                        <a href="http://www.12318.gov.cn/" target="_blank" rel="nofollow">http://www.12318.gov.cn</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div style="display:none"></div>
    <style type="text/css">
        .haveLogin {
           display:<?php if(!empty($_SESSION['gt_uname'])): ?>block<?php else: ?>none<?php endif; ?>;
        }
        .noneLogin, .back span a.noneLogin {
            display:<?php if(empty($_SESSION['gt_uname'])): ?>block<?php else: ?>none<?php endif; ?>;
        }
    </style>

    <!--加载js-->
    <script type="text/javascript" src="__PUBLIC__/Index/js/jquery.fancybox.js"></script>
    <script type="text/javascript" src="__PUBLIC__/Index/js/jquery.Xslider.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/validate.message.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/artDialog.js"></script>
    <script type="text/javascript" src="__PUBLIC__/Index/js/common.js"></script>
</body>
</html>
<script type="text/javascript" src="/Public/Index/js/jquery.pages.js"></script>
<script type="text/javascript">
    $(function(){
        $("#server_all").pages('li', {
            size:35,class_on:'tab_item',page_event:'hover'
        }, "#server_ban", function(c, l, s){
            var str = '', r, x, y;
            for (var i = 1; i <= c; i ++) {
                r = $.fn.pages.prototype.get_range(i, c, s);
                x = $("#server_all li a"+r[1]+":first").attr('href');
                x = x.substr(x.indexOf('server_id=') + 10);
                y = $("#server_all li a"+r[1]+":last").attr('href');
                y = y.substr(y.indexOf('server_id=') + 10);
                str += '<li><a href="javascript:void(0)" class="pm_a" pages_number="'+i+'" style="cursor:pointer;">'+x+'-'+y+'服</a></li>';
            }
            return str;
        });
    })
</script>