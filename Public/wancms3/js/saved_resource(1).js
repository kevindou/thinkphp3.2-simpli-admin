/* /base/js/plugins/ue.dialog/ue.dialog.js */
﻿(function($, window, document, undefined){
	var instanceId = 0,
		prefix = "ui-dialog_",
		zIndex = 1989,
		mask = [],
		noop = function(){},
		autoSize_tmpl,
		dialog_tmpl,
		ie6 = $.browser.msie && $.browser.version=="6.0",
		last_window_resize_time = new Date();
	
	dialog_tmpl ='	<div class="ui-dialog" id ="@{id}">@{content}</div>';
	autoSize_tmpl = '	<div class="ui-dialog-autoSize" style="position:absolute; top:-10000px;">\
							<table class="ui-dialog-autoSize-table" style="border-collapse:collapse;border-spacing:0;">\
								<tr><td style="margin:0;padding:0">\
									<div class="ui-dialog" style="overflow:hidden;">@{content}</div>\
								</td></tr>\
							</table>\
					 	</div>';
	
	/*简易模版函数*/
	function template(tmpl,json){
		return tmpl.replace(/\@{([a-zA-Z_0-9\-]*)\}/g, function (all, key) {
			return typeof json[key] !== "undefined" ? json[key] : ""
		});
	}
	
	/*获取浏览器可见区域的高度*/
	function getVisibleWidth(){
		return window.innerWidth || document.documentElement.clientWidth;
	}
	
	/*获取浏览器可见区域的宽度*/
	function getVisibleHeight(){
		return window.innerHeight || document.documentElement.clientHeight;
	}
	
	/*获取滚动条滚动的高度*/
	function getScrollTop(){
		return  document.documentElement.scrollTop || document.body.scrollTop;
	}

	/*获取滚动条滚动的高度*/
	function getScrollLeft(){
		return  document.documentElement.scrollLeft || document.body.scrollLeft;
	} 
	
	/*显示蒙层*/
	function setLock(dialog){
		var width = "100%";
		
		if (ie6){
			//有水平滚动条
			if ($(document.body).width() > getVisibleWidth()){
				width = $(document.body).width();
			}
			
			$(window).unbind("resize.lock").bind("resize.lock", function(){
				if (new Date() - last_window_resize_time < 100){
					return false;
				}
				
				last_window_resize_time = new Date();
				
				//有水平滚动条
				if ($(document.body).width() > getVisibleWidth()){
					width = $(document.body).width();
				} else {
					width = "100%";
				}
				
				$(".ui-dialog-mask").width(width);
			})
		}

		var defaults = {
				opacity : 0.3,
				width : width,
				height : $(document).height(),
				"background-color" : "#000000",
				position : ie6 ? "absolute" : "fixed",
				left : 0,
				top : 0,
				"z-index" : dialog.options.zIndex - 1
			};
		
		if($(".ui-dialog-mask").length == 0){
			$("body").append($('<div class="ui-dialog-mask"></div>'));
			$(".ui-dialog-mask").bind("click", function(){
				mask[mask.length-1].close();
			})
		}
		
		$(".ui-dialog-mask").css(defaults).show();
		mask.push(dialog);
	}
	
	function unlock(){
		if(mask.length == 0) return ;
		mask.pop();
		if(mask.length == 0){
			$(".ui-dialog-mask").remove();
		}else{
			if (ie6){
				$(".ui-dialog-mask").show().css("z-index",mask[mask.length-1].options.zIndex - 1);
			}else {
				$(".ui-dialog-mask").show().css({"z-index" : mask[mask.length-1].options.zIndex - 1, left : getScrollLeft()});
			}
		}
	}
	
	/*构造函数*/
	function ctor(options){
		var defaults = {
				id : "",//弹窗的id。参数值为ID名称
				force : false,//如果已经存在相同id的弹窗 是否强制关闭 ，参数值格式 false | true
				
				left : "auto",//设置弹出层的位置。默认值为auto,即居中。参数值为 数字 | "auto"
				right : "auto",//设置弹出层的位置。默认值为auto,即居中。参数值为 数字 | "auto"
				top : "auto",//设置弹出层的位置。默认值为auto,即居中。参数值为 数字 | "auto"
				bottom : "auto",//设置弹出层的位置。默认值为auto,即居中。参数值为 数字 | "auto"
				position : "absolute",//设置弹出层的定位的模式，默认值为absolute。如果lock 为 true 则 position 强制为 fixed。参数值为 absolute | fixed
				
				width : "auto",//设置弹出层的宽度，默认值为auto，即自适应模版的宽度。参数值格式为 ： 数字 | auto | 百分数("100%")
				height : "auto",//设置弹出层的高度，默认值为auto，即自适应模版的高度。参数值格式为 ： 数字 | auto | 百分数("100%")
				minWidth : "auto",//设置弹出层的最小宽度，默认值为auto，即不限制最小宽度。参数值格式为 ： 数字 | auto
				maxWidth : "auto",//设置弹出层的最大宽度，默认值为auto，即不限制最大宽度。参数值格式为 ： 数字 | auto
				
				lock : false,//是否显示遮罩层 参数值 ： false | true
				drag : false,//是否可以拖动 参数值: true | false
				dragHock : "",//设置可以拖动的元素 参数值：[string]jquery 选择符
				closeBtn : ".ui-dialog-close_btn",//关闭弹窗按钮的class
				
				zIndex : zIndex,//弹窗的zIndex
				
				content : "",//弹窗的内容
				forceLock : true,
				init : noop,//设置弹窗初始化的方法
				beforeClose : noop,//关闭弹窗之前的回调函数
				afterClose : noop//关闭弹窗之后的回调函数
			},
			_this = this;
		
		options.id = options.id || prefix + (++instanceId);	
		options.zIndex = options.zIndex || ++zIndex;	
		options.position = options.position == "fixed" ? "fixed" : "absolute";//position fixed | absolute
		
		//如果锁屏则强制 设置弹窗固定居中

        if (options.forceLock !== false){
            options.forceLock = true;
        }

		if (options.lock && options.forceLock){
			options.position = "fixed";
			options.left = "auto";
			options.right = "auto";
			options.top = "auto";
			options.bottom = "auto";
		}	
		
		this.options = options = $.extend(defaults, options);
		
		//已有相同id的弹窗
		if (options.id && ctor.list[options.id]){
			if (options.force){
				ctor.list[options.id].close();
			} else {
				_this = ctor.list[options.id];
				_this.show();
				return _this;
			}
		}
		
		this.create();
		this.options.init.call(this);
		this.obj.find(options.closeBtn).bind("click", function(){
			_this.close.call(_this);
			return false;
		})
	}
	
	ctor.list = {};
	
	ctor.prototype={
		reset : function(){
			this.obj.height("auto");
			var new_height = this.obj.height();
			this._size.height = new_height;
			this._offset = this.offset(this._size);
			this.obj.css(this._size);

			if (ie6){
				this.ie6fixed.options["height"] = new_height;
			} else {
				this.obj.css(this._offset);
			}
		},
		
		/*自适应宽高*/
		autoSize : function(content, width){
			var options = this.options,
				$autoSize = $(template(autoSize_tmpl, {content : content})),
				size;
				
			$(document.body).append($autoSize);
			
			if (typeof width !== 'undefined'){
				$autoSize.find(".ui-dialog-autoSize-table").width(width);
			}
			
			size = {
				width : $autoSize.find(".ui-dialog-autoSize-table").width(),
				height : $autoSize.find(".ui-dialog-autoSize-table").height()
			}
			
			if (typeof width !== 'undefined'){
				size.width = width;
			}
			
			$autoSize.remove();
			
			return size;
		},
		
		/*根据内容计算宽高*/
		size : function(content){
			var options = this.options,
				width = options.width,
				height = options.height,
				content = options.content,
				size;
				
			if(typeof width === "number" || width !== "auto"){
				size = this.autoSize(content, width);
			} else {
				size = this.autoSize(content);
			}

			if(typeof width === "number"){
				size.width = width;
			}
			
			if(typeof height === "number"){
				size.height = height;
			}

			return size;
		},
		
		/*根据弹窗的大小计算弹窗的位置*/
		offset : function(size){
			var options = this.options,	
				position = options.position,
				lock = options.lock,
				left = options.left,
				top = options.top,
				bottom = options.bottom,
				right = options.right,
				vheight,
				_offset = {};
			
			//默认水平和垂直居中
			if(typeof left !== "number"  && typeof right  !== "number"){
				left = "auto";
				right = "auto";
			}
			
			if(typeof top !== "number" && typeof bottom  !== "number"){
				top = "auto";
				bottom = "auto";
			}
			
			(typeof top === "number") && (top = top < 0 ? 0 : top);
			(typeof left === "number") && (left = left < 0 ? 0 : left);
			(typeof right === "number") && (right = right < 0 ? 0 : right);
			(typeof bottom === "number") && (bottom = bottom < 0 ? 0 : bottom);
			
			_offset = $.extend(_offset, {
				left : left ,
				top : top ,
				bottom : bottom,
				right : right
			});
			
						
			if (left == "auto" && right == "auto"){
				_offset["left"] = "50%";
				if (position == "fixed"){
					_offset["margin-left"] = - size.width / 2;
				} else {
					_offset["margin-left"] = - size.width / 2 + getScrollLeft();
				}
			}
			
			if (top == "auto" && bottom == "auto"){
				if (position == "fixed"){
					_offset["margin-top"] = - size.height / 2;
					_offset["top"] = "50%";
				} else {
					_offset["top"] = getScrollTop() + getVisibleHeight()  / 2 - size.height / 2;
				}
			}
			
			return _offset;
		},
		
		create : function(){
			var options = this.options,
				position = options.position,
				hold = options.hold,
				content = options.content || options.loading || "loading",
				_this = this;
				
			var _dialog_tmpl = template(dialog_tmpl,{content : content, id : options.id});
			
			//蒙层只会存在一个，确保弹出层在蒙层的前面，当弹窗和蒙层Zindex 一样时 蒙层可以盖住弹窗
			if($(".ui-dialog-mask").length == 0){
				$("body").append(_dialog_tmpl);
			}else{
				$(".ui-dialog-mask").before(_dialog_tmpl);
			}
			
			this.obj = $("#" + options.id);
		
			var css = {
					zIndex : options.zIndex,
					position : position
				},
				size = this.size(),
				offset;

			if (this.options.minWidth !== "auto"){
				if (size.width < this.options.minWidth){
					size.width = this.options.minWidth;
				}
			}
			
			if (this.options.maxWidth !== "auto"){
				if (size.width > this.options.maxWidth){
					size.width = this.options.maxWidth;
				}
			}
			
			this._size = size;
			this._offset = offset = this.offset(size);
			
			$.extend(css, size);
			$.extend(css, offset);
			
			this.obj.css(css);

			//IE6 position fixed 解决方案

			if(ie6 && position == "fixed"){
				this.ie6fixed = ue.fixed({
					target : this.obj,
					left : options.left,
					right : options.right,
					top : options.top,
					bottom : options.bottom,
					height : size.height,
					width : size.width
				});
			}
			
			//模态弹窗
			if (options.lock){
				setLock(this);
			}
			if(this.options.drag && this.options.dragHock && $(this.options.dragHock).length > 0 && ue.easydrag){
				ue.easydrag({
					target : this.obj,
					hock : this.obj.find(this.options.dragHock)
				});
			}
			uiDialog.list[options.id] = this;
		},
		
		close : function(beforeClose, afterClose){
			var options = this.options;
			this.options.beforeClose = typeof beforeClose === "function" ? beforeClose : options.beforeClose;
			this.options.afterClose = typeof afterClose === "function" ? afterClose : options.afterClose;
			var is_close = options.beforeClose.call(this);
			if (is_close === false) return;//取消关闭
			this.obj.remove();
			this.options.lock && unlock(this);
			delete ctor.list[options.id];
			options.afterClose.call(this);
		},
		
		show : function(){
			this.options.lock && setLock(this);
			this.obj.show();
		},
		
		hide : function(){
			this.obj.hide();
			this.options.lock && unlock(this);
		},
		
		timer : function (delay,callback){
			var _this = this,
				callback = typeof callback === "function" ? callback : noop;
			
			setTimeout(function(){callback.call(_this)},delay);
		}
	};
	
	window.ue = window.ue || {};
	
	/*fixed 组件*/
	(function(){
		var fixList = [];
		
		var pre_scroll_top;
		var pre_scroll_left;
		
		function ctor(options){
			var defaults = {
				relative : $(),
				target : "",
				height : "auto",
				width : "auto",
				left : "auto",
				top : "auto",
				bottom : "auto",
				right : "auto"
			};
			
			options = this.options = $.extend(defaults, options);
			
			var css = {
				"position" : "absolute",
				"margin" : 0
			}
			
			//水平居中
			if (options.left == "auto" && options.right == "auto"){
				css["left"] = getScrollLeft() +  (getVisibleWidth() - options.width) / 2;
			}
			
			//垂直居中
			if (options.top == "auto" || options.bottom == "auto"){
				css["top"] = getScrollTop() +  (getVisibleHeight() - options.height) / 2;
			}
			
			if (typeof options.right === "number"){
				css["left"] = "auto";
				css["right"] = options.right;
			}
			
			if (typeof options.left === "number"){
				css["left"] = getScrollLeft() + options.left;
				css["right"] = "auto";
			}
			
			if (typeof options.bottom === "number"){
				css["top"] = "auto";
				css["bottom"] = options.bottom
			}
			
			if (typeof options.top === "number"){
				css["top"] = getScrollTop() + options.top;
				css["bottom"] = "auto";
			}
			
			if (ie6){
				pre_scroll_top = getScrollTop();
				pre_scroll_left = getScrollLeft();
				css.position = "absolute";
				css.margin = 0;
				options.target.css(css);
			} else {
				css.position = "fixed";
			}
					
			fixList.push(this);
			
			return fixList[fixList.length - 1];
		}
	
		function ie6Reset(){
			var cur, options;
			for (var i = 0, l = fixList.length; i < l; i++){
				cur = fixList[i];
				if (cur){
					options = cur.options;
					var  css = {};
					if (options){
						//水平居中
						if (options.left == "auto" && options.right == "auto"){
							css["left"] = getScrollLeft() +  (getVisibleWidth() - options.width) / 2;
						}
						
						//垂直居中
						if (options.top == "auto" && options.bottom == "auto"){
							css["top"] = getScrollTop() +  (getVisibleHeight() - options.height) / 2;
						}
						
						if (typeof options.right === "number"){
							css["right"] = options.right; //- getScrollLeft();

							options.target.css({
								right : getScrollLeft() - pre_scroll_left  + options.right
							});
						}
						
						if (typeof options.left === "number"){
							css["left"] = getScrollLeft() + options.left;
						}
						
						if (typeof options.bottom === "number"){
							//解析ie6 bottom 定位错误的bug
							css["bottom"] = options.bottom;
							if (getVisibleHeight() % 2 == 0){
								if (getScrollTop() % 2 == 1){
									document.documentElement.scrollTop = getScrollTop() + 1;
								}
							} else{
								if (getScrollTop() % 2 == 0){
									document.documentElement.scrollTop = getScrollTop() + 1;
								}
							}

							options.target.css({
								bottom : getScrollTop() - pre_scroll_top  + options.bottom
							});
						}

						if (typeof options.top === "number"){
							css["top"] = getScrollTop() + options.top;
						}
						
						options.target.stop().animate(css,500);
					}
				}
			}
			
			pre_scroll_top = getScrollTop();
			pre_scroll_left = getScrollLeft();
		}
		
		if (ie6){		
			setInterval(function(){
				ie6Reset();
			},800);
		} else {
			
		}
			
		ctor.prototype = {
			remove : function(){
				
			}
		}
			
		ue.fixed = function(options){
			return new ctor(options);
		}
	})();

	ue.dialog = ue.uiDialog = window.uiDialog = function(options){
		return new ctor(options);
	}
	
	uiDialog.list = ctor.list;
	
	(function(){	
		var tmpl 		= '<div class="@{theme}"><div class="ui-dialog-shadow"></div><div class="ui-dialog-custom @{type}"><div class="ui-dialog-custom-inner">@{header}<div class="ui-dialog-body clearfix">@{content}</div>@{footer}</div></div></div>',
			header_tmpl = ' <div class="ui-dialog-header"><a href="#" class="ui-dialog-close_btn"></a><h2>@{title}</h2></div>',
			footer_tmpl = ' <div class="ui-dialog-footer">@{confirm_btn}@{cancel_btn}@{footer}</div>',
			cancel_tmpl = '<a href="#" class="ui-btn ui-btn-s ui-btn-s1 ui-dialog-cancel_btn"><span>取消</span></a>',
			confirm_tmpl = '<a href="#" class="ui-btn ui-btn-s ui-btn-s2 ui-dialog-confirm_btn"><span>确认</span></a>';
			
			
		uiDialog.custom = uiDialog.Custom = function(options){
			var defaults = {
					show_header :  true,
					show_footer : false,
					show_cancel_btn : false,
					show_confirm_btn : false,
					title : '来自4399.com的网页说',
					content : 'hello world',
					type : '',
					footer : '',
					
					theme : 'ui-dialog-a',
					lock : false,
					drag : true,
					dragHock : '.ui-dialog-header',
					confirm : noop,
					cancel : noop,
					icon : '',
					
					init : noop,
					delay : 0
				
				},
				tmpl_options,
				html = '';
			
			options = $.extend(defaults, options);
			
			tmpl_options = {
				header : options.show_header ? template(header_tmpl,options) : '',
				content : !!options.icon ? '<span class="ui-dialog-icon ' + options.icon + '"></span>' + '<div class="ui-dialog-icon-text">' + options.content + "</div>" : options.content,
				footer : options.show_footer ? template(footer_tmpl,{
						footer : options.footer,
						cancel_btn : options.show_cancel_btn ? cancel_tmpl : '',
						confirm_btn : options.show_confirm_btn ? confirm_tmpl : ''
						
					}) : '',
				type : options.type,
				theme : options.theme
			}
			
			options.content = template(tmpl, tmpl_options);
			
			var customInit = options.init;
			
			options.init = function(){
				var _this = this;
				
				options.show_confirm_btn && this.obj.find('.ui-dialog-confirm_btn').bind("click", function(){
					if(typeof options.confirm === 'function'){
						var result = options.confirm.call(_this);
						
						if(result !== false){
							 _this.close();
						}
					}
					return false;
				});
				
				options.show_cancel_btn && this.obj.find('.ui-dialog-cancel_btn').bind("click", function(){
					if(typeof options.cancel === 'function'){
						var result = options.cancel.call(_this);
						
						if(result !== false){
							 _this.close();
						}
					}
					return false;
				});
				
				/*this.obj.find('.ui-dialog-close_btn').bind("click", function(){
					_this.close();
					return false;
				});*/
				
				(options.delay > 0) && this.timer(options.delay, this.close);	
				
				customInit.call(_this);
			}
					
			return uiDialog(options);
			
		}
	
	})();
	
	uiDialog.alert = uiDialog.Alert = function(options){
		var defaults = {
			type : 'ui-dialog-alert',
			theme : 'ui-dialog-a1 ui-dialog-a',
			show_header :  true,
			show_footer : true,
			minWidth : 250,
			maxWidth : 600,
			lock : true,
			show_confirm_btn : true
		}
		
		options = $.extend(defaults, options);
				
		return  uiDialog.Custom(options);
	}

	uiDialog.confirm = uiDialog.Confirm = function(options){
		var defaults = {
			theme : 'ui-dialog-a1 ui-dialog-a',
			type : 'ui-dialog-confirm',
			show_header :  true,
			minWidth : 250,
			maxWidth : 600,
			show_footer : true,
			lock : true,
			show_confirm_btn : true,
			show_cancel_btn : true
		}
		
		options = $.extend(defaults, options);
		
		return uiDialog.Custom(options);
	}
	
	uiDialog.tip = uiDialog.Tip = function(options){
		var defaults = {
			type : 'ui-dialog-tip',
			show_header :  false,
			drag : false,
			delay : 2000
		}
		
		options = $.extend(defaults, options);
		
		return uiDialog.Custom(options);
	}
	
		/**
		options 跟随元素
		isfollowed 被跟随的元素
		pos 跟随元素相对于被跟随元素的位置
		trun {top ,left}微调 
	*/

	var H = {
			LEFT : 1,
			RIGHT : 2,
			CENTER : 4
		},
		V = {
			TOP : 8,
			BOTTOM : 16,
			MIDDLE : 32
		};
		
	function Follow(options, isfollowed, pos, trun){
        var _this,follow;

		//传入jquery对象
		if (typeof options === "object" && options.length > 0){
			follow = options;
		} else if (typeof options === "object"){
			options.left = 0;
			options.right = 0;
			options.lock = false;
			options.position = "absolute";
			follow = (new uiDialog(options)).obj;
		} else {
			return;
		}
		
		var h_pos, v_pos, pos = pos || '';
		var poss = $.trim(pos).toUpperCase().split('_');
		
		for (var i = 0 ; i < poss.length; i++){
			if (H[poss[i]]){
				h_pos = H[poss[i]];
                this._h_pos = poss[i];
			} else if (V[poss[i]]){
				v_pos = V[poss[i]];
                this._v_pos = poss[i];
			}
		}
		
		h_pos = h_pos || H.LEFT;
		v_pos = v_pos || V.TOP;
			
		this.follow = follow;
		this.isfollowed = isfollowed;
		this.h_pos = h_pos;
		this.v_pos = v_pos;
		this.trun = trun;
        this.pos = pos;
		
		this.reset();
		
		Follow.list.push(this);
    }
    
	uiDialog.follow = uiDialog.Follow = function(options, isfollowed, pos, trun){
		return new Follow(options, isfollowed, pos, trun);
	}
	
	Follow.prototype = {
		reset : function(){
			var follow = this.follow,
				isfollowed = this.isfollowed,
                pos = this.pos,
				h_pos = this.h_pos,
				v_pos = this.v_pos,
                _h_pos = this._h_pos,
				_v_pos = this._v_pos,
				trun = this.trun,
				offset = isfollowed.offset() || {left : 0, top : 0},
				trun = trun || {},
				x = trun.x || 0,
				y = trun.y || 0,
				isfollowed_width = isfollowed.outerWidth(),
				isfollowed_height = isfollowed.outerHeight(),
				follow_width = follow.outerWidth(),
				follow_height = follow.outerHeight(),
				left,
				top;

			
			left = offset.left;
			top = offset.top;
			
			switch(h_pos | v_pos){
				case V.TOP | H.LEFT : 
					top -= follow_height;
				break;
				case V.TOP | H.RIGHT: 
					left += isfollowed_width - follow_width;
					top -= follow_height;
				break;
				case V.TOP | H.CENTER: 
					left -= (follow_width - isfollowed_width) / 2;
					top -= follow_height;
				break;
				case V.MIDDLE | H.LEFT : 
					left -= follow_width;
					top -= (follow_height - isfollowed_height) / 2;
				break;
				case V.MIDDLE | H.RIGHT: 
					left += isfollowed_width;
					top -= (follow_height - isfollowed_height) / 2;
				break;
				case V.MIDDLE | H.CENTER: 
					top -= (follow_height - isfollowed_height) / 2;
					left -= (follow_width - isfollowed_width) / 2;
				break;
				case V.BOTTOM | H.LEFT :
					 top += isfollowed_height;
				break;
				case V.BOTTOM | H.RIGHT: 
					top += isfollowed_height;
					left += isfollowed_width - follow_width;
				break;
				case V.BOTTOM | H.CENTER: 
					top += isfollowed_height;
					left -= (follow_width - isfollowed_width) / 2;
				break;
			}
			
			left += x;
			top += y;
			
			if (left < 0){
				left = offset.left;
                _h_pos = "left";
			}
            
			if (left + follow_width > $(document.body).width()){
				left = offset.left + isfollowed_width - follow_width;
                _h_pos = "right";
			}
	
			if (top + follow_height > $(document.body).height()){
				top = offset.top - follow_height;
                _v_pos = "top";
			}
			
			if (top < 0 ){
				top = offset.top + isfollowed_height;
                _v_pos = "bottom";
			}
            
            var cls = [_h_pos, _v_pos].join("_").toLowerCase();
            
			follow.css({"position" : "absolute","left" : left ,"top" : top}).removeClass(this.pre_pos_cls || " ").addClass(cls).show();
            this.pre_pos_cls = cls;
		}
		
	};
	Follow.list = [];
	
	$(window).unbind("resize.follow").bind("resize.follow", function(){
		if (new Date() - last_window_resize_time < 100){
			return false;
		}
		
		last_window_resize_time = new Date();
		
		for (var i = 0; i < Follow.list.length; i++){
			Follow.list[i] && Follow.list[i].reset();
		}
	})
})(jQuery, window, document);
/* /base/js/plugins/ue.addBookmark/ue.addBookmark.js */
/**
 * Created with JetBrains PhpStorm.
 * User: f2er
 * Date: 12-12-18
 * Time: 下午2:50
 * To change this template use File | Settings | File Templates.
 */
