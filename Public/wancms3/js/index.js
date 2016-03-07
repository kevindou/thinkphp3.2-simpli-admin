!
function(a, b, c) {
  var d = new c.Class(c.Widget);
  d.include({
    init: function(b) {
      this.options = {
        el: "body",
        tabs: "li",
        panels: "div",
        eventType: "click",
        index: 0,
        auto: !1,
        interval: 5e3,
        easing: "fadeIn",
        currentClass: "focus"
      },
      a.extend(this.options, b || {}),
      this.el = a(this.options.el),
      this.tabs = a(this.options.tabs, this.el),
      this.panels = a(this.options.panels, this.el),
      this.el.attr("data-kid", this.id),
      this.change(this.options.index),
      this._events(),
      this.options.auto && this.auto()
    },
    change: function(a) {
      var b = this.options.currentClass;
      this.tabs.filter("." + b).removeClass(b),
      this.tabs.eq(a).addClass(b),
      "fadeIn" == this.options.easing ? this.panels.hide().eq(a).fadeIn() : this.panels.hide().eq(a).show(),
      this.currentIndex = a,
      this.trigger("change", a, this)
    },
    _events: function() {
      this.tabs.bind(this.options.eventType, this.proxy(this._eventHandler)),
      this.options.auto && (this.tabs.bind("mouseenter", this.proxy(this.stop)), this.tabs.bind("mouseleave", this.proxy(this.auto)), this.panels.bind("mouseenter", this.proxy(this.stop)), this.panels.bind("mouseleave", this.proxy(this.auto)))
    },
    _eventHandler: function(a) {
      var b = a.currentTarget;
      if (! (b.className.indexOf(this.options.currentClass) > -1)) {
        var c = 0;
        return this.tabs.each(function(a) {
          return b === this ? (c = a, !1) : void 0
        }),
        this.change(c),
        !1
      }
    },
    auto: function() {
      this.timerId = b.setInterval(this.proxy(this._autoHandler), this.options.interval),
      this.trigger("auto", this)
    },
    _autoHandler: function() {
      var a = this.currentIndex + 1;
      a >= this.tabs.size() && (a = 0),
      this.change(a)
    },
    stop: function() {
      this.timerId && (b.clearInterval(this.timerId), this.trigger("stop", this))
    },
    _destroying: function() {
      this.stop(),
      this.el.removeAttr("data-kid"),
      this.tabs.unbind(this.options.eventType),
      this.panels.unbind()
    }
  }),
  c.Tab = d
} (jQuery, window, SQ),
function(a, b, c) {
  var d = new c.Class(c.Widget);
  d.include({
    init: function(b) {
      this.options = {
        el: "body",
        imgs: "img",
        srcName: "data-src",
        threshold: 50,
        loaded: "J_lazyloaded",
        error: function() {}
      },
      a.extend(this.options, b),
      this.el = a(this.options.el),
      this.imgs = a(this.options.imgs, this.el),
      this.el.attr("data-kid", this.id),
      this.load(),
      this._events()
    },
    _events: function() {
      a(b).scroll(this.proxy(this.load)),
      a(b).resize(this.proxy(this.load)),
      this.imgs.error(this.proxy(this._errorHandler))
    },
    _destroying: function() {
      this.el.removeAttr("data-kid"),
      this.imgs.unbind("error"),
      this.imgs.removeClass(this.options.loaded)
    },
    _inView: function(c) {
      var d = c.offset(),
      e = a(b).height(),
      f = a(b).scrollTop(),
      g = e + f + this.options.threshold;
      return g > d.top
    },
    load: function() {
      var b = this.imgs.filter(":visible").not("." + this.options.loaded),
      c = this;
      b.each(function() {
        var b = a(this);
        c._inView(b) && c.loadImg(b)
      })
    },
    loadImg: function(a) {
      a.attr("src", a.attr(this.options.srcName)),
      a.addClass(this.options.loaded),
      this.trigger("load", a)
    },
    _errorHandler: function(b) {
      var c = a(b.target);
      this.trigger("error", c),
      this.options.error && this.options.error(c)
    }
  }),
  c.Lazyload = d
} (jQuery, window, SQ),
function(a, b) {
  var c = b.Class(b.Widget);
  c.extend({
    template: '<style type="text/css">.t-corner-tip {{zIndex}display:none;position:fixed;bottom:0;right:0;width:260px;height:156px;border:1px solid #aca8a3;box-shadow:0 0 2px #fff;background:#fff url(http://img1.31wanimg.com/www/css/images/common/bg-cornertip.png) repeat-x;}.t-corner-tip h4 {position:relative;color:#3e3f3f;padding:8px;font-weight:normal;border-bottom:1px solid #b6e6f4;}.t-corner-tip h4 span {font-size:12px;color:#afa7a7;}.t-corner-tip h4 a {position:absolute;right:2px;top:5px;padding:2px 4px;}.t-corner-tip h4 a:hover {text-decoration:none;color:#ff9f4a;}.t-corner-tip-panel {color:#13677e;font-size:16px;padding:15px 10px 0;line-height:1.5;height:75px;}.t-corner-tip-prize {font-size:18px;text-align:right;padding-right:20px;}.t-corner-tip-panel span {color:#ff8700;}.t-corner-tip-footer {text-align:right;}.t-corner-tip-footer a {margin-right:30px;display:inline-block;color:#fff;text-align:center;width:85px;height:21px;line-height:21px;background:#fff url(http://img1.31wanimg.com/www/css/images/common/bg-cornertip-btn.png) no-repeat;}.t-corner-tip-footer a:hover {text-decoration:none;background-position:-85px 0;}* html,* html body {background-image:url(about:blank);background-attachment:fixed;}* html .t-corner-tip {position:absolute;right:auto;bottom:auto;left:expression(eval(document.documentElement.scrollLeft+document.documentElement.clientWidth-this.offsetWidth)-(parseInt(this.currentStyle.marginLeft,10)||0)-(parseInt(this.currentStyle.marginRight,10)||0));top:expression(eval(document.documentElement.scrollTop+document.documentElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||0)));}</style><div class="t-corner-tip"><h4>31wan页游平台欢迎您 <span><span>{count}</span>秒后关闭</span> <a href="javascript:;" title="关闭">X</a></h4><div class="t-corner-tip-panel"><p>恭喜您完成“<span>{task}</span>”任务任务，获得<span>{grade}</span>积分。</p></div><div class="t-corner-tip-footer"><a href="{url}" target="_blank" title="点击领取">点击领取>></a></div></div>'
  }),
  c.include({
    init: function(b) {
      var c = this.options = a.extend({},
      {
        auto: !0,
        count: 3,
        zIndex: 0,
        grade: "0",
        once: !1,
        url: "http://shop.31wan.com/task/",
        title: "默认值"
      },
      b);
      c.auto && this.show()
    },
    _parse: function() {
      var b = this,
      d = this.options,
      e = c.template.replace("{task}", d.title).replace("{url}", d.url).replace("{grade}", d.grade).replace("{count}", d.count).replace("{zIndex}", "z-index:" + d.zIndex + ";" || "");
      this.element = a(e).appendTo(document.body),
      this.tip = this.element.filter("div"),
      this.count = this.tip.find("h4 span:eq(1)"),
      this.tip.on("click", "h4 a",
      function(a) {
        a.preventDefault(),
        b.close()
      })
    },
    show: function() {
      this.isParse || this._parse();
      var a = this;
      this.tip.slideDown(),
      a.countTemp = a.options.count,
      a._countStart(),
      this.isShow = !0
    },
    _countStart: function() {
      var a = this;
      a.timer = setTimeout(function() {
        return a.countTemp < 0 ? (a.close(), void 0) : (a.count.text(a.countTemp--), a._countStart(), void 0)
      },
      1e3)
    },
    close: function() {
      var a = this;
      this.isShow && (clearTimeout(this.timer), this.tip.slideUp(function() {
        a.options.once && a.destroy()
      }), this.isShow = !1)
    },
    _destroying: function() {
      this.tip.off(),
      this.element.remove()
    }
  }),
  b.CornerTip = c
} (jQuery, SQ),
function(a, b) {
  "use strict";
  var c = {
    init: function() {
      new b.Lazyload({
        el: ".wrap"
      }),
      this.hotGame(),
      this.kv(a("#kv")),
      this.eventRecomGame(),
      this.serverType(),
      this.apiGiftData(),
      this.statis(),
      this.cornerTip.init()
    },
    hotGame: function() {
      var b = a(".hot-game-con").eq(0);
      b.length && b.on("mouseenter mouseleave", ".hot-game",
      function(b) {
        b.preventDefault(),
        a(this).toggleClass("focus")
      });
      var c = a(".ranking").eq(0);
      c.length && c.on("mouseenter mouseleave", "tr",
      function() {
        a(this).toggleClass("focus")
      })
    },
    kv: function(a) {
      if (a && a.length) {
        var c = new b.Tab({
          el: a,
          tabs: ".kv-num li",
          panels: ".kv-img>li",
          eventType: "mouseenter",
          auto: !0,
          interval: 3e3
        }),
        d = a.find(".kv-img img");
        c.bind("change",
        function(a) {
          if (a > 0) {
            var b = d.eq(a),
            c = b.attr("data-imgsrc"); ! b.data("lock") && c && b.attr("src", c).data("lock", "locked")
          }
        })
      }
    },
    serverType: function() {
      var c = a(".server-con");
      c && c.length && (new b.Tab({
        el: c,
        tabs: ".open-server-type li",
        panels: ".server-box",
        eventType: "mouseenter",
        auto: !1
      }), this.serverOpen(a(".server-box-1")), this.serverOpen(a(".server-box-2")), this.serverOpen(a(".server-box-3")))
    },
    serverOpen: function(b) {
      if (b.length) {
        var c = 1,
        d = b.find("div.s-table"),
        e = d.length,
        f = b.find("span.ser-page");
        b.on("click", ".server-change-tabs a",
        function() {
          var b, g = a(this).attr("data-server-change-tabs");
          b = "ser-next" == g ? c + 1 : c - 1,
          1 > b && (b = e),
          b > e && (b = 1),
          d.hide().eq(b - 1).show(),
          f.text(b + "/" + e),
          c = b
        }).on("mouseenter mouseleave", "tr.s-tab-con",
        function() {
          a(this).toggleClass("focus")
        })
      }
    },
    eventRecomGame: function() {
      var b = a(".rec-game-con");
      if (b.length) {
        var c = 241,
        d = 265;
        b.on("mouseenter", ".rec-g-img",
        function() {
          a(this).find(".rec-info").css({
            top: d + "px",
            opacity: 0
          }).animate({
            top: c + "px",
            opacity: 1
          },
          {
            queue: !1
          })
        }).on("mouseleave", ".rec-g-img",
        function() {
          a(this).find(".rec-info").animate({
            top: d + "px",
            opacity: 0
          },
          {
            queue: !1
          })
        })
      }
    },
    apiGiftData: function() {
      a.getJSON("http://www.3.com/gift/index.php?action=get_rank_list&count=4&r=" + Math.random()).done(function(c) {
        if ("ok" === c.code && c.data) {
          var d = a("#giftbag-tpl").html(),
          e = b.T(d, c.data);
          a("#giftbag-con").html(e)
        }
      })
    },
    statis: function() {
      var c, d = null,
      e = ["hao123", "baidu_kapian"],
      f = b.getParam("referer") || b.getParam("refer"),
      g = b.getParam("source"),
      h = this; (f || "gg_nav" === g) && (c = b.getParam("uid"), a.inArray(f, e) > -1 && (d = {
        item: "xn6kayeq18",
        position: f,
        ext_1: c
      }), a.getScript("http://ptres.31wan.com/js/sq/widget/sq.statis.js",
      function() {
        f && (b.Statis.setReferer([f, c], d), b.Top.bindUnLogin(function() {
          h._statis()
        })),
        "gg_nav" === g && (b.cookie("37bd_source", g), new b.Statis.Trigger.Load({
          item: "g0vsewlqo2"
        }))
      }))
    },
    _statis: function() {
      b.Top.getLogin() || b.Top.login.dialog.show(1)
    },
    cornerTip: {
      init: function() {
        b.Top.bindLogin(a.proxy(function() {
          var a = b.cookie("notice_31wan_com\\[13\\]", {
            encodeKey: !1
          });
          a ? (a = a.split("|"), a[0] !== b.Top.userInfo.LOGIN_ACCOUNT ? this._remote() : this._tip(a)) : this._remote()
        },
        this))
      },
      _remote: function() {
        var c = this;
        a.get("http://my.31wan.com/api/notice_api.php?action=is_reg_notice",
        function() {
          var a = b.cookie("notice_31wan_com\\[13\\]", {
            encodeKey: !1
          });
          a && c._tip(a.split("|"))
        },
        "jsonp")
      },
      _tip: function(a) { + a[1] && (new b.CornerTip({
          once: !0,
          count: 5,
          grade: a[2],
          title: a[3],
          zIndex: 50
        }), a[1] = 0, b.cookie("notice_31wan_com[13]", a.join("|"), {
          path: "/",
          domain: "31wan.com",
          encodeKey: !1
        }))
      }
    }
  };
  b && b.Top && (b.Top.cornerTip = c.cornerTip),
  c.init()
} (jQuery, SQ);