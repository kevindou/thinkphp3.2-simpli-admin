document.writeln("<div class=\"box\" id=\"53kf\" style=\"top:70px;right:30px;position:absolute;width:109px;height:122px;\"><a href=\"http://www.1377.com/kf.html\" target=\"_blank\"><img src=\"http://www.1377.com/hyt/images/kf.gif\"/></a></div>");
var id=function(o){return document.getElementById(o)}
var scroll=function (o){
	var space=id(o).offsetTop;
	id(o).style.top=space+'px';
	void function(){
			var goTo = 0;
			var roll=setInterval(function(){
				var height =document.documentElement.scrollTop+document.body.scrollTop+space;
				var top = parseInt(id(o).style.top);
				if(height!= top){
					goTo = height-parseInt((height - top)*0.9);
					id(o).style.top=goTo+'px';
				}
				//else{if(roll) clearInterval(roll);}
			},20);
	}()
}

scroll('53kf');