webpackJsonp([11],{

/***/ 35:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(88)

var Component = __webpack_require__(7)(
  /* script */
  __webpack_require__(54),
  /* template */
  __webpack_require__(76),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/Users/james/projects/presaver/resources/assets/js/components/Dashboard.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] Dashboard.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-5ca4e85e", Component.options)
  } else {
    hotAPI.reload("data-v-5ca4e85e", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(87)

var Component = __webpack_require__(7)(
  /* script */
  __webpack_require__(58),
  /* template */
  __webpack_require__(74),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/Users/james/projects/presaver/resources/assets/js/components/Nav.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] Nav.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-462014ed", Component.options)
  } else {
    hotAPI.reload("data-v-462014ed", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 54:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Nav_vue__ = __webpack_require__(44);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Nav_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__Nav_vue__);
//
//
//
//
//
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

    components: {
        DashboardNav: __WEBPACK_IMPORTED_MODULE_0__Nav_vue___default.a
    },

    created: function created() {
        console.log('[Dashboard]');
    }
};

/***/ }),

/***/ 58:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__auth_js__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vuex__ = __webpack_require__(12);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
            //
        };
    },
    created: function created() {
        console.log('[Nav]');
    },


    computed: {
        isLoggedIn: function isLoggedIn() {
            return this.$store.getters.authenticated;
        }
    },
    methods: {
        logout: function logout() {
            __WEBPACK_IMPORTED_MODULE_0__auth_js__["a" /* default */].logout();
        }
    }
};

/***/ }),

/***/ 62:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(8)();
// imports


// module
exports.push([module.i, "\nnav {\n  background: #222;\n  color: #FFF;\n}\nnav ul {\n    list-style: none;\n    margin: 0;\n}\nnav ul li {\n      padding: 0;\n      margin: 2px;\n      font-size: 1rem;\n}\nnav ul li a {\n        background: #353535;\n        color: #FFF;\n        display: block;\n        padding: 30px;\n        text-align: center;\n        width: 100%;\n}\nnav ul li a span {\n          display: block;\n}\nnav ul li svg path {\n        fill: #FFF;\n}\n", ""]);

// exports


/***/ }),

/***/ 63:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(8)();
// imports


// module
exports.push([module.i, "\n.content {\n  display: -webkit-box;\n  display: -ms-flexbox;\n  display: flex;\n}\n#dashboard {\n  min-height: 100vh;\n}\n#dashboard nav {\n    -webkit-box-flex: 0;\n        -ms-flex: 0 0 100px;\n            flex: 0 0 100px;\n}\nmain {\n  background: #F9F9F9;\n  padding: 30px;\n  -webkit-box-flex: 1;\n      -ms-flex: 1 1 auto;\n          flex: 1 1 auto;\n}\n", ""]);

// exports


/***/ }),

