/**
 * file: comm.func.js
 * desc: 后台模块的公共JS文件
 * user: liujx
 * date: 2015-12-31
 */

function initDataTables(select, params)
{
    // 初始化赋值
    var objData = {
        "bAutoWidth": false,                    // 自动计算列宽
        "bPaginate": true,                      // 使用分页
        "bLengthChange": true,                  // 是否可以调整分页
        "aoColumns": [
            { "bSortable": false },
            null, null,null, null, null,
            { "bSortable": false }
        ],     // 标题信息
        "iDisplayStart": 0,                     // 默认开始位置
        "iDisplayLength": 10,                   // 显示长度
        // "bServerSide": true,                 // 开启服务器获取数据
        // "sAjaxSource": url,                  // 发送地址
        "bRetrieve":true,
        "bDestroy":true,
        "sPaginationType":"full_numbers",       // 分页样式

        // 语言配置
        "oLanguage": {
            // 显示
            "sLengthMenu": "每页 _MENU_ 条记录",
            "sZeroRecords": "没有找到记录",
            "sInfo": "显示 _START_ 到 _END_ 共有 _TOTAL_ 条数据",
            "sInfoEmpty": "无记录",
            "sInfoFiltered": "(从 _MAX_ 条记录过滤)",
            "sSearch": "搜索：",

            // 分页
            "oPaginate": {
                "sFirst": "首页",
                "sPrevious": "上一页",
                "sNext": "下一页",
                "sLast": "尾页"
            }
        },
    };

    // 重新赋值
    if (params != undefined && params != '')
    {
        for( var i in params )
        {
            objData[i] = params[i];
        }
    }

    return $(select).DataTable(objData);
}

/**
 * initDialog() 使用Dialog弹出窗口
 * @param  select jquery选择器
 * @param  title  弹出窗口的标题
 * @param  func   点击确定执行的函数
 * @param  params 使用的其他参数
 * @paramn mtype  使用的类型
 * @retrrn object
 */
function initDialog(select, title, func, params, mtype)
{
    var icon = '';
    switch (mtype)
    {
        case 'quest':
            icon = 'fa fa-exclamation-triangle red';
            break;
        default:
            icon = 'fa fa-pencil-square-o';
    }
    // 默认 dialog 的参数
    var objDialog = {
        resizable: true,
        modal: true,
        title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon " + icon + "'></i> " + title + "</h4></div>",
        title_html: true,
        minWidth:500,
        buttons:[{
            'text':'取消',
            'class':'btn btn-xs',
            'click':function(){
                $(this).dialog('close');
            }
        },{
            'text':'确定',
            'class':'btn btn-primary btn-xs',
            'click':func,
        }],
    };

    // 重新赋值
    if (params !== undefined && typeof(params) == 'object')
    {
        for(var i in params) objDialog[i] = params[i];
    }

    return $(select).dialog(objDialog);
}

/**
 * formSubmit() 表单数据提交的处理
 * @param select  select 提交的表单
 * @param strUrl  ajax 提交的地址
 * @param oper    定义操作类型的方式
 * @param fun     ajax 返回成功的处理函数
 */
function formSubmit(select, strUrl, oper, fun)
{
    var objForm = $(select);
    oper = oper == undefined ? 'edit' : oper;
    // 表单验证通过提交数据
    if(objForm.validate().form())
    {
        $.ajax({
            'url'      : strUrl,
            'type'     : 'post',
            'data'     : objForm.serialize()+'&oper='+oper,
            'dataType' : 'json',
            'success'  : function(json)
            {
                if (json.status == 1)
                {
                    $(select + '-error').hide();
                    fun(json, objForm);
                    if (objForm.get(0)) objForm.get(0).reset();
                    return false;
                }

                $(select + '-error').show().find(select + '-label').html(json.msg).show();
            },
            'error'    : function()
            {
                $(select + '-error').show().find(select + '-label').html('服务器繁忙,请稍候再试...').show();
            }
        });
    }
}

/**
 *initTd() 根据数据显示td数据
 * @param arr
 */
function initTd(arr)
{
    var html = '';
    if (arr != undefined)
    {
        for (var i in arr) html += '<td>' + arr[i] + '</td>';
    }

    return html;
}

/**
 * initAjax() 初始化ajax请求
 * @param url
 * @param data
 * @param success
 * @param error
 */
function initAjax(url, data, success, error)
{
    $.ajax({
        'url'      : url,
        'type'     : 'post',
        'data'     : data,
        'dataType' : 'json',
        'success'  : success,
        'error'    : error
    });
}

/**
 * initForm() 表单初始化赋值
 * @param select  需要赋值的表单对象选择器
 * @param data    赋值的数据(空就清空表单)
 */
function initForm(select, data)
{
    var obj = $(select).get(0);
    if (typeof obj == 'object')
    {
        obj.reset();
        if (data != undefined && typeof data == 'object')
        {
            for (var i in data)
            {
                if ( obj[i] != undefined)
                {
                    // 单选按钮
                    if (obj[i].type == undefined)
                    {
                        $(select).find('input[name='+i+']').removeAttr('checked');
                        $(select).find('input[name='+i+'][value=' + data[i] + ']').get(0).checked = true;
                    }
                    else
                        obj[i].value = data[i];
                }
            }
        }
    }
}

/**
 * Alert() 使用的bootbox弹出层函数
 * @param strMsg 提示信息
 * @param func   关闭执行回调函数
 * @param type   提示的类型
 * @constructor
 */
function Alert(strMsg, func, type)
{
    type   = type == undefined || type == 'success' ? 'success' : 'warning';
    strMsg = '<div class="alert alert-' + type + '">' + strMsg + '</div>';
    bootbox.alert({
        buttons: {
            ok: {
                label: '确定',
                className: 'btn-primary'
            }
        },
        message: strMsg,
        callback: func,
        title: "温馨提醒",
    });
}