/*
* addBookmark : 添加收藏组件
* name : 书签标题
* href : 书签地址
* Time : 2013-01-24
* */
(function($,win,undefined){
    function addBookmark(name,href){
        var title = name || document.title,
            url = href || document.location.href;
        if(window.sidebar){
            window.sidebar.addPanel(title,url,'');
        }else{
            try{
                window.external.AddFavorite(url,title);
            }catch(e){
                alert("您的浏览器不支持该功能,请使用Ctrl+D收藏本页");
            }
        }
    }
    win.ue = win.ue || {};
    ue.addBookmark = addBookmark;
})(jQuery,window);
/* /base/js/plugins/ue.marquee/ue.marquee.js */
;(function($, window, undefined){
	
	function fixMousewheel(e){
		var delta = 0, deltaX = 0, deltaY = 0
		// Old school scrollwheel delta
		if ( e.wheelDelta ) { delta = e.wheelDelta/120; }
		if ( e.detail     ) { delta = -e.detail/3; }
		
		// New school multidimensional scroll (touchpads) deltas
		deltaY = delta;
		
		// Gecko
		if ( e.axis !== undefined && e.axis === e.HORIZONTAL_AXIS ) {
			deltaY = 0;
			deltaX = -1*delta;
		}
		
		// Webkit
		if ( e.wheelDeltaY !== undefined ) { deltaY = e.wheelDeltaY/120; }
		if ( e.wheelDeltaX !== undefined ) { deltaX = -1*e.wheelDeltaX/120; }
		
		return {delta : delta, deltaX : deltaX, deltaY : deltaY}
	}

	function ctor(options){
		var defaults = {
				scrolltarget : "",//绑定滚轮切换的对象
				hovertarget : "",//鼠标hover停止切换的对象
				target : "",//滚动对象 一般为 ul
				items : "", //滚动的详细列表
				gotobtn : "",//指定滚动位置的按钮
				prevbtn : "",//向前或者 向上按钮
				prevbtndisabled : "",
				nextbtn : "",//向后或者 向下按钮
				nextbtndisabled : "",

				delay : 3000,//切换间隔时间
				speed : 600,//切换速度
				visiblenum : 1,//可见个数
				scrollnum : 1,//一次滚动几个
				autoplay : true,//是否自动播放
				currentclass : "",
				fade : 0,//是否渐隐渐现
				
				loop : 1,//循环模式 1 无限循环 0 不循环
				afterSlide : function(){},//每滚动一个完的回调函数
				beforeSlide : function(){},//每滚动一个之前的回调函数
				beforePrev : function(){},
				afterPrev : function(){},
				beforeNext : function(){},
				afterNext : function(){},
				mode : 0,//0表示竖直方向滚动 1 表示水平方向滚动
				direction : 0//表示默认的滚动方向0向上或者向左 1表示向下或者向右
			};
			
		options = this.options = $.extend(defaults, options);
		
		this.scrolltarget = $(options.scrolltarget);
		this.hovertarget = $(options.hovertarget);
		this.target = $(options.target);
		this.prevbtn = $(options.prevbtn);
		this.nextbtn = $(options.nextbtn);
		this.gotobtn = $(options.gotobtn);
		this.items = $(options.items);
		
		this.items.each(function(i, v){
			$(this).attr("data-index", i);
		});
		
		if (options.loop == 1){	
			//要实现一次滚动多个，项目个数至少是滚动个数的2倍
			if ((this.items.length - options.visiblenum) < options.scrollnum *2 ){
				this.target.append($(options.items).clone());
				this.items = $(options.items);
			}
		} else {
			if (options.prevbtndisabled == ""){
				this.prevbtn.css("visibility", "hidden");
			} else {
				this.prevbtn.addClass(options.prevbtndisabled);
			}
			if (this.items.length <= options.visiblenum){
				if (options.nextbtndisabled == ""){
					this.nextbtn.css("visibility", "hidden");
				} else {
					this.nextbtn.addClass(options.nextbtndisabled);
				}
				return;
			}
			
			if (options.nextbtndisabled == ""){
				this.nextbtn.css("visibility", "visible");
			} else {
				this.nextbtn.removeClass(options.nextbtndisabled);
			}
		}
				
		this.gotobtn.each(function(i, v){
			if (typeof $(this).attr("data-index") === "undefined"){
				$(this).attr("data-index", i);
			}
		});
		
		this.current = this.items.eq(0);
		this.bind();
		this.start();
	}
	
	ctor.prototype = {
		bind : function(){
			var options = this.options,
				_this = this;
			
			this.prevbtn.bind("click", function(){
				_this.prev();
				return false;
			});
			
			this.nextbtn.bind("click", function(){
				_this.next();
				return false;
			});
			
			this.gotobtn.bind("click", function(){
				var index = $(this).attr("data-index"),
					preindex = _this.current.attr("data-index");
				
				//往后面的指定位置滚动
				if (preindex < 0) preindex  = 0;

				_this.goto(index, preindex);
				
				return false;
			});
			
			this.scrolltarget.bind("mousewheel DOMMouseScroll", function(e){
				if (_this.animate) return false;
				var evt = fixMousewheel(e);
				
				if(evt.delta > 0){
					_this.prev();
				} else {
					_this.next();
				}
				
				e.preventDefault();
				e.stopPropagation();
				
				return false;
			});
			
			this.hovertarget.bind("mouseover mouseout", function(evt){
				if (evt.type == "mouseover"){
					_this.hoverstatus = true;
					setTimeout(function(){
						_this.checkHover();
					},300);
				} else if (evt.type == "mouseout"){
					_this.hoverstatus = false;
					setTimeout(function(){
						_this.checkHover();
					},300);
				}
			});
		},
		
		next : function(){
			if (this.animate) return false;
			this.scroll(0);
		},
		
		prev : function(){
			if (this.animate) return false;
			this.scroll(1);
		},
		
		goto : function(index, preindex){
			if (this.animate) return false;
			
			if (index > preindex){
				this.scroll(0, index - preindex);
			} else if (index < preindex){//往前面的指定位置滚动
				this.scroll(1, preindex - index);
			}
		},
		
		scroll : function(direction, scrollnum){
			var _this = this,
				options = this.options,
				current,
				distance,
				move_type,
				index,
				args = {},
				scrollnum = (typeof scrollnum === "number") ? scrollnum : options.scrollnum;
				direction = (typeof direction === "number") ?  direction : options.direction;
			
			_this.items = $(options.items);

			this.animate = true;
			this.stop();
			this.target.stop();
			
			//往后面翻页
			if (direction == 0){
				current = _this.items.slice(0, scrollnum);
				
				if (options.mode == 0){
					distance = current.outerHeight(true);
					move_type = "margin-top";
					args = {"margin-top" : - distance * scrollnum};
					
				} else {
					distance = current.outerWidth(true);
					move_type = "margin-left";
					args = {"margin-left" : - distance * scrollnum};
				}

				_this.current = _this.items.eq(scrollnum);
				index = _this.current.attr("data-index");
				_this.gotobtn.eq(index).addClass(options.currentclass).siblings().removeClass(options.currentclass);

				options.beforeNext.call(_this);
				options.beforeSlide.call(_this);
				
				if (options.loop == 0){

					if(_this.items.eq(0).attr("data-index") == _this.items.length - options.visiblenum - 1){
						if (options.nextbtndisabled == ""){
							_this.nextbtn.css("visibility", "hidden");
						} else {
							_this.nextbtn.addClass(options.nextbtndisabled);
						}
					} else{
						if (options.nextbtndisabled == ""){
							_this.nextbtn.css("visibility", "visible");
						} else {
							_this.nextbtn.removeClass(options.nextbtndisabled);
						}
					} 

					if (options.prevbtndisabled == ""){
						this.prevbtn.css("visibility", "visible");
					} else {
						this.prevbtn.removeClass(options.prevbtndisabled);
					}
				}
				
				_this.target.animate(args, options.speed, function(){
					
					_this.target.css(move_type, 0);
					_this.target.append(current);
					_this.items = $(options.items);
					setTimeout(function(){
						options.afterNext.call(_this);
						options.afterSlide.call(_this);
					},0);
					_this.animate = false;
					
					setTimeout(function(){
						_this.start()
					}, 0);
		
				});
			
			//向前面翻页
			} else {
				current = _this.items.slice(-scrollnum);
				
				if (options.mode == 0){
					distance = current.outerHeight(true);
					move_type = "margin-top";
					args = {"margin-top" : 0};
					
				} else {
					distance = current.outerWidth(true);
					move_type = "margin-left";
					args = {"margin-left" : 0};
				}
				
				_this.current = _this.items.eq(_this.items.length - scrollnum);
				index = _this.current.attr("data-index");
				_this.gotobtn.eq(index).addClass(options.currentclass).siblings().removeClass(options.currentclass);
				
				_this.target.prepend(current);
				_this.items = $(options.items);
				setTimeout(function(){
					options.beforePrev.call(_this);
					options.beforeSlide.call(_this);
				},0);

				if (options.loop == 0){

					if(this.items.eq(0).attr("data-index") == 0){
						if (options.prevbtndisabled == ""){
							this.prevbtn.css("visibility", "hidden");
						} else {
							this.prevbtn.addClass(options.prevbtndisabled);
						}
					} else {
						if (options.prevbtndisabled == ""){
							this.prevbtn.css("visibility", "visible");
						} else {
							this.prevbtn.removeClass(options.prevbtndisabled);
						}
					}

					if (options.nextbtndisabled == ""){
						_this.nextbtn.css("visibility", "visible");
					} else {
						_this.nextbtn.removeClass(options.nextbtndisabled);
					}
				}
				
				_this.target.css(move_type , - distance * scrollnum).animate(args, options.speed, function(){
					options.afterPrev.call(_this);
					options.afterSlide.call(_this);
					_this.animate = false;
					
					setTimeout(function(){
						_this.start()
					}, options.delay);
				});
			}
		},
		
		stop : function(){
			clearInterval(this.timer);
		},
		
		start : function(){
			var options = this.options,
				_this = this;
				
			if (!options.autoplay){
				return;
			}
			this.stop();
			this.timer = setInterval(function(){
				_this.scroll();
			}, options.delay + options.speed);
		},
		
		checkHover : function(){
			if (this.hoverstatus){
				this.stop();
			} else {
				this.start();
			}
		}
	}
	
	ue = window.ue || {};
	
	ue.marquee = function(options){
		return new ctor(options);
	}
	
})(jQuery, window);
/* /base/js/plugins/ue.tween/ue.tween.js */
ue = window.ue || {};
ue.tween = (function(){
	var loop = 46;
	
	function ctor(delay, type, tx, callback){
		var _this = this;
		this.times = 0;
		this.times_count = Math.floor(delay / loop);
		this.stop = function(){
			clearInterval(_this.timer);
			tx.call(null,1);
			typeof callback === 'function' && callback();
		};
		this.timer = setInterval(function(){
			_this.times++;
			_this.percent = _this.times < _this.times_count ? _this.times / _this.times_count : 1;
			
			tx.call(null,_this[type]());
			
			if (_this.percent == 1){
				clearInterval(_this.timer);
				typeof callback === 'function' && callback();
			}
			
		}, loop);
	}
	
	ctor.prototype = {
		pause : function(){
			clearInterval(this.timer);
		},
		
		'linear' : function(){
			return this.percent;
		},
		
		'easeout' : function(){
			return Math.sin( Math.PI / 2 * this.percent);
		},
		
		'easein' : function(){
			return 1 - Math.cos( Math.PI / 2 * this.percent);
		}
	}
	
	return function(delay, type, tx, callback){
		return new ctor(delay, type, tx, callback);
	}
})();
/* /base/js/plugins/ue.lazyImg.js */
/**
 * @description	: 延时加载
 * @author : chenxizhong@4399.net
 * @create date	: 2012-11-14
 * @change date	:  
 * @change details : 
 * @parameter : 
 * @method :
 * @details	: 
 * @return :  
 */
