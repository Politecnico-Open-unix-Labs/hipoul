(function (exports) {
    "use strict";

    var modules = {}, domready = false,
        functions_buffer = [];

    function require(module_name) {
        return modules[module_name] || exports[module_name] || undefined;
    }

    function module(name, callback) {
        modules[name] = modules[name] || {};
        callback(require, modules[name]);
    }

    function loadPage() {
        if (domready === false) {
            var i = 0, len = functions_buffer.length;
            while (i < len) {
                functions_buffer[i](require);
                i += 1;
            }
            domready = true;
        }
    }

    function main(callback) {
        if (domready === false) {
            functions_buffer[functions_buffer.length] = callback;
        } else {
            callback(require);
        }
    }

    if (exports.addEventListener !== undefined) {
        exports.addEventListener("DOMContentLoded", loadPage, false);
        exports.addEventListener("load", loadPage, false);
    } else if (exports.attachEvent !== undefined) {
        exports.attachEvent("onload", loadPage);
    } else {
        exports.onload = loadPage;
    }

    exports.module = module;
    exports.main = main;
}(this));

/*
   Peppy - A lightning fast CSS 3 Compliant selector engine.
   http://www.w3.org/TR/css3-selectors/#selectors

   version 0.1.2

   Author: James Donaghue - james.donaghue@gmail.com

   Copyright (c) 2008 James Donaghue (jamesdonaghue.com)
   Licenced under the FreeBSD (http://www.freebsd.org/copyright/freebsd-license.html) licence.
*/
module("peppy",function(L,K){function H(c,d){var e=[],h={};d&&(d=RegExp("^"+d+"$","i"));for(var g=0,m;m=c[g++];)if(m.uid=m.uid||D++,!h[m.uid]&&(!d||-1!==m.nodeName.search(d)))e[e.length]=h[m.uid]=m;return e}function x(c,d){return!c?null:"class"===d||"className"===d?c.className:"for"===d?c.htmlFor:c.getAttribute(d)||c[d]}function G(c,d,e,h){var g,m,k="",n=[],j=[],f,s,q;p.id.lastIndex=p.typeSelector.lastIndex=p.classRE.lastIndex=0;p.tag.test(c)||(c="*"+c);g=p.typeSelector.exec(c)[1];d=d instanceof Array?
d.slice(0):[d];q=d.length;s=q-1;p.id.test(g)?(k="id",m=(m=g.match(/^\w+/))?m[0]:"*",g=g.replace(p.id,"")):p.classRE.test(g)&&(k="class",m=(m=g.match(p.tag))?m[0]:"*",g=g.replace(p.tag,""),contextRE=C[g+"RegExp"]||(C[g+"RegExp"]=RegExp("(?:^|\\s)"+g.replace(/\./g,"\\s*")+"(?:\\s|$)")),g=g.replace(/\./g," "));for(;-1<s;){f=d[s--];f.uid=f.uid||D++;var v=c+f.uid;if(I&&y[v])n=n.concat(y[v]);else{if("id"===k){var j=g,t=f,u=e,w=v,B=m,A=void 0;f=[];if(h)j=x(t,"id")===j?[t]:[];else{if((A=t.getElementById?
t.getElementById(j):z.getElementById(j))&&x(A,"id")===j)f[f.length]=A,y[w]=f.slice(0);else{w=t.getElementsByTagName(B);u&&(w[w.length]=t);t=0;for(u=void 0;u=w[t++];)if(x(u,"id")===j){f[f.length]=u;break}}j=f}}else if("class"===k)if(t=g,j=contextRE,u=f,w=e,B=v,A=m,f=[],h)j=j.test(u.className)?[u]:[];else{if(u.getElementsByClassName)f=E(u.getElementsByClassName(t)),w&&j.test(u.className)&&(f[f.length]=u),"*"!=A&&(f=H(f,A)),y[B]=f.slice(0);else if(z.getElementsByClassName)f=E(z.getElementsByClassName(t)),
"*"!=A&&(f=H(f,A)),y[B]=f.slice(0);else{t="*"==A&&u.all?u.all:u.getElementsByTagName(A);w&&(t[t.length]=u);u=0;for(w=void 0;w=t[u++];)j.test(w.className)&&(f[f.length]=w)}j=f}else if(j=E(f.getElementsByTagName(g)),e&&(f.nodeName.toUpperCase()===g.toUpperCase()||"*"===g))j[j.length]=f;n=1<q?n.concat(j):j;y[v]=n.slice(0)}}return n}var z=document,B=/(?!.*?opera.*?)msie(?!.*?opera.*?)/i.test(navigator.userAgent),F=/webkit/i.test(navigator.userAgent),y={},I=!B&&!F,C={},D=0,p={trim:/^\s+|\s+$/g,quickTest:/^[^:\[>+~ ,]+$/,
typeSelector:/(^[^\[:]+?)(?:\[|\:|$)/,tag:/^(\w+|\*)/,id:/^(\w*|\*)#/,classRE:/^(\w*|\*)\./,attributeName:/(\w+)(?:[!+~*\^$|=])|\w+/,attributeValue:/(?:[!+~*\^$|=]=*)(.+)(?:\])/,pseudoName:/(\:[^\(]+)/,pseudoArgs:/(?:\()(.+)(?:\))/,nthParts:/([+-]?\d)*(n)([+-]\d+)*/i,combinatorTest:/[+>~ ](?![^\(]+\)|[^\[]+\])/,combinator:/\s*[>~]\s*(?![=])|\s*\+\s*(?![0-9)])|\s+/g,recursive:/:(not|has)\((\w+|\*)?([#.](\w|\d)+)*(\:(\w|-)+(\([^\)]+\))?|\[[^\}]+\])*(\s*,\s*(\w+|\*)?([#.](\w|\d)+)*(\:(\w|-)+(\([^\)]+\))?|\[[^\}]+\])*)*\)/gi},
E;E=window.attachEvent&&!window.opera?function(c){if(c instanceof Array)return c;for(var d=0,e=[],h;h=c[d++];)e[e.length]=h;return e}:function(c){return Array.prototype.slice.call(c)};peppy={query:function(c,d,e,h,g){var m=[];h||(c=c.replace(p.trim,"").replace(/(\[)\s+/g,"$1").replace(/\s+(\])/g,"$1").replace(/(\[[^\] ]+)\s+/g,"$1").replace(/\s+([^ \[]+\])/g,"$1").replace(/(\()\s+/g,"$1").replace(/(\+)([^0-9])/g,"$1 $2").replace(/['"]/g,"").replace(/\(\s*even\s*\)/gi,"(2n)").replace(/\(\s*odd\s*\)/gi,
"(2n+1)"));"string"===typeof d&&(d=0<(d=G(d,z)).length?d:void 0);d=d||z;d.uid=d.uid||D++;h=c+d.uid;if(I&&y[h])return y[h];p.quickTest.lastIndex=0;if(p.quickTest.test(c))return m=G(c,d,e,g),y[h]=m.slice(0);var k,n;k=[];k=c.split(/\s*,\s*/g);c=1<k.length?[""]:k;for(var j=0,f=0,s=0,q;1<k.length&&void 0!==(q=k[j++]);)f+=((l=q.match(/\(/g))?l.length:0)-((r=q.match(/\)/g))?r.length:0),c[s]=c[s]||"",c[s]+=""===c[s]?q:","+q,0===f&&s++;for(q=0;void 0!==(n=c[q++]);)if(p.quickTest.lastIndex=0,p.quickTest.test(n))v=
G(n,d,e,g),m=1<c.length?m.concat(v):v;else if(p.combinatorTest.lastIndex=0,p.combinatorTest.test(n)){var s=f=0,v;k=n.split(p.combinator);j=k.length;for(n=n.match(p.combinator)||[""];f<j;){var t,u;t=n[s++].replace(p.trim,"");v=v||peppy.query(k[f++],d,e,!0,g);u=peppy.query(k[f++],""==t||">"==t?v:d,""==t||">"==t,!0,g);v=peppy.queryCombinator(v,u,t)}m=1<c.length?m.concat(v):v;v=void 0}else v=peppy.querySelector(n,d,e,g),m=1<c.length?m.concat(v):v;1<c.length&&(m=H(m));return y[h]=m.slice(0)},queryCombinator:function(c,
d,e){var h=[],g={},m={},k={},n={};e=peppy.simpleSelector.combinator[e];for(var j=0,f;f=c[j++];)f.uid=f.uid||D++,g[f.uid]=f;for(c=0;j=d[c++];)j.uid=j.uid||D++,!m[j.uid]&&e(j,g,n,k)&&(h[h.length]=j),m[j.uid]=j;return h},querySelector:function(c,d,e,h){var g=[],m=!0;d=G(c,d,e,h);e=d.length-1;var k;/:(not|has)/i.test(c)&&(k=c.match(p.recursive),c=c.replace(p.recursive,""));if(!(c=c.match(/:(\w|-)+(\([^\(]+\))*|\[[^\[]+\]/g)))c=[];for(k&&(c=c.concat(k));void 0!==(h=c.pop());){var n=C[h],j,f;k=[];f=!1;
g=[];if(n)f=n[0],j=n[1],k=n.slice(2),n=j[f];else{if(/^:/.test(h))if(j=h.match(p.pseudoArgs),k[1]=j?j[1]:"",f=h.match(p.pseudoName)[1],j=peppy.simpleSelector.pseudos,/nth-(?!.+only)/i.test(h)){var s,q=k[1];if(!C[q]&&(s=q.match(p.nthParts)))n=parseInt(s[1],10)||0,s=parseInt(s[3],10)||0,/^\+n|^n/i.test(q)?n=1:/^-n/i.test(q)&&(n=-1),k[2]=n,k[3]=s,C[q]=[n,s]}else/^:contains/.test(h)&&(n=k[1],q=C[n],k[1]=q?q:C[n]=RegExp(n));else j=h.match(p.attributeName),f=h.match(p.attributeValue),k[1]=j[1]||j[0],k[2]=
f?f[1]:"",f=""+h.match(/[~!+*\^$|=]/),j=peppy.simpleSelector.attribute;n=j[f];C[h]=[f,j].concat(k)}/:(\w|-)+type/i.test(h);(f=/^:(nth[^-]|eq|gt|lt|first|last)/i.test(h))&&(k[3]=e);for(q=d.length-1;-1<q;)h=d[q--],m&&(h.peppyCount=q+1),s=!0,k[0]=h,f&&(k[2]=h.peppyCount),n.apply(j,k)||(s=!1),s&&g.push(h);d=g;m=!1}return g},simpleSelector:{attribute:{"null":function(c,d){return!!x(c,d)},"=":function(c,d,e){return x(c,d)==e},"~":function(c,d,e){return x(c,d).match(RegExp("\\b"+e+"\\b"))},"^":function(c,
d,e){return 0===x(c,d).indexOf(e)},$:function(c,d,e){c=x(c,d);return c.lastIndexOf(e)===c.length-e.length},"*":function(c,d,e){return-1!=x(c,d).indexOf(e)},"|":function(c,d,e){return x(c,d).match("^"+e+"-?(("+e+"-)*("+e+"$))*")},"!":function(c,d,e){return x(c,d)!==e}},pseudos:{":root":function(c){return c===z.getElementsByTagName("html")[0]?!0:!1},":nth-child":function(c,d,e,h){if(!c.nodeIndex){for(var g=c.parentNode.firstChild,m=0,k;g;g=g.nextSibling)1==g.nodeType&&(k=g,g.nodeIndex=++m);k.IsLastNode=
!0;1==m&&(k.IsOnlyChild=!0)}g=c.nodeIndex;return"first"==d?1==g:"last"==d?!!c.IsLastNode:"only"==d?!!c.IsOnlyChild:!e&&!h&&g==d||(0==e?g==h:0<e?g>=h&&0==(g-h)%e:g<=h&&0==(g+h)%e)},":nth-last-child":function(c,d){return this[":nth-child"](c,d,a,b)},":nth-of-type":function(c,d,e){return this[":nth-child"](c,d,a,b,e)},":nth-last-of-type":function(c,d,e){return this[":nth-child"](c,d,a,b,e)},":first-child":function(c){return this[":nth-child"](c,"first")},":last-child":function(c){return this[":nth-child"](c,
"last")},":first-of-type":function(c,d,e){return this[":nth-child"](c,"first",null,null,e)},":last-of-type":function(c,d,e){return this[":nth-child"](c,"last",null,null,e)},":only-child":function(c){return this[":nth-child"](c,"only")},":only-of-type":function(c,d,e){return this[":nth-child"](c,"only",null,null,e)},":empty":function(c){for(c=c.firstChild;null!==c;c=c.nextSibling)if(1===c.nodeType||3===c.nodeType)return!1;return!0},":not":function(c,d){return 0===peppy.query(d,c,!0,!0,!0).length},
":has":function(c,d){return 0<peppy.query(d,c,!0,!0,!0).length},":selected":function(c){return c.selected},":hidden":function(c){return"hidden"===c.type||"none"===c.style.display},":visible":function(c){return"hidden"!==c.type&&"none"!==c.style.display},":input":function(c){return-1!==c.nodeName.search(/input|select|textarea|button/i)},":radio":function(c){return"radio"===c.type},":checkbox":function(c){return"checkbox"===c.type},":text":function(c){return"text"===c.type},":header":function(c){return-1!==
c.nodeName.search(/h\d/i)},":enabled":function(c){return!c.disabled&&"hidden"!==c.type},":disabled":function(c){return c.disabled},":checked":function(c){return c.checked},":contains":function(c,d){return d.test(c.textContent||c.innerText||"")},":parent":function(c){return!!c.firstChild},":odd":function(c){return this[":nth-child"](c,"2n+2",2,2)},":even":function(c){return this[":nth-child"](c,"2n+1",2,1)},":nth":function(c,d,e){return d==e},":eq":function(c,d,e){return d==e},":gt":function(c,d,e){return e>
d},":lt":function(c,d,e){return e<d},":first":function(c,d,e){return 0==e},":last":function(c,d,e,h){return e==h}},combinator:{"":function(c,d,e,h){for(var g=c.uid;null!==(c=c.parentNode)&&!e[c.uid];)if(d[c.uid]||h[c.uid])return h[g]=!0;return e[g]=!1},">":function(c,d){return c.parentNode&&d[c.parentNode.uid]},"+":function(c,d,e){for(;null!==(c=c.previousSibling)&&!e[c.uid];)if(1===c.nodeType)return c.uid in d;return!1},"~":function(c,d,e,h){for(var g=c.uid;null!==(c=c.previousSibling)&&!e[c.uid];)if(d[c.uid]||
h[c.uid])return h[g]=!0;return e[g]=!1}}}};if(z.querySelectorAll){var J=peppy.query;peppy.query=function(c,d){d=d||z;if(d===z)try{return d.querySelectorAll(c)}catch(e){}return J.apply(J,E(arguments))}}else B=z.addEventListener||z.attachEvent,F=function(){y={}},B("DOMAttrModified",F,!1),B("DOMNodeInserted",F,!1),B("DOMNodeRemoved",F,!1);K.query=peppy.query});

module("debug", function (require, exports) {
    "use strict";

    var console = require("console"),
        JSON = require("JSON"),

        level = 0;

    function setLevel(mode) {
        switch (mode) {
            case "debug":
                _setLevel(3)
                break;
            case "test":
                _setLevel(2)
                break;
            case "production":
            default:
                _setLevel(1)
                break;
        }
    }

    function _setLevel(num) {
        level = num;
    }

    function inspect(obj) {
        if (obj !== undefined) {
            if (obj.constructor !== Object) {
                return obj.toString();
            } else {
                return JSON.stringify(obj);
            }
        }
    }

    function createLogger(prefix, num, callback) {
        return function () {
            var str = "",

                i,
                len;

            if (level >=  num) {
                str += prefix;

                for (i = 0, len = arguments.length; i < len; i += 1) {
                    str += " ";
                    str += inspect(arguments[i]);
                }
                if (console && console.log) {
                    console.log(str);
                }
            }
            if (callback !== undefined) {
                callback();
            }
        };
    }

    exports.log = createLogger("LOG:", 3);
    exports.error = createLogger("ERROR:", 2);
    exports.panic = createLogger("PANIC:", 1, function () {
        throw "Panic";
    });

    exports.setLevel = setLevel;
});

module("html5", function (require, exports) {
    "use strict";

    var doc = require("document"),
        debug = require("debug"),
        nav = require("navigator"),
        av = nav.appVersion,
        elements = "abbr,article,aside,audio,bb,canvas,datagrid,datalist,details,dialog,eventsource,figure,footer,header,hgroup,mark,menu,meter,nav,output,progress,section,time,video".split(','),
        i = 0,
        len = elements.length;

    function isIE() {
        return av.indexOf("MSIE") !== -1;
    }

    function IEVersion() {
        return parseFloat(av.split("MSIE")[1], 10);
    }

    exports.value = isIE();
    exports.version = IEVersion();

    if (exports.value === true && exports.version === 8) {
        debug.log("The Browser is Internet Explorer version", exports.version);
        debug.log("Applying HTML5 quirks");
        while (i < len) {
            doc.createElement(elements[i]);
            i += 1;
        }
    }
});


//////////////////////////////////////////////////////////////////////////////// INSERT BROWSER_HANDLE HERE
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////






module("browser_handler", function (require, exports) {
    "use strict";
 
    var $ = require("jQuery"),
        debug = require("debug"),
        stub = function() {},
        $elem = null;
       
    $(function() {
        $elem = $('#bits-status');
    })
 
    /* Handler functions definition */
    // Handle BITS status change.
    function statusHandler(status, first) {
        debug.log("browserHandler handling status");
        var open = status.value === "open" ? true : false;
        var icon = open ? "check" : "times";
        var string = open ? "Open" : "Closed";
       
        //first is a boolean value indicating if it is the first value received
        $elem.toggleClass("btn-success", open).toggleClass("btn-danger", !open)
            .html('<i class="fa fa-'+icon+'"></i> '+string);
    }
 
    // Exports only the browserHandler object in the global scope
    exports.status = statusHandler;
    exports.msg = stub;
    exports.tempInt = stub;
    exports.tempIntHist = stub;
});






////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////// BROWSER_HANDLE END


module("handler", function (require, exports) {
    "use strict";

    var debug = require("debug");

    function Handler(diffHandler) {
        this.data = "";
        this.diffHandler = diffHandler;
        this.firstHandle = true;
    }

    Handler.prototype.webSocket = function (event) {
        debug.log("Incoming data", event.data);
        this.data = Handler.escapeHTML(event.data);
        this.handle();
    };

    Handler.prototype.handle = function () {
        this.jsonHandler();
    };

    Handler.prototype.jsonHandler = function () {
        var json = JSON.parse(this.data);
        if (json.status !== undefined) {
            debug.log("New Status", json.status);
            this.diffHandler.status(json.status, this.firstHandle);
        }

        if (json.message !== undefined) {
            debug.log("New Msg", json.message);
            this.diffHandler.msg(json.message, this.firstHandle);
        }

        if (json.tempint !== undefined) {
            debug.log("New tempInt", json.tempint);
            this.diffHandler.tempInt(json.tempint, this.firstHandle);
        }

        if (json.tempinthist !== undefined) {
            debug.log("New tempIntHist", json.tempinthist);
            this.diffHandler.tempIntHist(json.tempinthist, this.firstHandle);
            this.diffHandler.tempInt(json.tempinthist[0], this.firstHandle);
        }

        if (this.firstHandle) {
            debug.log("First JSON arrived");
            this.firstHandle = false;
        }
    };

    Handler.escapeHTML = function (string) {
        return string.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    };

    exports.Handler = Handler;

});

/* You have to read the code bottom-up */


module("websocket", function (require, exports) {
    "use strict";

    var WebSocket = require("WebSocket"),
        MozWebSocket = require("MozWebSocket"),
        XHR = require("XMLHttpRequest"),
        nav = require("navigator"),

        ua = nav.userAgent,

        FakeWebSocket;

    // Implements a WS fallback via XHR
    FakeWebSocket = function () {
        var fakeUrl = "//" + window.location.hostname + "/data",
            xhr = new XHR(),
            i = 0,
            self = this;

        xhr.open("GET", fakeUrl, true);
        xhr.onreadystatechange = function handler() {
            if (self.onmessage !== undefined) {
                if (xhr.readyState === 4) {
                    self.onmessage({data: xhr.responseText});
                }
            } else {
                i += 1;
                setTimeout(function () {
                    handler();
                }, 100 * i);
            }
        };
        xhr.send(null);
    };

    function isChrome() {
        return ua.indexOf("Chrome") !== -1;
    }

    function isSafari() {
        return ua.indexOf("AppleWebKit") !== -1;
    }

    if (isSafari() && !isChrome()) { // Then WebSocket implementation is broken
        exports.WebSocket = FakeWebSocket;
    }

    exports.WebSocket = exports.WebSocket || WebSocket || MozWebSocket || FakeWebSocket;
});


main(function (require) {
    "use strict";

    var Handler = require("handler").Handler,
        browserHandler = require("browser_handler"),
        WebSocket = require("websocket").WebSocket,
        location = require("location"),
        query = require("peppy").query,
        debug = require("debug"),
        protocol = /https/.test(location.protocol)? "wss": "ws",
        ws = new WebSocket(protocol + "://bits.poul.org" + ":" + location.port + "/ws"),
        handler = new Handler(browserHandler);

    var debugMeta = query("meta[name='mode']")[0];
    if (debugMeta) {
        debug.setLevel(debugMeta.content);
    } else {
        debug.setLevel("production");
    }

    ws.onmessage = function (event) {
        handler.webSocket(event);
    };

    ws.onerror = function (event) {
        debug.error("WS Error", event);
    };
});
