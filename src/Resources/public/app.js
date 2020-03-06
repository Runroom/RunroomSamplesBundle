(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["app"],{

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _runroom_purejs_lib_animateTo__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @runroom/purejs/lib/animateTo */ "./node_modules/@runroom/purejs/lib/animateTo.js");
/* harmony import */ var _runroom_purejs_lib_animateTo__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_runroom_purejs_lib_animateTo__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _runroom_purejs_lib_events__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @runroom/purejs/lib/events */ "./node_modules/@runroom/purejs/lib/events.js");
/* harmony import */ var _runroom_purejs_lib_events__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_runroom_purejs_lib_events__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _runroom_purejs_lib_forEach__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @runroom/purejs/lib/forEach */ "./node_modules/@runroom/purejs/lib/forEach.js");
/* harmony import */ var _runroom_purejs_lib_forEach__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_runroom_purejs_lib_forEach__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _runroom_purejs_lib_isExplorer__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @runroom/purejs/lib/isExplorer */ "./node_modules/@runroom/purejs/lib/isExplorer.js");
/* harmony import */ var _runroom_purejs_lib_isExplorer__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_runroom_purejs_lib_isExplorer__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _runroom_purejs_lib_touchable__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @runroom/purejs/lib/touchable */ "./node_modules/@runroom/purejs/lib/touchable.js");
/* harmony import */ var _runroom_purejs_lib_touchable__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_runroom_purejs_lib_touchable__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _helpers_polyfills__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./helpers/polyfills */ "./assets/js/helpers/polyfills.js");
/* harmony import */ var _helpers_polyfills__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_helpers_polyfills__WEBPACK_IMPORTED_MODULE_5__);






// polyfills and helpers should be before any other component


_runroom_purejs_lib_touchable__WEBPACK_IMPORTED_MODULE_4___default()();

if (_runroom_purejs_lib_isExplorer__WEBPACK_IMPORTED_MODULE_3___default()()) {
  document.documentElement.classList.add('browser-ie');
}

_runroom_purejs_lib_events__WEBPACK_IMPORTED_MODULE_1___default.a.onDocumentReady(function () {
  // For small projects or low use of javascript, you can add events in this
  // same file, as follows. Eventhough the module import method is preferred.
  var anchors = document.querySelectorAll('.js-anchor');

  if (anchors) {
    _runroom_purejs_lib_forEach__WEBPACK_IMPORTED_MODULE_2___default()(anchors, function (anchor) {
      anchor.addEventListener('click', function (event) {
        var element = event.target.dataset.anchor || event.target.getAttribute('href');
        _runroom_purejs_lib_animateTo__WEBPACK_IMPORTED_MODULE_0___default()({ element: element, speed: 300 });
      });
    });
  }
});

/***/ }),

/***/ "./assets/js/helpers/polyfills.js":
/*!****************************************!*\
  !*** ./assets/js/helpers/polyfills.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

if (!('remove' in Element.prototype)) {
  Element.prototype.remove = function () {
    if (this.parentNode) {
      this.parentNode.removeChild(this);
    }
  };
}

/***/ }),