!(function($){
	"use strict";
	
	function windowHeight(){
		return window.innerHeight || document.documentElement.clientHeight;
	}
		
	function scrollTop(){
		return document.body.scrollTop || document.documentElement.scrollTop;
	}
	
	var lazyImg = function(options){
		options = $.extend({}, {
			target : '',
			type : ''
		},options);
		
		this.init(options);
	}
	
	
	var loadCount = 0;
	var scrollImgs = [];
	
	lazyImg.prototype = {
		init : function(options){
			var imgs = options.target.find('img');
			var _this = this;
			
			if(options.type === 'scroll'){
				scrollImgs = imgs;
				this.loadByScroll();
				$(window).unbind("scroll.lazyImg").bind("scroll.lazyImg", function(){
					_this.loadByScroll();
				})
			} else {
				this.load(imgs);
			}
		},
		
		load : function(imgs){
			var img;

			for( var i = 0, len = imgs.length; i < len; i++ ){
				img = $(imgs[i]);
				if (!!img.attr('data-src')){
            		img.attr("src", img.attr('data-src')).removeAttr("data-src");
				}
            }
		},
		
		loadByScroll : function(){
			var img;
			for( var i = 0, len = scrollImgs.length; i < len; i++ ){
				
				img = $(scrollImgs[i]);
				if (windowHeight() + scrollTop() >= img.offset().top){
					if (!!img.attr('data-src')){
						loadCount++;
						img.attr("src", img.attr('data-src')).removeAttr("data-src");
					}
					
					if (loadCount == scrollImgs.length){
						$(window).unbind("scroll.lazyImg");
					}
				}
            }
		}
	} 
	
	window.ue = window.ue || {};
	
	ue.lazyImg = function(options){
		return new lazyImg(options);
	}
})(jQuery);
/* /base/js/plugins/ZeroClipboard.js */
// Simple Set Clipboard System
// Author: Joseph Huckaby

