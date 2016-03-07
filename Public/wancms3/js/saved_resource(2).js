/* /credit/js/myui.task.js */
/**
 * Created with JetBrains PhpStorm.
 * User: f2er
 * Date: 12-12-31
 * Time: 下午4:34
 * To change this template use File | Settings | File Templates.
 */

var YJ_MY_URL ="http://"+ window.location.host,
    S1_IMG_4399 = "http://s1.img4399.com",
    YJ_CLUB_URL = "http://club.4399.com";

/*
* 0－日常任务
* 1－新手任务
* 2－其他任务 （特殊）
* */

(function($,undefined){
    /*简易模版函数*/
    function template(tmpl,json){
        return tmpl.replace(/\@{([a-zA-Z_0-9\-]*)\}/g, function (all, key) {
            return typeof json[key] !== "undefined" ? json[key] : ""
        });
    }

    /*任务*/
    var MY = MY || {};
    /*
    * MY.taskTemplate 任务模板
    * taskList 任务列表
    * doTask  任务详细信息
    * ingTask 进行中的任务
    * completeTask 完成任务
    * undoTask 任务失败
    * */
    MY.taskTemplate = {
        doTask : '<div class="ui-dialog-header">\
                                  <a href="#" class="ui-dialog-close_btn"></a>\
                                  <h2>去做任务</h2>\
                              </div>\
                              <div class="ui-dialog-body clearfix">\
                                  <div class="task_info">\
                                      <img class="task_info_image" src="@{image}" width="125" height="125">\
                                      <h4>@{name}</h4>\
                                      <ul>\
                                          <li>\
                                              <h5>任务描述:</h5>\
                                              @{intro}\
                                          </li>\
                                          <li>\
                                              <h5>任务目标:</h5>\
                                              <span class="task_info_target">@{target}</span>\
                                          </li>\
                                          <li>\
                                              <h5>任务奖励:</h5>\
                                              <span class="task_info_awards">@{prize}</span>\
                                          </li>\
                                      </ul>\
                                  </div>\
                              </div>\
                              <div class="ui-dialog-footer">\
                                  <div class="task_info_next">呃……好难,\
                                      <a href="" class="text_btn show_next_task_btn">跳过吧>></a>\
                                  </div>\
                                  <a href="@{url}" target="_blank" class="ui-btn ui-btn-s ui-btn-s2 do_task_btn"><span>去做任务</span></a>\
                              </div>',
        ingTask : '<div class="ui-dialog-header">\
                                   <a href="#" class="ui-dialog-close_btn"></a>\
                                   <h2>任务进行中</h2>\
                               </div>\
                               <div class="ui-dialog-body clearfix">\
                                   <div class="task_ing">\
                                       <p class="task_object">任务目标：<span>@{target}</span></p>\
                                       <div class="task_finish">\
                                           <p class="warning">请在任务完成以后再点击下方按钮</p>\
                                           <a href="" class="glb_bluebtn_l check_task_status_btn"><span>已完成任务</span></a>\
                                       </div>\
                                   </div>\
                               </div>\
                               <div class="ui-dialog-footer">\
                                   <div class="task_info_next">呃……好难,\
                                       <a href="" class="text_btn show_next_task_btn">跳过吧>></a>\
                                   </div>\
                                   <a href="#" class="text_btn back_to_detail_btn"><< 返回重新查看任务描述</a>\
                               </div>',
        completeTask : '<div class="ui-dialog-header">\
                                        <a href="#" class="ui-dialog-close_btn"></a>\
                                        <h2>完成任务</h2>\
                                    </div>\
                                    <div class="ui-dialog-body clearfix">\
                                        <div class="task_warn_suc">\
                                            <h3>恭喜您，完成任务啦！</h3>\
                                            <p>任务奖励：@{prize}</p>\
                                        </div>\
                                    </div>\
                                    <div class="ui-dialog-footer">\
                                        <a href="#" class="ui-btn ui-btn-s ui-btn-s2 show_next_task_btn"><span>下一个任务</span></a>\
                                    </div>',
        undoTask : '<div class="ui-dialog-header">\
                                    <a href="#" class="ui-dialog-close_btn"></a>\
                                    <h2>未完成任务</h2>\
                                </div>\
                                <div class="ui-dialog-body clearfix">\
                                    <div class="task_warn_fail">\
                                        <h3>对不起，您没有完成任务！</h3>\
                                    </div>\
                                </div>\
                                <div class="ui-dialog-footer">\
                                    <a href="#" class="ui-btn ui-btn-s ui-btn-s1 show_next_task_btn"><span>好难，跳过吧</span></a>\
                                    <a href="#" class="ui-btn ui-btn-s ui-btn-s2 do_task_btn"><span>再做一次任务</span></a>\
                                </div>'
    };
    /*
    * Paraconfig参数说明
    * dailyZone 日常任务容器ID
    * newer     新手任务容器ID
    * specialZone 特殊任务ID
    * targetZone  去做任务按钮class
    * taskTarget  全部任务容器ID
    * */
    /*
    * 任务类型
    * 新手任务  newer
    * 特殊任务  special
    * 日常任务  daily
    * 全部任务  all 或 daily_newer_special
    * */
     MY.task= {
        current : -1,
        current_data : {},
        parentsID : "", //当前对象的ul父容器
        currentData : {},
        Paraconfig : {
            dailyZone : "#j-daily-list",
            newerZone : "#j-novice-list",
            specialZone : "#j-special-list",
            targetZone : ".j-task-target",
            taskTarget  : "#j-taskList",
            callback : function(){}
        },
        taskType : "",
        /*显示弹窗*/
        showLoading : function(){
            var content = '<img src="' + S1_IMG_4399 + '/base/loading_dialog.gif" style="margin:10px 20px;"/> 正在加载中...';
            ue.uiDialog.Custom({
                id : 'show_task_dialog_loading',
                content : content,
                title : '去做任务',
                zIndex : 10000,
                height : 170,
                width : 500,
                lock : true
            })
        },
        /*根据show_task_dialog_loading,隐藏弹窗*/
        hideLoading : function(){
            ue.uiDialog.list["show_task_dialog_loading"] && ue.uiDialog.list["show_task_dialog_loading"].hide();
        },
        /*获取任务*/
        getTaskList : function(parameter){
            var that = this;
            that.taskType = parameter;
            var url = YJ_MY_URL + '/plugins/task/TaskList?type='+that.taskType.type;
            that.Paraconfig.dailyZone = parameter.dailyZone;
            that.Paraconfig.newerZone = parameter.newerZone;
            that.Paraconfig.specialZone = parameter.specialZone;
            that.Paraconfig.callback = parameter.callback;
            $.ajax({
                    dataType : "jsonp",
                    url : url,
                    data : {
                        "callback" : "UEMY.task.getTaskListCallback",
                        "doit" : "UEMY.task.getTaskListCallback",
                        "way" : "json"
                    }
            });
        },
        /*通过jsonp的回调函数*/
        getTaskListCallback : function(json){
            var that = this;
            if(json.code == 100){
                for( var i= 1;i<=3;i++){
                    if( json.result[i] == null ){
                        continue;
                    }
                    switch(i){
                        case 1:
                            $(that.Paraconfig.dailyZone).html(that.renderTpl(json.result[1])).parents('.jf_task').show();
                            break;
                        case 2:
                           $(that.Paraconfig.newerZone).html(that.renderTpl(json.result[2])).parents('.jf_task').show();
                           break;
                        case 3:
                            $(that.Paraconfig.specialZone).html(that.renderTpl(json.result[3])).parents('.jf_task').show();
                            break;
                    }

                }
                that.Paraconfig.callback && that.Paraconfig.callback();
                //已完成鼠标状态
                $(that.Paraconfig.taskTarget).find('.glb_disbtn_s,.glb_disbtn_s span').css('cursor','default');
               /*点击去做任务按钮事件*/
                $(that.Paraconfig.taskTarget).find(that.Paraconfig.targetZone).bind("click", function(e){
                    var tid = $(e.target).parents('li').attr("data-id"),
                        status = $(e.target).parents('li').attr("data-status");
                    that.parentsID = $(e.target).parents('ul').attr('id');
                    MY.task.current = $("#"+that.parentsID).find("li[data-id="+tid+"]").index();
                    MY.task.current_data = that.currentData;

                    if ( status == 2 ){
                        return false;
                    }
                    //判断是否登录，如未登录，呈现弹窗
                    Credit.get(function(){
                        MY.task.showLoading();
                        MY.task.getTaskDetail(tid);
                    })

                    return false;
                });
            }

            //判断新手任务是否全部完成
            var flag = true;
            for( var i = 0,len = $(that.Paraconfig.newerZone).find('li').size();i<len;i++){
                if($(that.Paraconfig.newerZone).find('li').eq(i).attr('data-status') != 2 ){
                    flag = false;
                    break;
                }
            }
            if( json.result[2] != null && flag == true){
                $(that.Paraconfig.newerZone).parent().html('<div class="jf_warnbox"><span class="warn_ico suc_ico"></span><h4 class="tit1">恭喜你！</h4><p class="txt4">新手任务你已经全部做完啦！去做做日常任务吧~！</p></div>');
            }

        },
        renderTpl : function(data){
            var that = this;
            var html = "";

            if( data == null ){
                return;
            }
            for( var i= 0,len = data.length;i<len;i++){
               that.currentData = data[i];
                var _datas = data[i];
                if( _datas.status == 2 ){
                    _datas.btnStatus = "已完成";
                    _datas.btnClass = "glb_disbtn_s";
                }else if(_datas.status == 1){
                    _datas.btnStatus = "领取奖励";
                    _datas.btnClass = "glb_orgbtn_s";
                }else{
                    _datas.btnStatus = "去做任务";
                    _datas.btnClass = "glb_greenbtn_s";
                }
                html += '<li data-status="'+_datas["status"]+'" data-id="'+_datas["id"]+'">';
                html += '<img src="http://s1.img4399.com/plugins/task/icon/'+_datas["id"]+'.jpg" alt="'+_datas["name"]+'" width="80" height="80" />';
                html +=' <h3>'+_datas["name"]+'</h3>';
                html +='<p><span>目标：</span>'+_datas["target"]+'</p>';
                html += '<p>';
                if( _datas["id"] !="8"){
                    html +='<a href="'+_datas["url"]+'" class="'+_datas['btnClass']+' j-task-target right"><span>'+_datas["btnStatus"]+'</span></a>';
                }
                if( _datas["id"] =="8" && (_datas["status"] == "2" || _datas["status"] == "1")){
                    html +='<a href="'+_datas["url"]+'" class="'+_datas['btnClass']+' j-task-target right"><span>'+_datas["btnStatus"]+'</span></a>';
                }
                html +='<span>奖励：</span><span class="num">'+_datas["credit"]+'</span>积分';
                if( _datas["growth"]!=0 ){
                    html += '<span class="num f_growthnum">'+_datas["growth"]+'</span>成长值';
                }
                html += '</p>';
                html +='</li>';
            }
            return html;
        },
        /*
         * 获取任务详细信息
         * */
        getTaskDetail : function(tid){
            var url = YJ_MY_URL + '/plugins/task/get-id-' + tid + '?_AJAX_=1&way=json';
            $.ajax({
                type : 'get',
                dataType : 'jsonp',
                url : url,
                data : {
                    callback : "UEMY.task.getTaskDetailCallback"
                }
            });
            return false;
        },
        /*
         * 通过jsonp获取任务详细信息的回调函数
         * */
        getTaskDetailCallback : function(data){
            MY.task.hideLoading();
            if (data.code == 100){
                MY.task.current_data = data.result.result;
                var status = data.result.status;
                if (status == 2){
                    MY.task.showTaskComplete(data);
                } else if (status == 1){
                    MY.task.getPrize(data.result.result.id);
                } else if (status == 0){
                    MY.task.showTaskDetail(data);
                }
            }
        },
        /*
         * 获取下一个任务
         * */
        getNextTask : function(){
            var that = this;
            var current = MY.task.current;
            ue.uiDialog.list["show_task_dialog"] && ue.uiDialog.list["show_task_dialog"].close();
            ue.uiDialog.list["task_complete_pop"] && ue.uiDialog.list["task_complete_pop"].close();
            ue.uiDialog.list["show_task_ing_dialog"] && ue.uiDialog.list["show_task_ing_dialog"].close();
            ue.uiDialog.list["task_failure_pop"] && ue.uiDialog.list["task_failure_pop"].close();

            for (var i = current + 1, len= $("#"+that.parentsID).find('li').length; i < len; i++){
                var status = $("#"+that.parentsID).find('li').eq(i).attr("data-status");
                if (status < 2){
                    $("#"+that.parentsID).find(that.Paraconfig.targetZone).eq(i).click();
                    MY.task.current = i;
                    return;
                }
            }
            MY.task.current = -1;
        },
        showTaskDetail : function(data){
            var tmpl = MY.taskTemplate.doTask;
            var tid = data.result.result.id;
            var credit = data.result.result.credit,
                growth = data.result.result.growth;
            data.result.result.image = S1_IMG_4399 + '/plugins/task/icon/' + tid + '.b.jpg';
            data.result.result.prize = (credit > 0 ? '<b class="number">' + credit + "</b>积分" : "") +  (growth > 0 ? " " + '<b class="number">' + growth + "</b>成长值" : "");

            tmpl = template(tmpl, data.result.result);
            MY.task.hideLoading();

            ue.uiDialog.custom({
                id : 'show_task_dialog',
                theme : "ui-dialog-a task_pop",
                force : true,
                content : tmpl,
                show_header : false,
                drag : true,
                dragHock : ".ui-dialog-header",
                width : 500,
                lock : true,
                init : function(){
                    var _this = this,
                        $this = this.obj;

                    $this.find(".ui-dialog-close_btn").bind("click", function(){
                        _this.close();
                        return false;
                    })

                    $this.find(".do_task_btn").bind("click", function(){
                        MY.task.showTaskingPop(tid, data.result.result.target);
                    })

                    $this.find(".show_next_task_btn").bind("click", function(){
                        MY.task.getNextTask();
                        return false;
                    })
                }

            })
        },
        showTaskingPop : function(tid, target){
            var tmpl = MY.taskTemplate.ingTask;
            ue.uiDialog.list["show_task_dialog"] && ue.uiDialog.list["show_task_dialog"].hide();
            ue.uiDialog.custom({
                id : 'show_task_ing_dialog',
                theme : "ui-dialog-a task_pop",
                force : true,
                content : template(tmpl, {target : target}),
                show_header : false,
                dragHock : ".ui-dialog-header",
                width : 500,
                drag : true,
                lock : true,
                init : function(){
                    var _this = this,
                        $this = this.obj;

                    $this.find(".ui-dialog-close_btn").bind("click", function(){
                        _this.close();
                        return false;
                    })

                    $this.find(".back_to_detail_btn").bind("click", function(){
                        _this.close();
                        ue.uiDialog.list["show_task_dialog"] && ue.uiDialog.list["show_task_dialog"].show();
                        return false;
                    })


                    $this.find(".check_task_status_btn").bind("click", function(){
                        MY.task.getPrize(tid);
                        return false;
                    });

                    $this.find(".show_next_task_btn").bind("click", function(){
                        MY.task.getNextTask();
                        return false;
                    })
                }

            })
        },
        getPrize : function(tid){
            var url = YJ_MY_URL + '/plugins/task/complete-id-' + tid;

            MY.task.showLoading();
            ue.uiDialog.list["show_task_ing_dialog"] && ue.uiDialog.list["show_task_ing_dialog"].close();

            $.ajax({
                dataType : "jsonp",
                url : url,
                data : {
                    "callback" : 'UEMY.task.getPrizeCallback',
                    way : "json"

                }
            });

        },
        getPrizeCallback : function(data){
            var that = this;
            if (data.code == 1 || data.code == 2){
                //if (data.result == 2){
                MY.task.showTaskComplete(data);
                MY.task.getTaskList(that.taskType);

                return false;
                //}
            }
            MY.task.showTaskFailure();
        },
        /*
         * 任务已完成
         * */
        showTaskComplete : function(tid){
            var tmpl = MY.taskTemplate.completeTask;
            MY.task.hideLoading();
            var data = MY.task.current_data;

            var credit = data.credit,
                growth = data.growth;

            var prize = (credit > 0 ? '<span>+' + credit + "</span> 积分" : "") +  (growth > 0 ? " " + '<span style="padding-left:10px">+' + growth + "</span> 成长值" : "");

            ue.uiDialog.custom({
                id : 'task_complete_pop',
                force : true,
                theme : "ui-dialog-a task_pop task_complete_pop",
                content :template(tmpl, {prize : prize}),
                show_header : false,
                dragHock : ".ui-dialog-header",
                width : 500,
                lock : true,
                drag : true,
                init : function(){
                    var _this = this,
                        $this = this.obj;

                    $this.find(".ui-dialog-close_btn").bind("click", function(){
                        _this.close();
                        return false;
                    })

                    $this.find(".show_next_task_btn").bind("click", function(){
                        MY.task.getNextTask();
                        return false;
                    })
                }

            })
        },
        /*
         * 任务失败
         * */
        showTaskFailure : function(){
            var tmpl = MY.taskTemplate.undoTask;
            var that = this;
            MY.task.hideLoading();
            ue.uiDialog.custom({
                id : 'task_failure_pop',
                force : true,
                theme : "ui-dialog-a task_pop",
                content : tmpl,
                show_header : false,
                dragHock : ".ui-dialog-header",
                width : 500,
                lock : true,
                drag : true,
                init : function(){
                    var _this = this,
                        $this = this.obj;

                    $this.find(".ui-dialog-close_btn").bind("click", function(){
                        _this.close();
                        return false;
                    })

                    $this.find(".do_task_btn").bind("click", function(){
                        _this.close();
                        $("#"+that.parentsID).find(that.Paraconfig.targetZone).eq(MY.task.current).click();
                        return false;
                    })

                    $this.find(".show_next_task_btn").bind("click", function(){
                        MY.task.getNextTask();
                        return false;
                    })
                }

            })
        }
    }
    MY = $.extend(window.UEMY, MY);
    window.UEMY = MY;
})(jQuery);
/* /credit/js/medal_gamelist.js */
/**
 * Created with JetBrains PhpStorm.
 * User: f2er
 * Date: 13-1-8
 * Time: 下午3:30
 * To change this template use File | Settings | File Templates.
 */
