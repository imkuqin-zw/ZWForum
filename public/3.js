webpackJsonp([3],{

/***/ 132:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(201)

var Component = __webpack_require__(0)(
  /* script */
  __webpack_require__(150),
  /* template */
  __webpack_require__(183),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "D:\\wamp64\\www\\ZWForum\\resources\\assets\\js\\views\\users\\Add.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] Add.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-646b5ca8", Component.options)
  } else {
    hotAPI.reload("data-v-646b5ca8", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 135:
/***/ (function(module, exports, __webpack_require__) {

!function(e,t){ true?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.VueMultiselect=t():e.VueMultiselect=t()}(this,function(){return function(e){function t(n){if(i[n])return i[n].exports;var s=i[n]={i:n,l:!1,exports:{}};return e[n].call(s.exports,s,s.exports,t),s.l=!0,s.exports}var i={};return t.m=e,t.c=i,t.i=function(e){return e},t.d=function(e,i,n){t.o(e,i)||Object.defineProperty(e,i,{configurable:!1,enumerable:!0,get:n})},t.n=function(e){var i=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(i,"a",i),i},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="/",t(t.s=8)}([function(e,t,i){"use strict";function n(e){return e&&e.__esModule?e:{default:e}}function s(e,t,i){return t in e?Object.defineProperty(e,t,{value:i,enumerable:!0,configurable:!0,writable:!0}):e[t]=i,e}function l(e,t){if(!e)return!1;var i=e.toString().toLowerCase();return i.indexOf(t.trim())!==-1}function o(e,t,i){return i?e.filter(function(e){return l(e[i],t)}):e.filter(function(e){return l(e,t)})}function r(e){return e.filter(function(e){return!e.$isLabel})}function a(e,t){return function(i){return i.reduce(function(i,n){return n[e]&&n[e].length?(i.push({$groupLabel:n[t],$isLabel:!0}),i.concat(n[e])):i.concat(n)},[])}}function u(e,t,i,n){return function(l){return l.map(function(l){var r,a=o(l[i],e,t);return a.length?(r={},s(r,n,l[n]),s(r,i,a),r):[]})}}Object.defineProperty(t,"__esModule",{value:!0});var c="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},h=i(2),p=n(h),f=function(){for(var e=arguments.length,t=Array(e),i=0;i<e;i++)t[i]=arguments[i];return function(e){return t.reduce(function(e,t){return t(e)},e)}};t.default={data:function(){return{search:"",isOpen:!1,hasEnoughSpace:!0,internalValue:this.value||0===this.value?(0,p.default)(Array.isArray(this.value)?this.value:[this.value]):[]}},props:{internalSearch:{type:Boolean,default:!0},options:{type:Array,required:!0},multiple:{type:Boolean,default:!1},value:{type:null,default:function(){return[]}},trackBy:{type:String},label:{type:String},searchable:{type:Boolean,default:!0},clearOnSelect:{type:Boolean,default:!0},hideSelected:{type:Boolean,default:!1},placeholder:{type:String,default:"Select option"},allowEmpty:{type:Boolean,default:!0},resetAfter:{type:Boolean,default:!1},closeOnSelect:{type:Boolean,default:!0},customLabel:{type:Function,default:function(e,t){return t?e[t]:e}},taggable:{type:Boolean,default:!1},tagPlaceholder:{type:String,default:"Press enter to create a tag"},max:{type:Number},id:{default:null},optionsLimit:{type:Number,default:1e3},groupValues:{type:String},groupLabel:{type:String},blockKeys:{type:Array,default:function(){return[]}}},mounted:function(){this.multiple||this.clearOnSelect||console.warn("[Vue-Multiselect warn]: ClearOnSelect and Multiple props can’t be both set to false.")},computed:{filteredOptions:function(){var e=this.search||"",t=e.toLowerCase(),i=this.options.concat();return this.internalSearch?(i=this.groupValues?this.filterAndFlat(i,t,this.label):o(i,t,this.label),i=this.hideSelected?i.filter(this.isNotSelected):i):i=this.groupValues?a(this.groupValues,this.groupLabel)(i):i,this.taggable&&t.length&&!this.isExistingOption(t)&&i.unshift({isTag:!0,label:e}),i.slice(0,this.optionsLimit)},valueKeys:function(){var e=this;return this.trackBy?this.internalValue.map(function(t){return t[e.trackBy]}):this.internalValue},optionKeys:function(){var e=this,t=this.groupValues?this.flatAndStrip(this.options):this.options;return this.label?t.map(function(t){return t[e.label].toString().toLowerCase()}):t.map(function(e){return e.toString().toLowerCase()})},currentOptionLabel:function(){return this.multiple?this.searchable?"":this.placeholder:this.internalValue[0]?this.getOptionLabel(this.internalValue[0]):this.searchable?"":this.placeholder}},watch:{internalValue:function(e,t){this.resetAfter&&this.internalValue.length&&(this.search="",this.internalValue=[])},search:function(){this.$emit("search-change",this.search,this.id)},value:function(e){this.internalValue=(0,p.default)(Array.isArray(e)?e:[e])}},methods:{getValue:function(){return this.multiple?(0,p.default)(this.internalValue):(0,p.default)(this.internalValue[0])},filterAndFlat:function(e){return f(u(this.search,this.label,this.groupValues,this.groupLabel),a(this.groupValues,this.groupLabel))(e)},flatAndStrip:function(e){return f(a(this.groupValues,this.groupLabel),r)(e)},updateSearch:function(e){this.search=e},isExistingOption:function(e){return!!this.options&&this.optionKeys.indexOf(e)>-1},isSelected:function(e){var t=this.trackBy?e[this.trackBy]:e;return this.valueKeys.indexOf(t)>-1},isNotSelected:function(e){return!this.isSelected(e)},getOptionLabel:function(e){return e||0===e?e.isTag?e.label:this.customLabel(e,this.label)||"":""},select:function(e,t){if(!(this.blockKeys.indexOf(t)!==-1||this.disabled||e.$isLabel||this.max&&this.multiple&&this.internalValue.length===this.max)){if(e.isTag)this.$emit("tag",e.label,this.id),this.search="",this.closeOnSelect&&!this.multiple&&this.deactivate();else{var i=this.isSelected(e);if(i)return void("Tab"!==t&&this.removeElement(e));this.multiple?this.internalValue.push(e):this.internalValue=[e],this.$emit("select",(0,p.default)(e),this.id),this.$emit("input",this.getValue(),this.id),this.clearOnSelect&&(this.search="")}this.closeOnSelect&&this.deactivate()}},removeElement:function(e){if(!this.disabled&&(this.allowEmpty||!(this.internalValue.length<=1))){var t="object"===("undefined"==typeof e?"undefined":c(e))?this.valueKeys.indexOf(e[this.trackBy]):this.valueKeys.indexOf(e);this.internalValue.splice(t,1),this.$emit("remove",(0,p.default)(e),this.id),this.$emit("input",this.getValue(),this.id),this.closeOnSelect&&this.deactivate()}},removeLastElement:function(){this.blockKeys.indexOf("Delete")===-1&&0===this.search.length&&Array.isArray(this.internalValue)&&this.removeElement(this.internalValue[this.internalValue.length-1])},activate:function(){this.isOpen||this.disabled||(this.adjustPosition(),this.groupValues&&0===this.pointer&&this.filteredOptions.length&&(this.pointer=1),this.isOpen=!0,this.searchable?(this.search="",this.$refs.search.focus()):this.$el.focus(),this.$emit("open",this.id))},deactivate:function(){this.isOpen&&(this.isOpen=!1,this.searchable?this.$refs.search.blur():this.$el.blur(),this.search="",this.$emit("close",this.getValue(),this.id))},toggle:function(){this.isOpen?this.deactivate():this.activate()},adjustPosition:function(){"undefined"!=typeof window&&(this.hasEnoughSpace=this.$el.getBoundingClientRect().top+this.maxHeight<window.innerHeight)}}}},function(e,t,i){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={data:function(){return{pointer:0,visibleElements:this.maxHeight/this.optionHeight}},props:{showPointer:{type:Boolean,default:!0},optionHeight:{type:Number,default:40}},computed:{pointerPosition:function(){return this.pointer*this.optionHeight}},watch:{filteredOptions:function(){this.pointerAdjust()}},methods:{optionHighlight:function(e,t){return{"multiselect__option--highlight":e===this.pointer&&this.showPointer,"multiselect__option--selected":this.isSelected(t)}},addPointerElement:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"Enter",t=e.key;this.filteredOptions.length>0&&this.select(this.filteredOptions[this.pointer],t),this.pointerReset()},pointerForward:function(){this.pointer<this.filteredOptions.length-1&&(this.pointer++,this.$refs.list.scrollTop<=this.pointerPosition-this.visibleElements*this.optionHeight&&(this.$refs.list.scrollTop=this.pointerPosition-(this.visibleElements-1)*this.optionHeight),this.filteredOptions[this.pointer].$isLabel&&this.pointerForward())},pointerBackward:function(){this.pointer>0?(this.pointer--,this.$refs.list.scrollTop>=this.pointerPosition&&(this.$refs.list.scrollTop=this.pointerPosition),this.filteredOptions[this.pointer].$isLabel&&this.pointerBackward()):this.filteredOptions[0].$isLabel&&this.pointerForward()},pointerReset:function(){this.closeOnSelect&&(this.pointer=0,this.$refs.list&&(this.$refs.list.scrollTop=0))},pointerAdjust:function(){this.pointer>=this.filteredOptions.length-1&&(this.pointer=this.filteredOptions.length?this.filteredOptions.length-1:0)},pointerSet:function(e){this.pointer=e}}}},function(e,t,i){"use strict";function n(e){if(Array.isArray(e))return e.map(n);if(e&&"object"===("undefined"==typeof e?"undefined":s(e))){for(var t={},i=Object.keys(e),l=0,o=i.length;l<o;l++){var r=i[l];t[r]=n(e[r])}return t}return e}Object.defineProperty(t,"__esModule",{value:!0});var s="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e};t.default=n},function(e,t,i){i(5);var n=i(6)(i(4),i(7),null,null);e.exports=n.exports},function(e,t,i){"use strict";function n(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0});var s=i(0),l=n(s),o=i(1),r=n(o);t.default={name:"vue-multiselect",mixins:[l.default,r.default],props:{selectLabel:{type:String,default:"Press enter to select"},selectedLabel:{type:String,default:"Selected"},deselectLabel:{type:String,default:"Press enter to remove"},showLabels:{type:Boolean,default:!0},limit:{type:Number,default:99999},maxHeight:{type:Number,default:300},limitText:{type:Function,default:function(e){return"and "+e+" more"}},loading:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1}},computed:{visibleValue:function(){return this.multiple?this.internalValue.slice(0,this.limit):[]},deselectLabelText:function(){return this.showLabels?this.deselectLabel:""},selectLabelText:function(){return this.showLabels?this.selectLabel:""},selectedLabelText:function(){return this.showLabels?this.selectedLabel:""}}}},function(e,t){},function(e,t){e.exports=function(e,t,i,n){var s,l=e=e||{},o=typeof e.default;"object"!==o&&"function"!==o||(s=e,l=e.default);var r="function"==typeof l?l.options:l;if(t&&(r.render=t.render,r.staticRenderFns=t.staticRenderFns),i&&(r._scopeId=i),n){var a=r.computed||(r.computed={});Object.keys(n).forEach(function(e){var t=n[e];a[e]=function(){return t}})}return{esModule:s,exports:l,options:r}}},function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",{staticClass:"multiselect",class:{"multiselect--active":e.isOpen,"multiselect--disabled":e.disabled,"multiselect--above":!e.hasEnoughSpace},attrs:{tabindex:e.searchable?-1:0},on:{focus:function(t){e.activate()},blur:function(t){!e.searchable&&e.deactivate()},keydown:[function(t){e._k(t.keyCode,"down",40)||t.target===t.currentTarget&&(t.preventDefault(),e.pointerForward())},function(t){e._k(t.keyCode,"up",38)||t.target===t.currentTarget&&(t.preventDefault(),e.pointerBackward())},function(t){e._k(t.keyCode,"enter",13)&&e._k(t.keyCode,"tab",9)||(t.stopPropagation(),t.target===t.currentTarget&&e.addPointerElement(t))}],keyup:function(t){e._k(t.keyCode,"esc",27)||e.deactivate()}}},[e._t("carret",[i("div",{staticClass:"multiselect__select",on:{mousedown:function(t){t.preventDefault(),e.toggle()}}})]),e._v(" "),i("div",{ref:"tags",staticClass:"multiselect__tags"},[e._l(e.visibleValue,function(t){return i("span",{staticClass:"multiselect__tag",on:{mousedown:function(e){e.preventDefault()}}},[i("span",{domProps:{textContent:e._s(e.getOptionLabel(t))}}),e._v(" "),i("i",{staticClass:"multiselect__tag-icon",attrs:{"aria-hidden":"true",tabindex:"1"},on:{keydown:function(i){e._k(i.keyCode,"enter",13)||(i.preventDefault(),e.removeElement(t))},mousedown:function(i){i.preventDefault(),e.removeElement(t)}}})])}),e._v(" "),e.internalValue&&e.internalValue.length>e.limit?[i("strong",{domProps:{textContent:e._s(e.limitText(e.internalValue.length-e.limit))}})]:e._e(),e._v(" "),i("transition",{attrs:{name:"multiselect__loading"}},[e._t("loading",[i("div",{directives:[{name:"show",rawName:"v-show",value:e.loading,expression:"loading"}],staticClass:"multiselect__spinner"})])],2),e._v(" "),e.searchable?i("input",{ref:"search",staticClass:"multiselect__input",attrs:{type:"text",autocomplete:"off",placeholder:e.placeholder,disabled:e.disabled},domProps:{value:e.isOpen?e.search:e.currentOptionLabel},on:{input:function(t){e.updateSearch(t.target.value)},focus:function(t){t.preventDefault(),e.activate()},blur:function(t){t.preventDefault(),e.deactivate()},keyup:function(t){e._k(t.keyCode,"esc",27)||e.deactivate()},keydown:[function(t){e._k(t.keyCode,"down",40)||(t.preventDefault(),e.pointerForward())},function(t){e._k(t.keyCode,"up",38)||(t.preventDefault(),e.pointerBackward())},function(t){e._k(t.keyCode,"enter",13)||t.preventDefault()},function(t){e._k(t.keyCode,"enter",13)&&e._k(t.keyCode,"tab",9)||(t.stopPropagation(),t.target===t.currentTarget&&e.addPointerElement(t))},function(t){e._k(t.keyCode,"delete",[8,46])||e.removeLastElement()}]}}):e._e(),e._v(" "),e.searchable?e._e():i("span",{staticClass:"multiselect__single",domProps:{textContent:e._s(e.currentOptionLabel)}})],2),e._v(" "),i("transition",{attrs:{name:"multiselect"}},[i("ul",{directives:[{name:"show",rawName:"v-show",value:e.isOpen,expression:"isOpen"}],ref:"list",staticClass:"multiselect__content",style:{maxHeight:e.maxHeight+"px"}},[e._t("beforeList"),e._v(" "),e.multiple&&e.max===e.internalValue.length?i("li",[i("span",{staticClass:"multiselect__option"},[e._t("maxElements",[e._v("Maximum of "+e._s(e.max)+" options selected. First remove a selected option to select another.")])],2)]):e._e(),e._v(" "),!e.max||e.internalValue.length<e.max?e._l(e.filteredOptions,function(t,n){return i("li",{key:n,staticClass:"multiselect__element"},[t.$isLabel?e._e():i("span",{staticClass:"multiselect__option",class:e.optionHighlight(n,t),attrs:{tabindex:"0","data-select":t.isTag?e.tagPlaceholder:e.selectLabelText,"data-selected":e.selectedLabelText,"data-deselect":e.deselectLabelText},on:{mousedown:function(i){i.preventDefault(),e.select(t)},mouseenter:function(t){e.pointerSet(n)}}},[e._t("option",[i("span",[e._v(e._s(e.getOptionLabel(t)))])],{option:t,search:e.search})],2),e._v(" "),t.$isLabel?i("span",{staticClass:"multiselect__option multiselect__option--disabled",class:e.optionHighlight(n,t)},[e._v("\n              "+e._s(t.$groupLabel)+"\n            ")]):e._e()])}):e._e(),e._v(" "),i("li",{directives:[{name:"show",rawName:"v-show",value:0===e.filteredOptions.length&&e.search&&!e.loading,expression:"filteredOptions.length === 0 && search && !loading"}]},[i("span",{staticClass:"multiselect__option"},[e._t("noResult",[e._v("No elements found. Consider changing the search query.")])],2)]),e._v(" "),e._t("afterList")],2)])],2)},staticRenderFns:[]}},function(e,t,i){"use strict";function n(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0}),t.deepClone=t.pointerMixin=t.multiselectMixin=t.Multiselect=void 0;var s=i(3),l=n(s),o=i(0),r=n(o),a=i(1),u=n(a),c=i(2),h=n(c);t.default=l.default,t.Multiselect=l.default,t.multiselectMixin=r.default,t.pointerMixin=u.default,t.deepClone=h.default}])});

/***/ }),

/***/ 150:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue_multiselect__ = __webpack_require__(135);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue_multiselect___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_vue_multiselect__);
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
            portrait: "",
            selectedRoles: [],
            roles: [],
            errorShow: false,
            successShow: false,
            formData: {
                email: '',
                name: '',
                password: '',
                password_confirmation: '',
                is_banned: 'no',
                is_admin: 'no',
                github_name: '',
                description: '',
                real_name: '',
                city: '',
                company: '',
                weibo_name: '',
                weibo_link: '',
                twitter_account: '',
                personal_website: '',
                roles: [],
                portrait: null
            }
        };
    },

    components: {
        Multiselect: __WEBPACK_IMPORTED_MODULE_0_vue_multiselect__["Multiselect"]
    },
    mounted: function mounted() {
        this.getRoleInfo();
    },

    methods: {
        validateBeforeSubmit: function validateBeforeSubmit() {
            var _this = this;

            this.$validator.validateAll().then(function (success) {
                if (!success) {
                    return;
                }

                _this.formData.roles = [];
                for (var tmp in _this.selectedRoles) {
                    _this.formData.roles.push(_this.selectedRoles[tmp].id);
                }

                axios.post(window.Domain + 'api/admin/user', _this.formData).then(function (response) {
                    _this.errorShow = false;
                    _this.successShow = true;
                }).catch(function (response) {
                    _this.errorShow = true;
                    _this.successShow = false;
                });
            });
        },
        getRoleInfo: function getRoleInfo() {
            var _this2 = this;

            axios.get(window.Domain + 'api/admin/role').then(function (response) {
                var data = response.data.data;
                _this2.roles = data;
            });
        },
        previewFile: function previewFile(e) {
            var file = e.target.files[0];
            var supportedTypes = ['image/jpg', 'image/jpeg', 'image/png'];
            if (file && supportedTypes.indexOf(file.type) >= 0) {
                this.showImage(file);
                console.log(this.formData.portrait);
            } else {
                this.formData.portrait = null;
                this.portrait = null;
            }
        },
        showImage: function showImage(file) {
            var _this3 = this;

            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function (e) {
                _this3.portrait = e.target.result;
                _this3.formData.portrait = e.target.result;
            };
        }
    }
};

