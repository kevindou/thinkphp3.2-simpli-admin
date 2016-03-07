// 首页js
$(function(){
    // 焦点图
    $('#focus').Xslider();
    $('#focus .switcher a').eq(0).addClass('cur');

    // 游戏新闻选项卡
    $('#news_Clicks ul li:first').addClass('active');
    $('#news_ShowOrHides ul:first').show();
    $('#news_Clicks ul li').mouseenter(function(){
        $(this).addClass('active').siblings('li').removeClass('active');
        $('#news_ShowOrHides ul:eq('+ $(this).index() +')').show().siblings().hide();
    });

    // 游戏职业
    var $_tab = $(".p_tab li");
    $_tab.eq(0).addClass("active");
    $(".p_tab_con ul li").eq(0).show().siblings().hide();
    $_tab.mouseover(function(){
        $(this).addClass("active").siblings().removeClass("active");
        var index=$(this).index();
        $(".p_tab_con ul li").eq(index).show().siblings().hide();
    })

    // 游戏资料最后多余|
    $('.gameList li').each(function(){
        $(this).find('span:last').html('');
    });

    // 查看图片
    $("a[rel=pic_list]").fancybox({
        'transitionIn'    : 'none',
        'transitionOut'    : 'none',
        'titlePosition'     : 'over',
        'titleFormat'        : function(title, currentArray, currentIndex, currentOpts) {
            return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
        }
    });
});