"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_views_ForgotPassword_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/ForgotPassword.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/ForgotPassword.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _forgetPassword_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./forgetPassword.css */ "./resources/js/components/forgetPassword.css");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      userEmail: ""
    };
  },
  methods: {
    sendMail: function sendMail(e) {
      var that = this;
      e.preventDefault();
      var formData = {};
      formData["userEmail"] = that.userEmail;
      if (that.userEmail == "") {
        that.errorAlert("Email is empty");
      } else {
        axios.post("/api/forgot-password", formData).then(function (response) {
          if (response.data.status == "Email not registered") {
            that.errorAlert(response.data.status);
          } else {
            that.saveAlert('Password change successfully');
          }
          that.userEmail = "";
        })["catch"](function (error) {
          that.errorAlert(error.message);
        });
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/ForgotPassword.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/ForgotPassword.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _components_ForgotPassword_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/ForgotPassword.vue */ "./resources/js/components/ForgotPassword.vue");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {},
  components: {
    ForgotPassword: _components_ForgotPassword_vue__WEBPACK_IMPORTED_MODULE_0__["default"]
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/ForgotPassword.vue?vue&type=template&id=3ac5fb09&":
/*!********************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/ForgotPassword.vue?vue&type=template&id=3ac5fb09& ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "login-page"
  }, [_vm._m(0), _vm._v(" "), _c("form", [_c("h3", [_vm._v("Forget Password")]), _vm._v(" "), _c("label", {
    attrs: {
      "for": "username"
    }
  }, [_vm._v("Email")]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.userEmail,
      expression: "userEmail"
    }],
    staticClass: "login-signup",
    attrs: {
      type: "text",
      placeholder: "Email or Phone",
      id: "username"
    },
    domProps: {
      value: _vm.userEmail
    },
    on: {
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.userEmail = $event.target.value;
      }
    }
  }), _vm._v(" "), _c("div", {
    staticClass: "forget-password"
  }, [_vm._v("\n            Enter the email address associated with your account.\n        ")]), _vm._v(" "), _c("button", {
    staticClass: "login-btn",
    on: {
      click: function click($event) {
        $event.stopPropagation();
        return _vm.sendMail.apply(null, arguments);
      }
    }
  }, [_vm._v("SEND")])])]);
};
var staticRenderFns = [function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "background"
  }, [_c("div", {
    staticClass: "shape"
  }), _vm._v(" "), _c("div", {
    staticClass: "shape"
  })]);
}];
render._withStripped = true;


/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/ForgotPassword.vue?vue&type=template&id=5aa612bd&":
/*!***************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/ForgotPassword.vue?vue&type=template&id=5aa612bd& ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("forgot-password");
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./resources/js/components/forgetPassword.css":
/*!*************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./resources/js/components/forgetPassword.css ***!
  \*************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../node_modules/laravel-mix/node_modules/css-loader/dist/runtime/api.js */ "./node_modules/laravel-mix/node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, ".login-page .background {\r\n    width: 430px;\r\n    height: 520px;\r\n    position: absolute;\r\n    transform: translate(-50%,-50%);\r\n    left: 50%;\r\n    top: 50%;\r\n  }\r\n  \r\n  .login-page .shape:first-child {\r\n    background: linear-gradient( #1845ad, #23a2f6 );\r\n    left: -80px;\r\n    top: -80px;\r\n  }\r\n  \r\n  .background .shape {\r\n    height: 200px;\r\n    width: 200px;\r\n    position: absolute;\r\n    border-radius: 50%;\r\n  }\r\n  \r\n  .login-page .shape:last-child {\r\n    background: linear-gradient( to right, #ff512f, #f09819 );\r\n    right: -30px;\r\n    bottom: -80px;\r\n  }\r\n  \r\n  .login-page form {\r\n    height: 520px;\r\n    width: 400px;\r\n    background-color: rgba(255,255,255,0.13);\r\n    position: absolute;\r\n    transform: translate(-50%,-50%);\r\n    top: 50%;\r\n    left: 50%;\r\n    border-radius: 10px;\r\n    -webkit-backdrop-filter: blur(10px);\r\n    backdrop-filter: blur(10px);\r\n    border: 2px solid rgba(255,255,255,0.1);\r\n    box-shadow: 0 0 40px rgb(8 7 16 / 60%);\r\n    padding: 50px 35px;\r\n  }\r\n  \r\n  .login-page .signup {\r\n    color: rgb(3 27 76);\r\n    cursor: pointer;\r\n  }\r\n  \r\n  .login-page form h3 {\r\n    font-size: 32px;\r\n    font-weight: 600;\r\n    line-height: 42px;\r\n    text-align: center;\r\n    color: #5a5654;\r\n  }\r\n  \r\n  .login-page label {\r\n    display: block;\r\n    margin-top: 30px;\r\n    font-size: 16px;\r\n    font-weight: 500;\r\n    color: #4e4e4e;\r\n  }\r\n  \r\n  .login-page .login-signup {\r\n    display: block;\r\n    height: 50px;\r\n    width: 100%;\r\n    background-color: rgba(255,255,255,0.07);\r\n    border-radius: 3px;\r\n    padding: 0 10px;\r\n    margin-top: 8px;\r\n    font-size: 14px;\r\n    font-weight: 300;\r\n    border: 1px solid #c4c4c4;\r\n    color: #4e4e4e;\r\n  }\r\n  \r\n  .login-page .login-btn {\r\n    margin-top: 50px;\r\n    width: 100%;\r\n    background-color: #FEA657;\r\n    color: #fff;\r\n    padding: 15px 0;\r\n    font-size: 18px;\r\n    font-weight: 600;\r\n    border-radius: 5px;\r\n    cursor: pointer;\r\n  }\r\n  \r\n  .login-page .forget-password {\r\n    color: #4e4e4e;\r\n    font-size: 14px;\r\n    margin-top: 10px;\r\n    text-decoration: none!important;\r\n    cursor: pointer;\r\n  }", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./resources/js/components/forgetPassword.css":
/*!****************************************************!*\
  !*** ./resources/js/components/forgetPassword.css ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_forgetPassword_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./forgetPassword.css */ "./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./resources/js/components/forgetPassword.css");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_forgetPassword_css__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_forgetPassword_css__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/components/ForgotPassword.vue":
/*!****************************************************!*\
  !*** ./resources/js/components/ForgotPassword.vue ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _ForgotPassword_vue_vue_type_template_id_3ac5fb09___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ForgotPassword.vue?vue&type=template&id=3ac5fb09& */ "./resources/js/components/ForgotPassword.vue?vue&type=template&id=3ac5fb09&");
/* harmony import */ var _ForgotPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ForgotPassword.vue?vue&type=script&lang=js& */ "./resources/js/components/ForgotPassword.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ForgotPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ForgotPassword_vue_vue_type_template_id_3ac5fb09___WEBPACK_IMPORTED_MODULE_0__.render,
  _ForgotPassword_vue_vue_type_template_id_3ac5fb09___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/ForgotPassword.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/views/ForgotPassword.vue":
/*!***********************************************!*\
  !*** ./resources/js/views/ForgotPassword.vue ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _ForgotPassword_vue_vue_type_template_id_5aa612bd___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ForgotPassword.vue?vue&type=template&id=5aa612bd& */ "./resources/js/views/ForgotPassword.vue?vue&type=template&id=5aa612bd&");
/* harmony import */ var _ForgotPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ForgotPassword.vue?vue&type=script&lang=js& */ "./resources/js/views/ForgotPassword.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ForgotPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ForgotPassword_vue_vue_type_template_id_5aa612bd___WEBPACK_IMPORTED_MODULE_0__.render,
  _ForgotPassword_vue_vue_type_template_id_5aa612bd___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/ForgotPassword.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/ForgotPassword.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/ForgotPassword.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ForgotPassword.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/ForgotPassword.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/ForgotPassword.vue?vue&type=script&lang=js&":
/*!************************************************************************!*\
  !*** ./resources/js/views/ForgotPassword.vue?vue&type=script&lang=js& ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ForgotPassword.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/ForgotPassword.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/ForgotPassword.vue?vue&type=template&id=3ac5fb09&":
/*!***********************************************************************************!*\
  !*** ./resources/js/components/ForgotPassword.vue?vue&type=template&id=3ac5fb09& ***!
  \***********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_template_id_3ac5fb09___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_template_id_3ac5fb09___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_template_id_3ac5fb09___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ForgotPassword.vue?vue&type=template&id=3ac5fb09& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/ForgotPassword.vue?vue&type=template&id=3ac5fb09&");


/***/ }),

/***/ "./resources/js/views/ForgotPassword.vue?vue&type=template&id=5aa612bd&":
/*!******************************************************************************!*\
  !*** ./resources/js/views/ForgotPassword.vue?vue&type=template&id=5aa612bd& ***!
  \******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_template_id_5aa612bd___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_template_id_5aa612bd___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_template_id_5aa612bd___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ForgotPassword.vue?vue&type=template&id=5aa612bd& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/ForgotPassword.vue?vue&type=template&id=5aa612bd&");


/***/ })

}]);