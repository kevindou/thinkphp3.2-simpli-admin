/**
 * file: pay.js
 * desc: 处理支付页面的Javascript
 * user: liujx
 * date: 2016-1-27
 */
// 验证数据是否为空
function empty(val)
{
    return val == undefined || val == '' || val == 0;
}
/*
 *	选择游戏事件
 */
function focusserver(name, val, payto)
{
    $("#game_id").val(val);
    $("#game_payto").val(payto)
    $("#gameSet a").html(name);
    $("#msg_for_game").hide();
    $("#cz_select_game").hide();
    $('#server_id1').html('');
    $('#Pagination').html('');
    getDataList(page_index);
    $("#cz_select_server").show();
}
/* 选择游戏 */
function open_all_game_data1()
{
    $("#cz_select_game").css('display','block');
    $("#cz_select_server").css('display','none');
}
function close_all_game_data1(){
    $("#cz_select_game").css('display','none');
    $("#cz_select_server").css('display','none');
}

function close_all_sever_data2()
{
    $("#cz_select_server").css('display','none');
    if ($("#qfSet a").html() == "选择区服")
    {
        $("#msg_for_game").show();
        $("#msg_for_game").html("服务器不能为空!");
    }
}
function open_all_sever_data2(){
    if($("#gameSet a").html()=="选择游戏"){
        $("#msg_for_game").html("充入游戏不能为空!");
    }else{
        $("#cz_select_server").show();
    }
}

function getserver(name,val){
    $("#server_id").val(val);
    $("#qfSet a").html(name);
    $("#qfSet1 a").html(name);
    $("#cz_select_game").hide();
    $("#cz_select_server").hide();
    $("#msg_for_game").hide();
}

// 初始化分页信息
var items_per_page = 20;
var page_index     = 0;

// 分页
function getDataList(index)
{
    var pageIndex = index;
    var gid       = $('#game_id').val();
    $.ajax({
        type:'POST',
        url: '?m=Game&a=getAll',
        data: {
            'pageIndex' : pageIndex,
            'pageSize'  : items_per_page,
            'gid'       : gid
        },
        dataType: 'json',
        contentType: "application/x-www-form-urlencoded",
        success: function(msg){
            var total = msg.total;
            var html = '';
            $.each(msg.result,function(i,n){
                html += "<li onclick=\"getserver('"+n['servername']+"','"+n['sid']+"')\" class=\"fwqxz\">"+n['servername']+"</li>";
            });

            $('#server_id1').html(html);

            // 分页-只初始化一次
            if ($("#Pagination").html().length <= 0)
            {
                $("#Pagination").pagination(total, {
                    'items_per_page'      : items_per_page,
                    'num_display_entries' : 5,
                    'num_edge_entries'    : 1,
                    'prev_text'           : "上一页",
                    'next_text'           : "下一页",
                    'callback'            : pageselectCallback
                });
            }
        }
    });
}

function pageselectCallback(page_index, jq)
{
    getDataList(page_index);
}

function getUserInfo(data, func, err)
{
    // 验证用户UID信息数据是否存在
    $.ajax({
        url :'?m=Pay&a=getUserInfo',
        type:'post',
        data:data,
        dataType:'json',
        success:func,
        error:err
    });
}

