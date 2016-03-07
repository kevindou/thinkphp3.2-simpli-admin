// JavaScript Document
var host=document.domain;
$(function(){
	$.ajax({
		url:"http://www.1377.com/hyt/serverlist/serverlist.xml",
		dataType:"xml",
		timeout: 5000,
		cache:false,
		error: function(data){
			//alert(data.responseText);
			alert("读取服务器列表出错!");
		},
		success: function(xml){
			var htmlstr="";
			var constr="";
			//alert($(xml).find('num').length);
			$(xml).find("server").each(
				function(i){
					if(i<=5){
						serverindex = $(this).children("serverindex").text();
						servername = $(this).children("servername").text();
						//serverstate = $(this).children("state").text();

						htmlstr+="<li><span class=\"status\"><a href=\"http://pay.1377.com/?gid=1016\" target=\"_blank\">充值</a></span><a href=\"http://web.1377.com/nav_to_game.php?target=hyt&server_id="+serverindex+"\" target=\"_blank\">"+servername+"</a></li>"

					}
					else{
						return false;
					}
				}
			);
			$(".serlink").html(decodeURI(htmlstr));
			
		}//success
	});
	//ajax end


});
