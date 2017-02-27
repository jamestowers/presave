webpackJsonp([12],{

/***/ 34:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(89)

var Component = __webpack_require__(7)(
  /* script */
  __webpack_require__(53),
  /* template */
  __webpack_require__(78),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/Users/james/projects/presaver/resources/assets/js/components/Campaigns.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] Campaigns.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7229c0a6", Component.options)
  } else {
    hotAPI.reload("data-v-7229c0a6", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 40:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(86)

var Component = __webpack_require__(7)(
  /* script */
  __webpack_require__(52),
  /* template */
  __webpack_require__(73),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/Users/james/projects/presaver/resources/assets/js/components/CampaignTile.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] CampaignTile.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-33458df8", Component.options)
  } else {
    hotAPI.reload("data-v-33458df8", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 52:
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

/* harmony default export */ __webpack_exports__["default"] = {

    props: {
        campaign: {
            type: Object,
            required: true
        }
    },

    data: function data() {
        return {
            //
        };
    },


    methods: {
        //
    }
};

/***/ }),

/***/ 53:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__CampaignTile_vue__ = __webpack_require__(40);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__CampaignTile_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__CampaignTile_vue__);
//
//
//
//
//
//
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
            campaigns: []
        };
    },
    created: function created() {
        this.fetchCampaigns();
    },


    components: {
        CampaignTile: __WEBPACK_IMPORTED_MODULE_0__CampaignTile_vue___default.a
    },

    methods: {
        fetchCampaigns: function fetchCampaigns() {
            this.$http.get('campaigns').then(this.onSuccess, this.onError);
        },
        onSuccess: function onSuccess(response) {
            console.log(response.data);
            this.campaigns = response.data.campaigns;
        },
        onError: function onError(error) {
            console.error(error.data);
        }
    }
};

/***/ }),

/***/ 61:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(8)();
// imports


// module
exports.push([module.i, "\n.campaign-tile {\n  display: -webkit-box;\n  display: -ms-flexbox;\n  display: flex;\n}\n.campaign-tile .thumbnail {\n    -webkit-box-flex: 0;\n        -ms-flex: 0 0 160px;\n            flex: 0 0 160px;\n    margin: 0 30px 30px 0;\n}\n", ""]);

// exports


/***/ }),

/***/ 64:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(8)();
// imports


// module
exports.push([module.i, "", ""]);

// exports


/***/ }),

/***/ 73:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "campaign-tile"
  }, [(_vm.campaign.release_artwork) ? _c('div', {
    staticClass: "thumbnail"
  }, [_c('img', {
    attrs: {
      "src": ("/uploads/" + (_vm.campaign.release_artwork))
    }
  })]) : _vm._e(), _vm._v(" "), _c('div', {}, [_c('h2', [_vm._v(_vm._s(_vm.campaign.release_title))]), _vm._v(" "), (_vm.campaign.id) ? _c('router-link', {
    staticClass: "btn-sm",
    attrs: {
      "to": {
        name: 'campaigns-edit',
        params: {
          campaignId: _vm.campaign.id
        }
      },
      "role": "button"
    }
  }, [_vm._v("Edit")]) : _vm._e(), _vm._v(" "), _c('p', {
    staticClass: "small"
  }, [_c('em', [_vm._v("Released: " + _vm._s(_vm.campaign.release_date))])]), _vm._v(" "), _c('p', [_vm._v(_vm._s(_vm.campaign.description))])], 1)])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-33458df8", module.exports)
  }
}

/***/ }),

/***/ 78:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "campaigns"
  }, [_c('h1', {
    staticClass: "page-title"
  }, [_vm._v("Campaigns")]), _vm._v(" "), _vm._l((_vm.campaigns), function(campaign) {
    return _c('campaign-tile', {
      attrs: {
        "campaign": campaign
      }
    })
  })], 2)
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-7229c0a6", module.exports)
  }
}

/***/ }),

/***/ 86:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(61);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(9)("7a8a5fa4", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!./../../../../node_modules/css-loader/index.js!./../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-33458df8!./../../../../node_modules/sass-loader/index.js!./../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./CampaignTile.vue", function() {
     var newContent = require("!!./../../../../node_modules/css-loader/index.js!./../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-33458df8!./../../../../node_modules/sass-loader/index.js!./../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./CampaignTile.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 89:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(64);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(9)("12e36140", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!./../../../../node_modules/css-loader/index.js!./../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-7229c0a6!./../../../../node_modules/sass-loader/index.js!./../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Campaigns.vue", function() {
     var newContent = require("!!./../../../../node_modules/css-loader/index.js!./../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-7229c0a6!./../../../../node_modules/sass-loader/index.js!./../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Campaigns.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ })

});