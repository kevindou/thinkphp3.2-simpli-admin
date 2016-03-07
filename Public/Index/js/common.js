// 添加收藏夹
function addBookmark(url,title){
    url = url || window.location.href;;
    title = title || document.title;
    if (window.sidebar) {
        window.sidebar.addPanel(title, url,"");
    } else if( document.all ) {
        window.external.AddFavorite( url, title);
    } else {
        alert('加入收藏失败，请使用 Ctrl+D 进行添加');
        return true;
    }
}

// 验证密码是否符合格式()
function checkPass(value)
{
    return /\d/.test(value) && /[a-z|A-Z]/.test(value);
}

// 成功执行函数
function success(msg, fun)
{
    art.dialog({
        width:300,
        height:100,
        title:'温馨提醒',
        content:msg,
        icon: 'succeed',
        lock:true,
        okVal:'确定',
        ok:function(){},
        close:fun,
    });
}

// 失败执行函数
function warning(msg, time)
{
    if (time == undefined) time = 1;
    art.dialog({
        width:250,
        height:100,
        title:'温馨提醒',
        content:'<span style="font-weight:bold">'+msg+'</span>',
        icon:'warning',
        okVal:'确定',
        time:1,
        //lock:true,
        ok:function(){},
    });
}

// 询问弹框
function quest(title, content, val, success)
{
    return art.dialog({
        width:250,
        height:100,
        title:title,
        content:'<span style="font-weight:bold">'+content+'</span>',
        icon:'question',
        okVal:val,
        ok:success,
        cancelValue: '取消',
        cancel: function(){}
    });
}

// 打开窗口
function artOpen(title, content, val, fun)
{
    return art.dialog({
        title: '<span style="font-weight:bold;color:green">' + title + '</span>',
        content: content,
        resize:true,
        okVal:val,
        ok:fun,
        cancelValue: '取消',
        cancel: function () {}
    }).show();
}

// 验证用户是否已经登录
function isLogin()
{
    var username = $.cookie('gt_user');
    if (username != undefined && username != '')
    {
        return username;
    }

    return false;
}

// 登录AJAX请求
function loginAjax(data, fun)
{
    var login_ing = art.dialog({
        title:'<span style="color:green">正在登录中...</span>',
        width:'auto',
        height:'auot',
        lock:true,
        fixed:false,
    }).show();

    // ajax提交数据
    $.ajax({
        url:'?m=Member&a=userLogin',
        type:'post',
        data:data,
        dataType:'json',
        success:function(json)
        {
            login_ing.close();
            if (json.status == 1)
            {
                $('.seeAll').attr('href', '?m=Game&a=index&pid=1&aid='+json.data.agentid);
                fun();
                return false;
            }

            $('.h_error:first').html(json.info);
        },
        error:function(){
            login_ing.close();
            $('.h_error:first').html('服务器繁忙,请稍后再试...')
        }
    })
}

// 判断用户登录
function isLoginShow()
{
    var u_login = artOpen('用户登录', $('#m_artLogin').html(), '立即登录', function(){
        if ($('.mLogin:first').validate().form())
        {
            loginAjax($('.mLogin:first').serialize(), function(){
                u_login.close();
                success('登录成功', function(){
                    user_login();
                });
            });
        }

        return false;
    });
}

// 判断用户是否已经登录，弹框提醒
function isLoginAlter()
{
    if (!isLogin())
    {
        isLoginShow();
        return false;
    }

    return true;
}

// 用户登录判断
function user_login()
{
    $('.h_error').html('');
    var username = isLogin();
    if(username)
    {
        $('.noneLogin').hide();
        $('.haveLogin').show();
        $('.my_name').html(username);
    }
    else
    {
        $('.noneLogin').show();
        $('.haveLogin').hide();
    }
}

// 用户推出
function logout()
{
    // 判断用户是否已经登录
    if (isLogin())
    {
        // 用户退出
        $.get('?m=Member&a=logout',function(){
            success('你已经退出登录',function(){
                user_login();
            });
        });
    }
}

// DIV满屏
function divAll()
{
    $('.content').css('min-height', $(window).height() - 251 + 'px')
}

$(function(){
    // div满屏
    divAll();
    $(window).resize(divAll);

    // 默认隐藏首页头部导航
    if ($('#newGames').length == 1)
    {
        $('.nav_header,.nav_fixed').css('display', 'none');
        $('body').css('background-position', 'center 0');
        $(window).scroll(function(){
            if ($(this).scrollTop() > 120)
                $('.nav_header').slideDown();
            else
                $('.nav_header').slideUp()
        });
    }

    // 需要登录才能进入的页面
    $('.isLogin').click(function(){
        return isLoginAlter();
    });

    // 添加用户密码验证
    $.validator.addMethod('checkPass', function(value, element, params){
        return !params || checkPass(value);
    });

    // 用户登录
    $('#user_login').click(function(){
        $('.h_error').html('');
        if ($('#login').validate({errorLabelContainer:'#login_error'}).form())
        {
            loginAjax($('#login').serialize(), function(){
                success('登录成功', function(){
                    $('#login')[0].reset();
                    // 执行函数
                    user_login();
                });
            });
        }
    });

    // 用户注册
    $('.user_register').click(function(){
        $('.h_error').html('');
        // 验证用户是否存在
        var d = artOpen('新用户注册', $('#m_artdialog').html(), '立即注册', function(){
            if ($('.regform:first').validate().form())
            {
                var loging = art.dialog({
                    title:'<span style="color:green">数据正在提交,请耐心等待...</span>',
                    width: 'auto',
                    height: 'auto',
                }).show();

                // 提交数据
                $.ajax({
                    url:'?m=Member&a=userRegiest',
                    type:'post',
                    data:$('.regform:first').serialize(),
                    dataType:'json',
                    success:function(json)
                    {
                        loging.close();
                        if (json.status == 1)
                        {
                            d.close();
                            success(json.info, function(){
                                user_login();
                            });

                            return false;
                        }

                        $('.h_error').html(json.info);
                    },
                    error:function(){
                        loging.close();
                        $('.h_error').html('服务器繁忙,请稍后再试...');
                    },
                })
            }

            return false;
        });
    });

    // 推荐服登录
    $('#login_games').click(function(){
        if (isLoginAlter())
        {
            var sid = $('#leftServer').val(),
                obj = $('.loginGames_' + sid+':first'),
                msg = '亲！推荐服务器不存在哦...';
            if (obj.length == 1)
            {
                msg = '亲！请先登录哦...';
                if (isLogin())  window.open(obj.attr('href'), '_blank');
            }

            warning(msg);
        }

        return false;
    });
});