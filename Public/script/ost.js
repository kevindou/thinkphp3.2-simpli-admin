function includeStyle(url){var style=document.createElement("link");style.type="text/css";style.setAttribute("rel","stylesheet");style.setAttribute("href",url);document.getElementsByTagName("head")[0].appendChild(style)}includeStyle("http://www.1377.com/webplat/topnav/style.css");function AddFavorite(){try{window.external.addFavorite('http://www.1377.com','1377好玩的网页游戏平台')}catch(e){try{window.sidebar.addPanel('1377好玩的网页游戏平台','http://www.1377.com','')}catch(e){alert('加入收藏失败，请使用Ctrl+D进行添加,或手动在浏览器里进行设置.')}}}function SetHome(){if(document.all){document.body.style.behavior='url(#default#homepage)';document.body.setHomePage('http://www.1377.com')}else{alert('浏览器不支持此操作, 请手动设为首页')}}

$(function(){
	var htmlstr='<div id="pub_top_bg"><div id="pub_header_warp"><div id="pub_header"><div id="pub_header_logo"><a href="http://www.1377.com" target="_blank"></a></div><div id="pub_header_nav"></div><div id="pub_header_features"><ul style="display:block"><li class="ost_fr ost_lsn ost_bg ost_total"><a href="javascript:"id="pop-AllGame">所有游戏</a><div class="ostFrame_div"><iframe width="255"height="300"src="http://www.1377.com/webplat/AllGames/index.html"scrolling="no"framemargin="0"frameborder="0"allowtransparency="true"></iframe></div></li><li class="ost_fr ost_lsn ost_fun"><a href="javascript:" onclick="AddFavorite()">收藏</a>    |   <a href="javascript:" onclick="SetHome()">设为首页</a></li><li class="ost_fr ost_lsn ost_log"><span><a href="javascript:"onclick="pop_Login.showDialog()">登录</a></span></li></ul></div></div></div></div><div id="pub-popLogin"><div class="location"><div class="input-uname"><span>账号:</span><input name="login_account"type="text"class="r-dialog-text"data-rule="username"id="pop-uname"value="账号/手机号"></div><div class="input-pwd"><span>密码:</span><input name="login_account" type="password" class="r-dialog-text" data-rule="username"id="pop-upwd"></div><div class="clear"></div><a href="javascript:void(0)"onclick="pop_Login.login()"class="submit_a"></a><a href="http://web.1377.com/member/findpass.php" target="_blank" class="forgetpass">忘记密码?</a></div><div class="ost-pop-close"onclick="pop_Login.closeDialog()">X</div></div>';
	
	if($("#ost").length==0){$strost=$("<div id=\"ost\" style=\"height:36px; width:100%\"></div>");$("body").delay(1000).prepend($strost)}$("#ost").html(htmlstr);$("#pub_header_nav").html("<ul></ul>");getJData();
		$("#pop-uname").focus(function(e) {
		if($(this).val()=="账号/手机号"){
			$(this).val("");
		}
	});
	
	$("#pop-uname").focus(function(e) {
		if($(this).val()=="账号/手机号"){
			$(this).val("");
		}
	});
	
	$("#pop-uname").blur(function(e) {
		if($(this).val()==""){
			$(this).val("账号/手机号");
		}
	});
	
	$("#pop-AllGame").mouseenter(function(e) {
		$(".ostFrame_div").show();
	});
	
	$("#pub_header_features").mouseleave(function(e) {
		$(".ostFrame_div").hide();
		
	});
	
	pop_Login.popIslogin();
	
});


var host = document.domain;
if(host == "bbs.1377.com"){
	BBS_(function(){
		if(BBS_("#ost").length==0){BBS_strost=BBS_("<div id=\"ost\" style=\"height:36px; width:100%\"></div>");BBS_("body").delay(1000).prepend(BBS_strost)}BBS_("#ost").html("<div id=\"pub_top_bg\"><div id=\"pub_header_warp\"><div id=\"pub_header\"><div id=\"pub_header_logo\"><a href=\"http://www.1377.com\" target=\"_blank\"></a></div><div id=\"pub_header_nav\"></div><div id=\"pub_header_features\"><span><a href=\"javascript:\" onclick=\"pop_Login.showDialog()\">登录</a></span> | <a href=\"http://web.1377.com/shortcut.php\" >收藏</a> &nbsp;&nbsp; | &nbsp;&nbsp;    <a href=\"javascript:\" onclick=\"setHomepage()\">设为首页</a></div></div></div>");BBS_("#pub_header_nav").html("<ul></ul>");bbs_getJData();
	});

}


var gamedata=[
    //{"gamename":"1377武易","src":"http://www.1377.com/wy","gametag":"h"},
	//{"gamename":"街机西游","src":"http://www.1377.com/xy","gametag":"n"},
	//{"gamename":"死神狂潮","src":"http://www.1377.com/bleach","gametag":"h"},
	//{"gamename":"火影疾风坛","src":"http://www.1377.com/hyt","gametag":"h"},
	//{"gamename":"热血武尊","src":"http://www.1377.com/wz","gametag":"h"},
	{"gamename":"暗夜奇迹","src":"http://www.1377.com/mu","gametag":"n"},
	//{"gamename":"奇迹MU来了","src":"http://www.1377.com/qj","gametag":"h"},
	{"gamename":"疾风英雄","src":"http://www.1377.com/hyyx","gametag":"n"}
	//{"gamename":"枪魂","src":"http://www.1377.com/qh","gametag":"h"}
	//"gamename":"妖精的尾巴","src":"http://www.1377.com/ft","gametag":"h"},
	//{"gamename":"忍界大战","src":"http://www.1377.com/hydz","gametag":"n"},
	//{"gamename":"大裁决","src":"http://www.1377.com/dcj","gametag":"n"}
	//{"gamename":"海贼无双","src":"http://www.1377.com/hzws","gametag":"n"},
	//{"gamename":"忍者疾风传","src":"http://www.1377.com/hyz","gametag":"h"},
	//{"gamename":"动漫英雄传","src":"http://www.1377.com/dmyx","gametag":"n"}
	//{"gamename":"圣杯传说","src":"http://www.1377.com/sbcs","gametag":"n"},

]

