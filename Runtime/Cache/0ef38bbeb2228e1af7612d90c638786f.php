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
                        <span class="le col_red my_name"><?php echo ($_SESSION['gt_homeUser']['username']); ?></span>
                        <a href="/index.php?m=Member&a=index" class="isLogin <?php if(MODULE_NAME == 'Member'): ?>active<?php endif; ?>">个人中心</a>
                        <a href="javascript:;" onclick="logout();">退出</a>
                    </span>
                <a href="?m=Agent&a=index&pid=1" class="<?php if(in_array(MODULE_NAME  , array('Agent', 'Game'))): ?>active<?php endif; ?>">游戏中心</a>
                <a href="/index.php?m=Pay&pitch=pay" class="col_red m_b isLogin <?php if($_GET['pitch'] == 'pay'): ?>active<?php endif; ?>">账号充值</a>
                <!--<a href="/index.php?m=Pay&a=games_pay" class="isLogin <?php if(ACTION_NAME == 'games_pay'): ?>active<?php endif; ?>">游戏充值</a>-->
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
            <h1 class="logo"><a title="死神狂潮" href="/">死神狂潮</a></h1>
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
                        <select class="int_txt" name="agentid" required="1" number="1" data-msg-required="游戏平台不能为空" date-msg-number="游戏平台必须为一个数字">
                            <option value="">请选择游戏平台</option>
                            <?php if(is_array($arrAgents)): foreach($arrAgents as $key=>$value): ?><option value="<?php echo ($value["id"]); ?>"><?php echo ($value["cn_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
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
                    <li>尊敬的：<span id="user_name" class="my_name"><?php echo ($_SESSION['gt_homeUser']['username']); ?></span></li>
                    <li class="tc">
                        <a href="?m=Member&a=index"> [用户中心] </a>
                        <a href="javascript:logout();"> [退出] </a>
                    </li>
                </ul>
            </div>

            <div class="login_but">
                <!--<a href="?m=Article&a=newCard" class="xsk">死神狂潮新手卡</a>-->
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
                官方交流群：370401248<br>
            </p>
            <a class="s_more" href="?m=About" rel="nofollow">关于我们</a>
        </div>
    </div>
</div>
    <div class="m_r">
        <?php // 定义图片地址
            $arr = array(
                array('url' => '/account/account_give_1.png', 'href' => '/?m=Article&a=detail&pid=4&id=59', 'title' => '推荐好友'),
                array('url' => '/account/account_give_2.png', 'href' => '/?m=Article&a=detail&pid=4&id=58', 'title' => '充值累计'),
                array('url' => 'img201404141520530.jpg', 'title' => '超级VIP'),
                array('url' => 'img201401151432130.jpg', 'title' => '基金活动'),
                array('url' => 'img201404291700070.jpg', 'title' => '新服活动'),
            ); ?>
        <div class="topBox clear">
            <!--轮播图片-->
            <div id="focus" class="topAd">
                <div class="conbox">
                    <?php foreach($arr as $value) : ?>
                    <a href="<?php echo (($value["href"])?($value["href"]):'#'); ?>" title="<?php echo ($value["title"]); ?>">
                        <img src="__PUBLIC__/Index/images/<?php echo ($value["url"]); ?>" width="378" height="246" alt="<?php echo ($value["title"]); ?>" />
                    </a>
                    <?php endforeach; ?>
                </div>
                <div class="switcher">
                    <a href="javascript:void(0)">0</a>
                    <a href="javascript:void(0)">1</a>
                    <a href="javascript:void(0)">2</a>
                    <a href="javascript:void(0)">3</a>
                    <a href="javascript:void(0)">4</a>
                </div>
            </div>

            <div class="topNews">
                <div id="news_Clicks" class="new_trigger">
                    <a id="news_Link" href="?m=Article&a=index&pid=1" class="fr"></a>
                    <ul class="fl clear">
                        <?php if(is_array($activity)): foreach($activity as $key=>$value): ?><li><a href="javascript:void(0)" class="n_b"><?php echo ($value["cateName"]); ?></a></li><?php endforeach; endif; ?>
                    </ul>
                </div>

                <div id="news_ShowOrHides" class="new_trigger_cnt">
                    <?php if(is_array($activity)): foreach($activity as $key=>$value): ?><ul class="new_trigger_list ccc" style="display:none">
                        <?php if(is_array($value["article"])): foreach($value["article"] as $key=>$item): ?><li>
                            <span><?php echo (date('Y-m-d',$item["createTime"])); ?></span>
                            <a  href="?m=Article&a=detail&pid=<?php echo ($item["cateId"]); ?>&id=<?php echo ($item["id"]); ?>">
                                <font color="#D52BB3"><?php echo ($item["title"]); ?></font>
                            </a>
                        </li><?php endforeach; endif; ?>
                    </ul><?php endforeach; endif; ?>
                </div>
            </div>
        </div>

        <div class="adList clear">
            <ul>
                <?php // 定义图片地址
                    $arr = array(
                        array('url' => '/account/account_xc1.png', 'href' => '/?m=Article&a=detail&pid=4&id=58', 'title' => '推荐好友'),
                        array('url' => '/account/account_xc2.png', 'href' => '/?m=Article&a=detail&pid=4&id=59', 'title' => '充值累计'),
                        array('url' => 'img201401141825030.jpg', 'title' => '死神狂潮首充大礼'),
                    ); ?>
                <?php if(is_array($arr)): foreach($arr as $key=>$value): ?><li>
                    <a href="<?php echo (($value["href"])?($value["href"]):'#'); ?>" >
                        <img src="__PUBLIC__/Index/images/<?php echo ($value["url"]); ?>" width="240" height="130" alt="<?php echo ($value["title"]); ?>" />
                    </a>
                </li><?php endforeach; endif; ?>
            </ul>
        </div>

        <div class="presentation b mt10">

            <ul class="p_tab">
				<li class="active"><span class="p1">鬼剑男</span></li>
				<li><span class="p2">鬼剑女</span></li>
				<li><span class="p3">灵刃男</span></li>
				<li><span class="p4">灵刃女</span></li>
				<li><span class="p5">鬼道男</span></li>
				<li><span class="p6">鬼道女</span></li>
			</ul>

			<!--样式修改127行到134行-->
			<div class="p_tab_con">	
				<ul>
                    <li class="jjM p_txt">
						<div class="p_name">职业: 鬼剑男</div>
						<p class="p_t">经历千年之战，是个战斗狂，喜欢使用看似无序的攻击方式。为了报答总队长的恩情而留在瀞灵庭！</p> 
						<p class="p_t">
							<b>性格：</b>热血特点：热血少年，战斗只为让敌人诚服与自己绝对的力量当中！<br />
							<b>职业特点：</b>斩术与鬼道结合的非常完美，擅长使用斩魄刀引动鬼道火焰的力量来制敌！
						</p> 
						<a class="pMore" href="?m=Article&a=detail&pid=7&id=8">查看详细</a>
					</li>
					
					
					<li class="jjF p_txt">
						<div class="p_name">职业: 鬼剑女</div>
						<p class="p_t">拥有完美的笑容，棕色皮肤，强大的鬼道的能力一开始被隐藏著，被总队长救后一直保持着感恩之心！</p> 
						<p class="p_t">
							<b>性格：</b>豪迈特点：神圣且豪迈，强大的实力却无法掌控自己狂暴的力量！<br />
							<b>职业特点：</b>斩术与鬼道结合的非常完美，擅长使用斩魄刀引动鬼道火焰的力量来制敌！
						</p> 
						<a class="pMore" href="?m=Article&a=detail&pid=7&id=8">查看详细</a>
					</li>
					
					
					<li class="mjM p_txt">
						<div class="p_name">职业: 灵刃男</div>
						<p class="p_t">灵力很强大，平时较为高傲冷淡，头脑冷静，眼光锐利。对着死神有着逆反心理，却因为总队长的恩情而加入死神队伍！</p> 
						<p class="p_t">
							<b>性格：</b>冷静特点：轻灵御姐，并可将灵子聚合成弓箭的模样杀伤敌人！<br />
							<b>职业特点：</b>高傲冷淡的外表下，拥有着无与伦比的箭术天赋！
						</p> 
						<a class="pMore" href="?m=Article&a=detail&pid=7&id=8">查看详细</a>
					</li>
					
					
					<li class="mjF p_txt">
						<div class="p_name">职业: 灵刃女</div>
						<p class="p_t">在戴着眼镜的冷静帅气的外表下，她拥有一颗燃烧的热血之心，放下了千年的仇恨加入瀞灵庭。</p> 
						<p class="p_t">
							<b>性格：</b>冷静特点：轻灵御姐，并可将灵子聚合成弓箭的模样杀伤敌人！<br />
							<b>职业特点：</b>一把灵弓灭杀千万大虚，冷静、俊朗，杀敌于千里之外。
						</p> 
						<a class="pMore" href="?m=Article&a=detail&pid=7&id=8">查看详细</a>
					</li>
					
					
					<li class="pmM p_txt">
						<div class="p_name">职业: 鬼道男</div>
						<p class="p_t">拥有忧郁的气质，冷漠的个性与强大的力量，能完美控制自己的理性，不喜欢滥杀，对总队长有着很强的忠诚心！</p> 
						<p class="p_t">
							<b>性格：</b>冷漠特点：冰冷的气息，绝对的智慧，并将智慧当做力量在战斗中使用！<br />
							<b>职业特点：</b>从破面融合死神的鬼道力量而开发出属于自身的鬼道，策略决定一切！
						</p> 
						<a class="pMore" href="?m=Article&a=detail&pid=7&id=8">查看详细</a>
					</li>
					
					<li class="pmF p_txt">
						<div class="p_name">职业: 鬼道女</div>
						<p class="p_t">可爱的萝莉，能力相当强大，但性格一直都单纯，可爱，善良，不愿杀戮。是众人最信赖的伙伴。</p> 
						<p class="p_t">
							<b>性格：</b>单纯特点：古灵精怪，用自己的智慧将对方玩弄于鼓掌<br />
							<b>职业特点：</b>从破面融合死神的鬼道力量而开发出属于自身的鬼道，策略决定一切！
						</p>
						<a class="pMore" href="?m=Article&a=detail&pid=7&id=8">查看详细</a>
					</li>
				</ul>
			</div>
        </div>
		
        <div class="mt10 clear">
            <div class="gameData b fl">
                <h3 class="l_tit r_t clear">
                    <a href="?m=Article&a=index&pid=1" class="more">更多</a>
                    <span class="gd">死神狂潮游戏资料</span>
                </h3>
                <ul class="gameList">
                    <?php if(is_array($gamedata)): foreach($gamedata as $key=>$value): ?><li>
                        <b><?php echo ($value["cateName"]); ?></b>
                        <?php if(is_array($value["article"])): foreach($value["article"] as $key=>$item): ?><a href="?m=Article&a=detail&pid=<?php echo ($item["cateId"]); ?>&id=<?php echo ($item["id"]); ?>"><?php echo ($item["title"]); ?></a><span> | </span><?php endforeach; endif; ?>
                    </li><?php endforeach; endif; ?>
                </ul>
            </div>

            <div class="raiders b fr">
                <h3 class="l_tit r_t clear"><a href="?m=Article&a=index&pid=3" class="more">更多</a><span class="gl">死神狂潮游戏攻略</span></h3>
                <ul class="new_trigger_list ccc">
                    <?php if($strategy): ?><?php if(is_array($strategy)): foreach($strategy as $key=>$value): ?><li><a  href="?m=Article&a=detail&pid=<?php echo ($value["cateId"]); ?>&id=<?php echo ($value["id"]); ?>" title="<?php echo ($value["title"]); ?>"><?php echo ($value["title"]); ?></a></li><?php endforeach; endif; ?><?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="photo b mt10">
            <h3 class="l_tit r_t clear"><a href="#youxijietu/" class="more">更多</a><span class="jt">死神狂潮游戏截图</span></h3>
            <div class="zhs_yxjt">
                <ul class="pic_list">
                    <?php $arr = array(
                            array('maxUrl' => 'img201401141503060.jpg', 'minUrl' => 'img201401141503010.jpg', 'title' => '精美截图4'),
                            array('maxUrl' => 'img201401141502310.jpg', 'minUrl' => 'img201401141502260.jpg', 'title' => '精美截图3'),
                            array('maxUrl' => 'img201401141501520.jpg', 'minUrl' => 'img201401141501450.jpg', 'title' => '精美截图2'),
                            array('maxUrl' => 'img201401141449230.jpg', 'minUrl' => 'img201401141449160.jpg', 'title' => '精美截图1'),
                        ); ?>
                    <?php if(is_array($arr)): foreach($arr as $key=>$value): ?><li>
                        <a rel="pic_list" rel="nofollow" href="__PUBLIC__/Index/images/<?php echo ($value["maxUrl"]); ?>">
                            <img src="__PUBLIC__/Index/images/<?php echo ($value["minUrl"]); ?>" width="170" height="106" alt="<?php echo ($value["title"]); ?>" />
                            <p><?php echo ($value["title"]); ?></p>
                        </a>
                    </li><?php endforeach; endif; ?>
                </ul>
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
                    <td class="label">游戏平台：</td>
                    <td>
                        <select name="agentid" required="1" number="1">
                            <option value="">请选择游戏平台</option>
                            <?php if(is_array($arrAgents)): foreach($arrAgents as $key=>$value): ?><option value="<?php echo ($value["id"]); ?>"><?php echo ($value["cn_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
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
           display:<?php if(isset($_SESSION['gt_homeUser']) && !empty($_SESSION['gt_homeUser'])): ?>block<?php else: ?>none<?php endif; ?>;
        }
        .noneLogin, .back span a.noneLogin {
            display:<?php if(!isset($_SESSION['gt_homeUser']) || empty($_SESSION['gt_homeUser'])): ?>block<?php else: ?>none<?php endif; ?>;
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
<script type="text/javascript" src="/Public/Index/js/index.js"></script>