$(function(){
    // 选择其他支付金额
    $('#text_money').focus(function(){
        $('#dyyl').html(0)
        $('input[type=radio]').removeAttr('checked');
        $('input[type=radio][value=0]').attr('checked', 'checked');
    });

    // 输入金额
    $('#text_money').bind('blur keyup', function(){
        this.value = this.value.replace(/\D/, '');
        if (this.value > 0) $('#dyyl').html(parseInt(this.value)*20)
    })

    // 支付金额改变
    $('input[type=radio]').change(function(){
        $('#text_money').val('');
        $('#dyyl').html(parseInt($('input[type=radio]:checked').val())*20);
    });

    // 验证账号是否存在
    $('#suid').blur(function(){
        // 获取提交信息
        var strUid = $(this).val(),         // 游戏平台UID
            intSid = $('#server_id').val(), // 服务器ID
            intGid = $('#game_id').val();   // 平台ID

        // 验证数据
        if (!empty(strUid) && !empty(intSid) && !empty(intGid))
        {
            getUserInfo({
                gid:intGid,
                sid:intSid,
                suid:strUid
            }, function(json){
                if (json.status == 1)
                    $("#zhts1").html("<img src='/Public/Index/images/tips.png'/><span>" +json.data[strUid].roleName+ "</span>");
                else
                    $("#zhts1").html("游戏账号不存在!");
            }, function(){
                $("#zhts1").html("游戏账号不存在!");
            });

            return false;
        }

        $("#zhts1").html("游戏账号不存在!");
        return false;
    });

    // 验证再次输入是否有误
    $('#re_suid').bind('blur keyup', function(){
        var str = ($(this).val() != $('#suid').val() || empty($(this).val())) ? '请确认输入游戏账号' : '<img src="/Public/Index/images/tips.png" />';
        $("#zhts2").html(str);
    });

    // 确认支付金币
    $('#tjButton').click(function(){
        if (isLoginAlter())
        {
            // 获取数据
            var strGid = $('#gameSet a').html(),                          // 平台
                strSid = $('#qfSet a').html(),                            // 服务器
                intGid = $('#game_id').val(),                             // 游戏平台ID
                intSid = $('#server_id').val(),                           // 服务器ID
                strUid = $('#suid').val(),                                // 游戏ID
                strRid = $('#re_suid').val(),                             // 确认游戏ID
                val    = parseInt($('input[type=radio]:checked').val()),  // 充值金额
                tval   = $('#text_money').val();                          // 其它方式充值的金额

            if (strGid == '选择平台' || strSid == '选择区服')
            {
                $('#game_id').val('');
                $('#server_id').val('');
                warning('请选择游戏平台');
                return false;
            }

            // 验证游戏平台ID
            if (empty(intGid))
            {
                warning('请选择游戏平台');
                return false;
            }

            // 验证服务器ID
            if (empty(intSid))
            {
                warning('请选择游戏服务器');
                return false;
            }

            // 验证游戏账号UID
            if (empty(strUid))
            {
                warning('请填写充值的游戏UID账号');
                return false;
            }

            // 确认游戏账号UID
            if (strUid !== strRid)
            {
                warning('请确认充值的游戏UID账号');
                return false;
            }

            if ((val <= 0 || isNaN(val)) && tval <= 0)
            {
                warning('请填写支付金额');
                return false;
            }

            if (val == 0)
            {
                if (tval < 5 || tval > 5000)
                {
                    warning('填写支付金额需要大于5小于5000');
                    return false;
                }

                val = parseInt(tval);
            }

            // 验证用户UID信息数据是否存在
            getUserInfo({
                gid:intGid,
                sid:intSid,
                suid:strUid
            }, function(json){
                if (json.status == 1)
                {
                    // 赋值
                    $('.cz_gid').html($('#gameSet a').html());          // 平台
                    $('.cz_sid').html($('#qfSet a').html());            // 服务器
                    $('.cz_uid').html(strUid);                          // 用户游戏UID
                    $('.cz_username').html(json.data[strUid].roleName); // 游戏角色名
                    $('.cz_money').html(val);                           // 充值金额
                    $('.cz_gold').html(val*20 + ' 金币');                // 获得金币
                    var d = artOpen('确认充值', $('#m_pay').html(),  '确认充值', function(){
                        //document.payForm.submit();
                        $('#payForm').submit();
                        d.close();
                        //window.location.reload();
                    });

                    return false;
                }
                warning(json.info);
            }, function(){
                warning('服务器繁忙,请稍候再试...');
            });

            return false;
        }
    });
});