//json读取
function getJData(){
		var htmlstr = "";
	$.each(gamedata,function(i){switch(gamedata[i].gametag){case"n":htmlstr+='<li><a href=\"'+gamedata[i].src+'\" target=\"_blank\" class=\"pub_link2\">'+gamedata[i].gamename+'</a><em class=\"tl_new\">新游戏</em></li>';break;case"n_h":htmlstr+='<li><a href=\"'+gamedata[i].src+'\" target=\"_blank\" class=\"pub_link2 hotgame\">'+gamedata[i].gamename+'</a><em class=\"tl_new \">新游戏</em></li>';break;case"b":htmlstr+='<li><a href=\"'+gamedata[i].src+'\" target=\"_blank\" class=\"pub_link2\">'+gamedata[i].gamename+'</a><em class=\"tl_beta \">测试</em></li>';break;case"h":htmlstr+='<li><a href=\"'+gamedata[i].src+'\" target=\"_blank\" class=\"pub_link2\">'+gamedata[i].gamename+'</a><em class=\"tl_hot\">新游戏</em></li>';break}if(i!=(gamedata.length-1)){htmlstr+='<span>|</span>'}$('#pub_header_nav ul').html(htmlstr)});
}


function bbs_getJData(){
			var htmlstr = "";
	BBS_.each(gamedata,function(i){switch(gamedata[i].gametag){case"n":htmlstr+='<li><a href=\"'+gamedata[i].src+'\" target=\"_blank\" class=\"pub_link2\">'+gamedata[i].gamename+'</a><em class=\"tl_new\">新游戏</em></li>';break;case"n_h":htmlstr+='<li><a href=\"'+gamedata[i].src+'\" target=\"_blank\" class=\"pub_link2 hotgame\">'+gamedata[i].gamename+'</a><em class=\"tl_new \">新游戏</em></li>';break;case"b":htmlstr+='<li><a href=\"'+gamedata[i].src+'\" target=\"_blank\" class=\"pub_link2\">'+gamedata[i].gamename+'</a><em class=\"tl_beta \">测试</em></li>';break;case"h":htmlstr+='<li><a href=\"'+gamedata[i].src+'\" target=\"_blank\" class=\"pub_link2\">'+gamedata[i].gamename+'</a><em class=\"tl_hot\">新游戏</em></li>';break}if(i!=(gamedata.length-1)){htmlstr+='<span>|</span>'}BBS_('#pub_header_nav ul').html(htmlstr)});
}


var pop_Login = {
		getFail:function(failstr){
			switch(failstr){
				case "fail::1001":
				alert("账号不存在!");
				break;
			case "fail::1002":
				alert("账号或密码错误!");
				break;
			case "fail::1003":
				alert("请先登录!");
				break;
			case "fail::1004":
				alert("请确保您已在指定服务器已相同账号创建了角色");
				break;
			default:
				alert("系统错误!"+failstr);
				break;
			}
		},
		showDialog:function(){
			$("#pub-popLogin").fadeIn('fast');
		},
		login:function(){
			var $name = $("#pop-uname").val();
			var $pwd = $("#pop-upwd").val(); 
			var strurl ='http://web.1377.com/userlogin.php?username='+$name+'&passwd='+$pwd+'&act=login'
			$.getScript(strurl,function(){
				var strpri = result.split("::");		
			
				if (strpri[0] == "fail") {
					pop_Login.getFail(result);
				} else {
					$("#pub-popLogin").hide();
					$("#pub_header_features span").html('<a href="http://web.1377.com/member/home.php" target="_blank" id="pub_header_features_uname">账号：'+strpri[1]+'</a> | <a href="javascript:" onclick="pop_Login.loginOut()">注 销</a>')
					$("#pub_header_features_uname").html("账号："+strpri[1]);
				}		
			});
			 //alert("尼玛");
			if( typeof(varLogin) != "undefined"){
				varLogin.isLogin();
			}
			
		},
		loginOut:function(){
			var strurl ='http://web.1377.com/userlogin.php?act=logout';
			$.getScript(strurl,function(){
					$("#pub_header_features span").html('<a href="javascript:" onclick="pop_Login.showDialog()">登录</a></span>')
			});
			
			if( typeof(varLogin) != "undefined"){
				varLogin.loginOut();
			}

		},
		popIslogin:function(){
			var strurl ='http://web.1377.com/userlogin.php?act=online';
			$.getScript(strurl,function(){
				var strpri = result.split("::");		
				if (strpri[0]== "ok") {
					$("#pub-popLogin").hide();
					$("#pub_header_features span").html('<a href="http://web.1377.com/member/home.php?t=5" target="_blank" id="pub_header_features_uname"></a> | <a href="javascript:" onclick="pop_Login.loginOut()">注 销</a>')
					$("#pub_header_features_uname").html("账号："+strpri[1]);
				}
			})                   
		},
		showAllGame:function(){
			$(".ostFrame_div").show();	
		},
		closeDialog:function(){
			$("#pub-popLogin").hide();	
		}
}