/***/ }),

/***/ 165:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)();
// imports


// module
exports.push([module.i, "\n@charset \"UTF-8\";\n.avatar-preview-img {\n  padding: 3px;\n  border: 1px solid #c8dcdb;\n  border-radius: 6px;\n  vertical-align: middle;\n  max-width: 100%;\n  box-sizing: border-box;\n}\n.form-control-feedback {\n  right: 15px;\n}\n.red-color {\n  color: red;\n}\nfieldset[disabled] .multiselect {\n  pointer-events: none;\n}\n.multiselect__spinner {\n  position: absolute;\n  right: 1px;\n  top: 1px;\n  width: 48px;\n  height: 35px;\n  background: #fff;\n  display: block;\n}\n.multiselect__spinner:before,\n.multiselect__spinner:after {\n  position: absolute;\n  content: \"\";\n  top: 50%;\n  left: 50%;\n  margin: -8px 0 0 -8px;\n  width: 16px;\n  height: 16px;\n  border-radius: 100%;\n  border-color: #41B883 transparent transparent;\n  border-style: solid;\n  border-width: 2px;\n  box-shadow: 0 0 0 1px transparent;\n}\n.multiselect__spinner:before {\n  -webkit-animation: spinning 2.4s cubic-bezier(0.41, 0.26, 0.2, 0.62);\n          animation: spinning 2.4s cubic-bezier(0.41, 0.26, 0.2, 0.62);\n  -webkit-animation-iteration-count: infinite;\n          animation-iteration-count: infinite;\n}\n.multiselect__spinner:after {\n  -webkit-animation: spinning 2.4s cubic-bezier(0.51, 0.09, 0.21, 0.8);\n          animation: spinning 2.4s cubic-bezier(0.51, 0.09, 0.21, 0.8);\n  -webkit-animation-iteration-count: infinite;\n          animation-iteration-count: infinite;\n}\n.multiselect__loading-enter-active,\n.multiselect__loading-leave-active {\n  -webkit-transition: opacity 0.4s ease-in-out;\n  transition: opacity 0.4s ease-in-out;\n  opacity: 1;\n}\n.multiselect__loading-enter,\n.multiselect__loading-leave-active {\n  opacity: 0;\n}\n.multiselect,\n.multiselect__input,\n.multiselect__single {\n  font-family: inherit;\n  font-size: 14px;\n  -ms-touch-action: manipulation;\n      touch-action: manipulation;\n}\n.multiselect {\n  box-sizing: content-box;\n  display: block;\n  position: relative;\n  width: 100%;\n  min-height: 40px;\n  text-align: left;\n  color: #35495E;\n}\n.multiselect * {\n  box-sizing: border-box;\n}\n.multiselect:focus {\n  outline: none;\n}\n.multiselect--disabled {\n  pointer-events: none;\n  opacity: 0.6;\n}\n.multiselect--active {\n  z-index: 50;\n}\n.multiselect--active .multiselect__current,\n.multiselect--active .multiselect__input,\n.multiselect--active .multiselect__tags {\n  border-bottom-left-radius: 0;\n  border-bottom-right-radius: 0;\n}\n.multiselect--active .multiselect__select {\n  -webkit-transform: rotateZ(180deg);\n          transform: rotateZ(180deg);\n}\n.multiselect--above.multiselect--active .multiselect__current,\n.multiselect--above.multiselect--active .multiselect__input,\n.multiselect--above.multiselect--active .multiselect__tags {\n  border-top-left-radius: 0;\n  border-top-right-radius: 0;\n}\n.multiselect__input,\n.multiselect__single {\n  position: relative;\n  display: inline-block;\n  min-height: 20px;\n  line-height: 20px;\n  border: none;\n  border-radius: 5px;\n  background: #fff;\n  padding: 1px 0 0 5px;\n  width: calc(100%);\n  -webkit-transition: border 0.1s ease;\n  transition: border 0.1s ease;\n  box-sizing: border-box;\n  margin-bottom: 8px;\n}\n.multiselect__tag ~ .multiselect__input,\n.multiselect__tag ~ .multiselect__single {\n  width: auto;\n}\n.multiselect__input:hover,\n.multiselect__single:hover {\n  border-color: #cfcfcf;\n}\n.multiselect__input:focus,\n.multiselect__single:focus {\n  border-color: #a8a8a8;\n  outline: none;\n}\n.multiselect__single {\n  padding-left: 6px;\n  margin-bottom: 8px;\n}\n.multiselect__tags {\n  min-height: 40px;\n  display: block;\n  padding: 8px 40px 0 8px;\n  border-radius: 5px;\n  border: 1px solid #E8E8E8;\n  background: #fff;\n}\n.multiselect__tag {\n  position: relative;\n  display: inline-block;\n  padding: 4px 26px 4px 10px;\n  border-radius: 5px;\n  margin-right: 10px;\n  color: #fff;\n  line-height: 1;\n  background: #41B883;\n  margin-bottom: 8px;\n  white-space: nowrap;\n}\n.multiselect__tag-icon {\n  cursor: pointer;\n  margin-left: 7px;\n  position: absolute;\n  right: 0;\n  top: 0;\n  bottom: 0;\n  font-weight: 700;\n  font-style: initial;\n  width: 22px;\n  text-align: center;\n  line-height: 22px;\n  -webkit-transition: all 0.2s ease;\n  transition: all 0.2s ease;\n  border-radius: 5px;\n}\n.multiselect__tag-icon:after {\n  content: \"\\D7\";\n  color: #266d4d;\n  font-size: 14px;\n}\n.multiselect__tag-icon:focus,\n.multiselect__tag-icon:hover {\n  background: #369a6e;\n}\n.multiselect__tag-icon:focus:after,\n.multiselect__tag-icon:hover:after {\n  color: white;\n}\n.multiselect__current {\n  line-height: 16px;\n  min-height: 40px;\n  box-sizing: border-box;\n  display: block;\n  overflow: hidden;\n  padding: 8px 12px 0;\n  padding-right: 30px;\n  white-space: nowrap;\n  margin: 0;\n  text-decoration: none;\n  border-radius: 5px;\n  border: 1px solid #E8E8E8;\n  cursor: pointer;\n}\n.multiselect__select {\n  line-height: 16px;\n  display: block;\n  position: absolute;\n  box-sizing: border-box;\n  width: 40px;\n  height: 38px;\n  right: 1px;\n  top: 1px;\n  padding: 4px 8px;\n  margin: 0;\n  text-decoration: none;\n  text-align: center;\n  cursor: pointer;\n  -webkit-transition: -webkit-transform 0.2s ease;\n  transition: -webkit-transform 0.2s ease;\n  transition: transform 0.2s ease;\n  transition: transform 0.2s ease, -webkit-transform 0.2s ease;\n}\n.multiselect__select:before {\n  position: relative;\n  right: 0;\n  top: 65%;\n  color: #999;\n  margin-top: 4px;\n  border-style: solid;\n  border-width: 5px 5px 0 5px;\n  border-color: #999999 transparent transparent transparent;\n  content: \"\";\n}\n.multiselect__placeholder {\n  color: #ADADAD;\n  display: inline-block;\n  margin-bottom: 10px;\n  padding-top: 2px;\n}\n.multiselect--active .multiselect__placeholder {\n  display: none;\n}\n.multiselect__content {\n  position: absolute;\n  list-style: none;\n  display: block;\n  background: #fff;\n  width: 100%;\n  max-height: 240px;\n  overflow: auto;\n  padding: 0;\n  margin: 0;\n  border: 1px solid #E8E8E8;\n  border-top: none;\n  border-bottom-left-radius: 5px;\n  border-bottom-right-radius: 5px;\n  z-index: 50;\n}\n.multiselect--above .multiselect__content {\n  bottom: 100%;\n  border-bottom-left-radius: 0;\n  border-bottom-right-radius: 0;\n  border-top-left-radius: 5px;\n  border-top-right-radius: 5px;\n  border-bottom: none;\n  border-top: 1px solid #E8E8E8;\n}\n.multiselect__content::webkit-scrollbar {\n  display: none;\n}\n.multiselect__element {\n  display: block;\n}\n.multiselect__option {\n  display: block;\n  padding: 12px;\n  min-height: 40px;\n  line-height: 16px;\n  text-decoration: none;\n  text-transform: none;\n  vertical-align: middle;\n  position: relative;\n  cursor: pointer;\n  white-space: nowrap;\n}\n.multiselect__option:after {\n  top: 0;\n  right: 0;\n  position: absolute;\n  line-height: 40px;\n  padding-right: 12px;\n  padding-left: 20px;\n}\n.multiselect__option--highlight {\n  background: #41B883;\n  outline: none;\n  color: white;\n}\n.multiselect__option--highlight:after {\n  content: attr(data-select);\n  background: #41B883;\n  color: white;\n}\n.multiselect__option--selected {\n  background: #F3F3F3;\n  color: #35495E;\n  font-weight: bold;\n}\n.multiselect__option--selected:after {\n  content: attr(data-selected);\n  color: silver;\n}\n.multiselect__option--selected.multiselect__option--highlight {\n  background: #FF6A6A;\n  color: #fff;\n}\n.multiselect__option--selected.multiselect__option--highlight:after {\n  background: #FF6A6A;\n  content: attr(data-deselect);\n  color: #fff;\n}\n.multiselect--disabled {\n  background: #ededed;\n  pointer-events: none;\n}\n.multiselect--disabled .multiselect__current,\n.multiselect--disabled .multiselect__select {\n  background: #ededed;\n  color: #a6a6a6;\n}\n.multiselect__option--disabled {\n  background: #ededed;\n  color: #a6a6a6;\n  cursor: text;\n  pointer-events: none;\n}\n.multiselect__option--disabled.multiselect__option--highlight {\n  background: #dedede !important;\n}\n.multiselect-enter-active,\n.multiselect-leave-active {\n  -webkit-transition: all 0.15s ease;\n  transition: all 0.15s ease;\n}\n.multiselect-enter,\n.multiselect-leave-active {\n  opacity: 0;\n}\n@-webkit-keyframes spinning {\nfrom {\n    -webkit-transform: rotate(0);\n            transform: rotate(0);\n}\nto {\n    -webkit-transform: rotate(2turn);\n            transform: rotate(2turn);\n}\n}\n@keyframes spinning {\nfrom {\n    -webkit-transform: rotate(0);\n            transform: rotate(0);\n}\nto {\n    -webkit-transform: rotate(2turn);\n            transform: rotate(2turn);\n}\n}\n", ""]);

