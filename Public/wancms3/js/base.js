!
function(a, b) {
  function c(a) {
    var b = ob[a] = {};
    return $.each(a.split(bb),
    function(a, c) {
      b[c] = !0
    }),
    b
  }
  function d(a, c, d) {
    if (d === b && 1 === a.nodeType) {
      var e = "data-" + c.replace(qb, "-$1").toLowerCase();
      if (d = a.getAttribute(e), "string" == typeof d) {
        try {
          d = "true" === d ? !0 : "false" === d ? !1 : "null" === d ? null: +d + "" === d ? +d: pb.test(d) ? $.parseJSON(d) : d
        } catch(f) {}
        $.data(a, c, d)
      } else d = b
    }
    return d
  }
  function e(a) {
    var b;
    for (b in a) if (("data" !== b || !$.isEmptyObject(a[b])) && "toJSON" !== b) return ! 1;
    return ! 0
  }
  function f() {
    return ! 1
  }
  function g() {
    return ! 0
  }
  function h(a) {
    return ! a || !a.parentNode || 11 === a.parentNode.nodeType
  }
  function i(a, b) {
    do a = a[b];
    while (a && 1 !== a.nodeType);
    return a
  }
  function j(a, b, c) {
    if (b = b || 0, $.isFunction(b)) return $.grep(a,
    function(a, d) {
      var e = !!b.call(a, d, a);
      return e === c
    });
    if (b.nodeType) return $.grep(a,
    function(a) {
      return a === b === c
    });
    if ("string" == typeof b) {
      var d = $.grep(a,
      function(a) {
        return 1 === a.nodeType
      });
      if (Kb.test(b)) return $.filter(b, d, !c);
      b = $.filter(b, d)
    }
    return $.grep(a,
    function(a) {
      return $.inArray(a, b) >= 0 === c
    })
  }
  function k(a) {
    var b = Nb.split("|"),
    c = a.createDocumentFragment();
    if (c.createElement) for (; b.length;) c.createElement(b.pop());
    return c
  }
  function l(a, b) {
    return a.getElementsByTagName(b)[0] || a.appendChild(a.ownerDocument.createElement(b))
  }
  function m(a, b) {
    if (1 === b.nodeType && $.hasData(a)) {
      var c, d, e, f = $._data(a),
      g = $._data(b, f),
      h = f.events;
      if (h) {
        delete g.handle,
        g.events = {};
        for (c in h) for (d = 0, e = h[c].length; e > d; d++) $.event.add(b, c, h[c][d])
      }
      g.data && (g.data = $.extend({},
      g.data))
    }
  }
  function n(a, b) {
    var c;
    1 === b.nodeType && (b.clearAttributes && b.clearAttributes(), b.mergeAttributes && b.mergeAttributes(a), c = b.nodeName.toLowerCase(), "object" === c ? (b.parentNode && (b.outerHTML = a.outerHTML), $.support.html5Clone && a.innerHTML && !$.trim(b.innerHTML) && (b.innerHTML = a.innerHTML)) : "input" === c && Xb.test(a.type) ? (b.defaultChecked = b.checked = a.checked, b.value !== a.value && (b.value = a.value)) : "option" === c ? b.selected = a.defaultSelected: "input" === c || "textarea" === c ? b.defaultValue = a.defaultValue: "script" === c && b.text !== a.text && (b.text = a.text), b.removeAttribute($.expando))
  }
  function o(a) {
    return "undefined" != typeof a.getElementsByTagName ? a.getElementsByTagName("*") : "undefined" != typeof a.querySelectorAll ? a.querySelectorAll("*") : []
  }
  function p(a) {
    Xb.test(a.type) && (a.defaultChecked = a.checked)
  }
  function q(a, b) {
    if (b in a) return b;
    for (var c = b.charAt(0).toUpperCase() + b.slice(1), d = b, e = rc.length; e--;) if (b = rc[e] + c, b in a) return b;
    return d
  }
  function r(a, b) {
    return a = b || a,
    "none" === $.css(a, "display") || !$.contains(a.ownerDocument, a)
  }
  function s(a, b) {
    for (var c, d, e = [], f = 0, g = a.length; g > f; f++) c = a[f],
    c.style && (e[f] = $._data(c, "olddisplay"), b ? (e[f] || "none" !== c.style.display || (c.style.display = ""), "" === c.style.display && r(c) && (e[f] = $._data(c, "olddisplay", w(c.nodeName)))) : (d = cc(c, "display"), e[f] || "none" === d || $._data(c, "olddisplay", d)));
    for (f = 0; g > f; f++) c = a[f],
    c.style && (b && "none" !== c.style.display && "" !== c.style.display || (c.style.display = b ? e[f] || "": "none"));
    return a
  }
  function t(a, b, c) {
    var d = kc.exec(b);
    return d ? Math.max(0, d[1] - (c || 0)) + (d[2] || "px") : b
  }
  function u(a, b, c, d) {
    for (var e = c === (d ? "border": "content") ? 4 : "width" === b ? 1 : 0, f = 0; 4 > e; e += 2)"margin" === c && (f += $.css(a, c + qc[e], !0)),
    d ? ("content" === c && (f -= parseFloat(cc(a, "padding" + qc[e])) || 0), "margin" !== c && (f -= parseFloat(cc(a, "border" + qc[e] + "Width")) || 0)) : (f += parseFloat(cc(a, "padding" + qc[e])) || 0, "padding" !== c && (f += parseFloat(cc(a, "border" + qc[e] + "Width")) || 0));
    return f
  }
  function v(a, b, c) {
    var d = "width" === b ? a.offsetWidth: a.offsetHeight,
    e = !0,
    f = $.support.boxSizing && "border-box" === $.css(a, "boxSizing");
    if (0 >= d || null == d) {
      if (d = cc(a, b), (0 > d || null == d) && (d = a.style[b]), lc.test(d)) return d;
      e = f && ($.support.boxSizingReliable || d === a.style[b]),
      d = parseFloat(d) || 0
    }
    return d + u(a, b, c || (f ? "border": "content"), e) + "px"
  }
  function w(a) {
    if (nc[a]) return nc[a];
    var b = $("<" + a + ">").appendTo(P.body),
    c = b.css("display");
    return b.remove(),
    ("none" === c || "" === c) && (dc = P.body.appendChild(dc || $.extend(P.createElement("iframe"), {
      frameBorder: 0,
      width: 0,
      height: 0
    })), ec && dc.createElement || (ec = (dc.contentWindow || dc.contentDocument).document, ec.write("<!doctype html><html><body>"), ec.close()), b = ec.body.appendChild(ec.createElement(a)), c = cc(b, "display"), P.body.removeChild(dc)),
    nc[a] = c,
    c
  }
  function x(a, b, c, d) {
    var e;
    if ($.isArray(b)) $.each(b,
    function(b, e) {
      c || uc.test(a) ? d(a, e) : x(a + "[" + ("object" == typeof e ? b: "") + "]", e, c, d)
    });
    else if (c || "object" !== $.type(b)) d(a, b);
    else for (e in b) x(a + "[" + e + "]", b[e], c, d)
  }
  function y(a) {
    return function(b, c) {
      "string" != typeof b && (c = b, b = "*");
      var d, e, f, g = b.toLowerCase().split(bb),
      h = 0,
      i = g.length;
      if ($.isFunction(c)) for (; i > h; h++) d = g[h],
      f = /^\+/.test(d),
      f && (d = d.substr(1) || "*"),
      e = a[d] = a[d] || [],
      e[f ? "unshift": "push"](c)
    }
  }
  function z(a, c, d, e, f, g) {
    f = f || c.dataTypes[0],
    g = g || {},
    g[f] = !0;
    for (var h, i = a[f], j = 0, k = i ? i.length: 0, l = a === Kc; k > j && (l || !h); j++) h = i[j](c, d, e),
    "string" == typeof h && (!l || g[h] ? h = b: (c.dataTypes.unshift(h), h = z(a, c, d, e, h, g)));
    return ! l && h || g["*"] || (h = z(a, c, d, e, "*", g)),
    h
  }
  function A(a, c) {
    var d, e, f = $.ajaxSettings.flatOptions || {};
    for (d in c) c[d] !== b && ((f[d] ? a: e || (e = {}))[d] = c[d]);
    e && $.extend(!0, a, e)
  }
  function B(a, c, d) {
    var e, f, g, h, i = a.contents,
    j = a.dataTypes,
    k = a.responseFields;
    for (f in k) f in d && (c[k[f]] = d[f]);
    for (;
    "*" === j[0];) j.shift(),
    e === b && (e = a.mimeType || c.getResponseHeader("content-type"));
    if (e) for (f in i) if (i[f] && i[f].test(e)) {
      j.unshift(f);
      break
    }
    if (j[0] in d) g = j[0];
    else {
      for (f in d) {
        if (!j[0] || a.converters[f + " " + j[0]]) {
          g = f;
          break
        }
        h || (h = f)
      }
      g = g || h
    }
    return g ? (g !== j[0] && j.unshift(g), d[g]) : void 0
  }
  function C(a, b) {
    var c, d, e, f, g = a.dataTypes.slice(),
    h = g[0],
    i = {},
    j = 0;
    if (a.dataFilter && (b = a.dataFilter(b, a.dataType)), g[1]) for (c in a.converters) i[c.toLowerCase()] = a.converters[c];
    for (; e = g[++j];) if ("*" !== e) {
      if ("*" !== h && h !== e) {
        if (c = i[h + " " + e] || i["* " + e], !c) for (d in i) if (f = d.split(" "), f[1] === e && (c = i[h + " " + f[0]] || i["* " + f[0]])) {
          c === !0 ? c = i[d] : i[d] !== !0 && (e = f[0], g.splice(j--, 0, e));
          break
        }
        if (c !== !0) if (c && a["throws"]) b = c(b);
        else try {
          b = c(b)
        } catch(k) {
          return {
            state: "parsererror",
            error: c ? k: "No conversion from " + h + " to " + e
          }
        }
      }
      h = e
    }
    return {
      state: "success",
      data: b
    }
  }
  function D() {
    try {
      return new a.XMLHttpRequest
    } catch(b) {}
  }
  function E() {
    try {
      return new a.ActiveXObject("Microsoft.XMLHTTP")
    } catch(b) {}
  }
  function F() {
    return setTimeout(function() {
      Vc = b
    },
    0),
    Vc = $.now()
  }
  function G(a, b) {
    $.each(b,
    function(b, c) {
      for (var d = (_c[b] || []).concat(_c["*"]), e = 0, f = d.length; f > e; e++) if (d[e].call(a, b, c)) return
    })
  }
  function H(a, b, c) {
    var d, e = 0,
    f = $c.length,
    g = $.Deferred().always(function() {
      delete h.elem
    }),
    h = function() {
      for (var b = Vc || F(), c = Math.max(0, i.startTime + i.duration - b), d = c / i.duration || 0, e = 1 - d, f = 0, h = i.tweens.length; h > f; f++) i.tweens[f].run(e);
      return g.notifyWith(a, [i, e, c]),
      1 > e && h ? c: (g.resolveWith(a, [i]), !1)
    },
    i = g.promise({
      elem: a,
      props: $.extend({},
      b),
      opts: $.extend(!0, {
        specialEasing: {}
      },
      c),
      originalProperties: b,
      originalOptions: c,
      startTime: Vc || F(),
      duration: c.duration,
      tweens: [],
      createTween: function(b, c) {
        var d = $.Tween(a, i.opts, b, c, i.opts.specialEasing[b] || i.opts.easing);
        return i.tweens.push(d),
        d
      },
      stop: function(b) {
        for (var c = 0,
        d = b ? i.tweens.length: 0; d > c; c++) i.tweens[c].run(1);
        return b ? g.resolveWith(a, [i, b]) : g.rejectWith(a, [i, b]),
        this
      }
    }),
    j = i.props;
    for (I(j, i.opts.specialEasing); f > e; e++) if (d = $c[e].call(i, a, j, i.opts)) return d;
    return G(i, j),
    $.isFunction(i.opts.start) && i.opts.start.call(a, i),
    $.fx.timer($.extend(h, {
      anim: i,
      queue: i.opts.queue,
      elem: a
    })),
    i.progress(i.opts.progress).done(i.opts.done, i.opts.complete).fail(i.opts.fail).always(i.opts.always)
  }
  function I(a, b) {
    var c, d, e, f, g;
    for (c in a) if (d = $.camelCase(c), e = b[d], f = a[c], $.isArray(f) && (e = f[1], f = a[c] = f[0]), c !== d && (a[d] = f, delete a[c]), g = $.cssHooks[d], g && "expand" in g) {
      f = g.expand(f),
      delete a[d];
      for (c in f) c in a || (a[c] = f[c], b[c] = e)
    } else b[d] = e
  }
  function J(a, b, c) {
    var d, e, f, g, h, i, j, k, l, m = this,
    n = a.style,
    o = {},
    p = [],
    q = a.nodeType && r(a);
    c.queue || (k = $._queueHooks(a, "fx"), null == k.unqueued && (k.unqueued = 0, l = k.empty.fire, k.empty.fire = function() {
      k.unqueued || l()
    }), k.unqueued++, m.always(function() {
      m.always(function() {
        k.unqueued--,
        $.queue(a, "fx").length || k.empty.fire()
      })
    })),
    1 === a.nodeType && ("height" in b || "width" in b) && (c.overflow = [n.overflow, n.overflowX, n.overflowY], "inline" === $.css(a, "display") && "none" === $.css(a, "float") && ($.support.inlineBlockNeedsLayout && "inline" !== w(a.nodeName) ? n.zoom = 1 : n.display = "inline-block")),
    c.overflow && (n.overflow = "hidden", $.support.shrinkWrapBlocks || m.done(function() {
      n.overflow = c.overflow[0],
      n.overflowX = c.overflow[1],
      n.overflowY = c.overflow[2]
    }));
    for (d in b) if (f = b[d], Xc.exec(f)) {
      if (delete b[d], i = i || "toggle" === f, f === (q ? "hide": "show")) continue;
      p.push(d)
    }
    if (g = p.length) {
      h = $._data(a, "fxshow") || $._data(a, "fxshow", {}),
      "hidden" in h && (q = h.hidden),
      i && (h.hidden = !q),
      q ? $(a).show() : m.done(function() {
        $(a).hide()
      }),
      m.done(function() {
        var b;
        $.removeData(a, "fxshow", !0);
        for (b in o) $.style(a, b, o[b])
      });
      for (d = 0; g > d; d++) e = p[d],
      j = m.createTween(e, q ? h[e] : 0),
      o[e] = h[e] || $.style(a, e),
      e in h || (h[e] = j.start, q && (j.end = j.start, j.start = "width" === e || "height" === e ? 1 : 0))
    }
  }
  function K(a, b, c, d, e) {
    return new K.prototype.init(a, b, c, d, e)
  }
  function L(a, b) {
    var c, d = {
      height: a
    },
    e = 0;
    for (b = b ? 1 : 0; 4 > e; e += 2 - b) c = qc[e],
    d["margin" + c] = d["padding" + c] = a;
    return b && (d.opacity = d.width = a),
    d
  }
  function M(a) {
    return $.isWindow(a) ? a: 9 === a.nodeType ? a.defaultView || a.parentWindow: !1
  }
  var N, O, P = a.document,
  Q = a.location,
  R = a.navigator,
  S = a.jQuery,
  T = a.$,
  U = Array.prototype.push,
  V = Array.prototype.slice,
  W = Array.prototype.indexOf,
  X = Object.prototype.toString,
  Y = Object.prototype.hasOwnProperty,
  Z = String.prototype.trim,
  $ = function(a, b) {
    return new $.fn.init(a, b, N)
  },
  _ = /[\-+]?(?:\d*\.|)\d+(?:[eE][\-+]?\d+|)/.source,
  ab = /\S/,
  bb = /\s+/,
  cb = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
  db = /^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/,
  eb = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
  fb = /^[\],:{}\s]*$/,
  gb = /(?:^|:|,)(?:\s*\[)+/g,
  hb = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,
  ib = /"[^"\\\r\n]*"|true|false|null|-?(?:\d\d*\.|)\d+(?:[eE][\-+]?\d+|)/g,
  jb = /^-ms-/,
  kb = /-([\da-z])/gi,
  lb = function(a, b) {
    return (b + "").toUpperCase()
  },
  mb = function() {
    P.addEventListener ? (P.removeEventListener("DOMContentLoaded", mb, !1), $.ready()) : "complete" === P.readyState && (P.detachEvent("onreadystatechange", mb), $.ready())
  },
  nb = {};
  $.fn = $.prototype = {
    constructor: $,
    init: function(a, c, d) {
      var e, f, g;
      if (!a) return this;
      if (a.nodeType) return this.context = this[0] = a,
      this.length = 1,
      this;
      if ("string" == typeof a) {
        if (e = "<" === a.charAt(0) && ">" === a.charAt(a.length - 1) && a.length >= 3 ? [null, a, null] : db.exec(a), !e || !e[1] && c) return ! c || c.jquery ? (c || d).find(a) : this.constructor(c).find(a);
        if (e[1]) return c = c instanceof $ ? c[0] : c,
        g = c && c.nodeType ? c.ownerDocument || c: P,
        a = $.parseHTML(e[1], g, !0),
        eb.test(e[1]) && $.isPlainObject(c) && this.attr.call(a, c, !0),
        $.merge(this, a);
        if (f = P.getElementById(e[2]), f && f.parentNode) {
          if (f.id !== e[2]) return d.find(a);
          this.length = 1,
          this[0] = f
        }
        return this.context = P,
        this.selector = a,
        this
      }
      return $.isFunction(a) ? d.ready(a) : (a.selector !== b && (this.selector = a.selector, this.context = a.context), $.makeArray(a, this))
    },
    selector: "",
    jquery: "1.8.3",
    length: 0,
    size: function() {
      return this.length
    },
    toArray: function() {
      return V.call(this)
    },
    get: function(a) {
      return null == a ? this.toArray() : 0 > a ? this[this.length + a] : this[a]
    },
    pushStack: function(a, b, c) {
      var d = $.merge(this.constructor(), a);
      return d.prevObject = this,
      d.context = this.context,
      "find" === b ? d.selector = this.selector + (this.selector ? " ": "") + c: b && (d.selector = this.selector + "." + b + "(" + c + ")"),
      d
    },
    each: function(a, b) {
      return $.each(this, a, b)
    },
    ready: function(a) {
      return $.ready.promise().done(a),
      this
    },
    eq: function(a) {
      return a = +a,
      -1 === a ? this.slice(a) : this.slice(a, a + 1)
    },
    first: function() {
      return this.eq(0)
    },
    last: function() {
      return this.eq( - 1)
    },
    slice: function() {
      return this.pushStack(V.apply(this, arguments), "slice", V.call(arguments).join(","))
    },
    map: function(a) {
      return this.pushStack($.map(this,
      function(b, c) {
        return a.call(b, c, b)
      }))
    },
    end: function() {
      return this.prevObject || this.constructor(null)
    },
    push: U,
    sort: [].sort,
    splice: [].splice
  },
  $.fn.init.prototype = $.fn,
  $.extend = $.fn.extend = function() {
    var a, c, d, e, f, g, h = arguments[0] || {},
    i = 1,
    j = arguments.length,
    k = !1;
    for ("boolean" == typeof h && (k = h, h = arguments[1] || {},
    i = 2), "object" == typeof h || $.isFunction(h) || (h = {}), j === i && (h = this, --i); j > i; i++) if (null != (a = arguments[i])) for (c in a) d = h[c],
    e = a[c],
    h !== e && (k && e && ($.isPlainObject(e) || (f = $.isArray(e))) ? (f ? (f = !1, g = d && $.isArray(d) ? d: []) : g = d && $.isPlainObject(d) ? d: {},
    h[c] = $.extend(k, g, e)) : e !== b && (h[c] = e));
    return h
  },
  $.extend({
    noConflict: function(b) {
      return a.$ === $ && (a.$ = T),
      b && a.jQuery === $ && (a.jQuery = S),
      $
    },
    isReady: !1,
    readyWait: 1,
    holdReady: function(a) {
      a ? $.readyWait++:$.ready(!0)
    },
    ready: function(a) {
      if (a === !0 ? !--$.readyWait: !$.isReady) {
        if (!P.body) return setTimeout($.ready, 1);
        $.isReady = !0,
        a !== !0 && --$.readyWait > 0 || (O.resolveWith(P, [$]), $.fn.trigger && $(P).trigger("ready").off("ready"))
      }
    },
    isFunction: function(a) {
      return "function" === $.type(a)
    },
    isArray: Array.isArray ||
    function(a) {
      return "array" === $.type(a)
    },
    isWindow: function(a) {
      return null != a && a == a.window
    },
    isNumeric: function(a) {
      return ! isNaN(parseFloat(a)) && isFinite(a)
    },
    type: function(a) {
      return null == a ? String(a) : nb[X.call(a)] || "object"
    },
    isPlainObject: function(a) {
      if (!a || "object" !== $.type(a) || a.nodeType || $.isWindow(a)) return ! 1;
      try {
        if (a.constructor && !Y.call(a, "constructor") && !Y.call(a.constructor.prototype, "isPrototypeOf")) return ! 1
      } catch(c) {
        return ! 1
      }
      var d;
      for (d in a);
      return d === b || Y.call(a, d)
    },
    isEmptyObject: function(a) {
      var b;
      for (b in a) return ! 1;
      return ! 0
    },
    error: function(a) {
      throw new Error(a)
    },
    parseHTML: function(a, b, c) {
      var d;
      return a && "string" == typeof a ? ("boolean" == typeof b && (c = b, b = 0), b = b || P, (d = eb.exec(a)) ? [b.createElement(d[1])] : (d = $.buildFragment([a], b, c ? null: []), $.merge([], (d.cacheable ? $.clone(d.fragment) : d.fragment).childNodes))) : null
    },
    parseJSON: function(b) {
      return b && "string" == typeof b ? (b = $.trim(b), a.JSON && a.JSON.parse ? a.JSON.parse(b) : fb.test(b.replace(hb, "@").replace(ib, "]").replace(gb, "")) ? new Function("return " + b)() : ($.error("Invalid JSON: " + b), void 0)) : null
    },
    parseXML: function(c) {
      var d, e;
      if (!c || "string" != typeof c) return null;
      try {
        a.DOMParser ? (e = new DOMParser, d = e.parseFromString(c, "text/xml")) : (d = new ActiveXObject("Microsoft.XMLDOM"), d.async = "false", d.loadXML(c))
      } catch(f) {
        d = b
      }
      return d && d.documentElement && !d.getElementsByTagName("parsererror").length || $.error("Invalid XML: " + c),
      d
    },
    noop: function() {},
    globalEval: function(b) {
      b && ab.test(b) && (a.execScript ||
      function(b) {
        a.eval.call(a, b)
      })(b)
    },
    camelCase: function(a) {
      return a.replace(jb, "ms-").replace(kb, lb)
    },
    nodeName: function(a, b) {
      return a.nodeName && a.nodeName.toLowerCase() === b.toLowerCase()
    },
    each: function(a, c, d) {
      var e, f = 0,
      g = a.length,
      h = g === b || $.isFunction(a);
      if (d) if (h) {
        for (e in a) if (c.apply(a[e], d) === !1) break
      } else for (; g > f && c.apply(a[f++], d) !== !1;);
      else if (h) {
        for (e in a) if (c.call(a[e], e, a[e]) === !1) break
      } else for (; g > f && c.call(a[f], f, a[f++]) !== !1;);
      return a
    },
    trim: Z && !Z.call("﻿ ") ?
    function(a) {
      return null == a ? "": Z.call(a)
    }: function(a) {
      return null == a ? "": (a + "").replace(cb, "")
    },
    makeArray: function(a, b) {
      var c, d = b || [];
      return null != a && (c = $.type(a), null == a.length || "string" === c || "function" === c || "regexp" === c || $.isWindow(a) ? U.call(d, a) : $.merge(d, a)),
      d
    },
    inArray: function(a, b, c) {
      var d;
      if (b) {
        if (W) return W.call(b, a, c);
        for (d = b.length, c = c ? 0 > c ? Math.max(0, d + c) : c: 0; d > c; c++) if (c in b && b[c] === a) return c
      }
      return - 1
    },
    merge: function(a, c) {
      var d = c.length,
      e = a.length,
      f = 0;
      if ("number" == typeof d) for (; d > f; f++) a[e++] = c[f];
      else for (; c[f] !== b;) a[e++] = c[f++];
      return a.length = e,
      a
    },
    grep: function(a, b, c) {
      var d, e = [],
      f = 0,
      g = a.length;
      for (c = !!c; g > f; f++) d = !!b(a[f], f),
      c !== d && e.push(a[f]);
      return e
    },
    map: function(a, c, d) {
      var e, f, g = [],
      h = 0,
      i = a.length,
      j = a instanceof $ || i !== b && "number" == typeof i && (i > 0 && a[0] && a[i - 1] || 0 === i || $.isArray(a));
      if (j) for (; i > h; h++) e = c(a[h], h, d),
      null != e && (g[g.length] = e);
      else for (f in a) e = c(a[f], f, d),
      null != e && (g[g.length] = e);
      return g.concat.apply([], g)
    },
    guid: 1,
    proxy: function(a, c) {
      var d, e, f;
      return "string" == typeof c && (d = a[c], c = a, a = d),
      $.isFunction(a) ? (e = V.call(arguments, 2), f = function() {
        return a.apply(c, e.concat(V.call(arguments)))
      },
      f.guid = a.guid = a.guid || $.guid++, f) : b
    },
    access: function(a, c, d, e, f, g, h) {
      var i, j = null == d,
      k = 0,
      l = a.length;
      if (d && "object" == typeof d) {
        for (k in d) $.access(a, c, k, d[k], 1, g, e);
        f = 1
      } else if (e !== b) {
        if (i = h === b && $.isFunction(e), j && (i ? (i = c, c = function(a, b, c) {
          return i.call($(a), c)
        }) : (c.call(a, e), c = null)), c) for (; l > k; k++) c(a[k], d, i ? e.call(a[k], k, c(a[k], d)) : e, h);
        f = 1
      }
      return f ? a: j ? c.call(a) : l ? c(a[0], d) : g
    },
    now: function() {
      return (new Date).getTime()
    }
  }),
  $.ready.promise = function(b) {
    if (!O) if (O = $.Deferred(), "complete" === P.readyState) setTimeout($.ready, 1);
    else if (P.addEventListener) P.addEventListener("DOMContentLoaded", mb, !1),
    a.addEventListener("load", $.ready, !1);
    else {
      P.attachEvent("onreadystatechange", mb),
      a.attachEvent("onload", $.ready);
      var c = !1;
      try {
        c = null == a.frameElement && P.documentElement
      } catch(d) {}
      c && c.doScroll && !
      function e() {
        if (!$.isReady) {
          try {
            c.doScroll("left")
          } catch(a) {
            return setTimeout(e, 50)
          }
          $.ready()
        }
      } ()
    }
    return O.promise(b)
  },
  $.each("Boolean Number String Function Array Date RegExp Object".split(" "),
  function(a, b) {
    nb["[object " + b + "]"] = b.toLowerCase()
  }),
  N = $(P);
  var ob = {};
  $.Callbacks = function(a) {
    a = "string" == typeof a ? ob[a] || c(a) : $.extend({},
    a);
    var d, e, f, g, h, i, j = [],
    k = !a.once && [],
    l = function(b) {
      for (d = a.memory && b, e = !0, i = g || 0, g = 0, h = j.length, f = !0; j && h > i; i++) if (j[i].apply(b[0], b[1]) === !1 && a.stopOnFalse) {
        d = !1;
        break
      }
      f = !1,
      j && (k ? k.length && l(k.shift()) : d ? j = [] : m.disable())
    },
    m = {
      add: function() {
        if (j) {
          var b = j.length; !
          function c(b) {
            $.each(b,
            function(b, d) {
              var e = $.type(d);
              "function" === e ? a.unique && m.has(d) || j.push(d) : d && d.length && "string" !== e && c(d)
            })
          } (arguments),
          f ? h = j.length: d && (g = b, l(d))
        }
        return this
      },
      remove: function() {
        return j && $.each(arguments,
        function(a, b) {
          for (var c; (c = $.inArray(b, j, c)) > -1;) j.splice(c, 1),
          f && (h >= c && h--, i >= c && i--)
        }),
        this
      },
      has: function(a) {
        return $.inArray(a, j) > -1
      },
      empty: function() {
        return j = [],
        this
      },
      disable: function() {
        return j = k = d = b,
        this
      },
      disabled: function() {
        return ! j
      },
      lock: function() {
        return k = b,
        d || m.disable(),
        this
      },
      locked: function() {
        return ! k
      },
      fireWith: function(a, b) {
        return b = b || [],
        b = [a, b.slice ? b.slice() : b],
        !j || e && !k || (f ? k.push(b) : l(b)),
        this
      },
      fire: function() {
        return m.fireWith(this, arguments),
        this
      },
      fired: function() {
        return !! e
      }
    };
    return m
  },
  $.extend({
    Deferred: function(a) {
      var b = [["resolve", "done", $.Callbacks("once memory"), "resolved"], ["reject", "fail", $.Callbacks("once memory"), "rejected"], ["notify", "progress", $.Callbacks("memory")]],
      c = "pending",
      d = {
        state: function() {
          return c
        },
        always: function() {
          return e.done(arguments).fail(arguments),
          this
        },
        then: function() {
          var a = arguments;
          return $.Deferred(function(c) {
            $.each(b,
            function(b, d) {
              var f = d[0],
              g = a[b];
              e[d[1]]($.isFunction(g) ?
              function() {
                var a = g.apply(this, arguments);
                a && $.isFunction(a.promise) ? a.promise().done(c.resolve).fail(c.reject).progress(c.notify) : c[f + "With"](this === e ? c: this, [a])
              }: c[f])
            }),
            a = null
          }).promise()
        },
        promise: function(a) {
          return null != a ? $.extend(a, d) : d
        }
      },
      e = {};
      return d.pipe = d.then,
      $.each(b,
      function(a, f) {
        var g = f[2],
        h = f[3];
        d[f[1]] = g.add,
        h && g.add(function() {
          c = h
        },
        b[1 ^ a][2].disable, b[2][2].lock),
        e[f[0]] = g.fire,
        e[f[0] + "With"] = g.fireWith
      }),
      d.promise(e),
      a && a.call(e, e),
      e
    },
    when: function(a) {
      var b, c, d, e = 0,
      f = V.call(arguments),
      g = f.length,
      h = 1 !== g || a && $.isFunction(a.promise) ? g: 0,
      i = 1 === h ? a: $.Deferred(),
      j = function(a, c, d) {
        return function(e) {
          c[a] = this,
          d[a] = arguments.length > 1 ? V.call(arguments) : e,
          d === b ? i.notifyWith(c, d) : --h || i.resolveWith(c, d)
        }
      };
      if (g > 1) for (b = new Array(g), c = new Array(g), d = new Array(g); g > e; e++) f[e] && $.isFunction(f[e].promise) ? f[e].promise().done(j(e, d, f)).fail(i.reject).progress(j(e, c, b)) : --h;
      return h || i.resolveWith(d, f),
      i.promise()
    }
  }),
  $.support = function() {
    var b, c, d, e, f, g, h, i, j, k, l, m = P.createElement("div");
    if (m.setAttribute("className", "t"), m.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", c = m.getElementsByTagName("*"), d = m.getElementsByTagName("a")[0], !c || !d || !c.length) return {};
    e = P.createElement("select"),
    f = e.appendChild(P.createElement("option")),
    g = m.getElementsByTagName("input")[0],
    d.style.cssText = "top:1px;float:left;opacity:.5",
    b = {
      leadingWhitespace: 3 === m.firstChild.nodeType,
      tbody: !m.getElementsByTagName("tbody").length,
      htmlSerialize: !!m.getElementsByTagName("link").length,
      style: /top/.test(d.getAttribute("style")),
      hrefNormalized: "/a" === d.getAttribute("href"),
      opacity: /^0.5/.test(d.style.opacity),
      cssFloat: !!d.style.cssFloat,
      checkOn: "on" === g.value,
      optSelected: f.selected,
      getSetAttribute: "t" !== m.className,
      enctype: !!P.createElement("form").enctype,
      html5Clone: "<:nav></:nav>" !== P.createElement("nav").cloneNode(!0).outerHTML,
      boxModel: "CSS1Compat" === P.compatMode,
      submitBubbles: !0,
      changeBubbles: !0,
      focusinBubbles: !1,
      deleteExpando: !0,
      noCloneEvent: !0,
      inlineBlockNeedsLayout: !1,
      shrinkWrapBlocks: !1,
      reliableMarginRight: !0,
      boxSizingReliable: !0,
      pixelPosition: !1
    },
    g.checked = !0,
    b.noCloneChecked = g.cloneNode(!0).checked,
    e.disabled = !0,
    b.optDisabled = !f.disabled;
    try {
      delete m.test
    } catch(n) {
      b.deleteExpando = !1
    }
    if (!m.addEventListener && m.attachEvent && m.fireEvent && (m.attachEvent("onclick", l = function() {
      b.noCloneEvent = !1
    }), m.cloneNode(!0).fireEvent("onclick"), m.detachEvent("onclick", l)), g = P.createElement("input"), g.value = "t", g.setAttribute("type", "radio"), b.radioValue = "t" === g.value, g.setAttribute("checked", "checked"), g.setAttribute("name", "t"), m.appendChild(g), h = P.createDocumentFragment(), h.appendChild(m.lastChild), b.checkClone = h.cloneNode(!0).cloneNode(!0).lastChild.checked, b.appendChecked = g.checked, h.removeChild(g), h.appendChild(m), m.attachEvent) for (j in {
      submit: !0,
      change: !0,
      focusin: !0
    }) i = "on" + j,
    k = i in m,
    k || (m.setAttribute(i, "return;"), k = "function" == typeof m[i]),
    b[j + "Bubbles"] = k;
    return $(function() {
      var c, d, e, f, g = "padding:0;margin:0;border:0;display:block;overflow:hidden;",
      h = P.getElementsByTagName("body")[0];
      h && (c = P.createElement("div"), c.style.cssText = "visibility:hidden;border:0;width:0;height:0;position:static;top:0;margin-top:1px", h.insertBefore(c, h.firstChild), d = P.createElement("div"), c.appendChild(d), d.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", e = d.getElementsByTagName("td"), e[0].style.cssText = "padding:0;margin:0;border:0;display:none", k = 0 === e[0].offsetHeight, e[0].style.display = "", e[1].style.display = "none", b.reliableHiddenOffsets = k && 0 === e[0].offsetHeight, d.innerHTML = "", d.style.cssText = "box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;", b.boxSizing = 4 === d.offsetWidth, b.doesNotIncludeMarginInBodyOffset = 1 !== h.offsetTop, a.getComputedStyle && (b.pixelPosition = "1%" !== (a.getComputedStyle(d, null) || {}).top, b.boxSizingReliable = "4px" === (a.getComputedStyle(d, null) || {
        width: "4px"
      }).width, f = P.createElement("div"), f.style.cssText = d.style.cssText = g, f.style.marginRight = f.style.width = "0", d.style.width = "1px", d.appendChild(f), b.reliableMarginRight = !parseFloat((a.getComputedStyle(f, null) || {}).marginRight)), "undefined" != typeof d.style.zoom && (d.innerHTML = "", d.style.cssText = g + "width:1px;padding:1px;display:inline;zoom:1", b.inlineBlockNeedsLayout = 3 === d.offsetWidth, d.style.display = "block", d.style.overflow = "visible", d.innerHTML = "<div></div>", d.firstChild.style.width = "5px", b.shrinkWrapBlocks = 3 !== d.offsetWidth, c.style.zoom = 1), h.removeChild(c), c = d = e = f = null)
    }),
    h.removeChild(m),
    c = d = e = f = g = h = m = null,
    b
  } ();
  var pb = /(?:\{[\s\S]*\}|\[[\s\S]*\])$/,
  qb = /([A-Z])/g;
  $.extend({
    cache: {},
    deletedIds: [],
    uuid: 0,
    expando: "jQuery" + ($.fn.jquery + Math.random()).replace(/\D/g, ""),
    noData: {
      embed: !0,
      object: "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",
      applet: !0
    },
    hasData: function(a) {
      return a = a.nodeType ? $.cache[a[$.expando]] : a[$.expando],
      !!a && !e(a)
    },
    data: function(a, c, d, e) {
      if ($.acceptData(a)) {
        var f, g, h = $.expando,
        i = "string" == typeof c,
        j = a.nodeType,
        k = j ? $.cache: a,
        l = j ? a[h] : a[h] && h;
        if (l && k[l] && (e || k[l].data) || !i || d !== b) return l || (j ? a[h] = l = $.deletedIds.pop() || $.guid++:l = h),
        k[l] || (k[l] = {},
        j || (k[l].toJSON = $.noop)),
        ("object" == typeof c || "function" == typeof c) && (e ? k[l] = $.extend(k[l], c) : k[l].data = $.extend(k[l].data, c)),
        f = k[l],
        e || (f.data || (f.data = {}), f = f.data),
        d !== b && (f[$.camelCase(c)] = d),
        i ? (g = f[c], null == g && (g = f[$.camelCase(c)])) : g = f,
        g
      }
    },
    removeData: function(a, b, c) {
      if ($.acceptData(a)) {
        var d, f, g, h = a.nodeType,
        i = h ? $.cache: a,
        j = h ? a[$.expando] : $.expando;
        if (i[j]) {
          if (b && (d = c ? i[j] : i[j].data)) {
            $.isArray(b) || (b in d ? b = [b] : (b = $.camelCase(b), b = b in d ? [b] : b.split(" ")));
            for (f = 0, g = b.length; g > f; f++) delete d[b[f]];
            if (! (c ? e: $.isEmptyObject)(d)) return
          } (c || (delete i[j].data, e(i[j]))) && (h ? $.cleanData([a], !0) : $.support.deleteExpando || i != i.window ? delete i[j] : i[j] = null)
        }
      }
    },
    _data: function(a, b, c) {
      return $.data(a, b, c, !0)
    },
    acceptData: function(a) {
      var b = a.nodeName && $.noData[a.nodeName.toLowerCase()];
      return ! b || b !== !0 && a.getAttribute("classid") === b
    }
  }),
  $.fn.extend({
    data: function(a, c) {
      var e, f, g, h, i, j = this[0],
      k = 0,
      l = null;
      if (a === b) {
        if (this.length && (l = $.data(j), 1 === j.nodeType && !$._data(j, "parsedAttrs"))) {
          for (g = j.attributes, i = g.length; i > k; k++) h = g[k].name,
          h.indexOf("data-") || (h = $.camelCase(h.substring(5)), d(j, h, l[h]));
          $._data(j, "parsedAttrs", !0)
        }
        return l
      }
      return "object" == typeof a ? this.each(function() {
        $.data(this, a)
      }) : (e = a.split(".", 2), e[1] = e[1] ? "." + e[1] : "", f = e[1] + "!", $.access(this,
      function(c) {
        return c === b ? (l = this.triggerHandler("getData" + f, [e[0]]), l === b && j && (l = $.data(j, a), l = d(j, a, l)), l === b && e[1] ? this.data(e[0]) : l) : (e[1] = c, this.each(function() {
          var b = $(this);
          b.triggerHandler("setData" + f, e),
          $.data(this, a, c),
          b.triggerHandler("changeData" + f, e)
        }), void 0)
      },
      null, c, arguments.length > 1, null, !1))
    },
    removeData: function(a) {
      return this.each(function() {
        $.removeData(this, a)
      })
    }
  }),
  $.extend({
    queue: function(a, b, c) {
      var d;
      return a ? (b = (b || "fx") + "queue", d = $._data(a, b), c && (!d || $.isArray(c) ? d = $._data(a, b, $.makeArray(c)) : d.push(c)), d || []) : void 0
    },
    dequeue: function(a, b) {
      b = b || "fx";
      var c = $.queue(a, b),
      d = c.length,
      e = c.shift(),
      f = $._queueHooks(a, b),
      g = function() {
        $.dequeue(a, b)
      };
      "inprogress" === e && (e = c.shift(), d--),
      e && ("fx" === b && c.unshift("inprogress"), delete f.stop, e.call(a, g, f)),
      !d && f && f.empty.fire()
    },
    _queueHooks: function(a, b) {
      var c = b + "queueHooks";
      return $._data(a, c) || $._data(a, c, {
        empty: $.Callbacks("once memory").add(function() {
          $.removeData(a, b + "queue", !0),
          $.removeData(a, c, !0)
        })
      })
    }
  }),
  $.fn.extend({
    queue: function(a, c) {
      var d = 2;
      return "string" != typeof a && (c = a, a = "fx", d--),
      arguments.length < d ? $.queue(this[0], a) : c === b ? this: this.each(function() {
        var b = $.queue(this, a, c);
        $._queueHooks(this, a),
        "fx" === a && "inprogress" !== b[0] && $.dequeue(this, a)
      })
    },
    dequeue: function(a) {
      return this.each(function() {
        $.dequeue(this, a)
      })
    },
    delay: function(a, b) {
      return a = $.fx ? $.fx.speeds[a] || a: a,
      b = b || "fx",
      this.queue(b,
      function(b, c) {
        var d = setTimeout(b, a);
        c.stop = function() {
          clearTimeout(d)
        }
      })
    },
    clearQueue: function(a) {
      return this.queue(a || "fx", [])
    },
    promise: function(a, c) {
      var d, e = 1,
      f = $.Deferred(),
      g = this,
      h = this.length,
      i = function() {--e || f.resolveWith(g, [g])
      };
      for ("string" != typeof a && (c = a, a = b), a = a || "fx"; h--;) d = $._data(g[h], a + "queueHooks"),
      d && d.empty && (e++, d.empty.add(i));
      return i(),
      f.promise(c)
    }
  });
  var rb, sb, tb, ub = /[\t\r\n]/g,
  vb = /\r/g,
  wb = /^(?:button|input)$/i,
  xb = /^(?:button|input|object|select|textarea)$/i,
  yb = /^a(?:rea|)$/i,
  zb = /^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,
  Ab = $.support.getSetAttribute;
  $.fn.extend({
    attr: function(a, b) {
      return $.access(this, $.attr, a, b, arguments.length > 1)
    },
    removeAttr: function(a) {
      return this.each(function() {
        $.removeAttr(this, a)
      })
    },
    prop: function(a, b) {
      return $.access(this, $.prop, a, b, arguments.length > 1)
    },
    removeProp: function(a) {
      return a = $.propFix[a] || a,
      this.each(function() {
        try {
          this[a] = b,
          delete this[a]
        } catch(c) {}
      })
    },
    addClass: function(a) {
      var b, c, d, e, f, g, h;
      if ($.isFunction(a)) return this.each(function(b) {
        $(this).addClass(a.call(this, b, this.className))
      });
      if (a && "string" == typeof a) for (b = a.split(bb), c = 0, d = this.length; d > c; c++) if (e = this[c], 1 === e.nodeType) if (e.className || 1 !== b.length) {
        for (f = " " + e.className + " ", g = 0, h = b.length; h > g; g++) f.indexOf(" " + b[g] + " ") < 0 && (f += b[g] + " ");
        e.className = $.trim(f)
      } else e.className = a;
      return this
    },
    removeClass: function(a) {
      var c, d, e, f, g, h, i;
      if ($.isFunction(a)) return this.each(function(b) {
        $(this).removeClass(a.call(this, b, this.className))
      });
      if (a && "string" == typeof a || a === b) for (c = (a || "").split(bb), h = 0, i = this.length; i > h; h++) if (e = this[h], 1 === e.nodeType && e.className) {
        for (d = (" " + e.className + " ").replace(ub, " "), f = 0, g = c.length; g > f; f++) for (; d.indexOf(" " + c[f] + " ") >= 0;) d = d.replace(" " + c[f] + " ", " ");
        e.className = a ? $.trim(d) : ""
      }
      return this
    },
    toggleClass: function(a, b) {
      var c = typeof a,
      d = "boolean" == typeof b;
      return $.isFunction(a) ? this.each(function(c) {
        $(this).toggleClass(a.call(this, c, this.className, b), b)
      }) : this.each(function() {
        if ("string" === c) for (var e, f = 0,
        g = $(this), h = b, i = a.split(bb); e = i[f++];) h = d ? h: !g.hasClass(e),
        g[h ? "addClass": "removeClass"](e);
        else("undefined" === c || "boolean" === c) && (this.className && $._data(this, "__className__", this.className), this.className = this.className || a === !1 ? "": $._data(this, "__className__") || "")
      })
    },
    hasClass: function(a) {
      for (var b = " " + a + " ",
      c = 0,
      d = this.length; d > c; c++) if (1 === this[c].nodeType && (" " + this[c].className + " ").replace(ub, " ").indexOf(b) >= 0) return ! 0;
      return ! 1
    },
    val: function(a) {
      var c, d, e, f = this[0]; {
        if (arguments.length) return e = $.isFunction(a),
        this.each(function(d) {
          var f, g = $(this);
          1 === this.nodeType && (f = e ? a.call(this, d, g.val()) : a, null == f ? f = "": "number" == typeof f ? f += "": $.isArray(f) && (f = $.map(f,
          function(a) {
            return null == a ? "": a + ""
          })), c = $.valHooks[this.type] || $.valHooks[this.nodeName.toLowerCase()], c && "set" in c && c.set(this, f, "value") !== b || (this.value = f))
        });
        if (f) return c = $.valHooks[f.type] || $.valHooks[f.nodeName.toLowerCase()],
        c && "get" in c && (d = c.get(f, "value")) !== b ? d: (d = f.value, "string" == typeof d ? d.replace(vb, "") : null == d ? "": d)
      }
    }
  }),
  $.extend({
    valHooks: {
      option: {
        get: function(a) {
          var b = a.attributes.value;
          return ! b || b.specified ? a.value: a.text
        }
      },
      select: {
        get: function(a) {
          for (var b, c, d = a.options,
          e = a.selectedIndex,
          f = "select-one" === a.type || 0 > e,
          g = f ? null: [], h = f ? e + 1 : d.length, i = 0 > e ? h: f ? e: 0; h > i; i++) if (c = d[i], !(!c.selected && i !== e || ($.support.optDisabled ? c.disabled: null !== c.getAttribute("disabled")) || c.parentNode.disabled && $.nodeName(c.parentNode, "optgroup"))) {
            if (b = $(c).val(), f) return b;
            g.push(b)
          }
          return g
        },
        set: function(a, b) {
          var c = $.makeArray(b);
          return $(a).find("option").each(function() {
            this.selected = $.inArray($(this).val(), c) >= 0
          }),
          c.length || (a.selectedIndex = -1),
          c
        }
      }
    },
    attrFn: {},
    attr: function(a, c, d, e) {
      var f, g, h, i = a.nodeType;
      if (a && 3 !== i && 8 !== i && 2 !== i) return e && $.isFunction($.fn[c]) ? $(a)[c](d) : "undefined" == typeof a.getAttribute ? $.prop(a, c, d) : (h = 1 !== i || !$.isXMLDoc(a), h && (c = c.toLowerCase(), g = $.attrHooks[c] || (zb.test(c) ? sb: rb)), d !== b ? null === d ? ($.removeAttr(a, c), void 0) : g && "set" in g && h && (f = g.set(a, d, c)) !== b ? f: (a.setAttribute(c, d + ""), d) : g && "get" in g && h && null !== (f = g.get(a, c)) ? f: (f = a.getAttribute(c), null === f ? b: f))
    },
    removeAttr: function(a, b) {
      var c, d, e, f, g = 0;
      if (b && 1 === a.nodeType) for (d = b.split(bb); g < d.length; g++) e = d[g],
      e && (c = $.propFix[e] || e, f = zb.test(e), f || $.attr(a, e, ""), a.removeAttribute(Ab ? e: c), f && c in a && (a[c] = !1))
    },
    attrHooks: {
      type: {
        set: function(a, b) {
          if (wb.test(a.nodeName) && a.parentNode) $.error("type property can't be changed");
          else if (!$.support.radioValue && "radio" === b && $.nodeName(a, "input")) {
            var c = a.value;
            return a.setAttribute("type", b),
            c && (a.value = c),
            b
          }
        }
      },
      value: {
        get: function(a, b) {
          return rb && $.nodeName(a, "button") ? rb.get(a, b) : b in a ? a.value: null
        },
        set: function(a, b, c) {
          return rb && $.nodeName(a, "button") ? rb.set(a, b, c) : (a.value = b, void 0)
        }
      }
    },
    propFix: {
      tabindex: "tabIndex",
      readonly: "readOnly",
      "for": "htmlFor",
      "class": "className",
      maxlength: "maxLength",
      cellspacing: "cellSpacing",
      cellpadding: "cellPadding",
      rowspan: "rowSpan",
      colspan: "colSpan",
      usemap: "useMap",
      frameborder: "frameBorder",
      contenteditable: "contentEditable"
    },
    prop: function(a, c, d) {
      var e, f, g, h = a.nodeType;
      if (a && 3 !== h && 8 !== h && 2 !== h) return g = 1 !== h || !$.isXMLDoc(a),
      g && (c = $.propFix[c] || c, f = $.propHooks[c]),
      d !== b ? f && "set" in f && (e = f.set(a, d, c)) !== b ? e: a[c] = d: f && "get" in f && null !== (e = f.get(a, c)) ? e: a[c]
    },
    propHooks: {
      tabIndex: {
        get: function(a) {
          var c = a.getAttributeNode("tabindex");
          return c && c.specified ? parseInt(c.value, 10) : xb.test(a.nodeName) || yb.test(a.nodeName) && a.href ? 0 : b
        }
      }
    }
  }),
  sb = {
    get: function(a, c) {
      var d, e = $.prop(a, c);
      return e === !0 || "boolean" != typeof e && (d = a.getAttributeNode(c)) && d.nodeValue !== !1 ? c.toLowerCase() : b
    },
    set: function(a, b, c) {
      var d;
      return b === !1 ? $.removeAttr(a, c) : (d = $.propFix[c] || c, d in a && (a[d] = !0), a.setAttribute(c, c.toLowerCase())),
      c
    }
  },
  Ab || (tb = {
    name: !0,
    id: !0,
    coords: !0
  },
  rb = $.valHooks.button = {
    get: function(a, c) {
      var d;
      return d = a.getAttributeNode(c),
      d && (tb[c] ? "" !== d.value: d.specified) ? d.value: b
    },
    set: function(a, b, c) {
      var d = a.getAttributeNode(c);
      return d || (d = P.createAttribute(c), a.setAttributeNode(d)),
      d.value = b + ""
    }
  },
  $.each(["width", "height"],
  function(a, b) {
    $.attrHooks[b] = $.extend($.attrHooks[b], {
      set: function(a, c) {
        return "" === c ? (a.setAttribute(b, "auto"), c) : void 0
      }
    })
  }), $.attrHooks.contenteditable = {
    get: rb.get,
    set: function(a, b, c) {
      "" === b && (b = "false"),
      rb.set(a, b, c)
    }
  }),
  $.support.hrefNormalized || $.each(["href", "src", "width", "height"],
  function(a, c) {
    $.attrHooks[c] = $.extend($.attrHooks[c], {
      get: function(a) {
        var d = a.getAttribute(c, 2);
        return null === d ? b: d
      }
    })
  }),
  $.support.style || ($.attrHooks.style = {
    get: function(a) {
      return a.style.cssText.toLowerCase() || b
    },
    set: function(a, b) {
      return a.style.cssText = b + ""
    }
  }),
  $.support.optSelected || ($.propHooks.selected = $.extend($.propHooks.selected, {
    get: function(a) {
      var b = a.parentNode;
      return b && (b.selectedIndex, b.parentNode && b.parentNode.selectedIndex),
      null
    }
  })),
  $.support.enctype || ($.propFix.enctype = "encoding"),
  $.support.checkOn || $.each(["radio", "checkbox"],
  function() {
    $.valHooks[this] = {
      get: function(a) {
        return null === a.getAttribute("value") ? "on": a.value
      }
    }
  }),
  $.each(["radio", "checkbox"],
  function() {
    $.valHooks[this] = $.extend($.valHooks[this], {
      set: function(a, b) {
        return $.isArray(b) ? a.checked = $.inArray($(a).val(), b) >= 0 : void 0
      }
    })
  });
  var Bb = /^(?:textarea|input|select)$/i,
  Cb = /^([^\.]*|)(?:\.(.+)|)$/,
  Db = /(?:^|\s)hover(\.\S+|)\b/,
  Eb = /^key/,
  Fb = /^(?:mouse|contextmenu)|click/,
  Gb = /^(?:focusinfocus|focusoutblur)$/,
  Hb = function(a) {
    return $.event.special.hover ? a: a.replace(Db, "mouseenter$1 mouseleave$1")
  };
  $.event = {
    add: function(a, c, d, e, f) {
      var g, h, i, j, k, l, m, n, o, p, q;
      if (3 !== a.nodeType && 8 !== a.nodeType && c && d && (g = $._data(a))) {
        for (d.handler && (o = d, d = o.handler, f = o.selector), d.guid || (d.guid = $.guid++), i = g.events, i || (g.events = i = {}), h = g.handle, h || (g.handle = h = function(a) {
          return "undefined" == typeof $ || a && $.event.triggered === a.type ? b: $.event.dispatch.apply(h.elem, arguments)
        },
        h.elem = a), c = $.trim(Hb(c)).split(" "), j = 0; j < c.length; j++) k = Cb.exec(c[j]) || [],
        l = k[1],
        m = (k[2] || "").split(".").sort(),
        q = $.event.special[l] || {},
        l = (f ? q.delegateType: q.bindType) || l,
        q = $.event.special[l] || {},
        n = $.extend({
          type: l,
          origType: k[1],
          data: e,
          handler: d,
          guid: d.guid,
          selector: f,
          needsContext: f && $.expr.match.needsContext.test(f),
          namespace: m.join(".")
        },
        o),
        p = i[l],
        p || (p = i[l] = [], p.delegateCount = 0, q.setup && q.setup.call(a, e, m, h) !== !1 || (a.addEventListener ? a.addEventListener(l, h, !1) : a.attachEvent && a.attachEvent("on" + l, h))),
        q.add && (q.add.call(a, n), n.handler.guid || (n.handler.guid = d.guid)),
        f ? p.splice(p.delegateCount++, 0, n) : p.push(n),
        $.event.global[l] = !0;
        a = null
      }
    },
    global: {},
    remove: function(a, b, c, d, e) {
      var f, g, h, i, j, k, l, m, n, o, p, q = $.hasData(a) && $._data(a);
      if (q && (m = q.events)) {
        for (b = $.trim(Hb(b || "")).split(" "), f = 0; f < b.length; f++) if (g = Cb.exec(b[f]) || [], h = i = g[1], j = g[2], h) {
          for (n = $.event.special[h] || {},
          h = (d ? n.delegateType: n.bindType) || h, o = m[h] || [], k = o.length, j = j ? new RegExp("(^|\\.)" + j.split(".").sort().join("\\.(?:.*\\.|)") + "(\\.|$)") : null, l = 0; l < o.length; l++) p = o[l],
          !e && i !== p.origType || c && c.guid !== p.guid || j && !j.test(p.namespace) || d && d !== p.selector && ("**" !== d || !p.selector) || (o.splice(l--, 1), p.selector && o.delegateCount--, n.remove && n.remove.call(a, p));
          0 === o.length && k !== o.length && (n.teardown && n.teardown.call(a, j, q.handle) !== !1 || $.removeEvent(a, h, q.handle), delete m[h])
        } else for (h in m) $.event.remove(a, h + b[f], c, d, !0);
        $.isEmptyObject(m) && (delete q.handle, $.removeData(a, "events", !0))
      }
    },
    customEvent: {
      getData: !0,
      setData: !0,
      changeData: !0
    },
    trigger: function(c, d, e, f) {
      if (!e || 3 !== e.nodeType && 8 !== e.nodeType) {
        var g, h, i, j, k, l, m, n, o, p, q = c.type || c,
        r = [];
        if (!Gb.test(q + $.event.triggered) && (q.indexOf("!") >= 0 && (q = q.slice(0, -1), h = !0), q.indexOf(".") >= 0 && (r = q.split("."), q = r.shift(), r.sort()), e && !$.event.customEvent[q] || $.event.global[q])) if (c = "object" == typeof c ? c[$.expando] ? c: new $.Event(q, c) : new $.Event(q), c.type = q, c.isTrigger = !0, c.exclusive = h, c.namespace = r.join("."), c.namespace_re = c.namespace ? new RegExp("(^|\\.)" + r.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, l = q.indexOf(":") < 0 ? "on" + q: "", e) {
          if (c.result = b, c.target || (c.target = e), d = null != d ? $.makeArray(d) : [], d.unshift(c), m = $.event.special[q] || {},
          !m.trigger || m.trigger.apply(e, d) !== !1) {
            if (o = [[e, m.bindType || q]], !f && !m.noBubble && !$.isWindow(e)) {
              for (p = m.delegateType || q, j = Gb.test(p + q) ? e: e.parentNode, k = e; j; j = j.parentNode) o.push([j, p]),
              k = j;
              k === (e.ownerDocument || P) && o.push([k.defaultView || k.parentWindow || a, p])
            }
            for (i = 0; i < o.length && !c.isPropagationStopped(); i++) j = o[i][0],
            c.type = o[i][1],
            n = ($._data(j, "events") || {})[c.type] && $._data(j, "handle"),
            n && n.apply(j, d),
            n = l && j[l],
            n && $.acceptData(j) && n.apply && n.apply(j, d) === !1 && c.preventDefault();
            return c.type = q,
            f || c.isDefaultPrevented() || m._default && m._default.apply(e.ownerDocument, d) !== !1 || "click" === q && $.nodeName(e, "a") || !$.acceptData(e) || l && e[q] && ("focus" !== q && "blur" !== q || 0 !== c.target.offsetWidth) && !$.isWindow(e) && (k = e[l], k && (e[l] = null), $.event.triggered = q, e[q](), $.event.triggered = b, k && (e[l] = k)),
            c.result
          }
        } else {
          g = $.cache;
          for (i in g) g[i].events && g[i].events[q] && $.event.trigger(c, d, g[i].handle.elem, !0)
        }
      }
    },
    dispatch: function(c) {
      c = $.event.fix(c || a.event);
      var d, e, f, g, h, i, j, k, l, m = ($._data(this, "events") || {})[c.type] || [],
      n = m.delegateCount,
      o = V.call(arguments),
      p = !c.exclusive && !c.namespace,
      q = $.event.special[c.type] || {},
      r = [];
      if (o[0] = c, c.delegateTarget = this, !q.preDispatch || q.preDispatch.call(this, c) !== !1) {
        if (n && (!c.button || "click" !== c.type)) for (f = c.target; f != this; f = f.parentNode || this) if (f.disabled !== !0 || "click" !== c.type) {
          for (h = {},
          j = [], d = 0; n > d; d++) k = m[d],
          l = k.selector,
          h[l] === b && (h[l] = k.needsContext ? $(l, this).index(f) >= 0 : $.find(l, this, null, [f]).length),
          h[l] && j.push(k);
          j.length && r.push({
            elem: f,
            matches: j
          })
        }
        for (m.length > n && r.push({
          elem: this,
          matches: m.slice(n)
        }), d = 0; d < r.length && !c.isPropagationStopped(); d++) for (i = r[d], c.currentTarget = i.elem, e = 0; e < i.matches.length && !c.isImmediatePropagationStopped(); e++) k = i.matches[e],
        (p || !c.namespace && !k.namespace || c.namespace_re && c.namespace_re.test(k.namespace)) && (c.data = k.data, c.handleObj = k, g = (($.event.special[k.origType] || {}).handle || k.handler).apply(i.elem, o), g !== b && (c.result = g, g === !1 && (c.preventDefault(), c.stopPropagation())));
        return q.postDispatch && q.postDispatch.call(this, c),
        c.result
      }
    },
    props: "attrChange attrName relatedNode srcElement altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
    fixHooks: {},
    keyHooks: {
      props: "char charCode key keyCode".split(" "),
      filter: function(a, b) {
        return null == a.which && (a.which = null != b.charCode ? b.charCode: b.keyCode),
        a
      }
    },
    mouseHooks: {
      props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
      filter: function(a, c) {
        var d, e, f, g = c.button,
        h = c.fromElement;
        return null == a.pageX && null != c.clientX && (d = a.target.ownerDocument || P, e = d.documentElement, f = d.body, a.pageX = c.clientX + (e && e.scrollLeft || f && f.scrollLeft || 0) - (e && e.clientLeft || f && f.clientLeft || 0), a.pageY = c.clientY + (e && e.scrollTop || f && f.scrollTop || 0) - (e && e.clientTop || f && f.clientTop || 0)),
        !a.relatedTarget && h && (a.relatedTarget = h === a.target ? c.toElement: h),
        a.which || g === b || (a.which = 1 & g ? 1 : 2 & g ? 3 : 4 & g ? 2 : 0),
        a
      }
    },
    fix: function(a) {
      if (a[$.expando]) return a;
      var b, c, d = a,
      e = $.event.fixHooks[a.type] || {},
      f = e.props ? this.props.concat(e.props) : this.props;
      for (a = $.Event(d), b = f.length; b;) c = f[--b],
      a[c] = d[c];
      return a.target || (a.target = d.srcElement || P),
      3 === a.target.nodeType && (a.target = a.target.parentNode),
      a.metaKey = !!a.metaKey,
      e.filter ? e.filter(a, d) : a
    },
    special: {
      load: {
        noBubble: !0
      },
      focus: {
        delegateType: "focusin"
      },
      blur: {
        delegateType: "focusout"
      },
      beforeunload: {
        setup: function(a, b, c) {
          $.isWindow(this) && (this.onbeforeunload = c)
        },
        teardown: function(a, b) {
          this.onbeforeunload === b && (this.onbeforeunload = null)
        }
      }
    },
    simulate: function(a, b, c, d) {
      var e = $.extend(new $.Event, c, {
        type: a,
        isSimulated: !0,
        originalEvent: {}
      });
      d ? $.event.trigger(e, null, b) : $.event.dispatch.call(b, e),
      e.isDefaultPrevented() && c.preventDefault()
    }
  },
  $.event.handle = $.event.dispatch,
  $.removeEvent = P.removeEventListener ?
  function(a, b, c) {
    a.removeEventListener && a.removeEventListener(b, c, !1)
  }: function(a, b, c) {
    var d = "on" + b;
    a.detachEvent && ("undefined" == typeof a[d] && (a[d] = null), a.detachEvent(d, c))
  },
  $.Event = function(a, b) {
    return this instanceof $.Event ? (a && a.type ? (this.originalEvent = a, this.type = a.type, this.isDefaultPrevented = a.defaultPrevented || a.returnValue === !1 || a.getPreventDefault && a.getPreventDefault() ? g: f) : this.type = a, b && $.extend(this, b), this.timeStamp = a && a.timeStamp || $.now(), this[$.expando] = !0, void 0) : new $.Event(a, b)
  },
  $.Event.prototype = {
    preventDefault: function() {
      this.isDefaultPrevented = g;
      var a = this.originalEvent;
      a && (a.preventDefault ? a.preventDefault() : a.returnValue = !1)
    },
    stopPropagation: function() {
      this.isPropagationStopped = g;
      var a = this.originalEvent;
      a && (a.stopPropagation && a.stopPropagation(), a.cancelBubble = !0)
    },
    stopImmediatePropagation: function() {
      this.isImmediatePropagationStopped = g,
      this.stopPropagation()
    },
    isDefaultPrevented: f,
    isPropagationStopped: f,
    isImmediatePropagationStopped: f
  },
  $.each({
    mouseenter: "mouseover",
    mouseleave: "mouseout"
  },
  function(a, b) {
    $.event.special[a] = {
      delegateType: b,
      bindType: b,
      handle: function(a) {
        {
          var c, d = this,
          e = a.relatedTarget,
          f = a.handleObj;
          f.selector
        }
        return (!e || e !== d && !$.contains(d, e)) && (a.type = f.origType, c = f.handler.apply(this, arguments), a.type = b),
        c
      }
    }
  }),
  $.support.submitBubbles || ($.event.special.submit = {
    setup: function() {
      return $.nodeName(this, "form") ? !1 : ($.event.add(this, "click._submit keypress._submit",
      function(a) {
        var c = a.target,
        d = $.nodeName(c, "input") || $.nodeName(c, "button") ? c.form: b;
        d && !$._data(d, "_submit_attached") && ($.event.add(d, "submit._submit",
        function(a) {
          a._submit_bubble = !0
        }), $._data(d, "_submit_attached", !0))
      }), void 0)
    },
    postDispatch: function(a) {
      a._submit_bubble && (delete a._submit_bubble, this.parentNode && !a.isTrigger && $.event.simulate("submit", this.parentNode, a, !0))
    },
    teardown: function() {
      return $.nodeName(this, "form") ? !1 : ($.event.remove(this, "._submit"), void 0)
    }
  }),
  $.support.changeBubbles || ($.event.special.change = {
    setup: function() {
      return Bb.test(this.nodeName) ? (("checkbox" === this.type || "radio" === this.type) && ($.event.add(this, "propertychange._change",
      function(a) {
        "checked" === a.originalEvent.propertyName && (this._just_changed = !0)
      }), $.event.add(this, "click._change",
      function(a) {
        this._just_changed && !a.isTrigger && (this._just_changed = !1),
        $.event.simulate("change", this, a, !0)
      })), !1) : ($.event.add(this, "beforeactivate._change",
      function(a) {
        var b = a.target;
        Bb.test(b.nodeName) && !$._data(b, "_change_attached") && ($.event.add(b, "change._change",
        function(a) { ! this.parentNode || a.isSimulated || a.isTrigger || $.event.simulate("change", this.parentNode, a, !0)
        }), $._data(b, "_change_attached", !0))
      }), void 0)
    },
    handle: function(a) {
      var b = a.target;
      return this !== b || a.isSimulated || a.isTrigger || "radio" !== b.type && "checkbox" !== b.type ? a.handleObj.handler.apply(this, arguments) : void 0
    },
    teardown: function() {
      return $.event.remove(this, "._change"),
      !Bb.test(this.nodeName)
    }
  }),
  $.support.focusinBubbles || $.each({
    focus: "focusin",
    blur: "focusout"
  },
  function(a, b) {
    var c = 0,
    d = function(a) {
      $.event.simulate(b, a.target, $.event.fix(a), !0)
    };
    $.event.special[b] = {
      setup: function() {
        0 === c++&&P.addEventListener(a, d, !0)
      },
      teardown: function() {
        0 === --c && P.removeEventListener(a, d, !0)
      }
    }
  }),
  $.fn.extend({
    on: function(a, c, d, e, g) {
      var h, i;
      if ("object" == typeof a) {
        "string" != typeof c && (d = d || c, c = b);
        for (i in a) this.on(i, c, d, a[i], g);
        return this
      }
      if (null == d && null == e ? (e = c, d = c = b) : null == e && ("string" == typeof c ? (e = d, d = b) : (e = d, d = c, c = b)), e === !1) e = f;
      else if (!e) return this;
      return 1 === g && (h = e, e = function(a) {
        return $().off(a),
        h.apply(this, arguments)
      },
      e.guid = h.guid || (h.guid = $.guid++)),
      this.each(function() {
        $.event.add(this, a, e, d, c)
      })
    },
    one: function(a, b, c, d) {
      return this.on(a, b, c, d, 1)
    },
    off: function(a, c, d) {
      var e, g;
      if (a && a.preventDefault && a.handleObj) return e = a.handleObj,
      $(a.delegateTarget).off(e.namespace ? e.origType + "." + e.namespace: e.origType, e.selector, e.handler),
      this;
      if ("object" == typeof a) {
        for (g in a) this.off(g, c, a[g]);
        return this
      }
      return (c === !1 || "function" == typeof c) && (d = c, c = b),
      d === !1 && (d = f),
      this.each(function() {
        $.event.remove(this, a, d, c)
      })
    },
    bind: function(a, b, c) {
      return this.on(a, null, b, c)
    },
    unbind: function(a, b) {
      return this.off(a, null, b)
    },
    live: function(a, b, c) {
      return $(this.context).on(a, this.selector, b, c),
      this
    },
    die: function(a, b) {
      return $(this.context).off(a, this.selector || "**", b),
      this
    },
    delegate: function(a, b, c, d) {
      return this.on(b, a, c, d)
    },
    undelegate: function(a, b, c) {
      return 1 === arguments.length ? this.off(a, "**") : this.off(b, a || "**", c)
    },
    trigger: function(a, b) {
      return this.each(function() {
        $.event.trigger(a, b, this)
      })
    },
    triggerHandler: function(a, b) {
      return this[0] ? $.event.trigger(a, b, this[0], !0) : void 0
    },
    toggle: function(a) {
      var b = arguments,
      c = a.guid || $.guid++,
      d = 0,
      e = function(c) {
        var e = ($._data(this, "lastToggle" + a.guid) || 0) % d;
        return $._data(this, "lastToggle" + a.guid, e + 1),
        c.preventDefault(),
        b[e].apply(this, arguments) || !1
      };
      for (e.guid = c; d < b.length;) b[d++].guid = c;
      return this.click(e)
    },
    hover: function(a, b) {
      return this.mouseenter(a).mouseleave(b || a)
    }
  }),
  $.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "),
  function(a, b) {
    $.fn[b] = function(a, c) {
      return null == c && (c = a, a = null),
      arguments.length > 0 ? this.on(b, null, a, c) : this.trigger(b)
    },
    Eb.test(b) && ($.event.fixHooks[b] = $.event.keyHooks),
    Fb.test(b) && ($.event.fixHooks[b] = $.event.mouseHooks)
  }),
  function(a, b) {
    function c(a, b, c, d) {
      c = c || [],
      b = b || F;
      var e, f, g, h, i = b.nodeType;
      if (!a || "string" != typeof a) return c;
      if (1 !== i && 9 !== i) return [];
      if (g = v(b), !g && !d && (e = cb.exec(a))) if (h = e[1]) {
        if (9 === i) {
          if (f = b.getElementById(h), !f || !f.parentNode) return c;
          if (f.id === h) return c.push(f),
          c
        } else if (b.ownerDocument && (f = b.ownerDocument.getElementById(h)) && w(b, f) && f.id === h) return c.push(f),
        c
      } else {
        if (e[2]) return K.apply(c, L.call(b.getElementsByTagName(a), 0)),
        c;
        if ((h = e[3]) && mb && b.getElementsByClassName) return K.apply(c, L.call(b.getElementsByClassName(h), 0)),
        c
      }
      return p(a.replace(Z, "$1"), b, c, d, g)
    }
    function d(a) {
      return function(b) {
        var c = b.nodeName.toLowerCase();
        return "input" === c && b.type === a
      }
    }
    function e(a) {
      return function(b) {
        var c = b.nodeName.toLowerCase();
        return ("input" === c || "button" === c) && b.type === a
      }
    }
    function f(a) {
      return N(function(b) {
        return b = +b,
        N(function(c, d) {
          for (var e, f = a([], c.length, b), g = f.length; g--;) c[e = f[g]] && (c[e] = !(d[e] = c[e]))
        })
      })
    }
    function g(a, b, c) {
      if (a === b) return c;
      for (var d = a.nextSibling; d;) {
        if (d === b) return - 1;
        d = d.nextSibling
      }
      return 1
    }
    function h(a, b) {
      var d, e, f, g, h, i, j, k = Q[D][a + " "];
      if (k) return b ? 0 : k.slice(0);
      for (h = a, i = [], j = t.preFilter; h;) { (!d || (e = _.exec(h))) && (e && (h = h.slice(e[0].length) || h), i.push(f = [])),
        d = !1,
        (e = ab.exec(h)) && (f.push(d = new E(e.shift())), h = h.slice(d.length), d.type = e[0].replace(Z, " "));
        for (g in t.filter) ! (e = hb[g].exec(h)) || j[g] && !(e = j[g](e)) || (f.push(d = new E(e.shift())), h = h.slice(d.length), d.type = g, d.matches = e);
        if (!d) break
      }
      return b ? h.length: h ? c.error(a) : Q(a, i).slice(0)
    }
    function i(a, b, c) {
      var d = b.dir,
      e = c && "parentNode" === b.dir,
      f = I++;
      return b.first ?
      function(b, c, f) {
        for (; b = b[d];) if (e || 1 === b.nodeType) return a(b, c, f)
      }: function(b, c, g) {
        if (g) {
          for (; b = b[d];) if ((e || 1 === b.nodeType) && a(b, c, g)) return b
        } else for (var h, i = H + " " + f + " ",
        j = i + r; b = b[d];) if (e || 1 === b.nodeType) {
          if ((h = b[D]) === j) return b.sizset;
          if ("string" == typeof h && 0 === h.indexOf(i)) {
            if (b.sizset) return b
          } else {
            if (b[D] = j, a(b, c, g)) return b.sizset = !0,
            b;
            b.sizset = !1
          }
        }
      }
    }
    function j(a) {
      return a.length > 1 ?
      function(b, c, d) {
        for (var e = a.length; e--;) if (!a[e](b, c, d)) return ! 1;
        return ! 0
      }: a[0]
    }
    function k(a, b, c, d, e) {
      for (var f, g = [], h = 0, i = a.length, j = null != b; i > h; h++)(f = a[h]) && (!c || c(f, d, e)) && (g.push(f), j && b.push(h));
      return g
    }
    function l(a, b, c, d, e, f) {
      return d && !d[D] && (d = l(d)),
      e && !e[D] && (e = l(e, f)),
      N(function(f, g, h, i) {
        var j, l, m, n = [],
        p = [],
        q = g.length,
        r = f || o(b || "*", h.nodeType ? [h] : h, []),
        s = !a || !f && b ? r: k(r, n, a, h, i),
        t = c ? e || (f ? a: q || d) ? [] : g: s;
        if (c && c(s, t, h, i), d) for (j = k(t, p), d(j, [], h, i), l = j.length; l--;)(m = j[l]) && (t[p[l]] = !(s[p[l]] = m));
        if (f) {
          if (e || a) {
            if (e) {
              for (j = [], l = t.length; l--;)(m = t[l]) && j.push(s[l] = m);
              e(null, t = [], j, i)
            }
            for (l = t.length; l--;)(m = t[l]) && (j = e ? M.call(f, m) : n[l]) > -1 && (f[j] = !(g[j] = m))
          }
        } else t = k(t === g ? t.splice(q, t.length) : t),
        e ? e(null, g, t, i) : K.apply(g, t)
      })
    }
    function m(a) {
      for (var b, c, d, e = a.length,
      f = t.relative[a[0].type], g = f || t.relative[" "], h = f ? 1 : 0, k = i(function(a) {
        return a === b
      },
      g, !0), n = i(function(a) {
        return M.call(b, a) > -1
      },
      g, !0), o = [function(a, c, d) {
        return ! f && (d || c !== A) || ((b = c).nodeType ? k(a, c, d) : n(a, c, d))
      }]; e > h; h++) if (c = t.relative[a[h].type]) o = [i(j(o), c)];
      else {
        if (c = t.filter[a[h].type].apply(null, a[h].matches), c[D]) {
          for (d = ++h; e > d && !t.relative[a[d].type]; d++);
          return l(h > 1 && j(o), h > 1 && a.slice(0, h - 1).join("").replace(Z, "$1"), c, d > h && m(a.slice(h, d)), e > d && m(a = a.slice(d)), e > d && a.join(""))
        }
        o.push(c)
      }
      return j(o)
    }
    function n(a, b) {
      var d = b.length > 0,
      e = a.length > 0,
      f = function(g, h, i, j, l) {
        var m, n, o, p = [],
        q = 0,
        s = "0",
        u = g && [],
        v = null != l,
        w = A,
        x = g || e && t.find.TAG("*", l && h.parentNode || h),
        y = H += null == w ? 1 : Math.E;
        for (v && (A = h !== F && h, r = f.el); null != (m = x[s]); s++) {
          if (e && m) {
            for (n = 0; o = a[n]; n++) if (o(m, h, i)) {
              j.push(m);
              break
            }
            v && (H = y, r = ++f.el)
          }
          d && ((m = !o && m) && q--, g && u.push(m))
        }
        if (q += s, d && s !== q) {
          for (n = 0; o = b[n]; n++) o(u, p, h, i);
          if (g) {
            if (q > 0) for (; s--;) u[s] || p[s] || (p[s] = J.call(j));
            p = k(p)
          }
          K.apply(j, p),
          v && !g && p.length > 0 && q + b.length > 1 && c.uniqueSort(j)
        }
        return v && (H = y, A = w),
        u
      };
      return f.el = 0,
      d ? N(f) : f
    }
    function o(a, b, d) {
      for (var e = 0,
      f = b.length; f > e; e++) c(a, b[e], d);
      return d
    }
    function p(a, b, c, d, e) {
      {
        var f, g, i, j, k, l = h(a);
        l.length
      }
      if (!d && 1 === l.length) {
        if (g = l[0] = l[0].slice(0), g.length > 2 && "ID" === (i = g[0]).type && 9 === b.nodeType && !e && t.relative[g[1].type]) {
          if (b = t.find.ID(i.matches[0].replace(gb, ""), b, e)[0], !b) return c;
          a = a.slice(g.shift().length)
        }
        for (f = hb.POS.test(a) ? -1 : g.length - 1; f >= 0 && (i = g[f], !t.relative[j = i.type]); f--) if ((k = t.find[j]) && (d = k(i.matches[0].replace(gb, ""), db.test(g[0].type) && b.parentNode || b, e))) {
          if (g.splice(f, 1), a = d.length && g.join(""), !a) return K.apply(c, L.call(d, 0)),
          c;
          break
        }
      }
      return x(a, l)(d, b, e, c, db.test(a)),
      c
    }
    function q() {}
    var r, s, t, u, v, w, x, y, z, A, B = !0,
    C = "undefined",
    D = ("sizcache" + Math.random()).replace(".", ""),
    E = String,
    F = a.document,
    G = F.documentElement,
    H = 0,
    I = 0,
    J = [].pop,
    K = [].push,
    L = [].slice,
    M = [].indexOf ||
    function(a) {
      for (var b = 0,
      c = this.length; c > b; b++) if (this[b] === a) return b;
      return - 1
    },
    N = function(a, b) {
      return a[D] = null == b || b,
      a
    },
    O = function() {
      var a = {},
      b = [];
      return N(function(c, d) {
        return b.push(c) > t.cacheLength && delete a[b.shift()],
        a[c + " "] = d
      },
      a)
    },
    P = O(),
    Q = O(),
    R = O(),
    S = "[\\x20\\t\\r\\n\\f]",
    T = "(?:\\\\.|[-\\w]|[^\\x00-\\xa0])+",
    U = T.replace("w", "w#"),
    V = "([*^$|!~]?=)",
    W = "\\[" + S + "*(" + T + ")" + S + "*(?:" + V + S + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + U + ")|)|)" + S + "*\\]",
    X = ":(" + T + ")(?:\\((?:(['\"])((?:\\\\.|[^\\\\])*?)\\2|([^()[\\]]*|(?:(?:" + W + ")|[^:]|\\\\.)*|.*))\\)|)",
    Y = ":(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + S + "*((?:-\\d)?\\d*)" + S + "*\\)|)(?=[^-]|$)",
    Z = new RegExp("^" + S + "+|((?:^|[^\\\\])(?:\\\\.)*)" + S + "+$", "g"),
    _ = new RegExp("^" + S + "*," + S + "*"),
    ab = new RegExp("^" + S + "*([\\x20\\t\\r\\n\\f>+~])" + S + "*"),
    bb = new RegExp(X),
    cb = /^(?:#([\w\-]+)|(\w+)|\.([\w\-]+))$/,
    db = /[\x20\t\r\n\f]*[+~]/,
    eb = /h\d/i,
    fb = /input|select|textarea|button/i,
    gb = /\\(?!\\)/g,
    hb = {
      ID: new RegExp("^#(" + T + ")"),
      CLASS: new RegExp("^\\.(" + T + ")"),
      NAME: new RegExp("^\\[name=['\"]?(" + T + ")['\"]?\\]"),
      TAG: new RegExp("^(" + T.replace("w", "w*") + ")"),
      ATTR: new RegExp("^" + W),
      PSEUDO: new RegExp("^" + X),
      POS: new RegExp(Y, "i"),
      CHILD: new RegExp("^:(only|nth|first|last)-child(?:\\(" + S + "*(even|odd|(([+-]|)(\\d*)n|)" + S + "*(?:([+-]|)" + S + "*(\\d+)|))" + S + "*\\)|)", "i"),
      needsContext: new RegExp("^" + S + "*[>+~]|" + Y, "i")
    },
    ib = function(a) {
      var b = F.createElement("div");
      try {
        return a(b)
      } catch(c) {
        return ! 1
      } finally {
        b = null
      }
    },
    jb = ib(function(a) {
      return a.appendChild(F.createComment("")),
      !a.getElementsByTagName("*").length
    }),
    kb = ib(function(a) {
      return a.innerHTML = "<a href='#'></a>",
      a.firstChild && typeof a.firstChild.getAttribute !== C && "#" === a.firstChild.getAttribute("href")
    }),
    lb = ib(function(a) {
      a.innerHTML = "<select></select>";
      var b = typeof a.lastChild.getAttribute("multiple");
      return "boolean" !== b && "string" !== b
    }),
    mb = ib(function(a) {
      return a.innerHTML = "<div class='hidden e'></div><div class='hidden'></div>",
      a.getElementsByClassName && a.getElementsByClassName("e").length ? (a.lastChild.className = "e", 2 === a.getElementsByClassName("e").length) : !1
    }),
    nb = ib(function(a) {
      a.id = D + 0,
      a.innerHTML = "<a name='" + D + "'></a><div name='" + D + "'></div>",
      G.insertBefore(a, G.firstChild);
      var b = F.getElementsByName && F.getElementsByName(D).length === 2 + F.getElementsByName(D + 0).length;
      return s = !F.getElementById(D),
      G.removeChild(a),
      b
    });
    try {
      L.call(G.childNodes, 0)[0].nodeType
    } catch(ob) {
      L = function(a) {
        for (var b, c = []; b = this[a]; a++) c.push(b);
        return c
      }
    }
    c.matches = function(a, b) {
      return c(a, null, null, b)
    },
    c.matchesSelector = function(a, b) {
      return c(b, null, null, [a]).length > 0
    },
    u = c.getText = function(a) {
      var b, c = "",
      d = 0,
      e = a.nodeType;
      if (e) {
        if (1 === e || 9 === e || 11 === e) {
          if ("string" == typeof a.textContent) return a.textContent;
          for (a = a.firstChild; a; a = a.nextSibling) c += u(a)
        } else if (3 === e || 4 === e) return a.nodeValue
      } else for (; b = a[d]; d++) c += u(b);
      return c
    },
    v = c.isXML = function(a) {
      var b = a && (a.ownerDocument || a).documentElement;
      return b ? "HTML" !== b.nodeName: !1
    },
    w = c.contains = G.contains ?
    function(a, b) {
      var c = 9 === a.nodeType ? a.documentElement: a,
      d = b && b.parentNode;
      return a === d || !!(d && 1 === d.nodeType && c.contains && c.contains(d))
    }: G.compareDocumentPosition ?
    function(a, b) {
      return b && !!(16 & a.compareDocumentPosition(b))
    }: function(a, b) {
      for (; b = b.parentNode;) if (b === a) return ! 0;
      return ! 1
    },
    c.attr = function(a, b) {
      var c, d = v(a);
      return d || (b = b.toLowerCase()),
      (c = t.attrHandle[b]) ? c(a) : d || lb ? a.getAttribute(b) : (c = a.getAttributeNode(b), c ? "boolean" == typeof a[b] ? a[b] ? b: null: c.specified ? c.value: null: null)
    },
    t = c.selectors = {
      cacheLength: 50,
      createPseudo: N,
      match: hb,
      attrHandle: kb ? {}: {
        href: function(a) {
          return a.getAttribute("href", 2)
        },
        type: function(a) {
          return a.getAttribute("type")
        }
      },
      find: {
        ID: s ?
        function(a, b, c) {
          if (typeof b.getElementById !== C && !c) {
            var d = b.getElementById(a);
            return d && d.parentNode ? [d] : []
          }
        }: function(a, c, d) {
          if (typeof c.getElementById !== C && !d) {
            var e = c.getElementById(a);
            return e ? e.id === a || typeof e.getAttributeNode !== C && e.getAttributeNode("id").value === a ? [e] : b: []
          }
        },
        TAG: jb ?
        function(a, b) {
          return typeof b.getElementsByTagName !== C ? b.getElementsByTagName(a) : void 0
        }: function(a, b) {
          var c = b.getElementsByTagName(a);
          if ("*" === a) {
            for (var d, e = [], f = 0; d = c[f]; f++) 1 === d.nodeType && e.push(d);
            return e
          }
          return c
        },
        NAME: nb &&
        function(a, b) {
          return typeof b.getElementsByName !== C ? b.getElementsByName(name) : void 0
        },
        CLASS: mb &&
        function(a, b, c) {
          return typeof b.getElementsByClassName === C || c ? void 0 : b.getElementsByClassName(a)
        }
      },
      relative: {
        ">": {
          dir: "parentNode",
          first: !0
        },
        " ": {
          dir: "parentNode"
        },
        "+": {
          dir: "previousSibling",
          first: !0
        },
        "~": {
          dir: "previousSibling"
        }
      },
      preFilter: {
        ATTR: function(a) {
          return a[1] = a[1].replace(gb, ""),
          a[3] = (a[4] || a[5] || "").replace(gb, ""),
          "~=" === a[2] && (a[3] = " " + a[3] + " "),
          a.slice(0, 4)
        },
        CHILD: function(a) {
          return a[1] = a[1].toLowerCase(),
          "nth" === a[1] ? (a[2] || c.error(a[0]), a[3] = +(a[3] ? a[4] + (a[5] || 1) : 2 * ("even" === a[2] || "odd" === a[2])), a[4] = +(a[6] + a[7] || "odd" === a[2])) : a[2] && c.error(a[0]),
          a
        },
        PSEUDO: function(a) {
          var b, c;
          return hb.CHILD.test(a[0]) ? null: (a[3] ? a[2] = a[3] : (b = a[4]) && (bb.test(b) && (c = h(b, !0)) && (c = b.indexOf(")", b.length - c) - b.length) && (b = b.slice(0, c), a[0] = a[0].slice(0, c)), a[2] = b), a.slice(0, 3))
        }
      },
      filter: {
        ID: s ?
        function(a) {
          return a = a.replace(gb, ""),
          function(b) {
            return b.getAttribute("id") === a
          }
        }: function(a) {
          return a = a.replace(gb, ""),
          function(b) {
            var c = typeof b.getAttributeNode !== C && b.getAttributeNode("id");
            return c && c.value === a
          }
        },
        TAG: function(a) {
          return "*" === a ?
          function() {
            return ! 0
          }: (a = a.replace(gb, "").toLowerCase(),
          function(b) {
            return b.nodeName && b.nodeName.toLowerCase() === a
          })
        },
        CLASS: function(a) {
          var b = P[D][a + " "];
          return b || (b = new RegExp("(^|" + S + ")" + a + "(" + S + "|$)")) && P(a,
          function(a) {
            return b.test(a.className || typeof a.getAttribute !== C && a.getAttribute("class") || "")
          })
        },
        ATTR: function(a, b, d) {
          return function(e) {
            var f = c.attr(e, a);
            return null == f ? "!=" === b: b ? (f += "", "=" === b ? f === d: "!=" === b ? f !== d: "^=" === b ? d && 0 === f.indexOf(d) : "*=" === b ? d && f.indexOf(d) > -1 : "$=" === b ? d && f.substr(f.length - d.length) === d: "~=" === b ? (" " + f + " ").indexOf(d) > -1 : "|=" === b ? f === d || f.substr(0, d.length + 1) === d + "-": !1) : !0
          }
        },
        CHILD: function(a, b, c, d) {
          return "nth" === a ?
          function(a) {
            var b, e, f = a.parentNode;
            if (1 === c && 0 === d) return ! 0;
            if (f) for (e = 0, b = f.firstChild; b && (1 !== b.nodeType || (e++, a !== b)); b = b.nextSibling);
            return e -= d,
            e === c || e % c === 0 && e / c >= 0
          }: function(b) {
            var c = b;
            switch (a) {
            case "only":
            case "first":
              for (; c = c.previousSibling;) if (1 === c.nodeType) return ! 1;
              if ("first" === a) return ! 0;
              c = b;
            case "last":
              for (; c = c.nextSibling;) if (1 === c.nodeType) return ! 1;
              return ! 0
            }
          }
        },
        PSEUDO: function(a, b) {
          var d, e = t.pseudos[a] || t.setFilters[a.toLowerCase()] || c.error("unsupported pseudo: " + a);
          return e[D] ? e(b) : e.length > 1 ? (d = [a, a, "", b], t.setFilters.hasOwnProperty(a.toLowerCase()) ? N(function(a, c) {
            for (var d, f = e(a, b), g = f.length; g--;) d = M.call(a, f[g]),
            a[d] = !(c[d] = f[g])
          }) : function(a) {
            return e(a, 0, d)
          }) : e
        }
      },
      pseudos: {
        not: N(function(a) {
          var b = [],
          c = [],
          d = x(a.replace(Z, "$1"));
          return d[D] ? N(function(a, b, c, e) {
            for (var f, g = d(a, null, e, []), h = a.length; h--;)(f = g[h]) && (a[h] = !(b[h] = f))
          }) : function(a, e, f) {
            return b[0] = a,
            d(b, null, f, c),
            !c.pop()
          }
        }),
        has: N(function(a) {
          return function(b) {
            return c(a, b).length > 0
          }
        }),
        contains: N(function(a) {
          return function(b) {
            return (b.textContent || b.innerText || u(b)).indexOf(a) > -1
          }
        }),
        enabled: function(a) {
          return a.disabled === !1
        },
        disabled: function(a) {
          return a.disabled === !0
        },
        checked: function(a) {
          var b = a.nodeName.toLowerCase();
          return "input" === b && !!a.checked || "option" === b && !!a.selected
        },
        selected: function(a) {
          return a.parentNode && a.parentNode.selectedIndex,
          a.selected === !0
        },
        parent: function(a) {
          return ! t.pseudos.empty(a)
        },
        empty: function(a) {
          var b;
          for (a = a.firstChild; a;) {
            if (a.nodeName > "@" || 3 === (b = a.nodeType) || 4 === b) return ! 1;
            a = a.nextSibling
          }
          return ! 0
        },
        header: function(a) {
          return eb.test(a.nodeName)
        },
        text: function(a) {
          var b, c;
          return "input" === a.nodeName.toLowerCase() && "text" === (b = a.type) && (null == (c = a.getAttribute("type")) || c.toLowerCase() === b)
        },
        radio: d("radio"),
        checkbox: d("checkbox"),
        file: d("file"),
        password: d("password"),
        image: d("image"),
        submit: e("submit"),
        reset: e("reset"),
        button: function(a) {
          var b = a.nodeName.toLowerCase();
          return "input" === b && "button" === a.type || "button" === b
        },
        input: function(a) {
          return fb.test(a.nodeName)
        },
        focus: function(a) {
          var b = a.ownerDocument;
          return a === b.activeElement && (!b.hasFocus || b.hasFocus()) && !!(a.type || a.href || ~a.tabIndex)
        },
        active: function(a) {
          return a === a.ownerDocument.activeElement
        },
        first: f(function() {
          return [0]
        }),
        last: f(function(a, b) {
          return [b - 1]
        }),
        eq: f(function(a, b, c) {
          return [0 > c ? c + b: c]
        }),
        even: f(function(a, b) {
          for (var c = 0; b > c; c += 2) a.push(c);
          return a
        }),
        odd: f(function(a, b) {
          for (var c = 1; b > c; c += 2) a.push(c);
          return a
        }),
        lt: f(function(a, b, c) {
          for (var d = 0 > c ? c + b: c; --d >= 0;) a.push(d);
          return a
        }),
        gt: f(function(a, b, c) {
          for (var d = 0 > c ? c + b: c; ++d < b;) a.push(d);
          return a
        })
      }
    },
    y = G.compareDocumentPosition ?
    function(a, b) {
      return a === b ? (z = !0, 0) : (a.compareDocumentPosition && b.compareDocumentPosition ? 4 & a.compareDocumentPosition(b) : a.compareDocumentPosition) ? -1 : 1
    }: function(a, b) {
      if (a === b) return z = !0,
      0;
      if (a.sourceIndex && b.sourceIndex) return a.sourceIndex - b.sourceIndex;
      var c, d, e = [],
      f = [],
      h = a.parentNode,
      i = b.parentNode,
      j = h;
      if (h === i) return g(a, b);
      if (!h) return - 1;
      if (!i) return 1;
      for (; j;) e.unshift(j),
      j = j.parentNode;
      for (j = i; j;) f.unshift(j),
      j = j.parentNode;
      c = e.length,
      d = f.length;
      for (var k = 0; c > k && d > k; k++) if (e[k] !== f[k]) return g(e[k], f[k]);
      return k === c ? g(a, f[k], -1) : g(e[k], b, 1)
    },
    [0, 0].sort(y),
    B = !z,
    c.uniqueSort = function(a) {
      var b, c = [],
      d = 1,
      e = 0;
      if (z = B, a.sort(y), z) {
        for (; b = a[d]; d++) b === a[d - 1] && (e = c.push(d));
        for (; e--;) a.splice(c[e], 1)
      }
      return a
    },
    c.error = function(a) {
      throw new Error("Syntax error, unrecognized expression: " + a)
    },
    x = c.compile = function(a, b) {
      var c, d = [],
      e = [],
      f = R[D][a + " "];
      if (!f) {
        for (b || (b = h(a)), c = b.length; c--;) f = m(b[c]),
        f[D] ? d.push(f) : e.push(f);
        f = R(a, n(e, d))
      }
      return f
    },
    F.querySelectorAll && !
    function() {
      var a, b = p,
      d = /'|\\/g,
      e = /\=[\x20\t\r\n\f]*([^'"\]]*)[\x20\t\r\n\f]*\]/g,
      f = [":focus"],
      g = [":active"],
      i = G.matchesSelector || G.mozMatchesSelector || G.webkitMatchesSelector || G.oMatchesSelector || G.msMatchesSelector;
      ib(function(a) {
        a.innerHTML = "<select><option selected=''></option></select>",
        a.querySelectorAll("[selected]").length || f.push("\\[" + S + "*(?:checked|disabled|ismap|multiple|readonly|selected|value)"),
        a.querySelectorAll(":checked").length || f.push(":checked")
      }),
      ib(function(a) {
        a.innerHTML = "<p test=''></p>",
        a.querySelectorAll("[test^='']").length && f.push("[*^$]=" + S + "*(?:\"\"|'')"),
        a.innerHTML = "<input type='hidden'/>",
        a.querySelectorAll(":enabled").length || f.push(":enabled", ":disabled")
      }),
      f = new RegExp(f.join("|")),
      p = function(a, c, e, g, i) {
        if (!g && !i && !f.test(a)) {
          var j, k, l = !0,
          m = D,
          n = c,
          o = 9 === c.nodeType && a;
          if (1 === c.nodeType && "object" !== c.nodeName.toLowerCase()) {
            for (j = h(a), (l = c.getAttribute("id")) ? m = l.replace(d, "\\$&") : c.setAttribute("id", m), m = "[id='" + m + "'] ", k = j.length; k--;) j[k] = m + j[k].join("");
            n = db.test(a) && c.parentNode || c,
            o = j.join(",")
          }
          if (o) try {
            return K.apply(e, L.call(n.querySelectorAll(o), 0)),
            e
          } catch(p) {} finally {
            l || c.removeAttribute("id")
          }
        }
        return b(a, c, e, g, i)
      },
      i && (ib(function(b) {
        a = i.call(b, "div");
        try {
          i.call(b, "[test!='']:sizzle"),
          g.push("!=", X)
        } catch(c) {}
      }), g = new RegExp(g.join("|")), c.matchesSelector = function(b, d) {
        if (d = d.replace(e, "='$1']"), !v(b) && !g.test(d) && !f.test(d)) try {
          var h = i.call(b, d);
          if (h || a || b.document && 11 !== b.document.nodeType) return h
        } catch(j) {}
        return c(d, null, null, [b]).length > 0
      })
    } (),
    t.pseudos.nth = t.pseudos.eq,
    t.filters = q.prototype = t.pseudos,
    t.setFilters = new q,
    c.attr = $.attr,
    $.find = c,
    $.expr = c.selectors,
    $.expr[":"] = $.expr.pseudos,
    $.unique = c.uniqueSort,
    $.text = c.getText,
    $.isXMLDoc = c.isXML,
    $.contains = c.contains
  } (a);
  var Ib = /Until$/,
  Jb = /^(?:parents|prev(?:Until|All))/,
  Kb = /^.[^:#\[\.,]*$/,
  Lb = $.expr.match.needsContext,
  Mb = {
    children: !0,
    contents: !0,
    next: !0,
    prev: !0
  };
  $.fn.extend({
    find: function(a) {
      var b, c, d, e, f, g, h = this;
      if ("string" != typeof a) return $(a).filter(function() {
        for (b = 0, c = h.length; c > b; b++) if ($.contains(h[b], this)) return ! 0
      });
      for (g = this.pushStack("", "find", a), b = 0, c = this.length; c > b; b++) if (d = g.length, $.find(a, this[b], g), b > 0) for (e = d; e < g.length; e++) for (f = 0; d > f; f++) if (g[f] === g[e]) {
        g.splice(e--, 1);
        break
      }
      return g
    },
    has: function(a) {
      var b, c = $(a, this),
      d = c.length;
      return this.filter(function() {
        for (b = 0; d > b; b++) if ($.contains(this, c[b])) return ! 0
      })
    },
    not: function(a) {
      return this.pushStack(j(this, a, !1), "not", a)
    },
    filter: function(a) {
      return this.pushStack(j(this, a, !0), "filter", a)
    },
    is: function(a) {
      return !! a && ("string" == typeof a ? Lb.test(a) ? $(a, this.context).index(this[0]) >= 0 : $.filter(a, this).length > 0 : this.filter(a).length > 0)
    },
    closest: function(a, b) {
      for (var c, d = 0,
      e = this.length,
      f = [], g = Lb.test(a) || "string" != typeof a ? $(a, b || this.context) : 0; e > d; d++) for (c = this[d]; c && c.ownerDocument && c !== b && 11 !== c.nodeType;) {
        if (g ? g.index(c) > -1 : $.find.matchesSelector(c, a)) {
          f.push(c);
          break
        }
        c = c.parentNode
      }
      return f = f.length > 1 ? $.unique(f) : f,
      this.pushStack(f, "closest", a)
    },
    index: function(a) {
      return a ? "string" == typeof a ? $.inArray(this[0], $(a)) : $.inArray(a.jquery ? a[0] : a, this) : this[0] && this[0].parentNode ? this.prevAll().length: -1
    },
    add: function(a, b) {
      var c = "string" == typeof a ? $(a, b) : $.makeArray(a && a.nodeType ? [a] : a),
      d = $.merge(this.get(), c);
      return this.pushStack(h(c[0]) || h(d[0]) ? d: $.unique(d))
    },
    addBack: function(a) {
      return this.add(null == a ? this.prevObject: this.prevObject.filter(a))
    }
  }),
  $.fn.andSelf = $.fn.addBack,
  $.each({
    parent: function(a) {
      var b = a.parentNode;
      return b && 11 !== b.nodeType ? b: null
    },
    parents: function(a) {
      return $.dir(a, "parentNode")
    },
    parentsUntil: function(a, b, c) {
      return $.dir(a, "parentNode", c)
    },
    next: function(a) {
      return i(a, "nextSibling")
    },
    prev: function(a) {
      return i(a, "previousSibling")
    },
    nextAll: function(a) {
      return $.dir(a, "nextSibling")
    },
    prevAll: function(a) {
      return $.dir(a, "previousSibling")
    },
    nextUntil: function(a, b, c) {
      return $.dir(a, "nextSibling", c)
    },
    prevUntil: function(a, b, c) {
      return $.dir(a, "previousSibling", c)
    },
    siblings: function(a) {
      return $.sibling((a.parentNode || {}).firstChild, a)
    },
    children: function(a) {
      return $.sibling(a.firstChild)
    },
    contents: function(a) {
      return $.nodeName(a, "iframe") ? a.contentDocument || a.contentWindow.document: $.merge([], a.childNodes)
    }
  },
  function(a, b) {
    $.fn[a] = function(c, d) {
      var e = $.map(this, b, c);
      return Ib.test(a) || (d = c),
      d && "string" == typeof d && (e = $.filter(d, e)),
      e = this.length > 1 && !Mb[a] ? $.unique(e) : e,
      this.length > 1 && Jb.test(a) && (e = e.reverse()),
      this.pushStack(e, a, V.call(arguments).join(","))
    }
  }),
  $.extend({
    filter: function(a, b, c) {
      return c && (a = ":not(" + a + ")"),
      1 === b.length ? $.find.matchesSelector(b[0], a) ? [b[0]] : [] : $.find.matches(a, b)
    },
    dir: function(a, c, d) {
      for (var e = [], f = a[c]; f && 9 !== f.nodeType && (d === b || 1 !== f.nodeType || !$(f).is(d));) 1 === f.nodeType && e.push(f),
      f = f[c];
      return e
    },
    sibling: function(a, b) {
      for (var c = []; a; a = a.nextSibling) 1 === a.nodeType && a !== b && c.push(a);
      return c
    }
  });
  var Nb = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
  Ob = / jQuery\d+="(?:null|\d+)"/g,
  Pb = /^\s+/,
  Qb = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
  Rb = /<([\w:]+)/,
  Sb = /<tbody/i,
  Tb = /<|&#?\w+;/,
  Ub = /<(?:script|style|link)/i,
  Vb = /<(?:script|object|embed|option|style)/i,
  Wb = new RegExp("<(?:" + Nb + ")[\\s/>]", "i"),
  Xb = /^(?:checkbox|radio)$/,
  Yb = /checked\s*(?:[^=]|=\s*.checked.)/i,
  Zb = /\/(java|ecma)script/i,
  $b = /^\s*<!(?:\[CDATA\[|\-\-)|[\]\-]{2}>\s*$/g,
  _b = {
    option: [1, "<select multiple='multiple'>", "</select>"],
    legend: [1, "<fieldset>", "</fieldset>"],
    thead: [1, "<table>", "</table>"],
    tr: [2, "<table><tbody>", "</tbody></table>"],
    td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
    col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
    area: [1, "<map>", "</map>"],
    _default: [0, "", ""]
  },
  ac = k(P),
  bc = ac.appendChild(P.createElement("div"));
  _b.optgroup = _b.option,
  _b.tbody = _b.tfoot = _b.colgroup = _b.caption = _b.thead,
  _b.th = _b.td,
  $.support.htmlSerialize || (_b._default = [1, "X<div>", "</div>"]),
  $.fn.extend({
    text: function(a) {
      return $.access(this,
      function(a) {
        return a === b ? $.text(this) : this.empty().append((this[0] && this[0].ownerDocument || P).createTextNode(a))
      },
      null, a, arguments.length)
    },
    wrapAll: function(a) {
      if ($.isFunction(a)) return this.each(function(b) {
        $(this).wrapAll(a.call(this, b))
      });
      if (this[0]) {
        var b = $(a, this[0].ownerDocument).eq(0).clone(!0);
        this[0].parentNode && b.insertBefore(this[0]),
        b.map(function() {
          for (var a = this; a.firstChild && 1 === a.firstChild.nodeType;) a = a.firstChild;
          return a
        }).append(this)
      }
      return this
    },
    wrapInner: function(a) {
      return $.isFunction(a) ? this.each(function(b) {
        $(this).wrapInner(a.call(this, b))
      }) : this.each(function() {
        var b = $(this),
        c = b.contents();
        c.length ? c.wrapAll(a) : b.append(a)
      })
    },
    wrap: function(a) {
      var b = $.isFunction(a);
      return this.each(function(c) {
        $(this).wrapAll(b ? a.call(this, c) : a)
      })
    },
    unwrap: function() {
      return this.parent().each(function() {
        $.nodeName(this, "body") || $(this).replaceWith(this.childNodes)
      }).end()
    },
    append: function() {
      return this.domManip(arguments, !0,
      function(a) { (1 === this.nodeType || 11 === this.nodeType) && this.appendChild(a)
      })
    },
    prepend: function() {
      return this.domManip(arguments, !0,
      function(a) { (1 === this.nodeType || 11 === this.nodeType) && this.insertBefore(a, this.firstChild)
      })
    },
    before: function() {
      if (!h(this[0])) return this.domManip(arguments, !1,
      function(a) {
        this.parentNode.insertBefore(a, this)
      });
      if (arguments.length) {
        var a = $.clean(arguments);
        return this.pushStack($.merge(a, this), "before", this.selector)
      }
    },
    after: function() {
      if (!h(this[0])) return this.domManip(arguments, !1,
      function(a) {
        this.parentNode.insertBefore(a, this.nextSibling)
      });
      if (arguments.length) {
        var a = $.clean(arguments);
        return this.pushStack($.merge(this, a), "after", this.selector)
      }
    },
    remove: function(a, b) {
      for (var c, d = 0; null != (c = this[d]); d++)(!a || $.filter(a, [c]).length) && (b || 1 !== c.nodeType || ($.cleanData(c.getElementsByTagName("*")), $.cleanData([c])), c.parentNode && c.parentNode.removeChild(c));
      return this
    },
    empty: function() {
      for (var a, b = 0; null != (a = this[b]); b++) for (1 === a.nodeType && $.cleanData(a.getElementsByTagName("*")); a.firstChild;) a.removeChild(a.firstChild);
      return this
    },
    clone: function(a, b) {
      return a = null == a ? !1 : a,
      b = null == b ? a: b,
      this.map(function() {
        return $.clone(this, a, b)
      })
    },
    html: function(a) {
      return $.access(this,
      function(a) {
        var c = this[0] || {},
        d = 0,
        e = this.length;
        if (a === b) return 1 === c.nodeType ? c.innerHTML.replace(Ob, "") : b;
        if (! ("string" != typeof a || Ub.test(a) || !$.support.htmlSerialize && Wb.test(a) || !$.support.leadingWhitespace && Pb.test(a) || _b[(Rb.exec(a) || ["", ""])[1].toLowerCase()])) {
          a = a.replace(Qb, "<$1></$2>");
          try {
            for (; e > d; d++) c = this[d] || {},
            1 === c.nodeType && ($.cleanData(c.getElementsByTagName("*")), c.innerHTML = a);
            c = 0
          } catch(f) {}
        }
        c && this.empty().append(a)
      },
      null, a, arguments.length)
    },
    replaceWith: function(a) {
      return h(this[0]) ? this.length ? this.pushStack($($.isFunction(a) ? a() : a), "replaceWith", a) : this: $.isFunction(a) ? this.each(function(b) {
        var c = $(this),
        d = c.html();
        c.replaceWith(a.call(this, b, d))
      }) : ("string" != typeof a && (a = $(a).detach()), this.each(function() {
        var b = this.nextSibling,
        c = this.parentNode;
        $(this).remove(),
        b ? $(b).before(a) : $(c).append(a)
      }))
    },
    detach: function(a) {
      return this.remove(a, !0)
    },
    domManip: function(a, c, d) {
      a = [].concat.apply([], a);
      var e, f, g, h, i = 0,
      j = a[0],
      k = [],
      m = this.length;
      if (!$.support.checkClone && m > 1 && "string" == typeof j && Yb.test(j)) return this.each(function() {
        $(this).domManip(a, c, d)
      });
      if ($.isFunction(j)) return this.each(function(e) {
        var f = $(this);
        a[0] = j.call(this, e, c ? f.html() : b),
        f.domManip(a, c, d)
      });
      if (this[0]) {
        if (e = $.buildFragment(a, this, k), g = e.fragment, f = g.firstChild, 1 === g.childNodes.length && (g = f), f) for (c = c && $.nodeName(f, "tr"), h = e.cacheable || m - 1; m > i; i++) d.call(c && $.nodeName(this[i], "table") ? l(this[i], "tbody") : this[i], i === h ? g: $.clone(g, !0, !0));
        g = f = null,
        k.length && $.each(k,
        function(a, b) {
          b.src ? $.ajax ? $.ajax({
            url: b.src,
            type: "GET",
            dataType: "script",
            async: !1,
            global: !1,
            "throws": !0
          }) : $.error("no ajax") : $.globalEval((b.text || b.textContent || b.innerHTML || "").replace($b, "")),
          b.parentNode && b.parentNode.removeChild(b)
        })
      }
      return this
    }
  }),
  $.buildFragment = function(a, c, d) {
    var e, f, g, h = a[0];
    return c = c || P,
    c = !c.nodeType && c[0] || c,
    c = c.ownerDocument || c,
    !(1 === a.length && "string" == typeof h && h.length < 512 && c === P && "<" === h.charAt(0)) || Vb.test(h) || !$.support.checkClone && Yb.test(h) || !$.support.html5Clone && Wb.test(h) || (f = !0, e = $.fragments[h], g = e !== b),
    e || (e = c.createDocumentFragment(), $.clean(a, c, e, d), f && ($.fragments[h] = g && e)),
    {
      fragment: e,
      cacheable: f
    }
  },
  $.fragments = {},
  $.each({
    appendTo: "append",
    prependTo: "prepend",
    insertBefore: "before",
    insertAfter: "after",
    replaceAll: "replaceWith"
  },
  function(a, b) {
    $.fn[a] = function(c) {
      var d, e = 0,
      f = [],
      g = $(c),
      h = g.length,
      i = 1 === this.length && this[0].parentNode;
      if ((null == i || i && 11 === i.nodeType && 1 === i.childNodes.length) && 1 === h) return g[b](this[0]),
      this;
      for (; h > e; e++) d = (e > 0 ? this.clone(!0) : this).get(),
      $(g[e])[b](d),
      f = f.concat(d);
      return this.pushStack(f, a, g.selector)
    }
  }),
  $.extend({
    clone: function(a, b, c) {
      var d, e, f, g;
      if ($.support.html5Clone || $.isXMLDoc(a) || !Wb.test("<" + a.nodeName + ">") ? g = a.cloneNode(!0) : (bc.innerHTML = a.outerHTML, bc.removeChild(g = bc.firstChild)), !($.support.noCloneEvent && $.support.noCloneChecked || 1 !== a.nodeType && 11 !== a.nodeType || $.isXMLDoc(a))) for (n(a, g), d = o(a), e = o(g), f = 0; d[f]; ++f) e[f] && n(d[f], e[f]);
      if (b && (m(a, g), c)) for (d = o(a), e = o(g), f = 0; d[f]; ++f) m(d[f], e[f]);
      return d = e = null,
      g
    },
    clean: function(a, b, c, d) {
      var e, f, g, h, i, j, l, m, n, o, q, r = b === P && ac,
      s = [];
      for (b && "undefined" != typeof b.createDocumentFragment || (b = P), e = 0; null != (g = a[e]); e++) if ("number" == typeof g && (g += ""), g) {
        if ("string" == typeof g) if (Tb.test(g)) {
          for (r = r || k(b), l = b.createElement("div"), r.appendChild(l), g = g.replace(Qb, "<$1></$2>"), h = (Rb.exec(g) || ["", ""])[1].toLowerCase(), i = _b[h] || _b._default, j = i[0], l.innerHTML = i[1] + g + i[2]; j--;) l = l.lastChild;
          if (!$.support.tbody) for (m = Sb.test(g), n = "table" !== h || m ? "<table>" !== i[1] || m ? [] : l.childNodes: l.firstChild && l.firstChild.childNodes, f = n.length - 1; f >= 0; --f) $.nodeName(n[f], "tbody") && !n[f].childNodes.length && n[f].parentNode.removeChild(n[f]); ! $.support.leadingWhitespace && Pb.test(g) && l.insertBefore(b.createTextNode(Pb.exec(g)[0]), l.firstChild),
          g = l.childNodes,
          l.parentNode.removeChild(l)
        } else g = b.createTextNode(g);
        g.nodeType ? s.push(g) : $.merge(s, g)
      }
      if (l && (g = l = r = null), !$.support.appendChecked) for (e = 0; null != (g = s[e]); e++) $.nodeName(g, "input") ? p(g) : "undefined" != typeof g.getElementsByTagName && $.grep(g.getElementsByTagName("input"), p);
      if (c) for (o = function(a) {
        return ! a.type || Zb.test(a.type) ? d ? d.push(a.parentNode ? a.parentNode.removeChild(a) : a) : c.appendChild(a) : void 0
      },
      e = 0; null != (g = s[e]); e++) $.nodeName(g, "script") && o(g) || (c.appendChild(g), "undefined" != typeof g.getElementsByTagName && (q = $.grep($.merge([], g.getElementsByTagName("script")), o), s.splice.apply(s, [e + 1, 0].concat(q)), e += q.length));
      return s
    },
    cleanData: function(a, b) {
      for (var c, d, e, f, g = 0,
      h = $.expando,
      i = $.cache,
      j = $.support.deleteExpando,
      k = $.event.special; null != (e = a[g]); g++) if ((b || $.acceptData(e)) && (d = e[h], c = d && i[d])) {
        if (c.events) for (f in c.events) k[f] ? $.event.remove(e, f) : $.removeEvent(e, f, c.handle);
        i[d] && (delete i[d], j ? delete e[h] : e.removeAttribute ? e.removeAttribute(h) : e[h] = null, $.deletedIds.push(d))
      }
    }
  }),
  function() {
    var a, b;
    $.uaMatch = function(a) {
      a = a.toLowerCase();
      var b = /(chrome)[ \/]([\w.]+)/.exec(a) || /(webkit)[ \/]([\w.]+)/.exec(a) || /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(a) || /(msie) ([\w.]+)/.exec(a) || a.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(a) || [];
      return {
        browser: b[1] || "",
        version: b[2] || "0"
      }
    },
    a = $.uaMatch(R.userAgent),
    b = {},
    a.browser && (b[a.browser] = !0, b.version = a.version),
    b.chrome ? b.webkit = !0 : b.webkit && (b.safari = !0),
    $.browser = b,
    $.sub = function() {
      function a(b, c) {
        return new a.fn.init(b, c)
      }
      $.extend(!0, a, this),
      a.superclass = this,
      a.fn = a.prototype = this(),
      a.fn.constructor = a,
      a.sub = this.sub,
      a.fn.init = function(c, d) {
        return d && d instanceof $ && !(d instanceof a) && (d = a(d)),
        $.fn.init.call(this, c, d, b)
      },
      a.fn.init.prototype = a.fn;
      var b = a(P);
      return a
    }
  } ();
  var cc, dc, ec, fc = /alpha\([^)]*\)/i,
  gc = /opacity=([^)]*)/,
  hc = /^(top|right|bottom|left)$/,
  ic = /^(none|table(?!-c[ea]).+)/,
  jc = /^margin/,
  kc = new RegExp("^(" + _ + ")(.*)$", "i"),
  lc = new RegExp("^(" + _ + ")(?!px)[a-z%]+$", "i"),
  mc = new RegExp("^([-+])=(" + _ + ")", "i"),
  nc = {
    BODY: "block"
  },
  oc = {
    position: "absolute",
    visibility: "hidden",
    display: "block"
  },
  pc = {
    letterSpacing: 0,
    fontWeight: 400
  },
  qc = ["Top", "Right", "Bottom", "Left"],
  rc = ["Webkit", "O", "Moz", "ms"],
  sc = $.fn.toggle;
  $.fn.extend({
    css: function(a, c) {
      return $.access(this,
      function(a, c, d) {
        return d !== b ? $.style(a, c, d) : $.css(a, c)
      },
      a, c, arguments.length > 1)
    },
    show: function() {
      return s(this, !0)
    },
    hide: function() {
      return s(this)
    },
    toggle: function(a, b) {
      var c = "boolean" == typeof a;
      return $.isFunction(a) && $.isFunction(b) ? sc.apply(this, arguments) : this.each(function() { (c ? a: r(this)) ? $(this).show() : $(this).hide()
      })
    }
  }),
  $.extend({
    cssHooks: {
      opacity: {
        get: function(a, b) {
          if (b) {
            var c = cc(a, "opacity");
            return "" === c ? "1": c
          }
        }
      }
    },
    cssNumber: {
      fillOpacity: !0,
      fontWeight: !0,
      lineHeight: !0,
      opacity: !0,
      orphans: !0,
      widows: !0,
      zIndex: !0,
      zoom: !0
    },
    cssProps: {
      "float": $.support.cssFloat ? "cssFloat": "styleFloat"
    },
    style: function(a, c, d, e) {
      if (a && 3 !== a.nodeType && 8 !== a.nodeType && a.style) {
        var f, g, h, i = $.camelCase(c),
        j = a.style;
        if (c = $.cssProps[i] || ($.cssProps[i] = q(j, i)), h = $.cssHooks[c] || $.cssHooks[i], d === b) return h && "get" in h && (f = h.get(a, !1, e)) !== b ? f: j[c];
        if (g = typeof d, "string" === g && (f = mc.exec(d)) && (d = (f[1] + 1) * f[2] + parseFloat($.css(a, c)), g = "number"), !(null == d || "number" === g && isNaN(d) || ("number" !== g || $.cssNumber[i] || (d += "px"), h && "set" in h && (d = h.set(a, d, e)) === b))) try {
          j[c] = d
        } catch(k) {}
      }
    },
    css: function(a, c, d, e) {
      var f, g, h, i = $.camelCase(c);
      return c = $.cssProps[i] || ($.cssProps[i] = q(a.style, i)),
      h = $.cssHooks[c] || $.cssHooks[i],
      h && "get" in h && (f = h.get(a, !0, e)),
      f === b && (f = cc(a, c)),
      "normal" === f && c in pc && (f = pc[c]),
      d || e !== b ? (g = parseFloat(f), d || $.isNumeric(g) ? g || 0 : f) : f
    },
    swap: function(a, b, c) {
      var d, e, f = {};
      for (e in b) f[e] = a.style[e],
      a.style[e] = b[e];
      d = c.call(a);
      for (e in b) a.style[e] = f[e];
      return d
    }
  }),
  a.getComputedStyle ? cc = function(b, c) {
    var d, e, f, g, h = a.getComputedStyle(b, null),
    i = b.style;
    return h && (d = h.getPropertyValue(c) || h[c], "" !== d || $.contains(b.ownerDocument, b) || (d = $.style(b, c)), lc.test(d) && jc.test(c) && (e = i.width, f = i.minWidth, g = i.maxWidth, i.minWidth = i.maxWidth = i.width = d, d = h.width, i.width = e, i.minWidth = f, i.maxWidth = g)),
    d
  }: P.documentElement.currentStyle && (cc = function(a, b) {
    var c, d, e = a.currentStyle && a.currentStyle[b],
    f = a.style;
    return null == e && f && f[b] && (e = f[b]),
    lc.test(e) && !hc.test(b) && (c = f.left, d = a.runtimeStyle && a.runtimeStyle.left, d && (a.runtimeStyle.left = a.currentStyle.left), f.left = "fontSize" === b ? "1em": e, e = f.pixelLeft + "px", f.left = c, d && (a.runtimeStyle.left = d)),
    "" === e ? "auto": e
  }),
  $.each(["height", "width"],
  function(a, b) {
    $.cssHooks[b] = {
      get: function(a, c, d) {
        return c ? 0 === a.offsetWidth && ic.test(cc(a, "display")) ? $.swap(a, oc,
        function() {
          return v(a, b, d)
        }) : v(a, b, d) : void 0
      },
      set: function(a, c, d) {
        return t(a, c, d ? u(a, b, d, $.support.boxSizing && "border-box" === $.css(a, "boxSizing")) : 0)
      }
    }
  }),
  $.support.opacity || ($.cssHooks.opacity = {
    get: function(a, b) {
      return gc.test((b && a.currentStyle ? a.currentStyle.filter: a.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "": b ? "1": ""
    },
    set: function(a, b) {
      var c = a.style,
      d = a.currentStyle,
      e = $.isNumeric(b) ? "alpha(opacity=" + 100 * b + ")": "",
      f = d && d.filter || c.filter || "";
      c.zoom = 1,
      b >= 1 && "" === $.trim(f.replace(fc, "")) && c.removeAttribute && (c.removeAttribute("filter"), d && !d.filter) || (c.filter = fc.test(f) ? f.replace(fc, e) : f + " " + e)
    }
  }),
  $(function() {
    $.support.reliableMarginRight || ($.cssHooks.marginRight = {
      get: function(a, b) {
        return $.swap(a, {
          display: "inline-block"
        },
        function() {
          return b ? cc(a, "marginRight") : void 0
        })
      }
    }),
    !$.support.pixelPosition && $.fn.position && $.each(["top", "left"],
    function(a, b) {
      $.cssHooks[b] = {
        get: function(a, c) {
          if (c) {
            var d = cc(a, b);
            return lc.test(d) ? $(a).position()[b] + "px": d
          }
        }
      }
    })
  }),
  $.expr && $.expr.filters && ($.expr.filters.hidden = function(a) {
    return 0 === a.offsetWidth && 0 === a.offsetHeight || !$.support.reliableHiddenOffsets && "none" === (a.style && a.style.display || cc(a, "display"))
  },
  $.expr.filters.visible = function(a) {
    return ! $.expr.filters.hidden(a)
  }),
  $.each({
    margin: "",
    padding: "",
    border: "Width"
  },
  function(a, b) {
    $.cssHooks[a + b] = {
      expand: function(c) {
        var d, e = "string" == typeof c ? c.split(" ") : [c],
        f = {};
        for (d = 0; 4 > d; d++) f[a + qc[d] + b] = e[d] || e[d - 2] || e[0];
        return f
      }
    },
    jc.test(a) || ($.cssHooks[a + b].set = t)
  });
  var tc = /%20/g,
  uc = /\[\]$/,
  vc = /\r?\n/g,
  wc = /^(?:color|date|datetime|datetime-local|email|hidden|month|number|password|range|search|tel|text|time|url|week)$/i,
  xc = /^(?:select|textarea)/i;
  $.fn.extend({
    serialize: function() {
      return $.param(this.serializeArray())
    },
    serializeArray: function() {
      return this.map(function() {
        return this.elements ? $.makeArray(this.elements) : this
      }).filter(function() {
        return this.name && !this.disabled && (this.checked || xc.test(this.nodeName) || wc.test(this.type))
      }).map(function(a, b) {
        var c = $(this).val();
        return null == c ? null: $.isArray(c) ? $.map(c,
        function(a) {
          return {
            name: b.name,
            value: a.replace(vc, "\r\n")
          }
        }) : {
          name: b.name,
          value: c.replace(vc, "\r\n")
        }
      }).get()
    }
  }),
  $.param = function(a, c) {
    var d, e = [],
    f = function(a, b) {
      b = $.isFunction(b) ? b() : null == b ? "": b,
      e[e.length] = encodeURIComponent(a) + "=" + encodeURIComponent(b)
    };
    if (c === b && (c = $.ajaxSettings && $.ajaxSettings.traditional), $.isArray(a) || a.jquery && !$.isPlainObject(a)) $.each(a,
    function() {
      f(this.name, this.value)
    });
    else for (d in a) x(d, a[d], c, f);
    return e.join("&").replace(tc, "+")
  };
  var yc, zc, Ac = /#.*$/,
  Bc = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm,
  Cc = /^(?:about|app|app\-storage|.+\-extension|file|res|widget):$/,
  Dc = /^(?:GET|HEAD)$/,
  Ec = /^\/\//,
  Fc = /\?/,
  Gc = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,
  Hc = /([?&])_=[^&]*/,
  Ic = /^([\w\+\.\-]+:)(?:\/\/([^\/?#:]*)(?::(\d+)|)|)/,
  Jc = $.fn.load,
  Kc = {},
  Lc = {},
  Mc = ["*/"] + ["*"];
  try {
    zc = Q.href
  } catch(Nc) {
    zc = P.createElement("a"),
    zc.href = "",
    zc = zc.href
  }
  yc = Ic.exec(zc.toLowerCase()) || [],
  $.fn.load = function(a, c, d) {
    if ("string" != typeof a && Jc) return Jc.apply(this, arguments);
    if (!this.length) return this;
    var e, f, g, h = this,
    i = a.indexOf(" ");
    return i >= 0 && (e = a.slice(i, a.length), a = a.slice(0, i)),
    $.isFunction(c) ? (d = c, c = b) : c && "object" == typeof c && (f = "POST"),
    $.ajax({
      url: a,
      type: f,
      dataType: "html",
      data: c,
      complete: function(a, b) {
        d && h.each(d, g || [a.responseText, b, a])
      }
    }).done(function(a) {
      g = arguments,
      h.html(e ? $("<div>").append(a.replace(Gc, "")).find(e) : a)
    }),
    this
  },
  $.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "),
  function(a, b) {
    $.fn[b] = function(a) {
      return this.on(b, a)
    }
  }),
  $.each(["get", "post"],
  function(a, c) {
    $[c] = function(a, d, e, f) {
      return $.isFunction(d) && (f = f || e, e = d, d = b),
      $.ajax({
        type: c,
        url: a,
        data: d,
        success: e,
        dataType: f
      })
    }
  }),
  $.extend({
    getScript: function(a, c) {
      return $.get(a, b, c, "script")
    },
    getJSON: function(a, b, c) {
      return $.get(a, b, c, "json")
    },
    ajaxSetup: function(a, b) {
      return b ? A(a, $.ajaxSettings) : (b = a, a = $.ajaxSettings),
      A(a, b),
      a
    },
    ajaxSettings: {
      url: zc,
      isLocal: Cc.test(yc[1]),
      global: !0,
      type: "GET",
      contentType: "application/x-www-form-urlencoded; charset=UTF-8",
      processData: !0,
      async: !0,
      accepts: {
        xml: "application/xml, text/xml",
        html: "text/html",
        text: "text/plain",
        json: "application/json, text/javascript",
        "*": Mc
      },
      contents: {
        xml: /xml/,
        html: /html/,
        json: /json/
      },
      responseFields: {
        xml: "responseXML",
        text: "responseText"
      },
      converters: {
        "* text": a.String,
        "text html": !0,
        "text json": $.parseJSON,
        "text xml": $.parseXML
      },
      flatOptions: {
        context: !0,
        url: !0
      }
    },
    ajaxPrefilter: y(Kc),
    ajaxTransport: y(Lc),
    ajax: function(a, c) {
      function d(a, c, d, g) {
        var j, l, s, t, v, x = c;
        2 !== u && (u = 2, i && clearTimeout(i), h = b, f = g || "", w.readyState = a > 0 ? 4 : 0, d && (t = B(m, w, d)), a >= 200 && 300 > a || 304 === a ? (m.ifModified && (v = w.getResponseHeader("Last-Modified"), v && ($.lastModified[e] = v), v = w.getResponseHeader("Etag"), v && ($.etag[e] = v)), 304 === a ? (x = "notmodified", j = !0) : (j = C(m, t), x = j.state, l = j.data, s = j.error, j = !s)) : (s = x, (!x || a) && (x = "error", 0 > a && (a = 0))), w.status = a, w.statusText = (c || x) + "", j ? p.resolveWith(n, [l, x, w]) : p.rejectWith(n, [w, x, s]), w.statusCode(r), r = b, k && o.trigger("ajax" + (j ? "Success": "Error"), [w, m, j ? l: s]), q.fireWith(n, [w, x]), k && (o.trigger("ajaxComplete", [w, m]), --$.active || $.event.trigger("ajaxStop")))
      }
      "object" == typeof a && (c = a, a = b),
      c = c || {};
      var e, f, g, h, i, j, k, l, m = $.ajaxSetup({},
      c),
      n = m.context || m,
      o = n !== m && (n.nodeType || n instanceof $) ? $(n) : $.event,
      p = $.Deferred(),
      q = $.Callbacks("once memory"),
      r = m.statusCode || {},
      s = {},
      t = {},
      u = 0,
      v = "canceled",
      w = {
        readyState: 0,
        setRequestHeader: function(a, b) {
          if (!u) {
            var c = a.toLowerCase();
            a = t[c] = t[c] || a,
            s[a] = b
          }
          return this
        },
        getAllResponseHeaders: function() {
          return 2 === u ? f: null
        },
        getResponseHeader: function(a) {
          var c;
          if (2 === u) {
            if (!g) for (g = {}; c = Bc.exec(f);) g[c[1].toLowerCase()] = c[2];
            c = g[a.toLowerCase()]
          }
          return c === b ? null: c
        },
        overrideMimeType: function(a) {
          return u || (m.mimeType = a),
          this
        },
        abort: function(a) {
          return a = a || v,
          h && h.abort(a),
          d(0, a),
          this
        }
      };
      if (p.promise(w), w.success = w.done, w.error = w.fail, w.complete = q.add, w.statusCode = function(a) {
        if (a) {
          var b;
          if (2 > u) for (b in a) r[b] = [r[b], a[b]];
          else b = a[w.status],
          w.always(b)
        }
        return this
      },
      m.url = ((a || m.url) + "").replace(Ac, "").replace(Ec, yc[1] + "//"), m.dataTypes = $.trim(m.dataType || "*").toLowerCase().split(bb), null == m.crossDomain && (j = Ic.exec(m.url.toLowerCase()), m.crossDomain = !(!j || j[1] === yc[1] && j[2] === yc[2] && (j[3] || ("http:" === j[1] ? 80 : 443)) == (yc[3] || ("http:" === yc[1] ? 80 : 443)))), m.data && m.processData && "string" != typeof m.data && (m.data = $.param(m.data, m.traditional)), z(Kc, m, c, w), 2 === u) return w;
      if (k = m.global, m.type = m.type.toUpperCase(), m.hasContent = !Dc.test(m.type), k && 0 === $.active++&&$.event.trigger("ajaxStart"), !m.hasContent && (m.data && (m.url += (Fc.test(m.url) ? "&": "?") + m.data, delete m.data), e = m.url, m.cache === !1)) {
        var x = $.now(),
        y = m.url.replace(Hc, "$1_=" + x);
        m.url = y + (y === m.url ? (Fc.test(m.url) ? "&": "?") + "_=" + x: "")
      } (m.data && m.hasContent && m.contentType !== !1 || c.contentType) && w.setRequestHeader("Content-Type", m.contentType),
      m.ifModified && (e = e || m.url, $.lastModified[e] && w.setRequestHeader("If-Modified-Since", $.lastModified[e]), $.etag[e] && w.setRequestHeader("If-None-Match", $.etag[e])),
      w.setRequestHeader("Accept", m.dataTypes[0] && m.accepts[m.dataTypes[0]] ? m.accepts[m.dataTypes[0]] + ("*" !== m.dataTypes[0] ? ", " + Mc + "; q=0.01": "") : m.accepts["*"]);
      for (l in m.headers) w.setRequestHeader(l, m.headers[l]);
      if (m.beforeSend && (m.beforeSend.call(n, w, m) === !1 || 2 === u)) return w.abort();
      v = "abort";
      for (l in {
        success: 1,
        error: 1,
        complete: 1
      }) w[l](m[l]);
      if (h = z(Lc, m, c, w)) {
        w.readyState = 1,
        k && o.trigger("ajaxSend", [w, m]),
        m.async && m.timeout > 0 && (i = setTimeout(function() {
          w.abort("timeout")
        },
        m.timeout));
        try {
          u = 1,
          h.send(s, d)
        } catch(A) {
          if (! (2 > u)) throw A;
          d( - 1, A)
        }
      } else d( - 1, "No Transport");
      return w
    },
    active: 0,
    lastModified: {},
    etag: {}
  });
  var Oc = [],
  Pc = /\?/,
  Qc = /(=)\?(?=&|$)|\?\?/,
  Rc = $.now();
  $.ajaxSetup({
    jsonp: "callback",
    jsonpCallback: function() {
      var a = Oc.pop() || $.expando + "_" + Rc++;
      return this[a] = !0,
      a
    }
  }),
  $.ajaxPrefilter("json jsonp",
  function(c, d, e) {
    var f, g, h, i = c.data,
    j = c.url,
    k = c.jsonp !== !1,
    l = k && Qc.test(j),
    m = k && !l && "string" == typeof i && !(c.contentType || "").indexOf("application/x-www-form-urlencoded") && Qc.test(i);
    return "jsonp" === c.dataTypes[0] || l || m ? (f = c.jsonpCallback = $.isFunction(c.jsonpCallback) ? c.jsonpCallback() : c.jsonpCallback, g = a[f], l ? c.url = j.replace(Qc, "$1" + f) : m ? c.data = i.replace(Qc, "$1" + f) : k && (c.url += (Pc.test(j) ? "&": "?") + c.jsonp + "=" + f), c.converters["script json"] = function() {
      return h || $.error(f + " was not called"),
      h[0]
    },
    c.dataTypes[0] = "json", a[f] = function() {
      h = arguments
    },
    e.always(function() {
      a[f] = g,
      c[f] && (c.jsonpCallback = d.jsonpCallback, Oc.push(f)),
      h && $.isFunction(g) && g(h[0]),
      h = g = b
    }), "script") : void 0
  }),
  $.ajaxSetup({
    accepts: {
      script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
    },
    contents: {
      script: /javascript|ecmascript/
    },
    converters: {
      "text script": function(a) {
        return $.globalEval(a),
        a
      }
    }
  }),
  $.ajaxPrefilter("script",
  function(a) {
    a.cache === b && (a.cache = !1),
    a.crossDomain && (a.type = "GET", a.global = !1)
  }),
  $.ajaxTransport("script",
  function(a) {
    if (a.crossDomain) {
      var c, d = P.head || P.getElementsByTagName("head")[0] || P.documentElement;
      return {
        send: function(e, f) {
          c = P.createElement("script"),
          c.async = "async",
          a.scriptCharset && (c.charset = a.scriptCharset),
          c.src = a.url,
          c.onload = c.onreadystatechange = function(a, e) { (e || !c.readyState || /loaded|complete/.test(c.readyState)) && (c.onload = c.onreadystatechange = null, d && c.parentNode && d.removeChild(c), c = b, e || f(200, "success"))
          },
          d.insertBefore(c, d.firstChild)
        },
        abort: function() {
          c && c.onload(0, 1)
        }
      }
    }
  });
  var Sc, Tc = a.ActiveXObject ?
  function() {
    for (var a in Sc) Sc[a](0, 1)
  }: !1,
  Uc = 0;
  $.ajaxSettings.xhr = a.ActiveXObject ?
  function() {
    return ! this.isLocal && D() || E()
  }: D,
  function(a) {
    $.extend($.support, {
      ajax: !!a,
      cors: !!a && "withCredentials" in a
    })
  } ($.ajaxSettings.xhr()),
  $.support.ajax && $.ajaxTransport(function(c) {
    if (!c.crossDomain || $.support.cors) {
      var d;
      return {
        send: function(e, f) {
          var g, h, i = c.xhr();
          if (c.username ? i.open(c.type, c.url, c.async, c.username, c.password) : i.open(c.type, c.url, c.async), c.xhrFields) for (h in c.xhrFields) i[h] = c.xhrFields[h];
          c.mimeType && i.overrideMimeType && i.overrideMimeType(c.mimeType),
          c.crossDomain || e["X-Requested-With"] || (e["X-Requested-With"] = "XMLHttpRequest");
          try {
            for (h in e) i.setRequestHeader(h, e[h])
          } catch(j) {}
          i.send(c.hasContent && c.data || null),
          d = function(a, e) {
            var h, j, k, l, m;
            try {
              if (d && (e || 4 === i.readyState)) if (d = b, g && (i.onreadystatechange = $.noop, Tc && delete Sc[g]), e) 4 !== i.readyState && i.abort();
              else {
                h = i.status,
                k = i.getAllResponseHeaders(),
                l = {},
                m = i.responseXML,
                m && m.documentElement && (l.xml = m);
                try {
                  l.text = i.responseText
                } catch(n) {}
                try {
                  j = i.statusText
                } catch(n) {
                  j = ""
                }
                h || !c.isLocal || c.crossDomain ? 1223 === h && (h = 204) : h = l.text ? 200 : 404
              }
            } catch(o) {
              e || f( - 1, o)
            }
            l && f(h, j, l, k)
          },
          c.async ? 4 === i.readyState ? setTimeout(d, 0) : (g = ++Uc, Tc && (Sc || (Sc = {},
          $(a).unload(Tc)), Sc[g] = d), i.onreadystatechange = d) : d()
        },
        abort: function() {
          d && d(0, 1)
        }
      }
    }
  });
  var Vc, Wc, Xc = /^(?:toggle|show|hide)$/,
  Yc = new RegExp("^(?:([-+])=|)(" + _ + ")([a-z%]*)$", "i"),
  Zc = /queueHooks$/,
  $c = [J],
  _c = {
    "*": [function(a, b) {
      var c, d, e = this.createTween(a, b),
      f = Yc.exec(b),
      g = e.cur(),
      h = +g || 0,
      i = 1,
      j = 20;
      if (f) {
        if (c = +f[2], d = f[3] || ($.cssNumber[a] ? "": "px"), "px" !== d && h) {
          h = $.css(e.elem, a, !0) || c || 1;
          do i = i || ".5",
          h /= i,
          $.style(e.elem, a, h + d);
          while (i !== (i = e.cur() / g) && 1 !== i && --j)
        }
        e.unit = d,
        e.start = h,
        e.end = f[1] ? h + (f[1] + 1) * c: c
      }
      return e
    }]
  };
  $.Animation = $.extend(H, {
    tweener: function(a, b) {
      $.isFunction(a) ? (b = a, a = ["*"]) : a = a.split(" ");
      for (var c, d = 0,
      e = a.length; e > d; d++) c = a[d],
      _c[c] = _c[c] || [],
      _c[c].unshift(b)
    },
    prefilter: function(a, b) {
      b ? $c.unshift(a) : $c.push(a)
    }
  }),
  $.Tween = K,
  K.prototype = {
    constructor: K,
    init: function(a, b, c, d, e, f) {
      this.elem = a,
      this.prop = c,
      this.easing = e || "swing",
      this.options = b,
      this.start = this.now = this.cur(),
      this.end = d,
      this.unit = f || ($.cssNumber[c] ? "": "px")
    },
    cur: function() {
      var a = K.propHooks[this.prop];
      return a && a.get ? a.get(this) : K.propHooks._default.get(this)
    },
    run: function(a) {
      var b, c = K.propHooks[this.prop];
      return this.pos = b = this.options.duration ? $.easing[this.easing](a, this.options.duration * a, 0, 1, this.options.duration) : a,
      this.now = (this.end - this.start) * b + this.start,
      this.options.step && this.options.step.call(this.elem, this.now, this),
      c && c.set ? c.set(this) : K.propHooks._default.set(this),
      this
    }
  },
  K.prototype.init.prototype = K.prototype,
  K.propHooks = {
    _default: {
      get: function(a) {
        var b;
        return null == a.elem[a.prop] || a.elem.style && null != a.elem.style[a.prop] ? (b = $.css(a.elem, a.prop, !1, ""), b && "auto" !== b ? b: 0) : a.elem[a.prop]
      },
      set: function(a) {
        $.fx.step[a.prop] ? $.fx.step[a.prop](a) : a.elem.style && (null != a.elem.style[$.cssProps[a.prop]] || $.cssHooks[a.prop]) ? $.style(a.elem, a.prop, a.now + a.unit) : a.elem[a.prop] = a.now
      }
    }
  },
  K.propHooks.scrollTop = K.propHooks.scrollLeft = {
    set: function(a) {
      a.elem.nodeType && a.elem.parentNode && (a.elem[a.prop] = a.now)
    }
  },
  $.each(["toggle", "show", "hide"],
  function(a, b) {
    var c = $.fn[b];
    $.fn[b] = function(d, e, f) {
      return null == d || "boolean" == typeof d || !a && $.isFunction(d) && $.isFunction(e) ? c.apply(this, arguments) : this.animate(L(b, !0), d, e, f)
    }
  }),
  $.fn.extend({
    fadeTo: function(a, b, c, d) {
      return this.filter(r).css("opacity", 0).show().end().animate({
        opacity: b
      },
      a, c, d)
    },
    animate: function(a, b, c, d) {
      var e = $.isEmptyObject(a),
      f = $.speed(b, c, d),
      g = function() {
        var b = H(this, $.extend({},
        a), f);
        e && b.stop(!0)
      };
      return e || f.queue === !1 ? this.each(g) : this.queue(f.queue, g)
    },
    stop: function(a, c, d) {
      var e = function(a) {
        var b = a.stop;
        delete a.stop,
        b(d)
      };
      return "string" != typeof a && (d = c, c = a, a = b),
      c && a !== !1 && this.queue(a || "fx", []),
      this.each(function() {
        var b = !0,
        c = null != a && a + "queueHooks",
        f = $.timers,
        g = $._data(this);
        if (c) g[c] && g[c].stop && e(g[c]);
        else for (c in g) g[c] && g[c].stop && Zc.test(c) && e(g[c]);
        for (c = f.length; c--;) f[c].elem !== this || null != a && f[c].queue !== a || (f[c].anim.stop(d), b = !1, f.splice(c, 1)); (b || !d) && $.dequeue(this, a)
      })
    }
  }),
  $.each({
    slideDown: L("show"),
    slideUp: L("hide"),
    slideToggle: L("toggle"),
    fadeIn: {
      opacity: "show"
    },
    fadeOut: {
      opacity: "hide"
    },
    fadeToggle: {
      opacity: "toggle"
    }
  },
  function(a, b) {
    $.fn[a] = function(a, c, d) {
      return this.animate(b, a, c, d)
    }
  }),
  $.speed = function(a, b, c) {
    var d = a && "object" == typeof a ? $.extend({},
    a) : {
      complete: c || !c && b || $.isFunction(a) && a,
      duration: a,
      easing: c && b || b && !$.isFunction(b) && b
    };
    return d.duration = $.fx.off ? 0 : "number" == typeof d.duration ? d.duration: d.duration in $.fx.speeds ? $.fx.speeds[d.duration] : $.fx.speeds._default,
    (null == d.queue || d.queue === !0) && (d.queue = "fx"),
    d.old = d.complete,
    d.complete = function() {
      $.isFunction(d.old) && d.old.call(this),
      d.queue && $.dequeue(this, d.queue)
    },
    d
  },
  $.easing = {
    linear: function(a) {
      return a
    },
    swing: function(a) {
      return.5 - Math.cos(a * Math.PI) / 2
    }
  },
  $.timers = [],
  $.fx = K.prototype.init,
  $.fx.tick = function() {
    var a, c = $.timers,
    d = 0;
    for (Vc = $.now(); d < c.length; d++) a = c[d],
    a() || c[d] !== a || c.splice(d--, 1);
    c.length || $.fx.stop(),
    Vc = b
  },
  $.fx.timer = function(a) {
    a() && $.timers.push(a) && !Wc && (Wc = setInterval($.fx.tick, $.fx.interval))
  },
  $.fx.interval = 13,
  $.fx.stop = function() {
    clearInterval(Wc),
    Wc = null
  },
  $.fx.speeds = {
    slow: 600,
    fast: 200,
    _default: 400
  },
  $.fx.step = {},
  $.expr && $.expr.filters && ($.expr.filters.animated = function(a) {
    return $.grep($.timers,
    function(b) {
      return a === b.elem
    }).length
  });
  var ad = /^(?:body|html)$/i;
  $.fn.offset = function(a) {
    if (arguments.length) return a === b ? this: this.each(function(b) {
      $.offset.setOffset(this, a, b)
    });
    var c, d, e, f, g, h, i, j = {
      top: 0,
      left: 0
    },
    k = this[0],
    l = k && k.ownerDocument;
    if (l) return (d = l.body) === k ? $.offset.bodyOffset(k) : (c = l.documentElement, $.contains(c, k) ? ("undefined" != typeof k.getBoundingClientRect && (j = k.getBoundingClientRect()), e = M(l), f = c.clientTop || d.clientTop || 0, g = c.clientLeft || d.clientLeft || 0, h = e.pageYOffset || c.scrollTop, i = e.pageXOffset || c.scrollLeft, {
      top: j.top + h - f,
      left: j.left + i - g
    }) : j)
  },
  $.offset = {
    bodyOffset: function(a) {
      var b = a.offsetTop,
      c = a.offsetLeft;
      return $.support.doesNotIncludeMarginInBodyOffset && (b += parseFloat($.css(a, "marginTop")) || 0, c += parseFloat($.css(a, "marginLeft")) || 0),
      {
        top: b,
        left: c
      }
    },
    setOffset: function(a, b, c) {
      var d = $.css(a, "position");
      "static" === d && (a.style.position = "relative");
      var e, f, g = $(a),
      h = g.offset(),
      i = $.css(a, "top"),
      j = $.css(a, "left"),
      k = ("absolute" === d || "fixed" === d) && $.inArray("auto", [i, j]) > -1,
      l = {},
      m = {};
      k ? (m = g.position(), e = m.top, f = m.left) : (e = parseFloat(i) || 0, f = parseFloat(j) || 0),
      $.isFunction(b) && (b = b.call(a, c, h)),
      null != b.top && (l.top = b.top - h.top + e),
      null != b.left && (l.left = b.left - h.left + f),
      "using" in b ? b.using.call(a, l) : g.css(l)
    }
  },
  $.fn.extend({
    position: function() {
      if (this[0]) {
        var a = this[0],
        b = this.offsetParent(),
        c = this.offset(),
        d = ad.test(b[0].nodeName) ? {
          top: 0,
          left: 0
        }: b.offset();
        return c.top -= parseFloat($.css(a, "marginTop")) || 0,
        c.left -= parseFloat($.css(a, "marginLeft")) || 0,
        d.top += parseFloat($.css(b[0], "borderTopWidth")) || 0,
        d.left += parseFloat($.css(b[0], "borderLeftWidth")) || 0,
        {
          top: c.top - d.top,
          left: c.left - d.left
        }
      }
    },
    offsetParent: function() {
      return this.map(function() {
        for (var a = this.offsetParent || P.body; a && !ad.test(a.nodeName) && "static" === $.css(a, "position");) a = a.offsetParent;
        return a || P.body
      })
    }
  }),
  $.each({
    scrollLeft: "pageXOffset",
    scrollTop: "pageYOffset"
  },
  function(a, c) {
    var d = /Y/.test(c);
    $.fn[a] = function(e) {
      return $.access(this,
      function(a, e, f) {
        var g = M(a);
        return f === b ? g ? c in g ? g[c] : g.document.documentElement[e] : a[e] : (g ? g.scrollTo(d ? $(g).scrollLeft() : f, d ? f: $(g).scrollTop()) : a[e] = f, void 0)
      },
      a, e, arguments.length, null)
    }
  }),
  $.each({
    Height: "height",
    Width: "width"
  },
  function(a, c) {
    $.each({
      padding: "inner" + a,
      content: c,
      "": "outer" + a
    },
    function(d, e) {
      $.fn[e] = function(e, f) {
        var g = arguments.length && (d || "boolean" != typeof e),
        h = d || (e === !0 || f === !0 ? "margin": "border");
        return $.access(this,
        function(c, d, e) {
          var f;
          return $.isWindow(c) ? c.document.documentElement["client" + a] : 9 === c.nodeType ? (f = c.documentElement, Math.max(c.body["scroll" + a], f["scroll" + a], c.body["offset" + a], f["offset" + a], f["client" + a])) : e === b ? $.css(c, d, e, h) : $.style(c, d, e, h)
        },
        c, g ? e: b, g, null)
      }
    })
  }),
  a.jQuery = a.$ = $,
  "function" == typeof define && define.amd && define.amd.jQuery && define("jquery", [],
  function() {
    return $
  })
} (window),
function($, exports) {
  var KUI, version = "0.0.3",
  _KEYWORDS = ["extended", "included"],
  _htmlDecodeDict = {
    quot: '"',
    lt: "<",
    gt: ">",
    amp: "&",
    nbsp: " "
  },
  _htmlEncodeDict = {
    '"': "quot",
    "<": "lt",
    ">": "gt",
    "&": "amp",
    " ": "nbsp"
  },
  _templateSettings = {
    evaluate: /{%([\s\S]+?)%}/g,
    interpolate: /{%=([\s\S]+?)%}/g,
    saveRegex: /\{\$(\w+)\}/g
  },
  _eventSplitter = /^(\w+)\s*(.*)$/,
  _extend = function(a, b, c) {
    var d = $.isArray(c);
    for (var e in b) d ? -1 === $.inArray(e, c) && (a[e] = b[e]) : a[e] = b[e]
  },
  Class = function(a) {
    var b = function() {
      this.initializer.apply(this, arguments),
      this.init.apply(this, arguments)
    };
    if (b.prototype.initializer = function() {},
    b.prototype.init = function() {},
    a) {
      var c = function() {};
      $.extend(!0, b, a),
      c.prototype = $.extend(!0, {},
      a.prototype),
      b.prototype = new c
    }
    return b.fn = b.prototype,
    b.fn.parent = b,
    b.extend = function(a) {
      if (a) {
        var c = $.extend(!0, {},
        a);
        _extend(b, c, _KEYWORDS);
        var d = c.extended;
        "function" == typeof d && d(b)
      }
      return b
    },
    b.include = function(a) {
      if (a) {
        var c = $.extend(!0, {},
        a);
        _extend(b.fn, c, _KEYWORDS);
        var d = c.included;
        "function" == typeof d && d(b)
      }
      return b
    },
    b.proxy = function(a) {
      var b = this,
      c = Array.prototype.slice.call(arguments, 1);
      return function() {
        var d = $.makeArray(arguments),
        e = d.concat(c);
        return a.apply(b, e)
      }
    },
    b.proxyAll = function() {
      for (var a = $.makeArray(arguments), b = 0; b < a.length; b++) this[a[b]] = this.proxy(this[a[b]])
    },
    b.fn.proxy = b.proxy,
    b.fn.proxyAll = b.proxyAll,
    b
  };
  Class.create = function(a, b) {
    var c = new Class;
    return a && c.include(a),
    b && c.extend(b),
    c
  },
  KUI = new Class,
  KUI.Class = Class,
  KUI.Events = {
    bind: function(a, b) {
      for (var c = a.split(" "), d = (this._callbacks || (this._callbacks = {}), 0); d < c.length; d++)(this._callbacks[c[d]] || (this._callbacks[c[d]] = [])).push(b);
      return this
    },
    trigger: function() {
      var a, b, c, d, e = $.makeArray(arguments),
      f = e.shift();
      if (! (b = this._callbacks)) return ! 1;
      if (! (a = this._callbacks[f])) return ! 1;
      for (c = 0, d = a.length; d > c && a[c].apply(this, e) !== !1; c++);
      return ! 0
    },
    unbind: function(a, b) {
      if (!a) return this._callbacks = {},
      this;
      var c, d, e, f;
      if (! (d = this._callbacks)) return this;
      if (! (c = this._callbacks[a])) return this;
      if (!b) return delete this._callbacks[a],
      this;
      for (e = 0, f = c.length; f > e; e++) if (b === c[e]) {
        c.splice(e, 1);
        break
      }
      return this
    }
  },
  KUI.extend({
    version: version,
    zIndex: 0,
    isObject: function(a) {
      return $.isPlainObject(a)
    },
    guid: function() {
      return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g,
      function(a) {
        var b = 16 * Math.random() | 0,
        c = "x" == a ? b: 3 & b | 8;
        return c.toString(16)
      }).toUpperCase()
    },
    namespace: function(a) {
      for (var b = window,
      c = a.split("."), d = 0, e = c.length; e > d; d++) {
        if (b[c[d]]) {
          if (d == e - 1 && b[c[d]]) throw new Error("namespace [ " + a + " ] is exist!")
        } else b[c[d]] = {};
        b = b[c[d]]
      }
    },
    decodeHTML: function(a) {
      return String(a).replace(/&(quot|lt|gt|amp|nbsp);/gi,
      function(a, b) {
        return _htmlDecodeDict[b]
      }).replace(/&#u([a-f\d]{4});/gi,
      function(a, b) {
        return String.fromCharCode(parseInt("0x" + b))
      }).replace(/&#(\d+);/gi,
      function(a, b) {
        return String.fromCharCode( + b)
      })
    },
    encodeHTML: function(a) {
      return String(a).replace(/["<>& ]/g,
      function(a) {
        return "&" + _htmlEncodeDict[a] + ";"
      })
    },
    clearHTML: function(a) {
      return a = a.replace(/<\/?[^>]*>/g, ""),
      a = a.replace(/[ | ]*\n/g, "\n"),
      a = a.replace(/\n[\s| | ]*\r/g, "\n"),
      a = a.replace(/&nbsp;/gi, "")
    },
    replaceWith: function(a, b) {
      var c = this,
      d = a.replace(/%7B/gi, "{").replace(/%7D/gi, "}");
      return d.replace(_templateSettings.saveRegex,
      function(a, d) {
        return d in b ? c.encodeHTML(b[d]) : a
      })
    },
    queryToJson: function(a, b) {
      a = a || exports.location.search;
      for (var c, d, e, f, g = a.substr(a.indexOf("?") + 1), h = g.split("&"), i = h.length, j = {},
      k = 0; i > k; k++) f = h[k].split("="),
      c = f[0],
      c && (d = f[1] ? b ? decodeURIComponent(f[1]) : f[1] : ""),
      e = j[c],
      "undefined" == typeof e ? j[c] = d: $.isArray(e) ? e.push(d) : j[c] = [e, d];
      return j
    },
    getParam: function(a, b, c) {
      var d = this.queryToJson(b, c);
      return a ? d[a] || "": d
    },
    getForm: function(a) {
      var b = $("input,select,textarea", $(a || exports.document)).serialize().replace(/\+/gi, "%20");
      return this.queryToJson(b, !0)
    },
    setForm: function(a, b) {
      for (var c in a) {
        var d = $("[name=" + c + "]", $(b || exports.document));
        if (d.size() > 0) {
          var e = d.attr("type") || ("SELECT" == d.get(0).nodeName ? "select": "textarea");
          switch (e.toLocaleLowerCase()) {
          case "text":
          case "hidden":
          case "select":
          case "textarea":
            d.val(a[c] || "");
            break;
          case "radio":
            d.each(function() {
              $(this).val() == a[c] && $(this).attr("checked", "checked")
            });
            break;
          case "checkbox":
            var f = a[c];
            "object" != typeof f && (f = f.toString().split(",")),
            d.each(function() {
              for (var a = $(this), b = a.val(), c = 0, d = f.length; d > c; c++) if (b == f[c]) {
                a.attr("checked", "checked");
                break
              }
            })
          }
        }
      }
    },
    getCharCount: function(a) {
      return a.replace(/[^\x00-\xff]/g, "xx").length
    },
    substr: function(a, b) {
      var c = 0,
      d = 0,
      e = new String;
      d = a.length;
      for (var f = 0; d > f; f++) {
        var g = a.charAt(f);
        if (c++, escape(g).length > 4 && c++, e = e.concat(g), c >= b) return c > b && (e = e.concat("...")),
        e
      }
      return b > c ? a: void 0
    },
    refresh: function() {
      var a = exports.location,
      b = this.queryToJson(a.search);
      $.isEmptyObject() && (b = {}),
      $.extend(b, {
        n: Math.random()
      }),
      a.href = a.pathname + "?" + $.param(b) + a.hash
    },
    isDigits: function(a) {
      return /^\d+$/.test(a)
    },
    isNumber: function(a) {
      return /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(a)
    },
    isDate: function(a) {
      return ! /Invalid|NaN/.test(new Date(a))
    },
    byId: function(a) {
      return document.getElementById(a)
    },
    log: function(a) {
      window.console && console.log && console.log(a)
    }
  }),
  KUI.Controller = Class.create({
    tag: "div",
    initializer: function(a) {
      if (this.options = a || {},
      "object" != typeof this.options) throw new Error("控制器初始化参数必须是对象");
      for (var b in this.options) this[b] = this.options[b];
      this.el || (this.el = exports.document.createElement(this.tag)),
      this.el = $(this.el),
      this.events || (this.events = this.parent.events),
      this.elements || (this.elements = this.parent.elements),
      this.events && this.delegateEvents(),
      this.elements && this.refreshElements(),
      this.proxied && this.proxyAll.apply(this, this.proxied)
    },
    $: function(a) {
      return $(a, this.el)
    },
    delegateEvents: function() {
      for (var a in this.events) {
        var b = this.events[a],
        c = this.proxy(this[b]),
        d = a.match(_eventSplitter),
        e = d[1],
        f = d[2];
        "" === f ? this.el.bind(e, c) : this.el.delegate(f, e, c)
      }
    },
    refreshElements: function() {
      for (var a in this.elements) this[this.elements[a]] = this.$(a)
    },
    delay: function(a, b) {
      setTimeout(this.proxy(a), b || 0)
    }
  }),
  KUI.Controller.create = function(a) {
    var b = new Class(KUI.Controller);
    return a && b.include(a),
    b
  },
  KUI._widgets = {},
  KUI.Widget = Class.create({
    initializer: function() {
      this.id = KUI.guid(),
      this.parent._register(this),
      this.parent.trigger("init", this),
      this.bind("destroy", this._destroying)
    },
    destroy: function() {
      this.trigger("destroy", this),
      this.parent._unregister(this.id),
      this.parent.trigger("destroyed", this)
    },
    _destroying: function() {}
  }),
  KUI.Widget.extend({
    get: function(a) {
      return KUI._widgets[a]
    },
    _unregister: function(a) {
      delete KUI._widgets[a]
    },
    _register: function(a) {
      KUI._widgets[a.id] = a
    }
  }),
  KUI.Widget.extend(KUI.Events),
  KUI.Widget.include(KUI.Events),
  KUI.template = KUI.T = function() {
    var a = arguments,
    b = this;
    if (2 == a.length) {
      if ($.isArray(a[1])) {
        for (var c = [], d = 0, e = a[1].length; e > d; d++) a[1][d]._currentIndex = d,
        c.push(KUI.template(a[0], a[1][d]));
        return c.join("")
      }
      return function(a, c) {
        if ("string" != typeof a) throw new Error("template is not a string");
        if (!$.isPlainObject(c)) throw new Error("data from template is not a object");
        var d = _templateSettings;
        a = b.replaceWith(a, c);
        var e = "var __p=[],print=function(){__p.push.apply(__p,arguments);};with(obj||{}){__p.push('" + a.replace(/\\/g, "\\\\").replace(/'/g, "\\'").replace(d.interpolate,
        function(a, b) {
          return "'," + b.replace(/\\'/g, "'") + ",'"
        }).replace(d.evaluate || null,
        function(a, b) {
          return "');" + b.replace(/\\'/g, "'").replace(/[\r\n\t]/g, " ") + "__p.push('"
        }).replace(/\r/g, "\\r").replace(/\n/g, "\\n").replace(/\t/g, "\\t") + "');}return __p.join('');",
        f = new Function("obj", e);
        return c ? f(c) : f
      } (a[0], a[1])
    }
    if (a.length > 2) {
      for (var c = arguments.callee(a[0], a[1]), d = 2, e = a.length; e > d; d++) c = arguments.callee(c, a[d]);
      return c
    }
    return arguments[0]
  },
  KUI.date = function(dateStr, format, options) {
    if (!dateStr) return new Date;
    var obj = null;
    if (/Date/.test(dateStr)) {
      var d = dateStr.replace(/\//g, "");
      obj = eval("(new " + d + ")")
    } else obj = "string" == typeof dateStr ? new Date(dateStr.replace(/-/g, "/")) : dateStr;
    var setting = {
      y: 0,
      M: 0,
      d: 0,
      h: 0,
      m: 0,
      s: 0
    };
    $.extend(setting, options || {}),
    obj = new Date(setting.y + obj.getFullYear(), setting.M + obj.getMonth(), setting.d + obj.getDate(), setting.h + obj.getHours(), setting.m + obj.getMinutes(), setting.s + obj.getSeconds());
    var o = {
      "M+": obj.getMonth() + 1,
      "d+": obj.getDate(),
      "h+": obj.getHours(),
      "m+": obj.getMinutes(),
      "s+": obj.getSeconds(),
      "q+": Math.floor((obj.getMonth() + 3) / 3),
      S: obj.getMilliseconds()
    };
    if (format) { / (y + ) / .test(format) && (format = format.replace(RegExp.$1, 4 == RegExp.$1.length ? obj.getFullYear() : (obj.getFullYear() + "").substr(4 - RegExp.$1.length)));
      for (var k in o) new RegExp("(" + k + ")").test(format) && (format = format.replace(RegExp.$1, 1 == RegExp.$1.length ? o[k] : ("00" + o[k]).substr(("" + o[k]).length)));
      return format
    }
    return obj
  },

  KUI.clip = function(a) {
    if (a) {
      ZeroClipboard.setDefaults({
        trustedOrigins: [window.location.protocol + "//" + window.location.host],
        allowScriptAccess: "always"
      });
      var b = new ZeroClipboard(a, {
        moviePath: "http://ptres.31wan.com/js/sq/plugin/ZeroClipboard.swf"
      });
      return b.on("complete",
      function() {
        window.alert("已经复制到剪贴板")
      }),
      b
    }
  },
  exports.KUI = exports.SQ = KUI
} (jQuery, window),
function(a, b, c) {
  var d = new c.Class(c.Widget);
  d.include({
    init: function(b) {
      this.setting = {
        title: null,
        buttons: null,
        mask: !0,
        type: "html",
        content: "",
        width: 600,
        height: 300,
        appendTo: document.body,
        autoShow: !0
      },
      a.extend(this.setting, b),
      this.render(),
      this.events(),
      this.setting.autoShow && this.show()
    },
    events: function() {
      a(window).resize(this.proxy(this.position)),
      this.el.on("click.sq.dialog", ".sq-dialog-btn[href^=javascript]", this.proxy(this._buttonsHandler)).on("click.sq.dialog", ".sq-dialog-close", this.proxy(this.hide))
    },
    _buttonsHandler: function(b) {
      b.preventDefault();
      var c = a(b.target),
      d = c.attr("data-name"),
      e = this.setting.buttons[d];
      e && ("function" == typeof e && e(b, this, d), e.fn && "function" == typeof e.fn && e.fn(b, this, d))
    },
    render: function() {
      if (!this.el) {
        var b = '<div style="display:none;"></div>';
        this.el = a(b),
        this.el.appendTo(a(this.setting.appendTo)),
        this.el.attr("data-kid", this.id)
      }
      var d = '<div class="sq-dialog-masking" style="height:{$docHeight}px;"></div>',
      e = '<div class="sq-dialog" style="width:{$width}px;left:{$left}px;top:{$top}px;">                                <div class="sq-dialog-avatar"></div>                                <div style="position:relative;">                                    <div class="sq-dialog-body">                                        <div class="sq-dialog-titlebar {$notitle}">                                            <span class="sq-dialog-titlebar-text">{$title}</span>                                            <a href="javascript:void(0);" title="关闭" class="sq-dialog-close">关闭</a>                                        </div>                                        <div class="sq-dialog-client">                                            <div class="sq-dialog-content" style="height:{$contentHeight}px;">                                                {%=content%}                                            </div>                                        </div>                                        <div class="sq-dialog-buttons {$nobutton}">                                           {%=buttons%}                                        </div>                                    </div>                                </div>                            </div>',
      f = c.template((this.setting.mask ? d: "") + e, this._renderObj());
      this.el.html(f),
      this.position()
    },
    position: function() {
      var b = a(".sq-dialog-masking", this.el),
      c = a(".sq-dialog", this.el),
      d = a(".sq-dialog-titlebar", this.el),
      e = a(".sq-dialog-buttons", this.el),
      f = a(window),
      g = c.width(),
      h = this.setting.height + e.outerHeight(!0) + d.outerHeight(!0) + 100,
      i = f.width(),
      j = f.height(),
      k = document.documentElement.scrollTop || document.body.scrollTop;
      b.height(a(document).height()),
      c.css({
        left: Math.abs(i - g) / 2,
        top: Math.abs(j - h) / 2 + k
      })
    },
    _buttons: function() {
      var a = [];
      if (this.setting.buttons && c.isObject(this.setting.buttons)) {
        var b = '<a class="sq-dialog-btn btn btn-s-1 {$cls}" {$target} href="{$href}" data-name="{$name}">{$name}</a>';
        for (var d in this.setting.buttons) {
          var e = this.setting.buttons[d],
          f = "javascript:;",
          g = "";
          "string" == typeof e && (f = e, g = "target='_blank'"),
          a.push(c.template(b, {
            cls: e.cls || "",
            name: d,
            href: f,
            target: g
          }))
        }
      }
      return a.join("")
    },
    _renderObj: function() {
      var b = a(window),
      d = this.setting.width,
      e = this.setting.height || 400,
      f = b.width(),
      g = b.height();
      return {
        docHeight: a(document).height(),
        width: this.setting.width,
        contentHeight: e,
        left: (f - d) / 2,
        top: (g - e) / 2,
        title: this.setting.title || "",
        notitle: this.setting.title ? "": "sq-dialog-notitle",
        nobutton: c.isObject(this.setting.buttons) ? "": "sq-dialog-nobutton",
        content: this._getContent(),
        buttons: this._buttons()
      }
    },
    _getContent: function() {
      var b = this.setting.content,
      c = "";
      switch (this.setting.type) {
      case "html":
        "object" == typeof b ? (c = a(b).html(), a(b).empty()) : c = b;
        break;
      case "iframe":
        c = '<iframe allowtransparency="true" frameborder="0" src="' + b + '" width="100%" height="' + (this.setting.height - 10) + '"></iframe>';
        break;
      case "ajax":
        c = '<div class="sq-dialog-loading"><p>正在努力加载...</p></div>',
        a.get(b, this.proxy(this.setContent))
      }
      return c
    },
    setContent: function(b) {
      var c = a(".sq-dialog-content", this.el);
      c.html(b)
    },
    show: function(a) {
      a && this.el.find(".sq-dialog-titlebar-text").text(a),
      this.el.show(),
      this.position(),
      this.trigger("show", this)
    },
    hide: function() {
      this.el.hide(),
      this.trigger("hide", this)
    },
    _destroying: function() {
      a(".sq-dialog-btn", this.el).unbind(),
      this.el.remove()
    }
  }),
  c.Dialog = d,
  c.alert = function(a, b, d) {
    return new c.Dialog({
      title: d || "提示信息",
      buttons: {
        "确定": function(a, c) {
          b && b(),
          c.destroy()
        }
      },
      content: "<div class='sq-dialog-alert'>" + a + "</div>",
      type: "html",
      width: 300,
      height: 70
    })
  },
  c.confirm = function(a, b, d) {
    return new c.Dialog({
      title: "提示信息",
      buttons: {
        "确定": function(a, c) {
          b && b(),
          c.destroy()
        },
        "取消": function(a, b) {
          d && d(),
          b.destroy()
        }
      },
      content: a,
      type: "html",
      width: 360,
      height: 70
    })
  },
  c.tip = function(a) {
    var b = new c.Dialog({
      title: null,
      buttons: null,
      content: a,
      type: "html",
      width: 400,
      height: 40,
      mask: !1
    });
    return setTimeout(function() {
      b.destroy()
    },
    3e3),
    b
  },
  c.loading = function(b, d) {
    d = d || a.noop,
    b = b || "正在加载数据，请稍后...",
    "function" == typeof b && (d = b, b = "正在加载数据，请稍后...");
    var e = new c.Dialog({
      title: "提示信息",
      buttons: {
        "取消加载": function(a, b) {
          b.hide()
        }
      },
      content: '<div class="sq-dialog-loading"><span>' + b + "</span></div>",
      type: "html",
      width: 400,
      height: 60
    });
    return e.bind("hide",
    function() {
      d.call(e),
      e.destroy()
    }),
    e
  }
} (jQuery, window, SQ),
function(a, b) {
  if (b && (!b.Login || !b.Login.version)) {
    var c = '<style type="text/css">.log-tip {top:50%;margin-top:-28px;left:50%;margin-left:-108px;width:218px;height:56px;position:absolute;z-index:2;background:#fff url(http://img1.31wanimg.com/www/css/images/common/bg-login-error.png) no-repeat;_background:#fff url(http://img1.31wanimg.com/www/css/images/common/bg-login-error-8.png) no-repeat;} .log-tip-text {color:#0089e6;font-size:18px;display:inline-block;margin:15px 0 0 60px;} .log-tip-close {position:absolute;display:block;right:2px;top:0;width:20px;height:20px;} .log-tip-cover {position:absolute;z-index:1;width:100%;height:100%;top:0;left:0;opacity:0.5;filter:alpha(opacity=50);background-color:#fff;_height:202px;} .log-tip-code {background-color:#fcfcfc;margin:7px 14px;} .log-tip-code p {margin:0;text-align:center;} .log-tip-code input {width:49px;text-align:center;border:1px solid #d8d9d9;background-color:#e4eff5;border-radius:2px;vertical-align:middle;} .log-tip-code input:focus {border-color:#c6c6c6;box-shadow:0 0 2px #c6c6c6;color:#666;} .log-tip-code img {margin-left:10px;margin-right:10px;cursor:pointer;vertical-align:middle;} .log-tip-btn {width:46px;height:22px;line-height:22px;display:inline-block;text-align:center;overflow:hidden;font-size:12px;vertical-align:middle;background:transparent url(http://img1.31wanimg.com/www/css/images/common/btn.png) -70px -76px;} .log-tip-btn:hover {background-position:-70px -98px;text-decoration:none;}.log-tip-code .log-tip-title {color:#ff6501;font-size:12px;margin-bottom:3px;}</style>';
    a("head").append(c);
    var d = '<style type="text/css">.r-cover {display:none;overflow:hidden;z-index:100;width:100%;position:absolute;left:0;top:0;height:100%;background:#000;opacity:0.5;filter:alpha(opacity=50);}.r-dialog {display:none;top:40px;padding-top:27px;_padding-top:25px;border:1px solid #bbc9d4;z-index:101;width:393px;font-size:14px;border-radius:2px;position:absolute;left:50%;margin-left:-196px;background:#fff url(http://img1.31wanimg.com/www/css/images/common/bg-dialog-banner.jpg) no-repeat;}.r-dialog .ico {vertical-align:middle;}.r-dialog-t {border-bottom:1px solid #a1bdc4;}.r-dialog-t .r-dialog-t-f {margin-left:125px;}.r-dialog-t li {float:left;margin-left:10px;_display:inline;}.r-dialog-t a {color:#007596;display:block;height:20px;background-color:#98e5f4;border:1px solid #b7ccd0;border-bottom:none;padding:6px 30px;border-top-left-radius:1px;border-top-right-radius:1px;_display:inline-block;}.r-dialog-t .focus, .r-dialog-t a:hover {text-decoration:none;background-color:#fff;border-color:#acc6cd;}.r-dialog-t .focus {position:relative;top:1px;cursor:default;color:#006388;}.r-dialog-text {font-size:16px;color:#4e4e4c;border:1px solid #d0dcde;background-color:#e9f8ff;padding:5px;width:214px;border-radius:2px;}.r-dialog-text:focus {border:1px solid #00e7ff;box-shadow:inset 0 0 4px #d6e5ea;}.r-dialog-text-error {border-color:#efb7bc;}.r-dialog-text-error:focus{border-color:#f78690;box-shadow:inset 0 0 2px #efb7bc;background-color:#ecd5db;}.r-dialog-panel{display:none;position:relative;padding:10px 20px 10px;}.r-dialog-panel p {margin-bottom:10px;}.r-dialog-panel-log .r-right {width:85px;}.r-dialog .btn-s-2 {margin-top:5px;}.r-right {display:inline-block;width:95px;text-align:right;}.r-dialog-panel .r-dialog-tip {height:17px;font-size:12px;color:#f00;margin-left:95px;margin-bottom:2px;}.r-dialog-keep {margin-left:85px;margin-right:70px;cursor:pointer;*margin-left:82px;*margin-right:66px;}.r-dialog-close {right:3px;top:-2px;font:16px "Comic Sans MS", Arial, Helvetica, sans-serif;position:absolute;transition:0.3s;color:#006fd3;text-align:center;}.r-dialog-close:hover {text-decoration:none;color:#ffa500;}.r-dialog-protocol {text-indent:50px;}.r-checkbox {position:relative;top:-1px;margin-right:2px;}.r-dialog-ico{display:inline-block;width:16px;height:16px;position:relative;top:4px;left:10px;*top:-1px;_top:3px;}.r-dialog-ico-error,.r-dialog-ico-right{background:transparent url(http://img1.31wanimg.com/www/css/images/common/ico.png) no-repeat;}.r-dialog-ico-error{background-position:0 -679px;}.r-dialog-ico-right{background-position:0 -659px;}.r-dialog-ico-pending{background:transparent url(http://img1.31wanimg.com/www/css/images/common/loading-16x16.gif) no-repeat;}</style><div class="r-cover" id="r-cover"></div><div id="r-dialog" class="r-dialog"><a href="#" title="关闭" class="r-dialog-close">X</a><ul class="r-dialog-t cf"><li class="r-dialog-t-f"><a data-order="0" href="#">用户登录</a></li><li><a data-order="1" href="#">用户注册</a></li></ul><div class="r-dialog-panel r-dialog-panel-log"><p class="r-dialog-tip"></p><p><label class="r-right" for="r-username"><span class="star">*</span>帐号：</label><input name="login_account" type="text" class="r-dialog-text" data-rule="username" id="r-username" /></p><p><label class="r-right" for="r-password"><span class="star">*</span>密码：</label><input name="password" type="password" class="r-dialog-text" data-rule="password" id="r-password" /></p><p><label class="r-dialog-keep" for="r-dialog-keep"><input name="remember_me" id="r-dialog-keep" class="r-checkbox" checked type="checkbox" />记住用户名</label><a title="找回密码" target="_blank" href="http://my.31wan.com/forgetpwd/">忘记密码？</a></p><p class="ac"><a href="#" id="tj-r-btn-log" class="btn btn-s-2">马上登录</a></p></div><div class="r-dialog-panel"><p class="r-dialog-tip"></p><p><label class="r-right" for="rr-username"><span class="star">*</span>帐号：</label><input data-rule="username" name="login_account" type="text" class="r-dialog-text" id="rr-username" /><span class="r-dialog-ico"></span></p><p><label class="r-right" for="rr-password"><span class="star">*</span>密码：</label><input data-rule="password" name="password" type="password" class="r-dialog-text" id="rr-password" /><span class="r-dialog-ico"></span></p><p><label class="r-right" for="rr-rpassword"><span class="star">*</span>确认密码：</label><input data-rule="eq" data-target="#rr-password" name="rpassword" data-error="两次密码不一致" type="password" class="r-dialog-text" id="rr-rpassword" /><span class="r-dialog-ico"></span></p>{realname}<p class="r-dialog-protocol"><label for="r-dialog-protocol" class="star">*</label><input class="r-checkbox" type="checkbox" checked data-rule="checkbox" id="r-dialog-protocol" /><a href="http://my.31wan.com/user_agreement.html" target="_blank">我已阅读并同意《用户注册服务协议》</a><span class="r-dialog-ico"></span></p><p class="ac"><a href="#" id="tj-r-btn-reg" class="btn btn-s-2">完成注册</a></p></div></div>',
    e = '<p><label class="r-right" for="rr-realname"><span class="star">*</span>真实姓名：</label><input name="name" data-rule="realname" type="text" class="r-dialog-text" id="rr-realname" /><span class="r-dialog-ico"></span></p><p><label class="r-right" for="rr-card"><span class="star">*</span>身份证号码：</label><input name="id_card_number" data-rule="card" type="text" class="r-dialog-text" id="rr-card" /><span class="r-dialog-ico"></span></p>';
    b.Login = {
      version: "0.0.3",
      logUrl: "http://my.31wan.com/api/login.php",
      regUrl: "http://my.31wan.com/api/register.php",
      outUrl: "http://my.31wan.com/api/login.php?action=logout",
      infoUrl: "http://my.31wan.com/api/login.php?action=userinfo",
      codeUrl: "http://my.31wan.com/code.php",
      existAccountUrl: "http://my.31wan.com/api/register.php?action=checkUser",
      rU: /^\w{4,20}$/i,
      rP: /^[a-zA-Z0-9`~!@#$%^&*()_+|{}\[\];':"<>?,.\/]{6,20}$/,
     // rCookie: "31wan_account",
     // referCookie: "31wanrefer",
      template: '<p class="log-tip"><span class="log-tip-text">用户名或密码错误</span><a class="log-tip-close" href="#" title="关闭"></a></p><div class="log-tip-cover"></div>',
      template2: '<div class="log-tip"><a class="log-tip-close" href="#" title="关闭"></a><div class="log-tip-code"><p class="log-tip-title">请输入验证码：</p><p><input type="text" /><img title="点击刷新" width="64" height="18" src="http://my.31wan.com/code.php?t={{timestamp}}" alt="点击验证码" title="点击刷新" /><a href="#" class="log-tip-btn">确定</a></p></div></div><div class="log-tip-cover"></div>',
  



   
  


  

    },
    b.Login.Dialog = new b.Class,
    b.Login.Dialog.include({
      $w: a(window),
      isShow: !1,
      defaults: {
        active: 0,
        logSuccess: a.noop,
        logFail: a.noop,
        regSuccess: a.noop,
        regFail: a.noop
      },
      init: function(a) {
        this.options = a
      },
      _init: function() {
        return this.opts = a.extend({},
        this.defaults, {
          $cover: a("#r-cover"),
          $dialog: a("#r-dialog")
        },
        this.options),
        this.opts.$dialog.length ? (this.$tabs = this.opts.$dialog.find(".r-dialog-t a"), this.$panels = this.opts.$dialog.find("div.r-dialog-panel"), this.$logError = this.$panels.eq(0).find("p.r-dialog-tip:first"), this.$regError = this.$panels.eq(1).find("p.r-dialog-tip:first"), this.btnLog = this.opts.$dialog.find("a.btn-s-2:first"), this._change(this.opts.active), this._events(), b.Login.getUsername(this.$username = a("#r-username")), this.rUsername = a("#rr-username"), void 0) : window.alert("似乎没有 dom 结构")
      },
      _events: function() {
        var c = this;
        c.opts.$dialog.on("click.sq.login", ".r-dialog-t a",
        function(a) {
          if (a.preventDefault(), !(this.className.indexOf("focus") > -1)) {
            var b = this.getAttribute("data-order");
            c._change(b, !0)
          }
        }).on("click.sq.login", ".r-dialog-close",
        function(a) {
          a.preventDefault(),
          c.hide()
        }).on("keydown.sq.login", "input",
        function(a) {
          if (13 === a.keyCode) if (this.className.indexOf("text") > -1) {
            if (c.$panels.find("input:focus").trigger("focusout"), this.className.indexOf("error") > -1) return;
            c["_get" + (0 === c.order ? "Login": "Register")](c.btnLog)
          } else c._removeCodeTip();
          27 === a.keyCode && c.hide()
        }).on("click.sq.login", "a.btn",
        function(a) {
          switch (a.preventDefault(), this.innerHTML) {
          case "马上登录":
            c._getLogin(c.btnLog);
            break;
          case "完成注册":
            c._getRegister()
          }
        }).on("change.sq.login", "#r-dialog-protocol",
        function() {
          var a = this.getAttribute("data-rule"),
          b = c["$" + (0 === c.order ? "log": "reg") + "Error"];
          if (a && c._validate[a]) {
            var d = c._validate.checkField(this, a, c),
            e = d === !0;
            c._validate.toggleError(this, e, e ? "": d, b)
          }
        }).on("focusin.sq.login", ".r-dialog-text-error",
        function() {
          var b = a.data(this, "message");
          b && c["$" + (0 === c.order ? "log": "reg") + "Error"].text(b)
        }).on("focusout.sq.login", ".r-dialog-text",
        function(a) {
          a.preventDefault();
          var b = this.getAttribute("data-rule");
          if (b && c._validate[b]) {
            var d = c._validate.checkField(this, b, c),
            e = d === !0;
            "rr-username" === this.id && e && c.remote && c.remote.inValid === this.value ? c._validate.toggleError(this, !1, c.remote.msg, c.$regError) : c._validate.toggleError(this, e, e ? "": d, c["$" + (0 === c.order ? "log": "reg") + "Error"])
          }
        }).on("click.sq.login", ".log-tip-close, .log-tip-btn",
        function(a) {
          a.preventDefault(),
          c._removeCodeTip()
        }).on("click.sq.login", ".log-tip img",
        function() {
          b.Login.refreshCode(this)
        });
        var d;
        c.$w.on("scroll.sq.login",
        function() {
          clearTimeout(d),
          d = setTimeout(function() {
            c._resize(!0)
          },
          300)
        })
      },
      _change: function(b, c) {
        this.$tabs.removeClass("focus").eq(b).addClass("focus"),
        this.$panels.hide().eq(b).show(),
        this._resize(c),
        this.order = +b,
        setTimeout(a.proxy(function() {
          this.$panels.eq(b).find("input:first").focus()
        },
        this), 100)
      },
      _getLogin: function(c) {
        if (!c.hasClass("pending")) {
          c.addClass("pending");
          var d, e = this,
          f = this.$username.val(),
          g = a("#r-password").val(),
          h = a("#r-dialog-keep").prop("checked") ? 1 : 0,
          i = this._validate.check(this.$panels.eq(0), this.$logError, e);
          i ? (d = {
            login_account: f,
            password: g,
            remember_me: h,
            success: function(a) {
              e.$panels.eq(0).find(":text, :password").val(""),
              e.opts.logSuccess.call(e, a),
              e.hide(),
              c.removeClass("pending")
            },
            fail: function(a) {
              return c.removeClass("pending"),
              a && "safe_true" === a.data ? (alert(a.msg), e._showCodeTip()) : (e.opts.logFail.call(e, a), e.$logError.html(a.msg), void 0)
            }
          },
          e.codeValue && (d.save_code = e.codeValue), b.Login.toLog(d)) : c.removeClass("pending")
        }
      },
      _getRegister: function() {
        var c = {},
        d = this,
        e = this.$panels.eq(1),
        //f = b.cookie(b.Login.referCookie),
        g = this._validate.check(e, this.$regError, d);
        g && !d.pending && (e.find("input").each(function() {
          c[this.name] = this.value
        }), f && (c.adrefer = f), b.Login.toReg(a.extend(c, {
          success: function(a) {
            d.$panels.eq(1).find(":text, :password").val(""),
            d.opts.regSuccess.call(d, a),
            d.hide(),
            d.remote && delete d.remote
          },
          fail: function(a) {
            d.opts.regFail.call(d, a),
            d.$regError.html(a.msg)
          }
        })))
      },
      _validate: {
        checkAccount: function(c, d) {
          var e = a(c),
          f = e.next(),
          g = c.value,
          h = a.data(c, "valid"),
          i = a.data(c, "invalid");
          d.remote || (d.remote = {}),
          d.remote.inValid = i,
          d.remote.valid = h,
          i !== g && h !== g && (d.pending = !0, f.toggleClass("r-dialog-ico-right r-dialog-ico-pending"), b.Login.existAccount(g,
          function(b) {
            b && ( - 1 !== b.code ? (f.removeClass("r-dialog-ico-pending").addClass("r-dialog-ico-right"), a.data(c, "valid", g)) : (f.removeClass("r-dialog-ico-pending"), d._validate.toggleError(c, !1, d.remote.msg = b.msg, d.$regError), a.data(c, "invalid", g)), delete d.pending)
          }))
        },
        check: function(b, c, d) {
          var e = this,
          f = !0;
          return b.find("input").each(function() {
            var a = this.getAttribute("data-rule");
            if (a && e[a]) {
              var b = e.checkField(this, a, d),
              g = b === !0;
              e.toggleError(this, g, g ? "": b, c),
              f && (f = g)
            }
          }),
          setTimeout(function() {
            var b = a(c[0].parentNode),
            d = b.find(".r-dialog-text-error:focus");
            d.length ? d.trigger("focus") : b.find(".r-dialog-text-error:first").focus().trigger("focus")
          },
          10),
          f
        },
        checkField: function(a, b, c) {
          if ("rr-password" === a.id) var d = c.rUsername.val();
          var e = this[b].call(a, a.value, {
            username: d || ""
          });
          return "rr-username" === a.id && e === !0 && this.checkAccount(a, c),
          e
        },
        toggleError: function(b, c, d, e) {
          var f = a(b),
          g = f.data("$mess");
          g || (g = f.siblings("span.r-dialog-ico"), f.data("$mess", g)),
          c ? (a(b).removeClass("r-dialog-text-error"), g.length && g.removeClass("r-dialog-ico-error").addClass("r-dialog-ico-right")) : (a(b).addClass("r-dialog-text-error"), g.length && g.removeClass("r-dialog-ico-right").addClass("r-dialog-ico-error")),
          e.html(d),
          a.data(b, "message", d)
        },
        username: function(c) {
          return "r-username" === a(this).attr("id") ? "" !== c: b.Login.checkUsername(c)
        },
        password: function(a, c) {
          return b.Login.checkPassword(a, c && c.username ? c.username: null)
        },
        eq: function(b) {
          return "" === b ? "请确认密码": a(this.getAttribute("data-target")).val() !== b ? "输入的密码不一致": !0
        },
        checkbox: function() {
          return this.checked ? !0 : "请阅读注册协议并勾选同意"
        },
        card: function(a) {
          var b = "身份证号无效，如 440106198202020555";
          if (!a) return "请输入身份证号，如 440106198202020555";
          if (!/^[0-9xX]+$/.test(a)) return b;
          if (15 !== a.length && 18 !== a.length) return b;
          var c, d, e, f, g, h, i = {
            11 : "北京",
            12 : "天津",
            13 : "河北",
            14 : "山西",
            15 : "内蒙古",
            21 : "辽宁",
            22 : "吉林",
            23 : "黑龙江",
            31 : "上海",
            32 : "江苏",
            33 : "浙江",
            34 : "安徽",
            35 : "福建",
            36 : "江西",
            37 : "山东",
            41 : "河南",
            42 : "湖北",
            43 : "湖南",
            44 : "广东",
            45 : "广西",
            46 : "海南",
            50 : "重庆",
            51 : "四川",
            52 : "贵州",
            53 : "云南",
            54 : "西藏",
            61 : "陕西",
            62 : "甘肃",
            63 : "青海",
            64 : "宁夏",
            65 : "新疆",
            71 : "台湾",
            81 : "香港",
            82 : "澳门",
            91 : "国外"
          },
          j = a.split("");
          if (null == i[parseInt(a.substr(0, 2), 10)]) return b;
          switch (a.length) {
          case 15:
            e = (parseInt(a.substr(6, 2), 10) + 1900) % 4 === 0 || (parseInt(a.substr(6, 2), 10) + 1900) % 100 === 0 && (parseInt(a.substr(6, 2), 10) + 1900) % 4 == 0 ? /^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}$/: /^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}$/,
            e.test(a) || (h = b);
            break;
          case 18:
            e = parseInt(a.substr(6, 4), 10) % 4 === 0 || parseInt(a.substr(6, 4), 10) % 100 === 0 && parseInt(a.substr(6, 4), 10) % 4 === 0 ? /^[1-9][0-9]{5}(19|20)[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}[0-9Xx]$/: /^[1-9][0-9]{5}(19|20)[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}[0-9Xx]$/,
            e.test(a) ? (f = 7 * (parseInt(j[0], 10) + parseInt(j[10], 10)) + 9 * (parseInt(j[1], 10) + parseInt(j[11], 10)) + 10 * (parseInt(j[2], 10) + parseInt(j[12], 10)) + 5 * (parseInt(j[3], 10) + parseInt(j[13], 10)) + 8 * (parseInt(j[4], 10) + parseInt(j[14], 10)) + 4 * (parseInt(j[5], 10) + parseInt(j[15], 10)) + 2 * (parseInt(j[6], 10) + parseInt(j[16], 10)) + parseInt(j[7], 10) + 6 * parseInt(j[8], 10) + 3 * parseInt(j[9], 10), c = f % 11, g = "F", d = "10X98765432", g = d.substr(c, 1), g != j[17].toUpperCase() && (h = b)) : h = b
          }
          return h || !0
        },
        realname: function(a) {
          return /^[\u4e00-\u9fa5]+$/.test(a) ? !0 : "请输入真实姓名，如 张三"
        },
        phone: function(a) {
          return "" === a ? "手机号码不能为空": /^0?(13[0-9]|15[0-35-9]|18[012356789]|14[57])[0-9]{8}$/.test(a) ? !0 : "输入的手机号码无效"
        },
        code: function(a) {
          return "" === a ? "安全码不能为空": /^\d+$/.test(a) ? a.length < 4 || a.length > 6 ? "输入的安全码无效": !0 : "安全码必须为数字"
        },
        mail: function(a) {
          return "" === a ? "邮箱不能为空": /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(a) ? !0 : "输入的邮箱无效"
        }
      },
      _showCodeTip: function() {
        this.codeTip = a(b.Login.template2.replace("{{timestamp}}", a.now())).appendTo(this.$panels.eq(0)),
        this.codeTip.find(".log-tip-close").focus(),
        this.codeInput = this.codeTip.find("input")
      },
      _removeCodeTip: function() {
        if (this.codeTip) {
          if (this.codeInput) {
            var a = this.codeInput.val();
            if (!/^\d{4}$/.test(a)) return alert("验证码无效");
            this.codeValue = a,
            this.codeInput = null
          }
          this.codeTip.remove(),
          this.codeTip = null
        }
      },
      show: function(c) {
        var f, g = this;
        g.parseTemplate ? g._show(c) : (f = b.getParam("referer") || b.getParam("refer"), a(document.body).append(d.replace("{realname}", f ? "": e)), g.parseTemplate = !0, g._init(), setTimeout(function() {
          g._show(c)
        },
        1))
      },
      _show: function(b) {
        this.opts.$cover.height(a(document).height()).show(),
        this.opts.$dialog.show(),
        this.isShow = !0,
        "number" == typeof b && this.order != b && this._change(b)
      },
      _getTop: function() {
        return document.documentElement.scrollTop || document.body.scrollTop
      },
      _resize: function(a) {
        var b = this.$w.height(),
        c = this.opts.$dialog.outerHeight(!0),
        d = (b - c) / 2,
        e = this._getTop();
        this.opts.$dialog[a ? "animate": "css"]({
          top: d + e
        })
      },
      hide: function() {
        this.isShow && (this.opts.$cover.hide(), this.opts.$dialog.hide(), this.isShow = !1)
      }
    })
  }
} (jQuery, SQ),
function(a, b, c) {
  function d(a) {
    var b = {},
    d = /^jQuery\d+$/;
    return c.each(a.attributes,
    function(a, c) {
      c.specified && !d.test(c.name) && (b[c.name] = c.value)
    }),
    b
  }
  function e(a, d) {
    var e = this,
    f = c(e);
    if (e.value == f.attr("placeholder") && f.hasClass("placeholder")) if (f.data("placeholder-password")) {
      if (f = f.hide().next().show().attr("id", f.removeAttr("id").data("placeholder-id")), a === !0) return f[0].value = d;
      f.focus()
    } else e.value = "",
    f.removeClass("placeholder"),
    e == b.activeElement && e.select()
  }
  function f() {
    var a, b = this,
    f = c(b),
    g = this.id;
    if ("" === b.value) {
      if ("password" === b.type) {
        if (!f.data("placeholder-textinput")) {
          try {
            a = f.clone().attr({
              type: "text"
            })
          } catch(h) {
            var i = c.extend(d(this), {
              type: "text"
            }),
            j = i.placeholder;
            delete i.placeholder,
            delete i.type,
            a = c("<input type='text' placeholder=" + j + " />").attr(i)
          }
          a.removeAttr("name").data({
            "placeholder-password": !0,
            "placeholder-id": g
          }).on("focus.placeholder", e),
          f.data({
            "placeholder-textinput": a,
            "placeholder-id": g
          }).before(a)
        }
        f = f.removeAttr("id").hide().prev().attr("id", g).show()
      }
      f.addClass("placeholder"),
      f[0].value = f.attr("placeholder")
    } else f.removeClass("placeholder")
  }
  var g, h, i = "placeholder" in b.createElement("input"),
  j = "placeholder" in b.createElement("textarea"),
  k = c.fn,
  l = c.valHooks;
  i && j ? (h = k.placeholder = function() {
    return this
  },
  h.input = h.textarea = !0) : (h = k.placeholder = function() {
    var a = this;
    return a.filter((i ? "textarea": ":input") + "[placeholder]").not(".placeholder").bind({
      "focusin.placeholder": e,
      "focusout.placeholder": f
    }).data("placeholder-enabled", !0).trigger("focusout.placeholder"),
    a
  },
  h.input = i, h.textarea = j, g = {
    get: function(a) {
      var b = c(a);
      return b.data("placeholder-enabled") && b.hasClass("placeholder") ? "": a.value
    },
    set: function(a, d) {
      var g = c(a);
      return g.data("placeholder-enabled") ? ("" == d ? (a.value = d, a != b.activeElement && f.call(a)) : g.hasClass("placeholder") ? e.call(a, !0, d) || (a.value = d) : a.value = d, g) : a.value = d
    }
  },
  i || (l.input = g), j || (l.textarea = g), c(function() {
    c(b).on("form", "submit.placeholder",
    function() {
      var a = c(".placeholder", this).each(e);
      setTimeout(function() {
        a.each(f)
      },
      10)
    })
  }), c(a).bind("beforeunload.placeholder",
  function() {
    c(".placeholder").each(function() {
      this.value = ""
    })
  }))
} (this, document, jQuery),
function(a, b) {
  var c = document,
  d = a(c),
  e = window.location,
  f = !1,
  g = a.Deferred(),
  h = a.Deferred(),
  i = a.Deferred(),
  j = !1,
  k = !1,
  l = a.Deferred(),
  m = {
    init: function() {
/*      this.eventClick(),
      this.apiCommonData(),
      this.loginModule = a("#login"),
      this.login.init(),
      this.leftLogin.init(this.loginModule),
      this.searchInputBox = a("#search-input"),
      this.searchType.init(),
      this.searchFillIn(),
      a.fn.placeholder && a("input[placeholder], textarea[placeholder]").placeholder(),
      this.os()*/
    },
    userInfo: null,
    getLogin: function() {
      return f
    },
    bindLogin: function(a) {
      g.done(a)
    },
    bindUnLogin: function(a) {
      h.done(a)
    },
    bindMsg: function(a) {
      i.done(a)
    },
    loginSuccess: function(a) {
      m.leftLogin.parse(a),
      f = !0,
      g.resolve(a)
    },
    login: {
      init: function() {
        m.leftLogin.log && m.leftLogin.log.hide(),
        b.Login.getUserInfo({
          nt: m.loginModule.length
        },
        function(a) {
          m.loginSuccess(a)
        },
        function(a) {
          a && -1 === a.code && (m.leftLogin.log && m.leftLogin.log.show(), m.tLog && m.tLog.show(), h.resolve(a))
        }),
        m.tLog = a("span.t-log:first"),
        this.dialog = new b.Login.Dialog({
          logSuccess: function(a) {
            m.loginSuccess(a)
          },
          regSuccess: function(a) {
            m.loginSuccess(a)
          }
        }),
        this.events()
      },
      events: function() {
        var c, f = this;
        d.on("click", "a.t-login, a.t-reg",
        function(a) {
          a.preventDefault(),
          f.dialog.show(this.className.indexOf("reg") > -1 ? 1 : 0)
        }).on("click", "a.t-log-out",
        function(a) {
          a.preventDefault(),
          b.Login.toOut(function() {
            e.reload()
          })
        }).on("mouseenter mouseleave", ".progress",
        function(b) {
          var d = a(this),
          g = d.data("offset");
          if ("mouseenter" === b.type) {
            if (clearTimeout(c), f.userExp || e.href.indexOf("my.31wan.com/user/vip.php") > -1) return;
            f.userExp = a(m.leftLogin.userExpTemp.replace("{grade}", m.userInfo.VIP_EXP).replace("{target}", -1 === e.host.indexOf("my.31wan.com") ? " target='_blank'": "")).appendTo(document.body),
            g || (g = d.offset()),
            f.userExp.css({
              top: g.top + 30,
              left: g.left + 13
            }).fadeIn(200)
          } else "mouseleave" === b.type && f.userExp && (c = setTimeout(function() {
            f.userExp.remove(),
            f.userExp = null
          },
          100))
        }).on("mouseenter mouseleave", ".loged-exp",
        function(a) {
          "mouseenter" === a.type ? clearTimeout(c) : c = setTimeout(function() {
            f.userExp.remove(),
            f.userExp = null
          },
          100)
        })
      }
    },
    leftLogin: {
      t: '<a target="_blank" title="{title}" href="{url}"><img width="16" height="16" src="{imgUrl}" /><span class="red">{name}</span><span>{sname}</span><b class="loged-game-r{recClass}">{recText}</b></a>',
      userExpTemp: '<div class="loged-exp"><p>您的成长值：<span class="orange">{grade}</span></p><p><a{target} class="orange" title="什么是成长值？" href="http://my.31wan.com/user/vip.php">什么是成长值？</a></p></div>',
      phoneBind: '<p class="loged-phone"> <i class="ico ico-alert"></i>为了您的帐号安全，请尽快<a class="orange" title="绑定手机" target="_blank" href="http://my.31wan.com/user/userprotect.php#3">绑定手机</a>！<a class="loged-phone-close" class="orange" href="javascript:;">[关闭]</a></p>',
     // phoneBindCookie: "31wan_phone_bind_tip",
      phoneBindSession: "31wan_phone_tip_session",
      init: function(c) {
        c && c.length && (this.username = a("#user_name"), this.password = a("#password"), this.element = c, this.log = c.find("div.log:first"), this.loged = c.find("div.loged:first"), this.loginTitle = c.prev(), this.checkbox = this.log.find("span.ico-check:first"), this.events(), b.Login.getUsername(this.username))
      },
      events: function() {
        var a = this;
        a.btnLog = a.log.find("a.log-btn-login:first"),
        a.element.on("click", "a.btn-l, a.log-btn-login",
        function(b) {
          b.preventDefault(),
          a.toLog(a.btnLog)
        }).on("keypress", "input",
        function(b) {
          13 === b.keyCode && (this.className.indexOf("log") > -1 ? a.toLog(a.btnLog) : a.tip && a.removeTip())
        }).on("click", ".log-tip:not(:has(input)), .log-tip-close, .log-tip-btn",
        function(b) {
          b.preventDefault(),
          a.tip && a.removeTip()
        }).on("click", "a.loged-out",
        function(a) {
          a.preventDefault(),
          b.Login.toOut(function() {
            e.reload()
          })
        }).on("click", ".ico-check, .ico-check~label",
        function() {
          a.checkbox.toggleClass("ico-checked")
        }).on("click", ".log-tip-code img",
        function() {
          b.Login.refreshCode(this)
        }).on("click", ".loged-phone .loged-phone-close",
        function(b) {
          b.preventDefault(),
          a.phoneBindTip.remove()
        }),
        d.on("keypress",
        function(b) {
          27 === b.keyCode && a.tip && a.removeTip()
        })
      },
      toLog: function(a) {
        if (!a.hasClass("pending")) {
          a.addClass("pending");
          var c, d, e = this,
          f = this.username.val(),
          g = this.password.val(),
          h = this.checkbox[0].className.indexOf("checked") > -1 ? 1 : 0;
          if (c = b.Login.checkPassword(g), "" === f && !this.tip) return this.showTip(),
          this.errorInput = this.username,
          void 0;
          if (c !== !0 && !this.tip) return this.showTip(),
          this.errorInput = this.password,
          void 0;
          d = {
            login_account: f,
            password: g,
            remember_me: h,
            success: function(b) {
              e.password.val(""),
              m.loginSuccess(b),
              a.removeClass("pending")
            },
            fail: function(b) {
              return a.removeClass("pending"),
              b && "safe_true" === b.data ? (alert(b.msg), e.showTip(!0)) : (b && b.code < 0 && e.showTip(), -1 === b.code && (e.errorInput = e.username), -2 === b.code && (e.errorInput = e.password), void 0)
            }
          },
          this.codeValue && (d.save_code = this.codeValue),
          b.Login.toLog(d)
        }
      },
      showTip: function(c) {
        this.tip = a(c ? b.Login.template2.replace("{{timestamp}}", a.now) : b.Login.template).appendTo(this.log),
        this.tip.find(".log-tip-close").focus(),
        c ? this.codeInput = this.tip.find("input").focus() : this.tip.css("cursor", "pointer")
      },
      removeTip: function() {
        if (this.tip) {
          if (this.codeInput) {
            var a = this.codeInput.val();
            if (!/^\d{4}$/.test(a)) return alert("验证码无效");
            this.codeValue = a,
            this.codeInput = null
          }
          this.tip.remove(),
          this.tip = null,
          this.btnLog.removeClass("pending"),
          this.errorInput.focus()
        }
      },
      parse: function(a) {
        m.userInfo = a,
        this._parseLeft(a),
        this._parseTop(a)
      },
      refreshPoint: function(b, c) {
        this.point || (this.point = a("#mypoints")),
        c ? this.point.text(b) : ("string" == typeof m.userInfo.POINT && (m.userInfo.POINT = +m.userInfo.POINT), this.point.text(m.userInfo.POINT = m.userInfo.POINT + b))
      },
      _formatAccount: function(a) {
        return a.length > 12 ? a.substring(0, 12) + "...": a
      },

      _parseTop: function(b) {
        var c = m.tLog,
        d = c.prev();
        c.length && (c.hide(), d.find("b").eq(0).text(this._formatAccount(b.LOGIN_ACCOUNT)).attr("title", b.LOGIN_ACCOUNT).end().end().css("display", "inline-block"), d.find(".t-loged-vip:first").text(0 !== b.VIP_DEEP ? b.VIP_DEEP: "").addClass(0 !== b.VIP_DEEP ? "t-loged-vip-red": "t-loged-vip-gray"), a.ajax({
          url: "http://my.31wan.com/api/message_api.php?action=is_remind",
          dataType: "jsonp",
          timeout: 3e3
        }).done(function(a) {
          a && 0 === a.code && a.data > 0 && (d.find("a.t-mails span").eq(0).show().parent().addClass("t-mails-on"), i.resolve(a))
        }))
      }
    },
    bindFixed: function(c) {
      "3" !== b.getParam("showlogintype") && (l.done(c), j || k ? j && l.resolve() : (k = !0, a.ajax({
        url: "http://ptres.31wan.com/js/sq/widget/sq.fixed.js?t=20140101",
        dataType: "script",
        cache: !0
      }).done(function() {
        k = !1,
        j = !0,
        l.resolve()
      })))
    },
    showDate: function(a, b) {
      var c = new Date,
      d = c.getMonth() + 1,
      e = c.getDate();
      a.html(d + "月"),
      b.html(e)
    },
    bookMark: function(a, d) {
      var f = a || e.href,
      g = d || c.title;
      try {
        window.external.AddFavorite(f, g)
      } catch(h) {
        try {
          window.sidebar.addPanel(g, f, "")
        } catch(h) {
          return b.alert("请您尝试同时按下Ctrl和D键收藏本页。")
        }
      }
    },
    setHome: function(a) {
      var c = a.target,
      d = e.href;
      try {
        return c.style.behavior = "url(#default#homepage)",
        c.setHomePage(d),
        !1
      } catch(f) {
        return b.alert("您的浏览器不支持此操作，请您手动设置主页。")
      }
    },
    eventClick: function() {
      var b = this,
      c = a("div.top:first"),
      d = a(".t-moregames"),
      e = a("#pop-game"),
      f = a(".search-box");
      c.on("click", "#sethome",
      function(a) {
        a.preventDefault(),
        b.setHome(a)
      }).on("click", "#bookmark",
      function(a) {
        a.preventDefault(),
        b.bookMark()
      }).on("mouseenter mouseleave", ".t-log",
      function(b) {
        b.preventDefault(),
        a(this).toggleClass("t-log-focus")
      }),
      d.add(e).bind("mouseenter",
      function() {
        b.pt && clearTimeout(b.pt),
        d.addClass("t-moregames-focus"),
        e.fadeIn("fast")
      }).bind("mouseleave",
      function() {
        b.pt && clearTimeout(b.pt),
        b.pt = setTimeout(function() {
          d.removeClass("t-moregames-focus"),
          e.hide()
        },
        100)
      }),
      f.on("submit", "#search-form",
      function() {
        var c = a.trim(b.searchInputBox.val()),
        d = b.searchInputBox.attr("placeholder");
        return c && c != d ? void 0 : !1
      }).on("mouseenter", ".search-type",
      function() {
        a(".selectbox").show(),
        a(".search-select-current").addClass("search-type-focus")
      }).on("mouseleave", ".search-type",
      function() {
        a(".selectbox").hide(),
        a(".search-select-current").removeClass("search-type-focus")
      }).on("click", ".selectbox-item",
      function(a) {
        a.preventDefault(),
        b.searchType._parse(a)
      })
    },
    searchType: {
      init: function() {
        this.searchForm = a("#search-form"),
        this.selectBox = a(".selectbox"),
        this.selectCurrent = a(".search-select-current-name"),
        this.searchTypeInfo = {
          game: {
            url: "http://www.31wan.com/search/game.php",
            key: "q",
            names: "游戏"
          },
          gift: {
            url: "http://www.31wan.com/gift/",
            key: "keyword",
            names: "礼包"
          },
          info: {
            url: "http://www.31wan.com/search/",
            key: "q",
            names: "资讯"
          }
        }
      },
      _parse: function(b) {
        var c = a(b.target).attr("data-search-type");
        this.change(c)
      },
      change: function(b) {
        b && (this.searchForm.attr("action", this.searchTypeInfo[b].url), a("#search-input").attr("name", this.searchTypeInfo[b].key), a(".search-hidden-type").val(b), this.selectCurrent.text(this.searchTypeInfo[b].names), this.selectBox.hide())
      }
    },
    apiCommonData: function() {
      var b = this;
      a.ajax({
        url: "ion=header&r=" + Math.random(),
        dataType: "jsonp"
      }).done(function(c) {
        if (1 === c.code) {
          var d = c.msg;
          b.topFlash(d.top_flash),
          b.hotWord(d.search_hot_word),
          b.topGameList(d.leader_game, a("#pop-1"), a("#pop-tpl-1"), 0, 10),
          b.topGameList(d.leader_game, a("#pop-2"), a("#pop-tpl-2"), 10, 20),
          b.topGameList(d.leader_game, a("#pop-3"), a("#pop-tpl-3"), 20, 29)
        }
      })
    },
    topFlash: function(b) {
      if (b) {
        var c = a(".top-flash");
        if (c.length) {
          var d = '<embed width="100%" height="100%" quality="high" type="application/x-shockwave-flash" wmode="transparent" src="' + b + '" title="31wan网页游戏" />';
          c.eq(0).html(d)
        }
      }
    },
    hotWord: function(b) {
      if (b) {
        var c = "";
        a.each(b,
        function(a) {
          5 > a && (c += '<a id="hotword-' + a + '" target="_blank" href="http://www.31wan.com/search/game.php?q=' + encodeURIComponent(b[a]) + '">' + b[a] + "</a>")
        }),
        a(c).appendTo(".hot-words")
      }
    },
    topGameList: function(c, d, e, f, g) {
      if (c && c.length && d.length && e.length) {
        var h = e.html(),
        i = c.slice(f, g),
        j = b.T(h, i);
        a(j).prependTo(d)
      }
    },
    searchFillIn: function() {
      var a = b.getParam("q") || b.getParam("keyword") || "",
      c = b.getParam("type");
      this.searchInputBox.length && (a && this.searchInputBox.val(decodeURIComponent(a)), c && this.searchType.change(c))
    },
    os: function() {
      navigator.userAgent.toLowerCase().indexOf("mac") > -1 && a(document.body).addClass("os-mac")
    }
  };
  a(document).ready(function() {
    m.init()
  }),
  b.Top = m
} (jQuery, SQ),
function(a, b) {
  "use strict";
  var c = window,
  d = {
    opts: {
      loginFrame: a("#login"),
      win: a("#dialog-sign"),
      notice_tip: "您已签到成功！"
    },
    init: function() {
      this.opts.loginFrame.length && this.opts.win.length && this.events()
    },
    events: function() {
      var b = this;
      a(document.body).on("click", "#l-sign-now, .js-sign-in",
      function(a) {
        a.preventDefault(),
        b.signNow()
      })
    },
    isSign: !1,
    signNow: function() {
      this.el || (this.el = new b.Dialog({
        title: "玩家签到",
        width: 410,
        height: 340,
        autoShow: !1,
        content: this.opts.win
      })),
      this.getSignLogs(),
      this.handler()
    },

    notice: function() {
      var b = a("#sign-notice");
      b.length && b.html(this.opts.notice_tip)
    },
    getSignLogs: function() {
      var c = b.Top.getLogin();
      if (c) {
        var d = this,
        e = "http://shop.31wan.com/sign/index.php?action=get_my_sign&r=" + Math.random();
        a.ajax({
          url: e,
          dataType: "jsonp"
        }).done(function(a) {
          d.calendar.init(a.data.sign_days)
        })
      }
    },
    calendar: {
      init: function(b) {
        this.events(a("#sign-date"), a("#sign-date-show"), b)
      },
      opts: {
        weeks: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],
        month: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"]
      },
      events: function(c, d, e) {
        var f = this.eventsHandler(e);
        c.html(f.nowY + "年" + f.nowM + "月"),
        a.browser.msie && "6.0" == a.browser.version ? (d.hide(), d.html(f.html), setTimeout(function() {
          d.show()
        },
        100)) : d.html(f.html);
        var g = this.today();
        for (var h in e) {
          var i = a(".sign-date").find("td[date=" + e[h] + "]");
          i && i.addClass("yes"),
          e[h] == g && (a("#sign-now").addClass("signed"), b.SignIn.isSign = !0)
        }
      },
      today: function(a) {
        var b = new Date,
        c = b.getFullYear(),
        d = b.getMonth(),
        e = b.getDate(),
        f = parseInt(d, 10) + 1;
        f = f > 0 && 10 > f ? "0" + f.toString() : f.toString();
        var g = e;
        g = g > 0 && 10 > g ? "0" + g.toString() : g.toString();
        var h = c.toString() + f + g;
        return "d" == a ? g: "m" == a ? f: h
      },
      eventsHandler: function() {
        var a = new Date,
        b = a.getFullYear(),
        c = a.getMonth(),
        d = this.getFirstDate(b, c).getDay(),
        e = this.getLastDate(b, c).getDay(),
        f = this.getLastDate(b, c).getDate(),
        g = '<table border="0" cellpadding="0" cellspacing="1"><tbody><tr>';
        for (var h in this.opts.weeks) g += "<th>" + this.opts.weeks[h] + "</th>";
        g += "</tr>",
        g += "<tr>";
        var i = 0;
        if (0 != d) for (var j = this.getLastDate(b, c - 1).getDate(), k = j - d + 1, l = k; j >= l; l++) g += '<td class="no"></td>',
        i++;
        var m = parseInt(c, 10) + 1;
        m > 0 && 10 > m && (m = "0" + m.toString());
        for (var n = this.today("d"), o = 1; f >= o; o++) {
          var p = "",
          q = o;
          q > 0 && 10 > q && (q = "0" + q.toString()),
          p = b.toString() + m + q,
          g += '<td class="date-td',
          o == n && (g += " today"),
          g += '" date="' + p + '">' + o + "</td>",
          i++,
          7 == i && (i = 0, g += "</tr>", 6 != e && (g += "<tr>"))
        }
        if (6 != e) {
          for (var r = 6 - e,
          s = 1; r >= s; s++) g += '<td class="no"></td>';
          g += "</tr>"
        }
        return g += "</tbody></table>",
        {
          html: g,
          nowY: b,
          nowM: c + 1,
          nowD: a.getDate()
        }
      },
      getFirstDate: function(a, b) {
        return new Date(a, b, 1)
      },
      getLastDate: function(a, b) {
        return new Date(a, b + 1, 0)
      }
    }
  };
  a(document).ready(function() {
    d.init()
  }),
  b.SignIn = d
} (jQuery, SQ);