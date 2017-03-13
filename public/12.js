webpackJsonp([12],{

/***/ 124:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(203)

var Component = __webpack_require__(0)(
  /* script */
  __webpack_require__(142),
  /* template */
  __webpack_require__(185),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "D:\\wamp64\\www\\ZWForum\\resources\\assets\\js\\views\\permisions\\Edit.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] Edit.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-702862b4", Component.options)
  } else {
    hotAPI.reload("data-v-702862b4", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 142:
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
            errorShow: false,
            successShow: false,
            allChecked: { user: false, role: false, cate: false, tag: false, topic: false, reply: false },
            trans: { user: '用户管理', role: '角色管理', cate: '分类管理', tag: '标签管理', topic: '话题管理', reply: '回复管理' },
            permissions: [],
            checkedPerms: { user: [], role: [], cate: [], tag: [], topic: [], reply: [] },
            formData: {
                display_name: '',
                description: '',
                perms: []
            }
        };
    },
    mounted: function mounted() {
        this.getPerms();
        this.getRoleInfo();
    },

    methods: {
        validateBeforeSubmit: function validateBeforeSubmit() {
            var _this = this;

            this.$validator.validateAll().then(function (success) {
                if (!success) {
                    return;
                }
                _this.formData.perms = [];
                for (var index in _this.checkedPerms) {
                    _this.checkedPerms[index].forEach(function (item) {
                        _this.formData.perms.push(item);
                    });
                }
                axios.put(window.Domain + 'api/admin/role/' + _this.$route.params.roleId, _this.formData).then(function (response) {
                    _this.errorShow = false;
                    _this.successShow = true;
                }).catch(function (error) {
                    this.errorShow = true;
                    this.successShow = false;
                });
            });
        },
        getPerms: function getPerms() {
            var _this2 = this;

            axios.get(window.Domain + 'api/admin/perms').then(function (response) {
                _this2.permissions = response.data;
                //console.log(this.formData.perms)
            }).catch(function (error) {
                console.log(error);
            });
        },
        checkedAll: function checkedAll(index) {
            var _this3 = this;

            if (this.allChecked[index]) {
                this.checkedPerms[index] = [];
                this.permissions[index].forEach(function (item) {
                    _this3.checkedPerms[index].push(item.id);
                });
            } else {
                this.checkedPerms[index] = [];
            }
        },
        getRoleInfo: function getRoleInfo() {
            var _this4 = this;

            axios.get(window.Domain + 'api/admin/role/' + this.$route.params.roleId).then(function (response) {
                var data = response.data.data;
                _this4.formData.display_name = data.display_name;
                _this4.formData.description = data.description;
                var perms = data.perms.data;
                for (var item in perms) {
                    _this4.checkedPerms[perms[item].type].push(perms[item].id);
                }
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
};

/***/ }),

/***/ 167:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)();
// imports


// module
exports.push([module.i, "\n.form-control-feedback{\r\n    right: 15px;\n}\n.red-color{\r\n    color:red;\n}\r\n", ""]);

// exports


/***/ }),

