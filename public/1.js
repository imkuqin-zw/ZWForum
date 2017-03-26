webpackJsonp([1],{

/***/ 122:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(201)
__webpack_require__(200)

var Component = __webpack_require__(0)(
  /* script */
  __webpack_require__(140),
  /* template */
  __webpack_require__(183),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "D:\\wamp64\\www\\ZWForum\\resources\\assets\\js\\views\\home\\index.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] index.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-635b9060", Component.options)
  } else {
    hotAPI.reload("data-v-635b9060", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 140:
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
//

/* harmony default export */ __webpack_exports__["default"] = {
  data: function data() {
    return {
      time: '',
      roles: [],
      portraitsUrl: '',
      user: {}
    };
  },
  mounted: function mounted() {
    this.portraitsUrl = window.PortraitsUrl;
    this.user = window.User;
    this.roles = window.Roles;
    this.time = window.Time;
  },

  computed: {
    userPortrait: function userPortrait() {
      if (!this.user.portrait_mid) return 'profile-pic_min.png';else return this.user.portrait_mid;
    }
  }
};

/***/ }),

/***/ 164:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)();
// imports


// module
exports.push([module.i, "\n.box-profile .img-responsive {\n  display: block;\n  max-width: 100%;\n  height: 100px;\n}\n.profile-info-name {\n  text-align: right;\n  padding: 6px 10px 6px 4px;\n  font-weight: 400;\n  color: #667E99;\n  background-color: transparent;\n  width: 110px;\n  vertical-align: middle;\n}\n.profile-info-value {\n  padding: 6px 4px 6px 6px;\n}\n.profile-info-name, .profile-info-value {\n  display: table-cell;\n  border-top: 1px dotted #D5E4F1;\n}\n.profile-user-info-striped {\n  border: 1px solid #DCEBF7;\n}\n.profile-user-info-striped .profile-info-value {\n    border-top: 1px dotted #DCEBF7;\n    padding-left: 12px;\n}\n.profile-user-info-striped .profile-info-name {\n    color: #336199;\n    background-color: #EDF3F4;\n    border-top: 1px solid #F7FBFF;\n}\n.profile-user-info {\n  display: table;\n  width: 98%;\n  width: calc(100% - 24px);\n  margin: 0 auto;\n}\n.profile-info-row {\n  display: table-row;\n}\n.profile-info-row:first-child .profile-info-name {\n    border-top: none;\n}\n", ""]);

// exports


/***/ }),

/***/ 165:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)();
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 183:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('section', {
    staticClass: "content animated"
  }, [_c('div', {
    staticClass: "box box-primary"
  }, [_c('div', {
    staticClass: "box-body box-profile "
  }, [_c('div', {
    staticClass: "col-xs-12 col-md-2"
  }, [_c('img', {
    staticClass: "profile-user-img img-responsive img-circle",
    attrs: {
      "src": _vm.portraitsUrl + _vm.userPortrait,
      "alt": "User profile picture"
    }
  })]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-md-10",
    staticStyle: {
      "margin-top": "5px"
    }
  }, [_c('div', {
    staticClass: "profile-user-info profile-user-info-striped"
  }, [_c('div', {
    staticClass: "profile-info-row"
  }, [_c('div', {
    staticClass: "profile-info-name"
  }, [_vm._v(" 用户名 ")]), _vm._v(" "), _c('div', {
    staticClass: "profile-info-value"
  }, [_c('span', [_vm._v(_vm._s(_vm.user.name))])])]), _vm._v(" "), _c('div', {
    staticClass: "profile-info-row"
  }, [_c('div', {
    staticClass: "profile-info-name"
  }, [_vm._v(" 本次登陆时间 ")]), _vm._v(" "), _c('div', {
    staticClass: "profile-info-value"
  }, [_c('span', [_vm._v(_vm._s(_vm.time))])])]), _vm._v(" "), _c('div', {
    staticClass: "profile-info-row"
  }, [_c('div', {
    staticClass: "profile-info-name"
  }, [_vm._v("角色 ")]), _vm._v(" "), _c('div', {
    staticClass: "profile-info-value"
  }, [_vm._l((_vm.roles), function(role) {
    return [_c('span', {
      staticClass: "label label-info"
    }, [_vm._v(_vm._s(role.display_name))])]
  })], 2)])])])])])])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-635b9060", module.exports)
  }
}

/***/ }),

/***/ 200:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(164);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("5de626ba", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-635b9060!../../../../../node_modules/sass-loader/index.js!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=1!./index.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-635b9060!../../../../../node_modules/sass-loader/index.js!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=1!./index.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 201:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(165);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("f3c16d82", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-635b9060!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-635b9060!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ })

});