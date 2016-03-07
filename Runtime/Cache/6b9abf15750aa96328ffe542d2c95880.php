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
<div class="main clear">
    <div class="m_l">
        <div class="m_l">
    <div class="start">
        <a href="?m=Agent&a=index&pid=1" class="start ht">开始游戏</a>
    </div>
    <div class="signIn">
        <div class="signBox">
            <div id="userlogin" class="noneLogin">
                <div class="clear">
                    <form name="login" id="login">
                        <a class="in_sub ht" href="javascript:;" id="user_login">登录</a>
                        <input type="text" name="username" id="login_user"  placeholder="请输入用户名"  class="in_txt" rangelength="[2,25]" required="1" data-msg-required="需要输入登录用户名" data-msg-rangelength="用户名不能小于4位或者大于20位" />
                        <input type="password" name="password" id="login_pwd"   placeholder="请输入密码" class="in_txt" rangelength="[2,25]" required="1" data-msg-required="需要输入登录密码" data-msg-rangelength="登录密码不能小于5位或者大于20位" />
                        <input type="text" name="verify"   id="login-vfy" placeholder="请输入验证码" size="5" minlength="5"  maxlength="5" class="in_txt" required="1" number="true" data-msg-required="验证码不能为空" data-msg-minlength="验证码最小为5位"/>
                        <img id="login-verifyImg" src="?m=Index&a=verify" onclick="this.src='?m=Index&a=verify&rdm='+Math.random()" style="width:69px;height:25px;margin:5px 0 0 3px;" title="点击刷新验证码" />
                    </form>
                    <div id="login_error"></div>
                    <label class="h_error"></label>
                </div>
                <div class="login_txt">
                    <a href="javascript:;" class="user_register">立即注册新用户</a>
                </div>
            </div>
            <div id="isLogin" class="siginBox haveLogin" >
                <ul class="user_info">
                    <li>欢迎登录：</li>
                    <li>尊敬的：<span id="user_name" class="my_name"><?php echo ($_SESSION['gt_uname']); ?></span></li>
                    <li class="tc">
                        <a href="?m=Member&a=index"> [用户中心] </a>
                        <a href="javascript:logout();"> [退出] </a>
                    </li>
                </ul>
            </div>

            <div class="login_but">
                <a href="?m=Article&a=newCard" class="xsk">死神狂潮新手卡</a>
                <a href="?m=Pay&pitch=pay" class="zc isLogin">游戏充值</a>
            </div>
        </div>
    </div>

    <div class="server mt10 b">
        <h3 class="l_tit">推荐服务器
            <div class="t_s">
                <a href="javascript:;"  class="s_s fr ht " id="login_games">进入</a>
                <input id="leftServer" type="text" value="" class="s_t fl" />
            </div>
        </h3>
        <div class="zhs_fwq">
            <ul class="serverList">
                <?php if(is_array($arrRecommend)): $k = 0; $__LIST__ = $arrRecommend;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="<?php if($k%2 == 1): ?>bj<?php endif; ?>">
                    <span>火爆</span>
                    <a target="_blank" class="loginGames_<?php echo ($vo["id"]); ?> isLogin" sid="<?php echo ($vo["id"]); ?>" href="?m=Server&aid=<?php echo ($vo["agentid"]); ?>&server_id=<?php echo ($vo["id"]); ?>"><?php echo ($vo["serverName"]); ?></a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <a class="s_more seeAll" href="<?php if(!empty($_SESSION['gt_uname'])): ?>?m=Game&a=index&pid=1&aid=<?php echo ($_SESSION['gt_aid']); ?><?php else: ?>?m=Agent&a=index&pid=1<?php endif; ?>">查看全部服务器</a>
        </div>
    </div>

    <div class="about mt10 b">
        <h3 class="l_tit">游戏介绍</h3>
        <p>
            《死神狂潮》是一款在死神的世界中努力成长为最强死神的横版通关类RPG游戏，可以通过游戏中特色的活动来不断的提升自己的能力，竟而挑战难度更高的敌人，成为死神狂潮中最强的人物。
            <a href="?m=Agent&a=index&pid=1" class="red">立即体验&gt;&gt;</a>
        </p>
    </div>

    <div class="client mt10 b">
        <h3 class="l_tit">客服中心</h3>
        <div class="zhs_fwq">
            <p class="client_list">
                充值客服QQ：<a href="tencent://message/?uin=33861362">33861362</a><br>
                官方交流群： 370401248<br>
            </p>
            <!--<a class="s_more" href="#" rel="nofollow">进入客服中心</a>-->
            <a class="s_more" href="?m=About" rel="nofollow">关于我们</a>
        </div>
    </div>
</div>
    </div>
    <div class="m_r">
        <div class="titile">
            <div class="where">
                <span>您现在所在的位置：</span>
                <span> 死神WEB平台 </span>
                <a href="/">平台首页</a>
                <?php if(!empty($arrCate)): ?><?php if(is_array($arrCate)): foreach($arrCate as $key=>$value): ?><span> &gt; </span>
                        <a href="?m=Article&index&pid=<?php echo ($value["id"]); ?>"><?php echo ($value["cateName"]); ?></a><?php endforeach; endif; ?><?php endif; ?>
            </div>
            <h3 class="inT">死神狂潮游戏活动</h3>
        </div>
        <div class="inside b">
            <div class="inbox">
                <div class="inside_tab">
                    <?php if($arrChild): ?><ul>
                        <?php if(is_array($arrChild)): foreach($arrChild as $key=>$value): ?><li <?php if($intPid == $value['id']): ?>class="active"<?php endif; ?>><a href="?m=Article&a=index&pid=<?php echo ($value["id"]); ?>"><?php echo ($value["cateName"]); ?></a></li><?php endforeach; endif; ?>
                    </ul><?php endif; ?>
                </div>
                <?php if($arrArticle): ?><ul class="newList">
                    <?php if(is_array($arrArticle)): foreach($arrArticle as $key=>$value): ?><li><span><?php echo (date('Y-m-d',$value["createTime"])); ?></span><a href="?m=Article&a=detail&pid=<?php echo ($value["cateId"]); ?>&id=<?php echo ($value["id"]); ?>"><?php echo ($value["title"]); ?></a></li><?php endforeach; endif; ?>
                </ul><?php endif; ?>
                <div class="pagination page">
                    <?php echo ($strPage); ?>
                </div>
            </div>
        </div>
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