// exports


/***/ }),

/***/ 183:
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
      'has-error': _vm.errors.has('email')
    }
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": "email"
    }
  }, [_vm._v("邮箱")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-9 col-md-6"
  }, [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.email),
      expression: "formData.email"
    }, {
      name: "validate",
      rawName: "v-validate:email.initial",
      value: ('required|email'),
      expression: "'required|email'",
      arg: "email",
      modifiers: {
        "initial": true
      }
    }],
    staticClass: "form-control",
    attrs: {
      "id": "email",
      "name": "email",
      "type": "text",
      "placeholder": ""
    },
    domProps: {
      "value": (_vm.formData.email)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.formData.email = $event.target.value
      }
    }
  }), _vm._v(" "), _c('span', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.errors.has('email')),
      expression: "errors.has('email')"
    }],
    staticClass: "glyphicon glyphicon-remove form-control-feedback",
    attrs: {
      "aria-hidden": "true"
    }
  }), _vm._v(" "), _c('span', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.errors.has('email')),
      expression: "errors.has('email')"
    }],
    staticClass: "red-color help-block"
  }, [_vm._v(_vm._s(_vm.errors.first('email')))])])]), _vm._v(" "), _c('div', {
    staticClass: "form-group",
    class: {
      'has-error': _vm.errors.has('name')
    }
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": "name"
    }
  }, [_vm._v("用户名")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-9 col-md-6"
  }, [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.name),
      expression: "formData.name"
    }, {
      name: "validate",
      rawName: "v-validate:email.initial",
      value: ('required'),
      expression: "'required'",
      arg: "email",
      modifiers: {
        "initial": true
      }
    }],
    staticClass: "form-control",
    attrs: {
      "id": "name",
      "name": "name",
      "type": "text",
      "placeholder": ""
    },
    domProps: {
      "value": (_vm.formData.name)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.formData.name = $event.target.value
      }
    }
  }), _vm._v(" "), _c('span', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.errors.has('name')),
      expression: "errors.has('name')"
    }],
    staticClass: "glyphicon glyphicon-remove form-control-feedback",
    attrs: {
      "aria-hidden": "true"
    }
  }), _vm._v(" "), _c('span', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.errors.has('name')),
      expression: "errors.has('name')"
    }],
    staticClass: "red-color help-block"
  }, [_vm._v(_vm._s(_vm.errors.first('name')))])])]), _vm._v(" "), _c('div', {
    staticClass: "form-group",
    class: {
      'has-error': _vm.errors.has('password')
    }
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": "name"
    }
  }, [_vm._v("密码")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-9 col-md-6"
  }, [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.password),
      expression: "formData.password"
    }, {
      name: "validate",
      rawName: "v-validate:password.initial",
      value: ('required|min:6'),
      expression: "'required|min:6'",
      arg: "password",
      modifiers: {
        "initial": true
      }
    }],
    staticClass: "form-control",
    attrs: {
      "id": "password",
      "name": "password",
      "type": "password",
      "placeholder": ""
    },
    domProps: {
      "value": (_vm.formData.password)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.formData.password = $event.target.value
      }
    }
  }), _vm._v(" "), _c('span', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.errors.has('password')),
      expression: "errors.has('password')"
    }],
    staticClass: "glyphicon glyphicon-remove form-control-feedback",
    attrs: {
      "aria-hidden": "true"
    }
  }), _vm._v(" "), _c('span', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.errors.has('password')),
      expression: "errors.has('password')"
    }],
    staticClass: "red-color help-block"
  }, [_vm._v(_vm._s(_vm.errors.first('password')))])])]), _vm._v(" "), _c('div', {
    staticClass: "form-group",
    class: {
      'has-error': _vm.errors.has('password_confirmation')
    }
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": "name"
    }
  }, [_vm._v("确认密码")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-9 col-md-6"
  }, [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.password_confirmation),
      expression: "formData.password_confirmation"
    }, {
      name: "validate",
      rawName: "v-validate:password_confirmation.initial",
      value: ('required|confirmed:password|min:6'),
      expression: "'required|confirmed:password|min:6'",
      arg: "password_confirmation",
      modifiers: {
        "initial": true
      }
    }],
    staticClass: "form-control",
    attrs: {
      "id": "password_confirmation",
      "name": "password_confirmation",
      "type": "password",
      "placeholder": ""
    },
    domProps: {
      "value": (_vm.formData.password_confirmation)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.formData.password_confirmation = $event.target.value
      }
    }
  }), _vm._v(" "), _c('span', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.errors.has('password_confirmation')),
      expression: "errors.has('password_confirmation')"
    }],
    staticClass: "glyphicon glyphicon-remove form-control-feedback",
    attrs: {
      "aria-hidden": "true"
    }
  }), _vm._v(" "), _c('span', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.errors.has('password_confirmation')),
      expression: "errors.has('password_confirmation')"
    }],
    staticClass: "red-color help-block"
  }, [_vm._v(_vm._s(_vm.errors.first('password_confirmation')))])])]), _vm._v(" "), _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": "name"
    }
  }, [_vm._v("是否禁用")]), _vm._v(" "), _c('div', {
    staticClass: "radio col-sm-9"
  }, [_c('label', [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.is_banned),
      expression: "formData.is_banned"
    }],
    attrs: {
      "type": "radio",
      "name": "is_banned",
      "value": "yes"
    },
    domProps: {
      "checked": _vm._q(_vm.formData.is_banned, "yes")
    },
    on: {
      "__c": function($event) {
        _vm.formData.is_banned = "yes"
      }
    }
  }), _vm._v("是\n                            ")]), _vm._v(" "), _c('label', [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.is_banned),
      expression: "formData.is_banned"
    }],
    attrs: {
      "type": "radio",
      "name": "is_banned",
      "value": "no"
    },
    domProps: {
      "checked": _vm._q(_vm.formData.is_banned, "no")
    },
    on: {
      "__c": function($event) {
        _vm.formData.is_banned = "no"
      }
    }
  }), _vm._v("否\n                            ")])])]), _vm._v(" "), _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": "name"
    }
  }, [_vm._v("是否管理员")]), _vm._v(" "), _c('div', {
    staticClass: "radio col-sm-9"
  }, [_c('label', [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.is_admin),
      expression: "formData.is_admin"
    }],
    attrs: {
      "type": "radio",
      "name": "is_admin",
      "value": "yes"
    },
    domProps: {
      "checked": _vm._q(_vm.formData.is_admin, "yes")
    },
    on: {
      "__c": function($event) {
        _vm.formData.is_admin = "yes"
      }
    }
  }), _vm._v("是\n                            ")]), _vm._v(" "), _c('label', [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.is_admin),
      expression: "formData.is_admin"
    }],
    attrs: {
      "type": "radio",
      "name": "is_admin",
      "value": "no"
    },
    domProps: {
      "checked": _vm._q(_vm.formData.is_admin, "no")
    },
    on: {
      "__c": function($event) {
        _vm.formData.is_admin = "no"
      }
    }
  }), _vm._v("否\n                            ")])])])]), _vm._v(" "), _c('div', {
    staticClass: "tab-pane",
    attrs: {
      "id": "tab_2"
    }
  }, [_c('div', {
    staticClass: "box-header"
  }), _vm._v(" "), _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": ""
    }
  }, [_vm._v("GitHub Name")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-6"
  }, [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.github_name),
      expression: "formData.github_name"
    }],
    staticClass: "form-control",
    attrs: {
      "name": "github_name",
      "type": "text",
      "value": ""
    },
    domProps: {
      "value": (_vm.formData.github_name)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.formData.github_name = $event.target.value
      }
    }
  })]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-4 help-block"
  }, [_vm._v("\n                            请跟 GitHub 上保持一致\n                        ")])]), _vm._v(" "), _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": ""
    }
  }, [_vm._v("真实姓名")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-6"
  }, [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.real_name),
      expression: "formData.real_name"
    }],
    staticClass: "form-control",
    attrs: {
      "name": "real_name",
      "type": "text",
      "value": ""
    },
    domProps: {
      "value": (_vm.formData.real_name)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.formData.real_name = $event.target.value
      }
    }
  })]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-4 help-block"
  }, [_vm._v("\n                            如：李小明\n                        ")])]), _vm._v(" "), _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": ""
    }
  }, [_vm._v("城市")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-6"
  }, [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.city),
      expression: "formData.city"
    }],
    staticClass: "form-control",
    attrs: {
      "name": "city",
      "type": "text",
      "value": ""
    },
    domProps: {
      "value": (_vm.formData.city)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.formData.city = $event.target.value
      }
    }
  })]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-4 help-block"
  }, [_vm._v("\n                            如：北京、广州\n                        ")])]), _vm._v(" "), _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": ""
    }
  }, [_vm._v("公司")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-6"
  }, [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.company),
      expression: "formData.company"
    }],
    staticClass: "form-control",
    attrs: {
      "name": "company",
      "type": "text",
      "value": ""
    },
    domProps: {
      "value": (_vm.formData.company)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.formData.company = $event.target.value
      }
    }
  })]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-4 help-block"
  }, [_vm._v("\n                            如：阿里巴巴\n                        ")])]), _vm._v(" "), _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": ""
    }
  }, [_vm._v("微博用户名")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-6"
  }, [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.weibo_name),
      expression: "formData.weibo_name"
    }],
    staticClass: "form-control",
    attrs: {
      "name": "weibo_name",
      "type": "text",
      "value": ""
    },
    domProps: {
      "value": (_vm.formData.weibo_name)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.formData.weibo_name = $event.target.value
      }
    }
  })]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-4 help-block"
  }, [_vm._v("\n                            如：Overtrue\n                        ")])]), _vm._v(" "), _c('div', {
    staticClass: "form-group",
    class: {
      'has-error': _vm.errors.has('weibo_link')
    }
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": ""
    }
  }, [_vm._v("微博个人页面")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-6"
  }, [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.weibo_link),
      expression: "formData.weibo_link"
    }, {
      name: "validate",
      rawName: "v-validate:weibo_link.initial",
      value: ('url'),
      expression: "'url'",
      arg: "weibo_link",
      modifiers: {
        "initial": true
      }
    }],
    staticClass: "form-control",
    attrs: {
      "name": "weibo_link",
      "type": "text",
      "value": ""
    },
    domProps: {
      "value": (_vm.formData.weibo_link)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.formData.weibo_link = $event.target.value
      }
    }
  })]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-4 help-block"
  }, [_vm._v("\n                            微博个人主页链接，如：http://weibo.com/laravelnews\n                        ")])]), _vm._v(" "), _vm._m(1), _vm._v(" "), _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": ""
    }
  }, [_vm._v("个人网站")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-6"
  }, [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.formData.personal_website),
      expression: "formData.personal_website"
    }],
    staticClass: "form-control",
    attrs: {
      "name": "personal_website",
      "type": "text",
      "value": ""
    },
    domProps: {
      "value": (_vm.formData.personal_website)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.formData.personal_website = $event.target.value
      }
    }
  })]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-4 help-block"
  }, [_vm._v("\n                            如：example.com，不需要加前缀 https://\n                        ")])]), _vm._v(" "), _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": ""
    }
  }, [_vm._v("个人简介")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-6"
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
  })]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-4 help-block"
  }, [_vm._v("\n                            请一句话介绍你自己，大部分情况下会在你的头像和名字旁边显示\n                        ")])])]), _vm._v(" "), _c('div', {
    staticClass: "tab-pane",
    attrs: {
      "id": "tab_3"
    }
  }, [_c('div', {
    staticClass: "box-header"
  }), _vm._v(" "), _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": ""
    }
  }, [_vm._v("角色")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-9 col-md-6"
  }, [_c('multiselect', {
    attrs: {
      "options": _vm.roles,
      "multiple": true,
      "select-label": "回车选中",
      "deselect-label": "当前选中",
      "close-on-select": false,
      "clear-on-select": false,
      "hide-selected": true,
      "placeholder": "添加角色",
      "label": "display_name",
      "track-by": "display_name"
    },
    model: {
      value: (_vm.selectedRoles),
      callback: function($$v) {
        _vm.selectedRoles = $$v
      }
    }
  })], 1)])]), _vm._v(" "), _c('div', {
    staticClass: "tab-pane",
    attrs: {
      "id": "tab_4"
    }
  }, [_c('div', {
    staticClass: "box-header"
  }), _vm._v(" "), _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": ""
    }
  }, [_vm._v("头像")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-9 col-md-6"
  }, [_c('input', {
    attrs: {
      "id": "avatar",
      "type": "file"
    },
    on: {
      "change": _vm.previewFile
    }
  }), _vm._v(" "), _c('br'), _vm._v(" "), _c('div', {
    staticStyle: {
      "max-width": "200px"
    }
  }, [_c('img', {
    staticClass: "avatar-preview-img",
    attrs: {
      "src": _vm.portrait
    }
  })])])])]), _vm._v(" "), _c('hr'), _vm._v(" "), _vm._m(2)])])])], 1)
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
  }, [_vm._v("详细信息")])]), _vm._v(" "), _c('li', {}, [_c('a', {
    attrs: {
      "href": "#tab_3",
      "data-toggle": "tab",
      "aria-expanded": "false"
    }
  }, [_vm._v("角色")])]), _vm._v(" "), _c('li', {}, [_c('a', {
    attrs: {
      "href": "#tab_4",
      "data-toggle": "tab",
      "aria-expanded": "false"
    }
  }, [_vm._v("头像")])])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-sm-2 control-label",
    attrs: {
      "for": ""
    }
  }, [_vm._v("Twitter 帐号")]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-6"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "name": "formData.twitter_account",
      "type": "text",
      "value": ""
    }
  })]), _vm._v(" "), _c('div', {
    staticClass: "col-sm-4 help-block"
  }, [_vm._v("\n                            如：summer_charlie\n                        ")])])
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
     require("vue-hot-reload-api").rerender("data-v-646b5ca8", module.exports)
  }
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
var update = __webpack_require__(3)("7599a3be", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-646b5ca8!../../../../../node_modules/sass-loader/index.js!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Add.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-646b5ca8!../../../../../node_modules/sass-loader/index.js!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Add.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ })

});