/***/ "./node_modules/@runroom/purejs/lib/animateTo.js":
/*!*******************************************************!*\
  !*** ./node_modules/@runroom/purejs/lib/animateTo.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

!function(e,t){ true?module.exports=t():undefined}(window,(function(){return function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}return n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=5)}([function(e,t,n){"use strict";n.r(t);t.default=function(e){return Number(e)===e}},function(e,t,n){"use strict";n.r(t);var r=n(0);t.default=function(e){if(!Object(r.default)(e)){var t=document.querySelector(e.toString());if(t)return t.offsetTop}return e||0}},function(e,t,n){"use strict";n.r(t);t.default=function(e){return"number"==typeof e&&isNaN(e)}},function(e,t,n){"use strict";function r(){return void 0!==window.pageYOffset?window.pageYOffset:(document.documentElement||document.body.parentNode||document.body).scrollTop}n.r(t),n.d(t,"default",(function(){return r}))},,function(e,t,n){"use strict";n.r(t);var r=n(1),o=n(3),u=n(2),i=function(e,t,n,r){return new(n||(n=Promise))((function(o,u){function i(e){try{c(r.next(e))}catch(e){u(e)}}function f(e){try{c(r.throw(e))}catch(e){u(e)}}function c(e){var t;e.done?o(e.value):(t=e.value,t instanceof n?t:new n((function(e){e(t)}))).then(i,f)}c((r=r.apply(e,t||[])).next())}))},f=function(e,t){var n,r,o,u,i={label:0,sent:function(){if(1&o[0])throw o[1];return o[1]},trys:[],ops:[]};return u={next:f(0),throw:f(1),return:f(2)},"function"==typeof Symbol&&(u[Symbol.iterator]=function(){return this}),u;function f(u){return function(f){return function(u){if(n)throw new TypeError("Generator is already executing.");for(;i;)try{if(n=1,r&&(o=2&u[0]?r.return:u[0]?r.throw||((o=r.return)&&o.call(r),0):r.next)&&!(o=o.call(r,u[1])).done)return o;switch(r=0,o&&(u=[2&u[0],o.value]),u[0]){case 0:case 1:o=u;break;case 4:return i.label++,{value:u[1],done:!1};case 5:i.label++,r=u[1],u=[0];continue;case 7:u=i.ops.pop(),i.trys.pop();continue;default:if(!(o=(o=i.trys).length>0&&o[o.length-1])&&(6===u[0]||2===u[0])){i=0;continue}if(3===u[0]&&(!o||u[1]>o[0]&&u[1]<o[3])){i.label=u[1];break}if(6===u[0]&&i.label<o[1]){i.label=o[1],o=u;break}if(o&&i.label<o[2]){i.label=o[2],i.ops.push(u);break}o[2]&&i.ops.pop(),i.trys.pop();continue}u=t.call(e,i)}catch(e){u=[6,e],r=0}finally{n=o=0}if(5&u[0])throw u[1];return{value:u[0]?u[1]:void 0,done:!0}}([u,f])}}};t.default=function(e,t){return i(this,void 0,void 0,(function(){var n,i,c,l,a,s;return f(this,(function(f){n=e.speed||500,i=e.offset||0,c=Object(o.default)(),l=Object(r.default)(e.element),a=l-c-i,20,s=0;try{if(Object(u.default)(a))throw"The element doesn't exists or is not a number";!function e(){var r=function(e,t,n,r){var o=e/(r/2);return o<1?n/2*o*o+t:-n/2*((o-=1)*(o-2)-1)+t}(s+=20,c,a,n);window.scroll(0,r),s<n?setTimeout(e,20):t&&t(null,r)}()}catch(e){throw e}return[2]}))}))}}])}));
//# sourceMappingURL=animateTo.js.map

/***/ }),

/***/ "./node_modules/@runroom/purejs/lib/events.js":
/*!****************************************************!*\
  !*** ./node_modules/@runroom/purejs/lib/events.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

!function(e,t){ true?module.exports=t():undefined}(window,(function(){return function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}return n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=7)}({7:function(e,t,n){"use strict";n.r(t),t.default={onDocumentReady:function(e){var t=document.readyState;if("complete"===t||"interactive"===t)return e();document.addEventListener("DOMContentLoaded",(function(){e()}))},onResizeWidth:function(e){var t,n=window.innerWidth;window.addEventListener("resize",(function(){n!==window.innerWidth&&(n=window.innerWidth,t&&clearTimeout(t),t=setTimeout((function(){e(n)}),100))}))}}}})}));
//# sourceMappingURL=events.js.map

/***/ }),

/***/ "./node_modules/@runroom/purejs/lib/forEach.js":
/*!*****************************************************!*\
  !*** ./node_modules/@runroom/purejs/lib/forEach.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

!function(e,t){ true?module.exports=t():undefined}(window,(function(){return function(e){var t={};function r(n){if(t[n])return t[n].exports;var o=t[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,r),o.l=!0,o.exports}return r.m=e,r.c=t,r.d=function(e,t,n){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)r.d(n,o,function(t){return e[t]}.bind(null,o));return n},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="",r(r.s=8)}({8:function(e,t,r){"use strict";r.r(t),t.default=function(e,t,r){if("[object Object]"===Object.prototype.toString.call(e))for(var n=Object.keys(e),o=0,u=n.length;o<u;o+=1)Object.prototype.hasOwnProperty.call(n,o)&&t.call(r,e[n[o]],n[o],e);else for(o=0,u=e.length;o<u;o+=1)t.call(r,e[o],o,e)}}})}));
//# sourceMappingURL=forEach.js.map

/***/ }),

/***/ "./node_modules/@runroom/purejs/lib/isExplorer.js":
/*!********************************************************!*\
  !*** ./node_modules/@runroom/purejs/lib/isExplorer.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

!function(e,t){ true?module.exports=t():undefined}(window,(function(){return function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}return n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=9)}({9:function(e,t,n){"use strict";n.r(t);t.default=function(){return!!window.MSInputMethodContext&&!!document.documentMode}}})}));
//# sourceMappingURL=isExplorer.js.map

/***/ }),

/***/ "./node_modules/@runroom/purejs/lib/touchable.js":
/*!*******************************************************!*\
  !*** ./node_modules/@runroom/purejs/lib/touchable.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

!function(e,t){ true?module.exports=t():undefined}(window,(function(){return function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}return n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=11)}({11:function(e,t,n){"use strict";n.r(t),t.default=function(){return!!("ontouchstart"in window||window.navigator.maxTouchPoints>0||window.navigator.msMaxTouchPoints>0)}}})}));
//# sourceMappingURL=touchable.js.map

/***/ })

},[["./assets/js/app.js","runtime"]]]);