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
<link href="__PUBLIC__/Index/css/pay.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__PUBLIC__/Index/js/jquery.pagination.js"></script>
<script type="text/javascript" src="__PUBLIC__/Index/js/pay.js"></script>
<div class="jobsbody">
	<form id="payForm" name="payForm" target="_blank" method="post" action="?m=Pay&a=begin_pay">
		<div id="neiye-layout">
			<div id="neiye_pay_left">
				<div id="neiye_pay_left_list">
					<div id="neiye_pay_left_list_t"></div>
					<div id="neiye_pay_left_list_c">
						<ul>
							<li>
								<a id="opt_alipay" class="paytype curent">
								<span class="name"><em></em><i>支付宝</i></span></a>
							</li>
						</ul>
					</div>
				</div>
				<div id="neiye_pay_left_infor">
					<div id="payboxtop"></div>
					<div id="neiye_pay_left_infor_t">
						<div class="paytitle">
							<span class="title">您当前选择的是“<strong id="pay_type_name">支付宝</strong>”的充值方式</span>
						</div>
					</div>
					<div id="neiye_pay_left_infor_c">
						<div class="neiye_pay_left_infor_c_1" style="">
							<div class="neiye_pay_left_infor_c_1_c" id="div_game" >
								<ul>
									<li>
										<!-- 标题 -->
										<span class="name">请选择平台：</span> 
										<span class="select_game">
											<div id="gameSet">
												<a href="javascript:void(0);" onclick="open_all_game_data1()">选择平台</a>
												<b onclick="open_all_game_data1()"></b> 
												<span id="msg_for_game"></span>
											</div>
										</span>
											
										<!-- 游戏列表  -->
										<div id="cz_select_game" class="m-hide">
											<div class="cz_sg_nav">
												<ul class="win_game_nav">
													<li class="no_2 on" id="no_2"><a href="javascript:void(0);" class="t2">网页游戏</a></li>
												</ul>
												<span onclick="close_all_game_data1()">
                                                    <img src="__PUBLIC__/Index/images/closed.gif" />
                                                </span>
											</div>

											<!--全部的游戏-->
											<div id="nlist2" style="opacity: 1;">
												<ul class="all_game_data" id="all_game_data">
													<!---->
													<?php if(is_array($games)): $i = 0; $__LIST__ = $games;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$game): $mod = ($i % 2 );++$i;?><li id="jt" onclick="focusserver('<?php echo ($game["gamename"]); ?>','<?php echo ($game["gid"]); ?>','<?php echo ($game["payto"]); ?>')"><?php echo ($game["gamename"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
												</ul>
											</div>
										</div>
									</li>
									<li id="div_server"><span class="name">请选择服务器：</span> 
										<span class="select_game">
											<div id="qfSet">
												<a href="#" class="isLogin" onclick="open_all_sever_data2()">选择区服</a>
                                                <b onclick="open_all_sever_data2()"></b>
											</div>
										</span>

										<div id="cz_select_server" class="m-hide">
											<h3>
												<span onclick="close_all_sever_data2()"><img src="__PUBLIC__/Index/images/closed.gif"></span><a href="javascript:void(0);">请选择服务器</a>
											</h3>
											<div class="cz_sega_boxa">
												<ul id="server_id1" class="all_servers"></ul>
											</div>
											<div id="Pagination" class="pagination"></div>
										</div>

									</li>
								</ul>
							</div>
						</div>

						<div class="neiye_pay_left_infor_c_1" style="">
							<div class="neiye_pay_left_infor_c_1_c">
								<ul id="czzhbox">
                                    <li style="text-indent:30px; color:orange">温馨提醒：需要填写正确的游戏UID账号,而不是登录账号哦!</li>
									<li id="czzh1" style="">
										<span id="cz_zh" class="name">充值游戏UID帐号:</span>
                                        <span class="zh">
                                            <input type="text"  name="suid" id="suid" value="<?php echo ($_SESSION['gt_homeUser']['suid']); ?>" />
                                        </span>
										<em id="zhts1"></em>
                                    </li>
									<li id="czzh2" style="">
                                        <span id="qrcz_zh" class="name isLogin">确认游戏UID帐号:</span>
                                        <span class="zh">
                                            <input name="re_suid" type="text" id="re_suid" value="<?php echo ($_SESSION['gt_homeUser']['suid']); ?>" />
                                        </span>
                                        <em id="zhts2"></em>
                                    </li>
									<div class="clear"></div>
								</ul>
							</div>
						</div>

						<div class="neiye_pay_left_infor_c_1 jebox" style="">
							<div class="neiye_pay_left_infor_c_1_c">
								<ul>
									<li>
										<span class="jename">充值金额：</span>
										<span id="je_set" class="select_game">
                                            <em><label><input type="radio" value="10" name="pay_amount">10元</label></em>
											<em><label><input type="radio" value="30" name="pay_amount">30元</label></em>
											<em><label><input type="radio" value="50"  name="pay_amount">50元</label></em>
											<em><label><input type="radio" value="100"  name="pay_amount" checked="checked">100元</label></em>
											<em><label><input type="radio" value="200"  name="pay_amount">200元</label></em>
											<em><label><input type="radio" value="300"  name="pay_amount">300元</label></em>
											<em><label><input type="radio" value="500"  name="pay_amount">500元</label></em>
											<em><label><input type="radio" value="1000"  name="pay_amount">1000元</label></em>
											<em><label><input type="radio" value="5000"  name="pay_amount">5000元</label></em>
											<em class="otherje">
                                                <label><b><input type="radio" value="0" name="pay_amount">其他</b></label>
                                                <span><input type="text" name="pay_money" id="text_money" range="[5, 5000]" /></span>
                                                <i>请输入(5-5000)之间的整数</i>
                                            </em>
                                        </span>
									</li>
									<li id="ylsuname" class="ylhs">
                                        您将获得：<font id="dyyl">1000</font> 金币 　
                                        <span style="color: red;"> * 兑换比例为1元=20金币</span>
                                    </li>
								</ul>
							</div>
						</div>
							
						<!-- 提交支付  -->
						<div class="neiye_pay_left_infor_c_2" id="tjanniu" style="">
							<div class="pay">
                                <a href="#" id="tjButton" class="tjBtn">提交</a>
							</div>
						</div>
					</div>
					<div id="neiye_pay_left_infor_f"></div>
					<div id="wxts">
						<div class="tstop"></div>
						<div class="tscon">
                            <h1>温馨提示：</h1>
                            <p>支付宝说明：</p>
                            <p>1、支付宝余额支付：只要您的支付宝账户中存有余额，就可以为游戏进行充值。</p>
                            <p>2、银行卡支付：只要您拥有与支付宝公司合作银行中的任意一张银行卡，并开通“网上银行”服务，即可完成充值。</p>
                            <p>3、如果您用信用卡支付，请确认该信用卡的网上交易限额大于等于您的充值金额；</p>
                        </div>
						<div class="tsbottom"></div>
					</div>
				</div>
            </div>
		</div>
		<div id="tj"></div>

        <!--表单需要提交的信息-->
        <input type="hidden" name="server_id" id="server_id" />
        <input type="hidden" name="game_id" id="game_id" />
	</form>
</div>
<div id="m_pay" class="m-hide">
    <table class="m_table">
        <tr>
            <td class="label">支付方式：</td>
            <td class="col_red">支付宝</td>
        </tr>
        <tr>
            <td class="label">游戏平台：</td>
            <td class="cz_gid"></td>
        </tr>
        <tr>
            <td class="label">游戏服务器：</td>
            <td class="cz_sid"></td>
        </tr>
        <tr>
            <td class="label">游戏UID账号：</td>
            <td class="cz_uid"></td>
        </tr>
        <tr>
            <td class="label">游戏角色名：</td>
            <td class="cz_username"></td>
        </tr>
        <tr>
            <td class="label">充值金额：</td>
            <td class="cz_money"></td>
        </tr>
        <tr>
            <td class="label">获得金币：</td>
            <td class="cz_gold"></td>
        </tr>
    </table>
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