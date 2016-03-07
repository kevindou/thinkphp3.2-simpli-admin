$(function() {
	// User login
	$('.theme-login').click(function(){
		$('.theme-popover-mask').show();
		$('.theme-popover-mask').height($(document).height());
		$('.theme-popover').slideDown(200);
	})
	$('.theme-poptit .close').click(function(){
		$('.theme-popover-mask').hide();
		$('.theme-popover').slideUp(200);
	})
	
	
	
	// User regiest
	$('.theme-login2').click(function(){
		$('.theme-popover-mask2').show();
		$('.theme-popover-mask2').height($(document).height());
		$('.theme-popover2').slideDown(200);
	})
	$('.theme-poptit2 .close').click(function(){
		$('.theme-popover-mask2').hide();
		$('.theme-popover2').slideUp(200);
	})
	
});



function login()
{
	var usr = document.getElementById('login-name').value;
	var usrpwd = document.getElementById('login-pwd').value;
	var usrvfy = document.getElementById('login-vfy').value;
	var agent = document.getElementById('login-agent').value;
	if(!parseInt(agent)) {
		alert('请选择平台后进行登录');
		return false;
	}
	
	if(usr == '' || usrpwd == '' || usrvfy == '') {
		alert('用户名,密码或验证码不能为空');
		return false;
	}
	
	var url = '?m=Member&a=userLogin';
	var json = {'usr' : usr, 'usrpwd' : usrpwd, 'usrvfy' : usrvfy, 'agent' : agent};
	$.post(url, json, function(msg) {
		if(parseInt(msg.status)) {
			alert(msg.msg); return false;
		} 
		location.reload();
		
	}, 'json');
}



function regiest()
{
	var usr = document.getElementById('reg-name').value;
	var usrpwd = document.getElementById('reg-pwd').value;
	var usrpwd2 = document.getElementById('reg-pwd2').value;
	var usrvfy = document.getElementById('reg-vfy').value;
	var agent = document.getElementById('reg-agent').value;
	if(!parseInt(agent)) {
		alert('请选择平台后进行注册');
		return false;
	}
	
	
	if (/[\u4E00-\u9FA5]/i.test(usr)) {
		alert('用户名不能为中文');
		return false;
	}
	
	if(usr.length > 20 || usr.length < 4){
		alert('用户名长度不能超过20位或者小于4位');
		return false;
	}
		
	if(usr == '' || usrpwd == '' || usrpwd2 == '' || usrvfy == '') {
		alert('用户名,密码或验证码不能为空');
		return false;
	}
	
	if(usrpwd.length < 6) {
		alert('密码必须为6位以上');
		return false;
	}
	
	if(usrpwd != usrpwd2) {
		alert('2次密码输入不匹配');
		return false;
	}
		
	S_level=checkStrong(usrpwd); 
	if(S_level < 2){
		alert('密码必须为数字加字母.');
		return false;
	}	
	
	var url = '?m=Member&a=userRegiest';
	var json = {'usr' : usr, 'usrpwd' : usrpwd, 'usrpwd2' : usrpwd2, 'usrvfy' : usrvfy, 'agent' : agent};
	$.post(url, json, function(msg) {
		if(parseInt(msg.status)) {
			alert(msg.msg); return false;
		} 
		location.reload();
		
	}, 'json');

}


function reSet()
{
	var opass = document.getElementById('old-pass').value;
	var npass = document.getElementById('new-pass').value;
	var npass2 = document.getElementById('new-pass2').value;
	var vfy = document.getElementById('reset-vfy').value;
	
	if(opass == '' || npass == '' || npass2 == '') {
		alert('密码不能为空');
		return false;
	}
	
	if(vfy == '') {
		alert('验证码不能为空');
		return false;
	}
	
	if(npass.length < 6 || npass2.length < 6) {
		alert('新密码必须为6位以上');
		return false;
	}
	
	S_level = checkStrong(npass); 
	if(S_level < 2){
		alert('密码必须为数字加字母.');
		return false;
	}
	
	if(npass != npass2) {
		alert('2次密码输入不匹配');
		return false;
	}
	
	if(opass == npass2) {
		alert('新密码与旧密码相同,无需修改');
		return false;
	}
	
	var url = "?m=Member&a=reSet";
	var json = {'opass' : opass, 'npass' : npass, 'npass2' : npass2, 'vfy' : vfy};
	$.post(url, json, function(msg) {
		alert(msg.msg);
	}, 'json');
}


function logout()
{
	$.post('?m=Member&a=logout', function(msg) {
		window.location.href = "http://bmmigrant.gametrees.com/";
	});
}


//判断输入密码的类型  
function CharMode(iN){  
	if (iN>=48 && iN <=57) //数字  
	return 1;  
	if (iN>=65 && iN <=90) //大写  
	return 2;  
	if (iN>=97 && iN <=122) //小写  
	return 4;  
	else  
	return 8;   
}  
//bitTotal函数  
//计算密码模式  
function bitTotal(num){  
	modes=0;  
	for (i=0;i<4;i++){  
		if (num & 1) modes++;  
		num>>>=1; 
	}  
	return modes;  
}  
//返回强度级别  
function checkStrong(sPW){  
	if (sPW.length<=4)  
		return 0; //密码太短  
	Modes=0;  
	for (i=0;i<sPW.length;i++){  
		//密码模式  
		Modes|=CharMode(sPW.charCodeAt(i));  
	}
	return bitTotal(Modes);  
}  


