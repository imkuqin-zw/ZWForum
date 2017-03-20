webpackJsonp([9],{

/***/ 127:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(204)

var Component = __webpack_require__(0)(
  /* script */
  __webpack_require__(145),
  /* template */
  __webpack_require__(186),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "D:\\wamp64\\www\\ZWForum\\resources\\assets\\js\\views\\replies\\Show.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] Show.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-78cd9bfc", Component.options)
  } else {
    hotAPI.reload("data-v-78cd9bfc", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 145:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = {
    data: function data() {
        return {
            content: ''
        };
    },
    mounted: function mounted() {
        this.getTagInfo();
    },

    methods: {
        getTagInfo: function getTagInfo() {
            var _this = this;

            axios.get(window.Domain + 'api/admin/reply/' + this.$route.params.replyId).then(function (response) {
                var data = response.data.data;
                _this.content = data.content;
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
};

/***/ }),

/***/ 168:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)();
// imports


// module
exports.push([module.i, "\n.markdown-body, .markdown-reply {\n  font-size: 15px;\n  -ms-text-size-adjust: 100%;\n  -webkit-text-size-adjust: 100%;\n  line-height: 1.4;\n  color: #333333;\n  overflow: hidden;\n  line-height: 1.6;\n  word-wrap: break-word;\n}\n.markdown-body a, .markdown-reply a {\n    background: transparent;\n}\n.markdown-body a:active,\n  .markdown-body a:hover, .markdown-reply a:active,\n  .markdown-reply a:hover {\n    outline: 0;\n}\n.markdown-body ol li, .markdown-reply ol li {\n    margin: 8px 0;\n}\n.markdown-body pre[class*=language-], .markdown-reply pre[class*=language-] {\n    margin: 1.2em 0 !important;\n}\n.markdown-body strong, .markdown-reply strong {\n    font-weight: bold;\n}\n.markdown-body h1, .markdown-reply h1 {\n    font-size: 2em;\n    margin: 0.67em 0;\n}\n.markdown-body img, .markdown-reply img {\n    border: 0;\n}\n.markdown-body hr, .markdown-reply hr {\n    box-sizing: content-box;\n    height: 0;\n}\n.markdown-body table, .markdown-reply table {\n    border-collapse: collapse;\n    border-spacing: 0;\n}\n.markdown-body td,\n  .markdown-body th, .markdown-reply td,\n  .markdown-reply th {\n    padding: 0;\n}\n.markdown-body *, .markdown-reply * {\n    box-sizing: border-box;\n}\n.markdown-body a, .markdown-reply a {\n    text-decoration: none;\n}\n.markdown-body a:hover,\n  .markdown-body a:focus,\n  .markdown-body a:active, .markdown-reply a:hover,\n  .markdown-reply a:focus,\n  .markdown-reply a:active {\n    text-decoration: none;\n}\n.markdown-body hr, .markdown-reply hr {\n    height: 0;\n    margin: 15px 0;\n    overflow: hidden;\n    background: transparent;\n    border: 0;\n    border-bottom: 1px solid #ddd;\n}\n.markdown-body hr:before,\n  .markdown-body hr:after, .markdown-reply hr:before,\n  .markdown-reply hr:after {\n    display: table;\n    content: \" \";\n}\n.markdown-body hr:after, .markdown-reply hr:after {\n    clear: both;\n}\n.markdown-body h1,\n  .markdown-body h2,\n  .markdown-body h3,\n  .markdown-body h4,\n  .markdown-body h5,\n  .markdown-body h6, .markdown-reply h1,\n  .markdown-reply h2,\n  .markdown-reply h3,\n  .markdown-reply h4,\n  .markdown-reply h5,\n  .markdown-reply h6 {\n    margin-top: 15px;\n    margin-bottom: 15px;\n    line-height: 1.1;\n}\n.markdown-body h1, .markdown-reply h1 {\n    font-size: 30px;\n}\n.markdown-body h2, .markdown-reply h2 {\n    font-size: 21px;\n}\n.markdown-body h3, .markdown-reply h3 {\n    font-size: 16px;\n}\n.markdown-body h4, .markdown-reply h4 {\n    font-size: 14px;\n}\n.markdown-body h5, .markdown-reply h5 {\n    font-size: 12px;\n}\n.markdown-body h6, .markdown-reply h6 {\n    font-size: 11px;\n}\n.markdown-body blockquote, .markdown-reply blockquote {\n    margin: 0;\n}\n.markdown-body ul,\n  .markdown-body ol, .markdown-reply ul,\n  .markdown-reply ol {\n    padding: 0;\n    margin-top: 0;\n    margin-bottom: 0;\n}\n.markdown-body ol ol, .markdown-reply ol ol {\n    list-style-type: lower-roman;\n}\n.markdown-body dd, .markdown-reply dd {\n    margin-left: 0;\n}\n.markdown-body code,\n  .markdown-body pre, .markdown-reply code,\n  .markdown-reply pre {\n    font-family: monaco, Consolas, \"Liberation Mono\", Menlo, Courier, monospace;\n    font-size: 1em;\n}\n.markdown-body pre, .markdown-reply pre {\n    margin-top: 0;\n    margin-bottom: 0;\n    overflow: auto;\n}\n.markdown-body .markdown-body > *:first-child, .markdown-reply .markdown-body > *:first-child {\n    margin-top: 0 !important;\n}\n.markdown-body .markdown-body > *:last-child, .markdown-reply .markdown-body > *:last-child {\n    margin-bottom: 0 !important;\n}\n.markdown-body .anchor, .markdown-reply .anchor {\n    position: absolute;\n    top: 0;\n    bottom: 0;\n    left: 0;\n    display: block;\n    padding-right: 6px;\n    padding-left: 30px;\n    margin-left: -30px;\n}\n.markdown-body .anchor:focus, .markdown-reply .anchor:focus {\n    outline: none;\n}\n.markdown-body h1,\n  .markdown-body h2,\n  .markdown-body h3,\n  .markdown-body h4,\n  .markdown-body h5,\n  .markdown-body h6, .markdown-reply h1,\n  .markdown-reply h2,\n  .markdown-reply h3,\n  .markdown-reply h4,\n  .markdown-reply h5,\n  .markdown-reply h6 {\n    position: relative;\n    margin-top: 1.0em;\n    margin-bottom: 16px;\n    font-weight: bold;\n    line-height: 1.4;\n}\n.markdown-body h1, .markdown-reply h1 {\n    padding-bottom: 0.3em;\n    font-size: 2.25em;\n    line-height: 1.2;\n    border-bottom: 2px solid #eee;\n}\n.markdown-body h2, .markdown-reply h2 {\n    padding-bottom: 0.3em;\n    font-size: 1.5em;\n    line-height: 1.225;\n    border-bottom: 2px solid #eee;\n}\n.markdown-body h3, .markdown-reply h3 {\n    font-size: 1.4em;\n    line-height: 1.43;\n}\n.markdown-body h4, .markdown-reply h4 {\n    font-size: 1.3em;\n}\n.markdown-body h5, .markdown-reply h5 {\n    font-size: 1.2em;\n}\n.markdown-body h6, .markdown-reply h6 {\n    font-size: 1.1em;\n    color: #777;\n}\n.markdown-body p,\n  .markdown-body blockquote,\n  .markdown-body ul,\n  .markdown-body ol,\n  .markdown-body dl,\n  .markdown-body table,\n  .markdown-body pre, .markdown-reply p,\n  .markdown-reply blockquote,\n  .markdown-reply ul,\n  .markdown-reply ol,\n  .markdown-reply dl,\n  .markdown-reply table,\n  .markdown-reply pre {\n    margin-top: 0;\n    margin-bottom: 10px;\n    line-height: 30px;\n}\n.markdown-body hr, .markdown-reply hr {\n    height: 4px;\n    padding: 0;\n    margin: 16px 0;\n    background-color: #e7e7e7;\n    border: 0 none;\n}\n.markdown-body ul,\n  .markdown-body ol, .markdown-reply ul,\n  .markdown-reply ol {\n    padding-left: 2em;\n}\n.markdown-body ol ol,\n  .markdown-body ol ul, .markdown-reply ol ol,\n  .markdown-reply ol ul {\n    margin-top: 0;\n    margin-bottom: 0;\n}\n.markdown-body li > p, .markdown-reply li > p {\n    margin-top: 16px;\n}\n.markdown-body dl, .markdown-reply dl {\n    padding: 0;\n}\n.markdown-body dl dt, .markdown-reply dl dt {\n    padding: 0;\n    margin-top: 16px;\n    font-size: 1em;\n    font-style: italic;\n    font-weight: bold;\n}\n.markdown-body dl dd, .markdown-reply dl dd {\n    padding: 0 16px;\n    margin-bottom: 16px;\n}\n.markdown-body blockquote, .markdown-reply blockquote {\n    font-size: inherit;\n    padding: 0 15px;\n    color: #777;\n    border-left: 4px solid #ddd;\n}\n.markdown-body blockquote > :first-child, .markdown-reply blockquote > :first-child {\n    margin-top: 20;\n}\n.markdown-body blockquote > :last-child, .markdown-reply blockquote > :last-child {\n    margin-bottom: 20;\n}\n.markdown-body blockquote, .markdown-reply blockquote {\n    margin: 20px 0 !important;\n    background-color: #f7f7f7;\n    padding: 6px 8px;\n}\n.markdown-body table, .markdown-reply table {\n    display: block;\n    width: 100%;\n    overflow: auto;\n    margin: 25px 0;\n}\n.markdown-body table th, .markdown-reply table th {\n    font-weight: bold;\n}\n.markdown-body table th,\n  .markdown-body table td, .markdown-reply table th,\n  .markdown-reply table td {\n    padding: 6px 13px;\n    border: 1px solid #ddd;\n}\n.markdown-body table tr, .markdown-reply table tr {\n    background-color: #fff;\n    border-top: 1px solid #ccc;\n}\n.markdown-body table tr:nth-child(2n), .markdown-reply table tr:nth-child(2n) {\n    background-color: #f8f8f8;\n}\n.markdown-body img, .markdown-reply img {\n    max-width: 100%;\n    box-sizing: border-box;\n}\n.markdown-body img:not(.emoji), .markdown-reply img:not(.emoji) {\n    border: 1px solid #ddd;\n    box-shadow: 0 0 30px #ccc;\n    -moz-box-shadow: 0 0 30px #ccc;\n    -webkit-box-shadow: 0 0 30px #ccc;\n    margin-bottom: 30px;\n    margin-top: 10px;\n}\n.markdown-body code, .markdown-reply code {\n    margin: 5px;\n    color: #858080;\n    border-radius: 4px;\n    background-color: #f9fafa;\n    border: 1px solid #e4e4e4;\n    max-width: 740px;\n    overflow-x: auto;\n    font-size: .9em;\n    padding: 1px 2px 1px;\n}\n.markdown-body code:before,\n  .markdown-body code:after, .markdown-reply code:before,\n  .markdown-reply code:after {\n    letter-spacing: -0.2em;\n    content: \"\\A0\";\n}\n.markdown-body pre > code, .markdown-reply pre > code {\n    padding: 0;\n    margin: 0;\n    font-size: 100%;\n    white-space: pre;\n    background: transparent;\n    border: 0;\n    color: #E6E8D3;\n}\n.markdown-body .highlight, .markdown-reply .highlight {\n    margin-bottom: 16px;\n}\n.markdown-body .highlight pre,\n  .markdown-body pre, .markdown-reply .highlight pre,\n  .markdown-reply pre {\n    padding: 14px;\n    overflow: auto;\n    line-height: 1.45;\n    background-color: #4e4e4e;\n    border-radius: 3px;\n    color: #fff;\n    border: none;\n}\n.markdown-body .highlight pre, .markdown-reply .highlight pre {\n    margin-bottom: 0;\n}\n.markdown-body pre, .markdown-reply pre {\n    word-wrap: normal;\n}\n.markdown-body pre code, .markdown-reply pre code {\n    display: inline;\n    max-width: initial;\n    padding: 0;\n    margin: 0;\n    overflow: initial;\n    line-height: inherit;\n    word-wrap: normal;\n    background-color: transparent;\n    border: 0;\n}\n.markdown-body pre code:before,\n  .markdown-body pre code:after, .markdown-reply pre code:before,\n  .markdown-reply pre code:after {\n    content: normal;\n}\n.markdown-body .highlight, .markdown-reply .highlight {\n    background: #ffffff;\n}\n.markdown-body .highlight .c, .markdown-reply .highlight .c {\n    color: #999988;\n    font-style: italic;\n}\n.markdown-body .highlight .err, .markdown-reply .highlight .err {\n    color: #a61717;\n    background-color: #e3d2d2;\n}\n.markdown-body .highlight .k, .markdown-reply .highlight .k {\n    font-weight: bold;\n}\n.markdown-body .highlight .o, .markdown-reply .highlight .o {\n    font-weight: bold;\n}\n.markdown-body .highlight .cm, .markdown-reply .highlight .cm {\n    color: #999988;\n    font-style: italic;\n}\n.markdown-body .highlight .cp, .markdown-reply .highlight .cp {\n    color: #999999;\n    font-weight: bold;\n}\n.markdown-body .highlight .c1, .markdown-reply .highlight .c1 {\n    color: #999988;\n    font-style: italic;\n}\n.markdown-body .highlight .cs, .markdown-reply .highlight .cs {\n    color: #999999;\n    font-weight: bold;\n    font-style: italic;\n}\n.markdown-body .highlight .gd, .markdown-reply .highlight .gd {\n    color: #000000;\n    background-color: #ffdddd;\n}\n.markdown-body .highlight .gd .x, .markdown-reply .highlight .gd .x {\n    color: #000000;\n    background-color: #ffaaaa;\n}\n.markdown-body .highlight .ge, .markdown-reply .highlight .ge {\n    font-style: italic;\n}\n.markdown-body .highlight .gr, .markdown-reply .highlight .gr {\n    color: #aa0000;\n}\n.markdown-body .highlight .gh, .markdown-reply .highlight .gh {\n    color: #999999;\n}\n.markdown-body .highlight .gi, .markdown-reply .highlight .gi {\n    color: #000000;\n    background-color: #ddffdd;\n}\n.markdown-body .highlight .gi .x, .markdown-reply .highlight .gi .x {\n    color: #000000;\n    background-color: #aaffaa;\n}\n.markdown-body .highlight .go, .markdown-reply .highlight .go {\n    color: #888888;\n}\n.markdown-body .highlight .gp, .markdown-reply .highlight .gp {\n    color: #555555;\n}\n.markdown-body .highlight .gs, .markdown-reply .highlight .gs {\n    font-weight: bold;\n}\n.markdown-body .highlight .gu, .markdown-reply .highlight .gu {\n    color: #800080;\n    font-weight: bold;\n}\n.markdown-body .highlight .gt, .markdown-reply .highlight .gt {\n    color: #aa0000;\n}\n.markdown-body .highlight .kc, .markdown-reply .highlight .kc {\n    font-weight: bold;\n}\n.markdown-body .highlight .kd, .markdown-reply .highlight .kd {\n    font-weight: bold;\n}\n.markdown-body .highlight .kn, .markdown-reply .highlight .kn {\n    font-weight: bold;\n}\n.markdown-body .highlight .kp, .markdown-reply .highlight .kp {\n    font-weight: bold;\n}\n.markdown-body .highlight .kr, .markdown-reply .highlight .kr {\n    font-weight: bold;\n}\n.markdown-body .highlight .kt, .markdown-reply .highlight .kt {\n    color: #445588;\n    font-weight: bold;\n}\n.markdown-body .highlight .m, .markdown-reply .highlight .m {\n    color: #009999;\n}\n.markdown-body .highlight .s, .markdown-reply .highlight .s {\n    color: #dd1144;\n}\n.markdown-body .highlight .n, .markdown-reply .highlight .n {\n    color: #333333;\n}\n.markdown-body .highlight .na, .markdown-reply .highlight .na {\n    color: teal;\n}\n.markdown-body .highlight .nb, .markdown-reply .highlight .nb {\n    color: #0086b3;\n}\n.markdown-body .highlight .nc, .markdown-reply .highlight .nc {\n    color: #445588;\n    font-weight: bold;\n}\n.markdown-body .highlight .no, .markdown-reply .highlight .no {\n    color: teal;\n}\n.markdown-body .highlight .ni, .markdown-reply .highlight .ni {\n    color: purple;\n}\n.markdown-body .highlight .ne, .markdown-reply .highlight .ne {\n    color: #990000;\n    font-weight: bold;\n}\n.markdown-body .highlight .nf, .markdown-reply .highlight .nf {\n    color: #990000;\n    font-weight: bold;\n}\n.markdown-body .highlight .nn, .markdown-reply .highlight .nn {\n    color: #555555;\n}\n.markdown-body .highlight .nt, .markdown-reply .highlight .nt {\n    color: navy;\n}\n.markdown-body .highlight .nv, .markdown-reply .highlight .nv {\n    color: teal;\n}\n.markdown-body .highlight .ow, .markdown-reply .highlight .ow {\n    font-weight: bold;\n}\n.markdown-body .highlight .w, .markdown-reply .highlight .w {\n    color: #bbbbbb;\n}\n.markdown-body .highlight .mf, .markdown-reply .highlight .mf {\n    color: #009999;\n}\n.markdown-body .highlight .mh, .markdown-reply .highlight .mh {\n    color: #009999;\n}\n.markdown-body .highlight .mi, .markdown-reply .highlight .mi {\n    color: #009999;\n}\n.markdown-body .highlight .mo, .markdown-reply .highlight .mo {\n    color: #009999;\n}\n.markdown-body .highlight .sb, .markdown-reply .highlight .sb {\n    color: #dd1144;\n}\n.markdown-body .highlight .sc, .markdown-reply .highlight .sc {\n    color: #dd1144;\n}\n.markdown-body .highlight .sd, .markdown-reply .highlight .sd {\n    color: #dd1144;\n}\n.markdown-body .highlight .s2, .markdown-reply .highlight .s2 {\n    color: #dd1144;\n}\n.markdown-body .highlight .se, .markdown-reply .highlight .se {\n    color: #dd1144;\n}\n.markdown-body .highlight .sh, .markdown-reply .highlight .sh {\n    color: #dd1144;\n}\n.markdown-body .highlight .si, .markdown-reply .highlight .si {\n    color: #dd1144;\n}\n.markdown-body .highlight .sx, .markdown-reply .highlight .sx {\n    color: #dd1144;\n}\n.markdown-body .highlight .sr, .markdown-reply .highlight .sr {\n    color: #009926;\n}\n.markdown-body .highlight .s1, .markdown-reply .highlight .s1 {\n    color: #dd1144;\n}\n.markdown-body .highlight .ss, .markdown-reply .highlight .ss {\n    color: #990073;\n}\n.markdown-body .highlight .bp, .markdown-reply .highlight .bp {\n    color: #999999;\n}\n.markdown-body .highlight .vc, .markdown-reply .highlight .vc {\n    color: teal;\n}\n.markdown-body .highlight .vg, .markdown-reply .highlight .vg {\n    color: teal;\n}\n.markdown-body .highlight .vi, .markdown-reply .highlight .vi {\n    color: teal;\n}\n.markdown-body .highlight .il, .markdown-reply .highlight .il {\n    color: #009999;\n}\n.markdown-body .highlight .gc, .markdown-reply .highlight .gc {\n    color: #999;\n    background-color: #EAF2F5;\n}\n.markdown-reply h1,\n.markdown-reply h2,\n.markdown-reply h3,\n.markdown-reply h4,\n.markdown-reply h5,\n.markdown-reply h6 {\n  position: relative;\n  margin-top: .5em;\n  margin-bottom: 16px;\n  font-weight: bold;\n  line-height: 1.4;\n}\n.markdown-reply h1 {\n  padding-bottom: 0.3em;\n  font-size: 1.4em;\n  line-height: 1.2;\n  border-bottom: 1px solid #eee;\n}\n.markdown-reply h2 {\n  padding-bottom: 0.3em;\n  font-size: 1.25em;\n  line-height: 1.225;\n  border-bottom: 1px solid #eee;\n}\n.markdown-reply h3 {\n  font-size: 1.2em;\n  line-height: 1.43;\n}\n.markdown-reply h4 {\n  font-size: 1.1em;\n}\n.markdown-reply h5 {\n  font-size: 1em;\n}\n.markdown-reply h6 {\n  font-size: 1em;\n  color: #777;\n}\n.markdown-body > h2:first-child {\n  margin-top: 0.4em;\n}\n.emoji {\n  width: 1.6em;\n  display: inline-block;\n  margin-bottom: 0;\n  margin-top: -5px;\n  margin-left: 5px;\n}\n", ""]);

// exports


/***/ }),

/***/ 186:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('section', {
    staticClass: "content animated"
  }, [_c('div', {
    staticClass: "markdown-reply container box"
  }, [_c('div', {
    staticClass: "box-header"
  }), _vm._v(" "), _c('div', {
    domProps: {
      "innerHTML": _vm._s(_vm.content)
    }
  })])])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-78cd9bfc", module.exports)
  }
}

/***/ }),

/***/ 204:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(168);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("e7ca9124", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-78cd9bfc!../../../../../node_modules/sass-loader/index.js!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Show.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-78cd9bfc!../../../../../node_modules/sass-loader/index.js!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Show.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ })

});