/***/ 74:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('nav', [_c('ul', [_c('li', [(!_vm.isLoggedIn) ? _c('router-link', {
    attrs: {
      "to": {
        name: 'login'
      }
    }
  }, [_c('svg', {
    attrs: {
      "xmlns": "http://www.w3.org/2000/svg",
      "width": "20",
      "height": "20",
      "viewBox": "0 0 640 640"
    }
  }, [_c('path', {
    attrs: {
      "d": "M528 640h-448c-26.5 0-48-21.5-48-48v-416c0-26.5 21.5-48 48-48h448c26.5 0 48 21.5 48 48v416c0 26.5-21.5 48-48 48zM80 160c-8.8 0-16 7.2-16 16v416c0 8.8 7.2 16 16 16h448c8.8 0 16-7.2 16-16v-416c0-8.8-7.2-16-16-16h-448z"
    }
  }), _c('path', {
    attrs: {
      "d": "M528 96h-448c-8.8 0-16-7.2-16-16s7.2-16 16-16h448c8.8 0 16 7.2 16 16s-7.2 16-16 16z"
    }
  }), _c('path', {
    attrs: {
      "d": "M496 32h-384c-8.8 0-16-7.2-16-16s7.2-16 16-16h384c8.8 0 16 7.2 16 16s-7.2 16-16 16z"
    }
  }), _c('path', {
    attrs: {
      "d": "M442.1 291.6c-3.7-3-8.6-4.3-13.3-3.3l-160 32c-7.5 1.5-12.9 8.1-12.9 15.7v86.2c-9.4-4-20.3-6.2-32-6.2-35.9 0-64 21.1-64 48s28.1 48 64 48 64-21.1 64-48v-114.9l128-25.6v66.7c-9.4-4-20.3-6.2-32-6.2-35.9 0-64 21.1-64 48s28.1 48 64 48 64-21.1 64-48v-128c0-4.8-2.1-9.3-5.9-12.4zM224 480c-19.5 0-32-9.5-32-16s12.5-16 32-16 32 9.5 32 16-12.5 16-32 16zM384 448c-19.5 0-32-9.5-32-16s12.5-16 32-16 32 9.5 32 16-12.5 16-32 16z"
    }
  })]), _vm._v(" "), _c('span', [_vm._v("Login")])]) : _vm._e()], 1), _vm._v(" "), _c('li', [(_vm.isLoggedIn) ? _c('router-link', {
    attrs: {
      "to": {
        name: 'campaigns'
      }
    }
  }, [_c('svg', {
    attrs: {
      "xmlns": "http://www.w3.org/2000/svg",
      "width": "20",
      "height": "20",
      "viewBox": "0 0 640 640"
    }
  }, [_c('path', {
    attrs: {
      "d": "M528 640h-448c-26.5 0-48-21.5-48-48v-416c0-26.5 21.5-48 48-48h448c26.5 0 48 21.5 48 48v416c0 26.5-21.5 48-48 48zM80 160c-8.8 0-16 7.2-16 16v416c0 8.8 7.2 16 16 16h448c8.8 0 16-7.2 16-16v-416c0-8.8-7.2-16-16-16h-448z"
    }
  }), _c('path', {
    attrs: {
      "d": "M528 96h-448c-8.8 0-16-7.2-16-16s7.2-16 16-16h448c8.8 0 16 7.2 16 16s-7.2 16-16 16z"
    }
  }), _c('path', {
    attrs: {
      "d": "M496 32h-384c-8.8 0-16-7.2-16-16s7.2-16 16-16h384c8.8 0 16 7.2 16 16s-7.2 16-16 16z"
    }
  }), _c('path', {
    attrs: {
      "d": "M442.1 291.6c-3.7-3-8.6-4.3-13.3-3.3l-160 32c-7.5 1.5-12.9 8.1-12.9 15.7v86.2c-9.4-4-20.3-6.2-32-6.2-35.9 0-64 21.1-64 48s28.1 48 64 48 64-21.1 64-48v-114.9l128-25.6v66.7c-9.4-4-20.3-6.2-32-6.2-35.9 0-64 21.1-64 48s28.1 48 64 48 64-21.1 64-48v-128c0-4.8-2.1-9.3-5.9-12.4zM224 480c-19.5 0-32-9.5-32-16s12.5-16 32-16 32 9.5 32 16-12.5 16-32 16zM384 448c-19.5 0-32-9.5-32-16s12.5-16 32-16 32 9.5 32 16-12.5 16-32 16z"
    }
  })]), _vm._v(" "), _c('span', [_vm._v("My Campaigns")])]) : _vm._e()], 1), _vm._v(" "), _c('li', [(_vm.isLoggedIn) ? _c('router-link', {
    attrs: {
      "to": {
        name: 'campaigns-create'
      }
    }
  }, [_c('svg', {
    attrs: {
      "xmlns": "http://www.w3.org/2000/svg",
      "width": "20",
      "height": "20",
      "viewBox": "0 0 640 640"
    }
  }, [_c('path', {
    attrs: {
      "d": "M592 320h-272v-272c0-8.8-7.2-16-16-16s-16 7.2-16 16v272h-272c-8.8 0-16 7.2-16 16s7.2 16 16 16h272v272c0 8.8 7.2 16 16 16s16-7.2 16-16v-272h272c8.8 0 16-7.2 16-16s-7.2-16-16-16z"
    }
  })]), _vm._v(" "), _c('span', [_vm._v("Create new campaign")])]) : _vm._e()], 1), _vm._v(" "), _c('li', [(_vm.isLoggedIn) ? _c('a', {
    attrs: {
      "href": "javascript:void(0)"
    },
    on: {
      "click": _vm.logout
    }
  }, [_c('svg', {
    attrs: {
      "xmlns": "http://www.w3.org/2000/svg",
      "width": "20",
      "height": "20",
      "viewBox": "0 0 640 640"
    }
  }, [_c('path', {
    attrs: {
      "d": "M368 256c8.8 0 16-7.2 16-16v-128c0-26.5-21.5-48-48-48h-288c-26.5 0-48 21.5-48 48v384c0 23.9 17.2 49.9 39.1 59.3l165.2 70.8c5.7 2.4 11.5 3.7 17 3.7 6.8 0 13.3-1.8 18.9-5.5 10.1-6.6 15.8-18.4 15.8-32.3v-48h80c26.5 0 48-21.5 48-48v-128c0-8.8-7.2-16-16-16s-16 7.2-16 16v128c0 8.8-7.2 16-16 16h-80v-304c0-23.9-17.2-49.9-39.1-59.3l-122.9-52.7h242c8.8 0 16 7.2 16 16v128c0 8.8 7.2 16 16 16zM204.3 178.1c10.3 4.4 19.7 18.7 19.7 29.9v384c0 3.3-0.9 5.2-1.4 5.5-0.6 0.4-2.6 0.5-5.7-0.9l-165.2-70.8c-10.3-4.4-19.7-18.7-19.7-29.9v-384c0-2.5 0.6-4.9 1.6-7l170.7 73.1z"
    }
  }), _c('path', {
    attrs: {
      "d": "M587.3 292.7l-96-96c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l68.7 68.7h-201.4c-8.8 0-16 7.2-16 16s7.2 16 16 16h201.4l-68.7 68.7c-6.2 6.2-6.2 16.4 0 22.6 3.1 3.1 7.2 4.7 11.3 4.7s8.2-1.6 11.3-4.7l96-96c6.2-6.2 6.2-16.4 0-22.6z"
    }
  })]), _vm._v(" "), _c('span', [_vm._v("Log out")])]) : _vm._e()])])])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-462014ed", module.exports)
  }
}

/***/ }),

/***/ 76:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "content group",
    attrs: {
      "id": "dashboard"
    }
  }, [_c('dashboard-nav'), _vm._v(" "), _c('main', [_c('router-view')], 1)], 1)
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-5ca4e85e", module.exports)
  }
}

/***/ }),

/***/ 87:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(62);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(9)("532651fc", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!./../../../../node_modules/css-loader/index.js!./../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-462014ed!./../../../../node_modules/sass-loader/index.js!./../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Nav.vue", function() {
     var newContent = require("!!./../../../../node_modules/css-loader/index.js!./../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-462014ed!./../../../../node_modules/sass-loader/index.js!./../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Nav.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 88:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(63);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(9)("f00400a2", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!./../../../../node_modules/css-loader/index.js!./../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-5ca4e85e!./../../../../node_modules/sass-loader/index.js!./../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Dashboard.vue", function() {
     var newContent = require("!!./../../../../node_modules/css-loader/index.js!./../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-5ca4e85e!./../../../../node_modules/sass-loader/index.js!./../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Dashboard.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ })

});