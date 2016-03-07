function AutoScroll(obj){
        $(obj).find("ul:first").animate({
                marginTop:"-30px"
        },500,function(){
                $(this).css({marginTop:"0px"}).find("li:first").appendTo(this);
        });
}
$(document).ready(function(){
	setInterval('AutoScroll("#top_message")',2000)
});