var ZeroClipboard = {
	
	version: "1.0.7",
	clients: {}, // registered upload clients on page, indexed by id
	moviePath: 'http://s1.img4399.com/score/js/ZeroClipboard.swf?1769', // URL to movie
	nextId: 1, // ID of next movie
	
	$: function(thingy) {
		// simple DOM lookup utility function
		if (typeof(thingy) == 'string') thingy = document.getElementById(thingy);
		if (!thingy.addClass) {
			// extend element with a few useful methods
			thingy.hide = function() { this.style.display = 'none'; };
			thingy.show = function() { this.style.display = ''; };
			thingy.addClass = function(name) { this.removeClass(name); this.className += ' ' + name; };
			thingy.removeClass = function(name) {
				var classes = this.className.split(/\s+/);
				var idx = -1;
				for (var k = 0; k < classes.length; k++) {
					if (classes[k] == name) { idx = k; k = classes.length; }
				}
				if (idx > -1) {
					classes.splice( idx, 1 );
					this.className = classes.join(' ');
				}
				return this;
			};
			thingy.hasClass = function(name) {
				return !!this.className.match( new RegExp("\\s*" + name + "\\s*") );
			};
		}
		return thingy;
	},
	
	setMoviePath: function(path) {
		// set path to ZeroClipboard.swf
		this.moviePath = path;
	},
	
	dispatch: function(id, eventName, args) {
		// receive event from flash movie, send to client		
		var client = this.clients[id];
		if (client) {
			client.receiveEvent(eventName, args);
		}
	},
	
	register: function(id, client) {
		// register new client to receive events
		this.clients[id] = client;
	},
	
	getDOMObjectPosition: function(obj, stopObj) {
		// get absolute coordinates for dom element
		var info = {
			left: 0, 
			top: 0, 
			width: obj.width ? obj.width : obj.offsetWidth, 
			height: obj.height ? obj.height : obj.offsetHeight
		};

		while (obj && (obj != stopObj)) {
			info.left += obj.offsetLeft;
			info.top += obj.offsetTop;
			obj = obj.offsetParent;
		}

		return info;
	},
	
	Client: function(elem) {
		// constructor for new simple upload client
		this.handlers = {};
		
		// unique ID
		this.id = ZeroClipboard.nextId++;
		this.movieId = 'ZeroClipboardMovie_' + this.id;
		
		// register client with singleton to receive flash events
		ZeroClipboard.register(this.id, this);
		
		// create movie
		if (elem) this.glue(elem);
	}
};