/***/ 185:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('section', {
    staticClass: "content animated"
  }, [_c('error-alert', {
    attrs: {
      "errorShow": _vm.errorShow
    }
  }), _vm._v(" "), _c('success-alert', {
    attrs: {
      "successShow": _vm.successShow
    }
  }), _vm._v(" "), _c('div', {
    staticClass: "nav-tabs-custom"
  }, [_vm._m(0), _vm._v(" "), _c('form', {
    staticClass: "form-horizontal",
    on: {
      "submit": function($event) {
        $event.preventDefault();
        _vm.validateBeforeSubmit($event)
      }
    }
  }, [_c('div', {
    staticClass: "tab-content container-fluid"
  }, [_c('div', {
    staticClass: "tab-pane active",
    attrs: {
      "id": "tab_1"
    }
  }, [_c('div', {
    staticClass: "box-header"
  }), _vm._v(" "), _c('div', {
    staticClass: "form-group",
    class: {
      'has-error': _vm.errors.has('display_name')
    }
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": "name"
    }
  }, [_vm._v("角色展示名")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-9 col-md-6"
  }, [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.display_name),
      expression: "formData.display_name"
    }, {
      name: "validate",
      rawName: "v-validate:display_name.initial",
      value: ('required'),
      expression: "'required'",
      arg: "display_name",
      modifiers: {
        "initial": true
      }
    }],
    staticClass: "form-control",
    attrs: {
      "id": "display_name",
      "name": "display_name",
      "type": "text"
    },
    domProps: {
      "value": (_vm.formData.display_name)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.formData.display_name = $event.target.value
      }
    }
  }), _vm._v(" "), _c('span', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.errors.has('display_name')),
      expression: "errors.has('display_name')"
    }],
    staticClass: "glyphicon glyphicon-remove form-control-feedback",
    attrs: {
      "aria-hidden": "true"
    }
  }), _vm._v(" "), _c('span', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.errors.has('display_name')),
      expression: "errors.has('display_name')"
    }],
    staticClass: "red-color help-block"
  }, [_vm._v(_vm._s(_vm.errors.first('display_name')))])])]), _vm._v(" "), _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": ""
    }
  }, [_vm._v("描述")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-9 col-md-6"
  }, [_c('textarea', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.description),
      expression: "formData.description"
    }],
    staticClass: "form-control",
    staticStyle: {
      "overflow": "hidden",
      "word-wrap": "break-word",
      "resize": "horizontal",
      "height": "104px"
    },
    attrs: {
      "rows": "3",
      "name": "description",
      "cols": "50"
    },
    domProps: {
      "value": (_vm.formData.description)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.formData.description = $event.target.value
      }
    }
  })])])]), _vm._v(" "), _c('div', {
    staticClass: "tab-pane",
    attrs: {
      "id": "tab_2"
    }
  }, [_c('div', {
    staticClass: "box-header"
  }), _vm._v(" "), _vm._l((_vm.permissions), function(permission, index) {
    return _c('div', {
      staticClass: "form-group"
    }, [_c('div', {
      staticClass: "col-sm-2 "
    }, [_c('div', {
      staticClass: "checkbox "
    }, [_c('label', {
      staticStyle: {
        "font-weight": "700"
      }
    }, [_c('input', {
      directives: [{
        name: "model",
        rawName: "v-model",
        value: (_vm.allChecked[index]),
        expression: "allChecked[index]"
      }],
      attrs: {
        "type": "checkbox"
      },
      domProps: {
        "checked": Array.isArray(_vm.allChecked[index]) ? _vm._i(_vm.allChecked[index], null) > -1 : (_vm.allChecked[index])
      },
      on: {
        "click": function($event) {
          _vm.checkedAll(index)
        },
        "__c": function($event) {
          var $$a = _vm.allChecked[index],
            $$el = $event.target,
            $$c = $$el.checked ? (true) : (false);
          if (Array.isArray($$a)) {
            var $$v = null,
              $$i = _vm._i($$a, $$v);
            if ($$c) {
              $$i < 0 && (_vm.allChecked[index] = $$a.concat($$v))
            } else {
              $$i > -1 && (_vm.allChecked[index] = $$a.slice(0, $$i).concat($$a.slice($$i + 1)))
            }
          } else {
            _vm.allChecked[index] = $$c
          }
        }
      }
    }), _vm._v(" " + _vm._s(_vm.trans[index]) + "\n                                ")])])]), _vm._v(" "), _c('div', {
      staticClass: "col-sm-10 "
    }, [_c('div', {
      staticClass: "checkbox"
    }, _vm._l((permission), function(item, index_2) {
      return _c('label', {
        staticStyle: {
          "margin-right": "10px"
        }
      }, [_c('input', {
        directives: [{
          name: "model",
          rawName: "v-model",
          value: (_vm.checkedPerms[index]),
          expression: "checkedPerms[index]"
        }],
        attrs: {
          "id": index_2,
          "type": "checkbox"
        },
        domProps: {
          "value": item.id,
          "checked": Array.isArray(_vm.checkedPerms[index]) ? _vm._i(_vm.checkedPerms[index], item.id) > -1 : (_vm.checkedPerms[index])
        },
        on: {
          "__c": function($event) {
            var $$a = _vm.checkedPerms[index],
              $$el = $event.target,
              $$c = $$el.checked ? (true) : (false);
            if (Array.isArray($$a)) {
              var $$v = item.id,
                $$i = _vm._i($$a, $$v);
              if ($$c) {
                $$i < 0 && (_vm.checkedPerms[index] = $$a.concat($$v))
              } else {
                $$i > -1 && (_vm.checkedPerms[index] = $$a.slice(0, $$i).concat($$a.slice($$i + 1)))
              }
            } else {
              _vm.checkedPerms[index] = $$c
            }
          }
        }
      }), _vm._v(" " + _vm._s(item.display_name) + "\n                                ")])
    }))])])
  })], 2), _vm._v(" "), _c('hr'), _vm._v(" "), _vm._m(1)])])])], 1)
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('ul', {
    staticClass: "nav nav-tabs"
  }, [_c('li', {
    staticClass: "active"
  }, [_c('a', {
    attrs: {
      "href": "#tab_1",
      "data-toggle": "tab",
      "aria-expanded": "true"
    }
  }, [_vm._v("基础信息")])]), _vm._v(" "), _c('li', {}, [_c('a', {
    attrs: {
      "href": "#tab_2",
      "data-toggle": "tab",
      "aria-expanded": "false"
    }
  }, [_vm._v("权限分配")])])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('div', {
    staticClass: "col-sm-offset-2 col-sm-9"
  }, [_c('button', {
    staticClass: "btn btn-primary",
    attrs: {
      "type": "submit"
    }
  }, [_vm._v("提交")])])])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-702862b4", module.exports)
  }
}

/***/ }),

/***/ 203:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(167);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("c3f93932", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-702862b4!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Edit.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-702862b4!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Edit.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ })

});