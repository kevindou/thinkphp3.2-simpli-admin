<?php
// 定义标题和面包屑信息
$this->title = '管理员信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--前面导航信息-->
<p>
    <button class="btn btn-white btn-success btn-bold me-table-insert">
        <i class="ace-icon fa fa-plus bigger-120 blue"></i>
        添加
    </button>
    <button class="btn btn-white btn-warning btn-bold me-table-delete">
        <i class="ace-icon fa fa-trash-o bigger-120 orange"></i>
        删除
    </button>
    <button class="btn btn-white btn-info btn-bold me-hide">
        <i class="ace-icon fa  fa-external-link bigger-120 orange"></i>
        隐藏
    </button>
    <button class="btn btn-white btn-primary btn-bold orange2 me-table-reload">
        <i class="ace-icon fa fa-refresh bigger-120 orange"></i>
        刷新
    </button>
</p>
<!--表格数据-->
<table class="table table-striped table-bordered table-hover" id="showTable"></table>
<script type="text/javascript">
    var aStatus = <?=json_encode($status)?>,
        aAdmins = <?=json_encode($this->params['admins'])?>,
        aRoles  = <?=json_encode($roles)?>,
        myTable = new MeTable({sTitle:"管理员信息"},{
        "aoColumns":[
            oCheckBox,
			{"title": "管理员ID", "data": "id", "sName": "id", "edit": {"type": "hidden"}, "search": {"type": "text"}},
			{"title": "管理员账号", "data": "username", "sName": "username", "edit": {"type": "text", "options": {"required":true,"rangelength":"[2, 255]"}}, "search": {"type": "text"}, "bSortable": false}, 
			{"title": "密码", "data": "password", "sName": "password", "edit": {"type": "password", "options": {"rangelength":"[2, 20]"}}, "bSortable": false, "defaultContent":"", "bViews":false},
			{"title": "确认密码", "data": "repassword", "sName": "repassword", "edit": {"type": "password", "options": {"rangelength":"[2, 20]", "equalTo":"input[name=password]:first"}}, "bSortable": false, "defaultContent":"", "bViews":false},
			{"title": "邮箱", "data": "email", "sName": "email", "edit": {"type": "text", "options": {"required":true,"rangelength":"[2, 255]", "email": true}}, "search": {"type": "text"}, "bSortable": false},
			{"title": "角色", "data": "role", "sName": "role", "value": aRoles, "edit": {"type": "select", "options": {"required":true}}, "bSortable": false},
			{"title": "状态", "data": "status", "sName": "status", "value": aStatus, "edit": {"type": "radio", "default": 1, "options": {"required":true,"number":true,}}, "bSortable": false},
			{"title": "创建时间", "data": "create_time", "sName": "create_time", "createdCell" : dateTimeString}, 
			{"title": "创建用户", "data": "create_id", "sName": "created_id", "bSortable": false, "createdCell": adminToString},
			{"title": "修改时间", "data": "update_time", "sName": "update_time", "createdCell" : dateTimeString}, 
			{"title": "修改用户", "data": "update_id", "sName": "update_id", "bSortable": false, "createdCell": adminToString},
			oOperate
        ],

        // 设置隐藏和排序信息
        // "order":[[0, "desc"]],
         "columnDefs":[{"targets":[3, 4], "visible":false}],
    });

    /**
     * 显示的前置和后置操作
     * myTable.beforeShow(array data, bool isDetail) return true 前置
     * myTable.afterShow(array data, bool isDetail)  return true 后置
     */

     /**
      * 编辑的前置和后置操作
      * myTable.beforeSave(array data) return true 前置
      * myTable.afterSave(array data)  return true 后置
      */

    $(function(){
        myTable.init();
    })
</script>