$(document).ready(function(){
	$('.verify').click(function(){
		  var num =   new Date().getTime();
		  var rand = Math.round(Math.random() * 10000);
		  num = num + rand;
		  $('.verify')[0].src = "{:U('Public/verify')}";
	});
	var state = '1';
	if(state=='1')
	{
	$.dialog({
      title:'注册协议',
      content:$('#J_agreements_content').html(),
      ok:function(){
         $.dialog.tips('你已经同意了此协议,现在可以进行帐号注册 ',2);
      },
      cancel: function () {
      	history.back();
      },
      cancelVal:'我不同意',
      okVal:'我同意',
      lock:true
      });
	 }
   $('#J_agreements_btn').click(function(){
         $.dialog.tips($('#J_agreements_content').html(),'5');
   });
     $('#username').blur(function(){
    	 var $val = $(this).val();
    	     if($val==""||$val.length<5||$val.length>22)
    		 {
    		    $('#show_error_username').html("<a  style='color:red;' >用户名应由5-22位的字母、数字组成</a>");
    		 }
    	     else
    	     {
    	    	 $.ajax({
      	    	   type:'get',
      	    	   data:'u='+$val,
      	    	   dataType:'json',
      	    	   error:function(){
      	    		   $.dialog.tips('系统发生错误,请稍候重试!');
      	    	   },
      	    	   success:function(data){
      	    		   if(data.state!="1")
      	    			   {
      	    			     $('#show_error_username').html("<a  style='color:red;' >"+data.msg+"</a>");
      	    			   return false;
      	    			   }
      	    		   else
      	    			   {
      	    			     $('#show_error_username').html("<a style='color:green;' >"+data.msg+"</a>");
      	    			   }
      	    	   },
      	    	   url:'{:U("Accounts/username_check")}'
      	       })
    	     }
    	$("#password").blur(function(){
    		var $pass = $(this).val();
    		if($pass==""||$pass.length<6||$pass.length>22)
    			{
 			     $('#show_error_password').html("<a style='color:red;'>您的输入有误，请检查</a>");
 			    return false;
    			}
    		else
    			{
			     $('#show_error_password').html("<a style='color:green;'>恭喜你的密码验证通过!</a>");
    			}
    	})
     });

     $('#email').blur(function(){
    	 var $email = $(this).val();
    	 if($email!="")
         {
    	       $.ajax({
    	    	   url:'{:U("Accounts/email_check")}',
    	    	   data:'e='+$email,
    	    	   dataType:'json',
    	    	   error:function(){
    	    		   $.dialog.tips('系统发生错误,请稍候重试!');
    	    	   },
    	    	   success:function(data)
    	    	   {
    	    		   if(data.state!="1")
    	    			   {
    	  			         $('#show_error_email').html("<a style='color:red;'>"+data.msg+"</a>");
    	  			       return false;
    	    			   }
    	    		   else
    	    			   {
    	    			   $('#show_error_email').html("<a style='color:green;'>"+data.msg+"</a>");
    	    			   }
    	    	   },
    	    	   cache:false,
    	    	   type:'get'
    	       })
         }
    	 else
    		 {
			   $('#show_error_email').html("<a style='color:red;'>您的输入有误，请检查</a>");
			   return false;
    		 }
     })
	    $('#nickname').blur(function(){
    	var $nickname = $(this).val();
    	if($nickname!="")
    		{
    		  $.ajax({
    			  data:'n='+$nickname,
    			  url:'{:U("Accounts/nickname_check")}',
    			  dataType:'json',
    			  error:function(){
    				  $.dialog.tips('系统发生错误,请稍候重试');
    			  },
    			  success:function(data){
    				  if(data.state!="1")
    					  {
    					  $('#show_error_nickname').html("<a style='color:red;'>"+data.msg+"</a>");	
    					  return false;
    					  }
    				  else
    					  {
    					  $('#show_error_nickname').html("<a style='color:green;'>"+data.msg+"</a>");
    					  }
    			  }
    		  })
    		}
    	else
    		{
			  $('#show_error_nickname').html("<a style='color:red;'>请输入用户昵称</a>");
			  return false;
    		}
    });
    
    $('#true_name').blur(function(){
    	$truename = $(this).val();
    	if($truename==""||$truename.length<2||$truename.length>4)
    		{
			  $('#show_error_true_name').html("<a style='color:red;'>请输入您的真实姓名</a>");
			  return false;
    		}
    	else
    		{
    		$.ajax({
  			  data:{real:$truename},
  			  url:'{:U("Accounts/realname_check")}',
  			  type:'get',
  			  dataType:'json',
  			  cache:false,
  			  error:function(){
  				  $.dialog.tips('系统发生错误,请稍候重试');
  			  },
  			  success:function(data){
  				  if(data.state!="1")
  					  {
  					  $('#show_error_true_name').html("<a style='color:red;'>"+data.msg+"</a>");	
  					  return false;
  					  }
  				  else
  					  {
  					  $('#show_error_true_name').html("<a style='color:green;'>"+data.msg+"</a>");
  					  }
  			  }
  		  })
    		}
    });
    $('#idcard').blur(function(){
    	$idcard = $(this).val();
    	if($idcard==""||$idcard.length<15||$idcard.length>18)
    		{
			  $('#show_error_idcard').html("<a style='color:red;'>请输入您的身份证号码! </a>");
			  return false;
    		}
    	else
    		{
    		$.ajax({
  			  data:'id='+$idcard,
  			  url:'{:U("Accounts/idcard_check")}',
  			  dataType:'json',
  			  error:function(){
  				  $.dialog.tips('系统发生错误,请稍候重试');
  			  },
  			  success:function(data){
  				  if(data.state!="1")
  					  {
  					  $('#show_error_idcard').html("<a style='color:red;'>"+data.msg+"</a>");	
  					return false;
  					  }
  				  else
  					  {
  					  $('#show_error_idcard').html("<a style='color:green;'>"+data.msg+"</a>");
  					  }
  			  }
  		  })
    		}
    });



    $('#reg_form').submit(function(){
    	var $username = $('#username').val();
    	var $password = $('#password').val();
    	var $email = $('#email').val();
    	var $nickname = $('#nickname').val();
    	var $true_name = $('#true_name').val();
    	var $idcard = $('#idcard').val();
    	var $verify_code = $('#verify_code').val();
    	if($username.length<5||$username.length>20||$password.leng<6||$password.length>22||$username==""||$password==""||$email=="")
    	{
    		$.dialog.alert('请填写完整您的注册信息再进行提交!');
    		return false;
    	}
    })
})