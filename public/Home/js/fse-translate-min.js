var fseTranslate = function () { var b = this; FlyJSONP.init({ debug: false }); b.translate = function (k) { k.from = k.from || "zh"; k.to = k.to || "en"; k.callBack = k.callBack || function () { }; var u = $("*"); var o = u.length; var e = 0; var m = new Object(); var v = new Array(); for (var r = 0; r < o; r++) { var h = $(u[r]); var s = h.contents().filter(function (i, j) { return j.nodeType == 3 }); var f = s.length; for (var q = 0; q < f; q++) { if (!s[q].data) { continue } if (typeof (s[q].data) != "string") { continue } if (s[q].data.replace(/\s/g, "").length == 0) { continue } e++; m[e] = s[q]; v.push("sosharp"); v.push(e); v.push("e"); v.push(s[q].data) } } var n = v.join(""); var d = a(null, n, 4900, 0); g(d, 0); function g(i, j) { if (j == i.length) { return } FlyJSONP.post({ url: "http://fanyi.baidu.com/v2transapi", parameters: { from: k.from, to: k.to, query: i[j], transtype: "realtime", simple_means_flag: 3 }, success: function (w) { j++; g(i, j); c(w) }, error: function (w) { } }) } var l = 0; var p = []; function c(y) { l++; y = y || {}; if (typeof (y) != "object") { try { y = JSON.parse(y || {}) } catch (z) { return } } if (!y.trans_result) { return } if (!y.trans_result["data"]) { return } if (y.trans_result["data"].length == null) { return } if (y.trans_result["data"].length == 0) { return } if (!y.trans_result["data"][0]["dst"]) { return } var j = y.trans_result["data"]; var w = j.length; for (var x = 0; x < w; x++) { p.push(j[x]["dst"]) } if (l == d.length) { t() } } function t() { var z = p.join(""); var A = /(sosharp|Sosharp)((?!sosharp|Sosharp).)*/g; var j = z.match(A); j = $.grep(j, function (i) { return (i || "").replace(/\s/g, "").length > 0 }); var C = j.length; for (var y = 0; y < C; y++) { var w = j[y].indexOf("e"); var B = j[y].substr(0, w).replace(/[^0-9]/g, ""); var x = j[y].substring(w + 1); m[B].data = x } k.callBack(m) } }; function a(d, e, c, f) { if (!d || typeof (d) != "object" || d.length == null) { d = new Array() } if (!e || typeof (e) != "string") { e = "" } if (!c || typeof (c) != "number") { c = 1 } if (!f || typeof (f) != "number") { f = 0 } if (e.length > (f + c)) { d.push(e.substr(f, c)); f += c; return a(d, e, c, f) } else { d.push(e.substr(f, e.length - f)); return d } } return this }; var FlyJSONP = (function (b) { var j, g, d, a, e, h, i, f, c; g = function (k, m, l) { if (k.addEventListener) { k.addEventListener(m, l, false) } else { if (k.attachEvent) { k.attachEvent("on" + m, l) } else { k["on" + m] = l } } }; d = function (m, k) { j.log("Garbage collecting!"); k.parentNode.removeChild(k); b[m] = undefined; try { delete b[m] } catch (l) { } }; a = function (l, m) { var n = "", k, o; for (k in l) { if (l.hasOwnProperty(k)) { k = m ? encodeURIComponent(k) : k; o = m ? encodeURIComponent(l[k]) : l[k]; n += k + "=" + o + "&" } } return n.replace(/&$/, "") }; e = function () { var n = "", m = [], k = "0123456789ABCDEF", l = 0; for (l = 0; l < 32; l += 1) { m[l] = k.substr(Math.floor(Math.random() * 16), 1) } m[12] = "4"; m[16] = k.substr((m[16] & 3) | 8, 1); n = "flyjsonp_" + m.join(""); return n }; h = function (l, k) { j.log(k); if (typeof (l) !== "undefined") { l(k) } }; i = function (l, k) { j.log("GET success"); if (typeof (l) !== "undefined") { l(k) } j.log(k) }; f = function (l, k) { j.log("POST success"); if (typeof (l) !== "undefined") { l(k) } j.log(k) }; c = function (k) { j.log("Request complete"); if (typeof (k) !== "undefined") { k() } }; j = {}; j.options = { debug: false }; j.init = function (k) { var l; j.log("Initializing!"); for (l in k) { if (k.hasOwnProperty(l)) { j.options[l] = k[l] } } j.log("Initialization options"); j.log(j.options); return true }; j.log = function (k) { if (b.console && j.options.debug) { b.console.log(k) } }; j.get = function (m) { m = m || {}; var l = m.url, o = m.callbackParameter || "callback", n = m.parameters || {}, k = b.document.createElement("script"), q = e(), p = "?"; if (!l) { throw new Error("URL must be specified!") } n[o] = q; if (l.indexOf("?") >= 0) { p = "&" } l += p + a(n, true); b[q] = function (r) { if (typeof (r) === "undefined") { h(m.error, "Invalid JSON data returned") } else { if (m.httpMethod === "post") { r = r.query.results; if (!r || !r.postresult) { h(m.error, "Invalid JSON data returned") } else { if (r.postresult.json) { r = r.postresult.json } else { r = r.postresult } f(m.success, r) } } else { i(m.success, r) } } d(q, k); c(m.complete) }; j.log("Getting JSONP data"); k.setAttribute("src", l); b.document.getElementsByTagName("head")[0].appendChild(k); g(k, "error", function () { d(q, k); c(m.complete); h(m.error, "Error while trying to access the URL") }) }; j.post = function (l) { l = l || {}; var k = l.url, p = l.parameters || {}, o, n, m = {}; if (!k) { throw new Error("URL must be specified!") } o = encodeURIComponent('select * from jsonpost where url="' + k + '" and postdata="' + a(p, false) + '"'); n = "http://query.yahooapis.com/v1/public/yql?q=" + o + "&format=json&env=" + encodeURIComponent("store://datatables.org/alltableswithkeys"); m.url = n; m.httpMethod = "post"; if (typeof (l.success) !== "undefined") { m.success = l.success } if (typeof (l.error) !== "undefined") { m.error = l.error } if (typeof (l.complete) !== "undefined") { m.complete = l.complete } j.get(m) }; return j }(this));