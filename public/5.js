webpackJsonp([5],{

/***/ 32:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(7)(
  /* script */
  __webpack_require__(49),
  /* template */
  __webpack_require__(72),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/Users/james/projects/presaver/resources/assets/js/components/Auth/Register.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] Register.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0e4cbd14", Component.options)
  } else {
    hotAPI.reload("data-v-0e4cbd14", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 49:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__auth_js__ = __webpack_require__(10);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
            name: null,
            email: null,
            password: null,
            success: false,
            error: false,
            response: null
        };
    },

    methods: {
        register: function register() {
            //event.preventDefault()
            __WEBPACK_IMPORTED_MODULE_0__auth_js__["a" /* default */].register(this, this.name, this.email, this.password);
        }
    }
};

/***/ }),

/***/ 72:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "flex-center full-height flex-column full-width bg-dark"
  }, [(_vm.error && !_vm.success) ? _c('div', {
    staticClass: "alert alert-danger"
  }, [_c('p', [_vm._v("There was an error, unable to complete registration.")])]) : _vm._e(), _vm._v(" "), (_vm.success) ? _c('div', {
    staticClass: "alert alert-success"
  }, [_c('p', [_vm._v("Registration completed. You can now sign in.")])]) : _vm._e(), _vm._v(" "), _c('h1', [_vm._v("Register")]), _vm._v(" "), (!_vm.success) ? _c('form', {
    attrs: {
      "autocomplete": "off"
    },
    on: {
      "submit": function($event) {
        $event.preventDefault();
        _vm.register($event)
      }
    }
  }, [_c('div', {
    staticClass: "form-group",
    class: {
      'has-error': _vm.error && _vm.response.username
    }
  }, [_c('label', {
    attrs: {
      "for": "name"
    }
  }, [_vm._v("Name")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.name),
      expression: "name"
    }],
    attrs: {
      "type": "text",
      "id": "name",
      "required": ""
    },
    domProps: {
      "value": (_vm.name)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.name = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.error && _vm.response.name) ? _c('span', {
    staticClass: "help-block"
  }, [_vm._v(_vm._s(_vm.response.name))]) : _vm._e()]), _vm._v(" "), _c('div', {
    staticClass: "form-group",
    class: {
      'has-error': _vm.error && _vm.response.email
    }
  }, [_c('label', {
    attrs: {
      "for": "email"
    }
  }, [_vm._v("E-mail")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.email),
      expression: "email"
    }],
    attrs: {
      "type": "email",
      "id": "email",
      "placeholder": "Email address",
      "required": ""
    },
    domProps: {
      "value": (_vm.email)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.email = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.error && _vm.response.email) ? _c('span', {
    staticClass: "help-block"
  }, [_vm._v(_vm._s(_vm.response.email))]) : _vm._e()]), _vm._v(" "), _c('div', {
    staticClass: "form-group",
    class: {
      'has-error': _vm.error && _vm.response.password
    }
  }, [_c('label', {
    attrs: {
      "for": "password"
    }
  }, [_vm._v("Password")]), _vm._v(" "), _c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.password),
      expression: "password"
    }],
    attrs: {
      "type": "password",
      "id": "password",
      "required": ""
    },
    domProps: {
      "value": (_vm.password)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.password = $event.target.value
      }
    }
  }), _vm._v(" "), (_vm.error && _vm.response.password) ? _c('span', {
    staticClass: "help-block"
  }, [_vm._v(_vm._s(_vm.response.password))]) : _vm._e()]), _vm._v(" "), _c('router-link', {
    staticClass: "pull-left",
    attrs: {
      "to": {
        name: 'login'
      }
    }
  }, [_vm._v("Login")]), _vm._v(" "), _c('button', {
    staticClass: "btn btn-default",
    attrs: {
      "type": "submit"
    }
  }, [_vm._v("Submit")])], 1) : _vm._e()])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-0e4cbd14", module.exports)
  }
}

/***/ })

});