ZeroClipboard.Client.prototype = {
	
	id: 0, // unique ID for us
	ready: false, // whether movie is ready to receive events or not
	movie: null, // reference to movie object
	clipText: '', // text to copy to clipboard
	handCursorEnabled: true, // whether to show hand cursor, or default pointer cursor
	cssEffects: true, // enable CSS mouse effects on dom container
	handlers: null, // user event handlers
	
	glue: function(elem, appendElem, stylesToAdd) {
		// glue to DOM element
		// elem can be ID or actual DOM element object
		this.domElement = ZeroClipboard.$(elem);
		
		// float just above object, or zIndex 99 if dom element isn't set
		var zIndex = 100000;
		if (this.domElement.style.zIndex) {
			zIndex = parseInt(this.domElement.style.zIndex, 10) + 1;
		}
		
		if (typeof(appendElem) == 'string') {
			appendElem = ZeroClipboard.$(appendElem);
		}
		else if (typeof(appendElem) == 'undefined') {
			appendElem = document.getElementsByTagName('body')[0];
		}
		
		// find X/Y position of domElement
		var box = ZeroClipboard.getDOMObjectPosition(this.domElement, appendElem);
		
		// create floating DIV above element
		this.div = document.createElement('div');
		var style = this.div.style;
		style.position = 'absolute';
		style.left = '' + box.left + 'px';
		style.top = '' + box.top + 'px';
		style.width = '' + box.width + 'px';
		style.height = '' + box.height + 'px';
		style.zIndex = zIndex;
		this.div.id = 'ZeroClipboard_hold' +  this.id;
		
		if (typeof(stylesToAdd) == 'object') {
			for (addedStyle in stylesToAdd) {
				style[addedStyle] = stylesToAdd[addedStyle];
			}
		}
		
		// style.backgroundColor = '#f00'; // debug
		
		appendElem.appendChild(this.div);
		
		this.div.innerHTML = this.getHTML( box.width, box.height );
	},
	
	getHTML: function(width, height) {
		// return HTML for movie
		var html = '';
		var flashvars = 'id=' + this.id + 
			'&width=' + width + 
			'&height=' + height;
			
		if (navigator.userAgent.match(/MSIE/)) {
			// IE gets an OBJECT tag
			var protocol = location.href.match(/^https/i) ? 'https://' : 'http://';
			html += '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="'+protocol+'download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="'+width+'" height="'+height+'" id="'+this.movieId+'" align="middle"><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="false" /><param name="movie" value="'+ZeroClipboard.moviePath+'" /><param name="loop" value="false" /><param name="menu" value="false" /><param name="quality" value="best" /><param name="bgcolor" value="#ffffff" /><param name="flashvars" value="'+flashvars+'"/><param name="wmode" value="transparent"/></object>';
		}
		else {
			// all other browsers get an EMBED tag
			html += '<embed id="'+this.movieId+'" src="'+ZeroClipboard.moviePath+'" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="'+width+'" height="'+height+'" name="'+this.movieId+'" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="'+flashvars+'" wmode="transparent" />';
		}
		return html;
	},
	
	hide: function() {
		// temporarily hide floater offscreen
		if (this.div) {
			this.div.style.left = '-2000px';
		}
	},
	
	show: function() {
		// show ourselves after a call to hide()
		this.reposition();
	},
	
	destroy: function() {
		// destroy control and floater
		if (this.domElement && this.div) {
			this.hide();
			this.div.innerHTML = '';
			
			var body = document.getElementsByTagName('body')[0];
			try { body.removeChild( this.div ); } catch(e) {;}
			
			this.domElement = null;
			this.div = null;
		}
	},
	
	reposition: function(elem) {
		// reposition our floating div, optionally to new container
		// warning: container CANNOT change size, only position
		if (elem) {
			this.domElement = ZeroClipboard.$(elem);
			if (!this.domElement) this.hide();
		}
		
		if (this.domElement && this.div) {
			var box = ZeroClipboard.getDOMObjectPosition(this.domElement);
			var style = this.div.style;
			style.left = '' + box.left + 'px';
			style.top = '' + box.top + 'px';
		}
	},
	
	setText: function(newText) {
		// set text to be copied to clipboard
		this.clipText = newText;
		if (this.ready) this.movie.setText(newText);
	},
	
	addEventListener: function(eventName, func) {
		// add user event listener for event
		// event types: load, queueStart, fileStart, fileComplete, queueComplete, progress, error, cancel
		eventName = eventName.toString().toLowerCase().replace(/^on/, '');
		if (!this.handlers[eventName]) this.handlers[eventName] = [];
		this.handlers[eventName].push(func);
	},
	
	setHandCursor: function(enabled) {
		// enable hand cursor (true), or default arrow cursor (false)
		this.handCursorEnabled = enabled;
		if (this.ready) this.movie.setHandCursor(enabled);
	},
	
	setCSSEffects: function(enabled) {
		// enable or disable CSS effects on DOM container
		this.cssEffects = !!enabled;
	},
	
	receiveEvent: function(eventName, args) {
		// receive event from flash
		eventName = eventName.toString().toLowerCase().replace(/^on/, '');
				
		// special behavior for certain events
		switch (eventName) {
			case 'load':
				// movie claims it is ready, but in IE this isn't always the case...
				// bug fix: Cannot extend EMBED DOM elements in Firefox, must use traditional function
				this.movie = document.getElementById(this.movieId);
				if (!this.movie) {
					var self = this;
					setTimeout( function() { self.receiveEvent('load', null); }, 1 );
					return;
				}
				
				// firefox on pc needs a "kick" in order to set these in certain cases
				if (!this.ready && navigator.userAgent.match(/Firefox/) && navigator.userAgent.match(/Windows/)) {
					var self = this;
					setTimeout( function() { self.receiveEvent('load', null); }, 100 );
					this.ready = true;
					return;
				}
				
				this.ready = true;
				this.movie.setText( this.clipText );
				this.movie.setHandCursor( this.handCursorEnabled );
				break;
			
			case 'mouseover':
				if (this.domElement && this.cssEffects) {
					this.domElement.addClass('hover');
					if (this.recoverActive) this.domElement.addClass('active');
				}
				break;
			
			case 'mouseout':
				if (this.domElement && this.cssEffects) {
					this.recoverActive = false;
					if (this.domElement.hasClass('active')) {
						this.domElement.removeClass('active');
						this.recoverActive = true;
					}
					this.domElement.removeClass('hover');
				}
				break;
			
			case 'mousedown':
				if (this.domElement && this.cssEffects) {
					this.domElement.addClass('active');
				}
				break;
			
			case 'mouseup':
				if (this.domElement && this.cssEffects) {
					this.domElement.removeClass('active');
					this.recoverActive = false;
				}
				break;
		} // switch eventName
		
		if (this.handlers[eventName]) {
			for (var idx = 0, len = this.handlers[eventName].length; idx < len; idx++) {
				var func = this.handlers[eventName][idx];
			
				if (typeof(func) == 'function') {
					// actual function reference
					func(this, args);
				}
				else if ((typeof(func) == 'object') && (func.length == 2)) {
					// PHP style object + method, i.e. [myObject, 'myMethod']
					func[0][ func[1] ](this, args);
				}
				else if (typeof(func) == 'string') {
					// name of function
					window[func](this, args);
				}
			} // foreach event handler defined
		} // user defined handler for event
	}
	
};