/*
* MedalGame 勋章小游戏
* contentID 内容ID
* num       返回的游戏数量
* depend on jQuery
* *
/* /credit/js/credit_index.js */
/**
 * Created with JetBrains PhpStorm.
 * User: f2er
 * Date: 12-12-26
 * Time: 下午6:32
 * To change this template use File | Settings | File Templates.
 */
var indexPage = {
    init : function(){
        //幻灯片
        if($(".jf_slidebox .slide_img li").length>1){
            ue.marquee({
                hovertarget : ".jf_slidebox",//鼠标hover停止切换的对象
                target : '.jf_slidebox .slide_img',//滚动对象 一般为 ul
                items : '.jf_slidebox .slide_img li', //滚动的详细列表
                gotobtn : ".jf_slidebox .slide_num li",
                delay : 3000,//切换间隔时间
                speed : 600,//切换速度
                visiblenum : 1,
                scrollnull : 1,
                currentclass : "cur",
                autoplay : true,//是否自动播放
                afterSlide : function(){
                    var $targetA = this.current.find("a");
                    var href = $targetA.attr("href"),
                        target = $targetA.attr("target"),
                        title = $targetA.attr("title");
                    if (!target){
                        target = "";
                    } else {
                       target = 'target="' + target + '"';
                    }
                    $(".jf_slidebox .slide_title").html('<a href="' + href + '" ' + target + '>' + title + '</a>');
                },//每滚动一个完的回调函数
                beforeSlide : function(){
                    var $targetImg = this.current.find('img');
                    var imgSrc = $targetImg.attr('data-src');
                    $targetImg.attr('src',imgSrc);
                },//每滚动一个之前的回调函数
                mode : 1,//1表示竖直方向滚动 0表示水平方向滚动
                direction : 0
            });
        }
        
        $(".jf_ranktab li").bind("click", function(){
            var index = $(this).index();
            $(this).addClass("cur").siblings().removeClass("cur");
            $(".jf_rankcon").hide().eq(index).show();
        })

        $(".jf_ranklist li").mouseover(function(){
            $(this).addClass("cur").siblings().removeClass("cur");
        })

    }
};

