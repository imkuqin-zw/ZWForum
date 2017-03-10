webpackJsonp([5],{

/***/ 131:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(208)

var Component = __webpack_require__(0)(
  /* script */
  __webpack_require__(149),
  /* template */
  __webpack_require__(190),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "D:\\wamp64\\www\\ZWForum\\resources\\assets\\js\\views\\topics\\List.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] List.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-f24e830a", Component.options)
  } else {
    hotAPI.reload("data-v-f24e830a", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 149:
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

/* harmony default export */ __webpack_exports__["default"] = {
    data: function data() {
        return {
            perm: [],
            apiUrl: '',
            tableName: '',
            tableFields: [{ name: 'id', trans: 'id' }, { name: 'title', trans: '标题' }, { name: 'reply_count', trans: '回复数' }, { name: 'is_top', trans: '是否置顶' }, { name: 'reply_count', trans: '回复数' }, { name: 'vote_count', trans: '点赞数' }, { name: 'is_blocked', trans: '是否禁止显示' }, { name: 'is_excellent', trans: '是否加精' }, { name: 'user', trans: '文章创建者' }, { name: 'category', trans: '分类名' }, { name: 'created_at', trans: '创建时间' }]
        };
    },
    created: function created() {
        this.apiUrl = window.Domain + 'api/admin/topic';
        this.tableName = 'topic';
    }
};

/***/ }),

/***/ 172:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)();
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 190:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('section', {
    staticClass: "content animated"
  }, [_c('vue-table', {
    attrs: {
      "apiUrl": _vm.apiUrl,
      "tableName": _vm.tableName,
      "tableFields": _vm.tableFields
    }
  })], 1)
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-f24e830a", module.exports)
  }
}

/***/ }),

/***/ 208:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(172);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("0ee19652", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-f24e830a!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./List.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-f24e830a!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./List.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ })

});