/* /base/js/plugins/ue.copy/ue.copy.js */
/**
 * To  : 复制组件
 * User: f2er
 * Date: 12-12-19
 * Time: 上午10:54
 * To change this template use File | Settings | File Templates.
 */
/*
* 需要ZeroClipboard.js
* */
(function($,win,undefined){
    function Copy(ops){
        var _default = {
            btnId :"",
            txtId : "",
			container : undefined,
            success : function(){alert("已复制到剪切板，可通过ctrl+v粘贴");}
        }
        this.options = options = $.extend(_default, ops);
        this.init();
		if (!this.is_init){
			ZeroClipboard.setMoviePath( 'http://s1.img4399.com/score/js/ZeroClipboard.swf?1769' ); //和copy.php不在同一目录需设置setMoviePath
        	//ZeroClipboard.setMoviePath( 'http://s1.img4399.com/score/js/ZeroClipboard10.swf?1769' );
			this.is_init = true;
		}
		
    }
	
	Copy.prototype.close = function(){
		$("#ZeroClipboard_hold" + this.clip.id).remove();
	};
	
	Copy.prototype.init = function (){
		var _this = this,
			options = this.options;
			
		var clip = this.clip = new ZeroClipboard.Client(); //创建新的Zero Clipboard对象
		clip.setText( '' ); // will be set later on mouseDown //清空剪贴板
		clip.setHandCursor( true ); //设置鼠标移到复制框时的形状
		clip.setCSSEffects( true ); //启用css
		clip.addEventListener( 'load', function(client) {
			// alert( "movie is loaded" );
		} );
		clip.addEventListener( 'complete', function(client, text) { //复制完成后的监听事件
			// alert("Copied text to clipboard: " + text );
			//clip.hide(); // 复制一次后，hide()使复制按钮失效，防止重复计算使用次数
			options.success(clip);
		} );
		clip.addEventListener( 'mouseOver', function(client) {
			// alert("mouse over");
		} );
		clip.addEventListener( 'mouseOut', function(client) {
			// alert("mouse out");
		} );
		clip.addEventListener( 'mouseDown', function(client) {
			// set text to copy here
			clip.setText( $("#"+options.txtId).val() || $("#"+options.txtId).text() );
			// alert("mouse down");
		} );
		clip.addEventListener( 'mouseUp', function(client) {
			// alert("mouse up");
			//alert("已复制到剪切板，可通过ctrl+v粘贴");
		} );
		clip.glue( options.btnId, options.container);
	}
    win.ue = win.ue || {};
    ue.copy = function(options){
		return new Copy(options);
	}
})(jQuery,window);

/* /base/js/plugins/ue.pager/ue.pager.js */
﻿(function(){
	/*简易模版函数*/
	function template(tmpl,json){
		if (typeof tmpl !== "string" || typeof json !== "object") return "";
		return tmpl.replace(/\@{([a-zA-Z_0-9\-]*)\}/g, function (all, key) {
			return typeof json[key] !== "undefined" ? json[key] : ""
		});
	}
	
	function ctor(options){
		var defaults = {
			//target : $(),//放置分页的元素
			pagerTarget : $(),
			formTarget : $(),
			first : '<a href="#" class="pager_first pager_item">首页</a>',
			firstDisabled : '<span class="pager_first pager_item">首页</span>',
			last : '<a href="#" class="pager_last pager_item">末页</a>',
			lastDisabled : '<span class="pager_last pager_item">末页</span>',
			prev : '<a href="#" class="pager_prev pager_item">上一页</a>',
			prevDisabled : '<span class="pager_prev pager_item">上一页</span>',
			next : '<a href="#" class="pager_next pager_item">下一页</a>',
			nextDisabled : '<span class="pager_next pager_item">下一页</span>',
			current : '<span class="pager_page pager_item pager_current">@{page}</span>',
			page : '<a href="#" class="pager_page pager_item">@{page}</a>',
			tip : '<span class="pager_item pager_tip">@{nowPage}/@{pageCount}</span>',
			goto : '<form><input class="pager_input"/><input type="submit" value="go" class="pager_goto"/></form>',
			gotobtn : ".pager_goto",
			input : ".pager_input",
			now : 1,//当前页
			maxPage : 5,//显示的最多页数
			per : 5,//每页显示的记录
			count : 0,//记录总计
			onchange : function(){}//切换页数回调函数}
		}
		
		
		this.options = options = $.extend(defaults, options);
		options.total = Math.ceil(options.count / options.per);
		this.init();
	}
	
	ctor.prototype = {
		init : function(){
			var _this = this,
				options = this.options,
				//target = options.target,
				pagerTarget = options.pagerTarget,
				formTarget = options.formTarget,
				now = options.now,
				total = options.total,
				maxPage = options.maxPage,
				end,start,
				$first = $(options.first),
				$firstDisabled = $(options.firstDisabled),
				$last = $(options.last),
				$lastDisabled = $(options.lastDisabled),
				$prev = $(options.prev),
				$prevDisabled = $(options.prevDisabled),
				$next = $(options.next),
				$nextDisabled = $(options.nextDisabled),
				$page = $(options.page),
				$current = $(options.current),
				$goto = $(options.goto),
				$temp;
			
			formTarget.html("");
			pagerTarget.html("");
			if(total <= 1) {
				return false;
			}

			if(now == 1){
				pagerTarget.append($firstDisabled.clone());
				pagerTarget.append($prevDisabled.clone());
			}else{
				pagerTarget.append($first.clone().attr("data-page", 1));
				pagerTarget.append($prev.clone().attr("data-page", now - 1));
			}
						
			if (now >= (maxPage -1)){
				end = now + 2;
			} else {
				end = maxPage;
			}
			
			if (end > total){
				end = total;
			}
			start = end - (maxPage -1);
			if (start < 1){
				start = 1;
			}
			for(var i = start; i <= end; i++){
				if(now == i){
					$temp = $current.clone();
					$temp.html(template($temp.html(), {page : i}));
					pagerTarget.append($temp);
				}else{
					$temp = $page.clone().attr("data-page", i);
					$temp.html(template($temp.html(), {page : i}));
					pagerTarget.append($temp);
				}
			}
				
			if(now == total){
				pagerTarget.append($nextDisabled.clone());
				pagerTarget.append($lastDisabled.clone());
			}else{
				pagerTarget.append($next.clone().attr("data-page", now + 1));
				pagerTarget.append($last.clone().attr("data-page", total));
			}
			
			pagerTarget.append(template(options.tip, {nowPage : now, pageCount : total}));
			formTarget.append($goto);
			
			pagerTarget.find("a").bind("click", function(){
				var p = parseInt($(this).attr("data-page"));
				if (isNaN(p)){
					p = parseInt($(this).parents("[data-page]").attr("data-page"));
				}
				options.onchange.call(_this, p);
				return false;
			})
			
			formTarget.find("form").submit = function(){return false};
			formTarget.find(options.gotobtn).bind("click", function(){
				var p = parseInt(formTarget.find(options.input).val());
				if (p < 1 || p > total || isNaN(p)){return false};
				options.onchange.call(_this, p);
				return false;
			})
		}
	}
	
	
	window.ue = window.ue || {};

	ue.pager = function(options){
		return new ctor(options);
	}
})();
/* /base/js/plugins/ue.share/ue.share.js */
/*邀请分享*/
(function(){
	var en = encodeURIComponent,
		options;
	
	function ctor(ops){
		var defaults = {
			target : $(),
			pop : $(),
			qzone : $(),
			tqq : $(),
			tsina : $(),
			copy : $(),
			input : $(),
			success : $(),
			success : $(),
			title : document.title,
			url : document.location.href,
			pic : ""
		}
		
		options = $.extend(defaults, ops);
		init();
	}
	
	window.ue = window.ue || {};
	
	var clip;
	var is_click = false;
	
	function init(){
		
		options.target.bind("click", function(){
			is_click = !is_click;
			if(is_click){
				show();
			} else {
				hide();
			}
			return false;
		});
		
		options.qzone.bind("click", function(){
			shareTo('qzone');
			return false;
		});
		
		options.tqq.bind("click", function(){
			shareTo('tqq');
			return false;
		});
		
		options.tsina.bind("click", function(){
			shareTo('tsina');
			return false;
		});
		
		options.input.val(options.url);
		
	}
	
	function show(){
		is_click = true;
		
		options.success.hide();
		$(document).unbind("click.share").bind("click.share", function(evt){
			
			var target = evt.target;
			
			if (target.id =='ZeroClipboardMovie_' + clip.id) return false;
			var $parent = $(target).parents(options.pop.selector);

			if ($parent.length == 0){
				is_click = false;
				checkHover();
			}

			return true;
		});
		
		options.pop.show();
		clip = new ZeroClipboard.Client(); 
		clip.setText(options.url); 
		clip.glue(options.copy[0]); 
		clip.addEventListener("complete", function(){
			options.success.show();
			setTimeout(function(){
				options.success.hide();
			},2000);
			return false;
		});
	}
		
	function hide(){	
		is_click = false;
		options.pop.hide();
		$("#ZeroClipboard_hold" + clip.id).remove();
	}
		
	function checkHover(){
		if(!is_click){
			is_click = false;
			hide();
		}
	}
		
	function shareTo(type){
		var w , h, left, top, share_url;
		
		if (type == 'qzone'){
			share_url = [
				'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=' + en(options.url),
				'&title=' + en(options.title),
				'&pics=' + en(options.pic),
				'&summary=' + en(options.title)
			].join('');
			
			w = 850;
			h = 650;
			
		} else if (type == 'tsina'){
			share_url = [
				'http://v.t.sina.com.cn/share/share.php?c=&url=' + en(options.url),
				'&title=' + en(options.title),
				'&content=utf8&pic=' + en(options.pic)
			].join('');
			
			w = 610;
			h = 570;
			
		} else if (type == 'tqq'){
			share_url=[
				'http://v.t.qq.com/share/share.php?site=' + en('www.4399.com'),
				'&url=' + en(options.url),
				'&title=' + en(options.title),
				'&pic=' + en(options.pic)
			].join('');
			
			w = 700;
			h = 470;
			
		}
			
		function shareCallback(){
			left = (screen.width - w) / 2;
			top = (screen.height - h) / 2;
			
			if(!window.open(share_url, type, [
					'toolbar=0,resizable=1,status=0,width=' + w,
					',height=' + h,
					',left=' + left ,
					',top=' + top
				].join(''))){
				location.href = share_url;
			}
		}
	
		if(/Firefox/.test(navigator.userAgent)){
			setTimeout(shareCallback,0);
		}else{
			shareCallback();
		}
	}
	
	ue.share = function(options){
		return ctor(options);//只有一个实例
	}	
})();
