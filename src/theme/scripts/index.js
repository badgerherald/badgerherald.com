/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/wordpress-script/featured-video.tsx":
/*!*************************************************!*\
  !*** ./src/wordpress-script/featured-video.tsx ***!
  \*************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {


var __assign = (this && this.__assign) || function () {
    __assign = Object.assign || function(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
                t[p] = s[p];
        }
        return t;
    };
    return __assign.apply(this, arguments);
};
Object.defineProperty(exports, "__esModule", ({ value: true }));
// WordPress dependencies.
var components_1 = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
var compose_1 = __webpack_require__(/*! @wordpress/compose */ "@wordpress/compose");
var React = __webpack_require__(/*! react */ "react");
var react_1 = __webpack_require__(/*! react */ "react");
var hooks_1 = __webpack_require__(/*! @wordpress/hooks */ "@wordpress/hooks");
var core_data_1 = __webpack_require__(/*! @wordpress/core-data */ "@wordpress/core-data");
/**
 * Adds a checkbox and field for overriding the feature image with a video
 *
 * @param {function} PostFeaturedImage Featured Image component.
 *
 * @return {function} PostFeaturedImage Modified Featured Image component.
 */
(0, hooks_1.addFilter)("editor.PostFeaturedImage", "webpress/featured-image-as-video", (0, compose_1.createHigherOrderComponent)(function (OriginalComponent) {
    return function (props) {
        var _a = (0, core_data_1.useEntityProp)("postType", "post", "meta"), meta = _a[0], setMeta = _a[1];
        var setFeaturedImageIsVideo = function (value) {
            return setMeta(Object.assign({}, meta, {
                _featured_image_is_video: value,
            }));
        };
        var setFeaturedImageVideoUrl = function (value) {
            setMeta(Object.assign({}, meta, {
                _featured_image_video_url: value,
            }));
        };
        return (React.createElement(react_1.Fragment, null,
            React.createElement(OriginalComponent, __assign({}, props)),
            React.createElement(FeaturedVideoToggle, { isVideo: meta._featured_image_is_video, videoUrl: meta._featured_image_video_url, onSetIsVideo: setFeaturedImageIsVideo, onSetVideoUrl: setFeaturedImageVideoUrl })));
    };
}, "webpress/featured-image-as-video"));
function FeaturedVideoToggle(_a) {
    var isVideo = _a.isVideo, videoUrl = _a.videoUrl, onSetIsVideo = _a.onSetIsVideo, onSetVideoUrl = _a.onSetVideoUrl;
    return (React.createElement(React.Fragment, null,
        React.createElement(components_1.CheckboxControl, { label: "Replace with YouTube Video?", checked: isVideo, onChange: onSetIsVideo }),
        isVideo && React.createElement(components_1.TextControl, { value: videoUrl, onChange: onSetVideoUrl })));
}


/***/ }),

/***/ "./src/wordpress-script/index.tsx":
/*!****************************************!*\
  !*** ./src/wordpress-script/index.tsx ***!
  \****************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {


var __createBinding = (this && this.__createBinding) || (Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    Object.defineProperty(o, k2, { enumerable: true, get: function() { return m[k]; } });
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
}));
var __exportStar = (this && this.__exportStar) || function(m, exports) {
    for (var p in m) if (p !== "default" && !Object.prototype.hasOwnProperty.call(exports, p)) __createBinding(exports, m, p);
};
Object.defineProperty(exports, "__esModule", ({ value: true }));
__exportStar(__webpack_require__(/*! ./featured-video */ "./src/wordpress-script/featured-video.tsx"), exports);
__exportStar(__webpack_require__(/*! ./media-byline */ "./src/wordpress-script/media-byline.tsx"), exports);


/***/ }),

/***/ "./src/wordpress-script/media-byline.tsx":
/*!***********************************************!*\
  !*** ./src/wordpress-script/media-byline.tsx ***!
  \***********************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {


var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        if (typeof b !== "function" && b !== null)
            throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var __assign = (this && this.__assign) || function () {
    __assign = Object.assign || function(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
                t[p] = s[p];
        }
        return t;
    };
    return __assign.apply(this, arguments);
};
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
var __spreadArray = (this && this.__spreadArray) || function (to, from, pack) {
    if (pack || arguments.length === 2) for (var i = 0, l = from.length, ar; i < l; i++) {
        if (ar || !(i in from)) {
            if (!ar) ar = Array.prototype.slice.call(from, 0, i);
            ar[i] = from[i];
        }
    }
    return to.concat(ar || Array.prototype.slice.call(from));
};
Object.defineProperty(exports, "__esModule", ({ value: true }));
var hooks_1 = __webpack_require__(/*! @wordpress/hooks */ "@wordpress/hooks");
var compose_1 = __webpack_require__(/*! @wordpress/compose */ "@wordpress/compose");
var element_1 = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
var block_editor_1 = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
var core_data_1 = __webpack_require__(/*! @wordpress/core-data */ "@wordpress/core-data");
var components_1 = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
var React = __webpack_require__(/*! react */ "react");
var MediaBylineManager = /** @class */ (function () {
    function MediaBylineManager() {
        this.urlMap = new Map();
        this.idMap = new Map();
    }
    //private bylines = new Map<BylineId, MediaByline>();
    /*
    bylineForId(id: string) {
      if (!this.bylines.has(id)) {
        let bylineHolder = useState<MediaByline>(undefined);
        this.bylineStates.set(id, bylineHolder);
        this.load(id).then((byline) => bylineHolder[1].apply(byline));
      }
      return this.stateSetters.get(id);
    }
    */
    MediaBylineManager.prototype.useBylineStateFor = function (url) {
        if (!this.urlMap.has(url)) {
            this.urlMap.set(url, (0, element_1.useState)(undefined));
        }
        return this.urlMap.get(url);
    };
    MediaBylineManager.prototype.idForURL = function (url) {
        return __awaiter(this, void 0, void 0, function () {
            var data, promise;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0:
                        if (!this.urlMap.has(url)) {
                            data = new URLSearchParams();
                            data.append("src", url);
                            data.append("readonly", "1");
                            promise = fetch(ajaxurl + "?action=webpress_save_byline", {
                                method: "POST",
                                body: data,
                            }).then(function (response) { return response.json(); });
                        }
                        return [4 /*yield*/, this.urlMap.get(url)];
                    case 1: return [2 /*return*/, (_a.sent()).media];
                }
            });
        });
    };
    MediaBylineManager.prototype.load = function (mediaId) {
        return __awaiter(this, void 0, void 0, function () {
            var data, promise;
            return __generator(this, function (_a) {
                if (!mediaId) {
                    return [2 /*return*/, undefined];
                }
                if (!this.stateSetters.has(mediaId)) {
                    data = new URLSearchParams();
                    data.append("id", mediaId);
                    data.append("readonly", "1");
                    promise = fetch(ajaxurl + "?action=webpress_save_byline", {
                        method: "POST",
                        body: data,
                    }).then(function (response) { return response.json(); });
                    this.stateSetters.set(mediaId, promise);
                }
                return [2 /*return*/, this.stateSetters.get(mediaId)];
            });
        });
    };
    return MediaBylineManager;
}());
/**
 * Singleton class used to load/store/cache media credit for an image
 * All loading/saving should happen through the shared singleton to maintain state
 *
 * e.g.
 *
 * MediaCreditManager.shared.load(attachementId)
 */
var MediaCreditManager = /** @class */ (function () {
    function MediaCreditManager() {
        var _this = this;
        this.cache = new Map();
        this.urlMap = new Map();
        this.saveOperations = new Map();
        this.saveDebounced = this.debounce(function () { return _this.saveAll(); }, 500);
    }
    MediaCreditManager.prototype.hydrate = function () {
        return __awaiter(this, void 0, void 0, function () {
            var figures;
            var _this = this;
            return __generator(this, function (_a) {
                figures = document.querySelectorAll("figure.wp-block-image");
                figures.forEach(function (figure) { return __awaiter(_this, void 0, void 0, function () {
                    var imgTag, bylineTag, credit;
                    return __generator(this, function (_a) {
                        switch (_a.label) {
                            case 0:
                                imgTag = figure.querySelector("img");
                                if (!imgTag) {
                                    return [2 /*return*/];
                                }
                                bylineTag = this.installByline(figure);
                                return [4 /*yield*/, this.creditForUrl(imgTag.src)];
                            case 1:
                                credit = _a.sent();
                                if (credit) {
                                    this.updateByline(bylineTag, credit);
                                }
                                return [2 /*return*/];
                        }
                    });
                }); });
                return [2 /*return*/];
            });
        });
    };
    MediaCreditManager.prototype.debounce = function (cb, duration) {
        var _this = this;
        return function () {
            var args = [];
            for (var _i = 0; _i < arguments.length; _i++) {
                args[_i] = arguments[_i];
            }
            clearTimeout(_this.timer);
            _this.timer = setTimeout(function () {
                cb.apply(void 0, args);
            }, duration);
        };
    };
    MediaCreditManager.prototype.saveAll = function () {
        return __awaiter(this, void 0, void 0, function () {
            var _this = this;
            return __generator(this, function (_a) {
                this.saveOperations.forEach(function (value, key) { return __awaiter(_this, void 0, void 0, function () {
                    var operation, data, _i, _a, _b, key_1, value_1, response;
                    return __generator(this, function (_c) {
                        operation = value;
                        data = new URLSearchParams();
                        for (_i = 0, _a = Object.entries(operation); _i < _a.length; _i++) {
                            _b = _a[_i], key_1 = _b[0], value_1 = _b[1];
                            data.append(key_1, value_1);
                        }
                        response = fetch(ajaxurl + "?action=webpress_save_byline", {
                            method: "POST",
                            body: data,
                        }).then(function (response) { return response.json(); });
                        this.cache.set(key, response);
                        this.saveOperations.delete(key);
                        return [2 /*return*/];
                    });
                }); });
                this.subscribe(undefined, undefined);
                return [2 /*return*/];
            });
        });
    };
    MediaCreditManager.prototype.save = function (mediaId, bylineId, creditLine, url) {
        return __awaiter(this, void 0, void 0, function () {
            var byline;
            return __generator(this, function (_a) {
                byline = {
                    id: mediaId,
                    byline_author: bylineId,
                    byline_credit_line: creditLine,
                };
                this.saveOperations.set(mediaId, byline);
                this.urlMap.delete(url);
                this.saveDebounced();
                return [2 /*return*/];
            });
        });
    };
    MediaCreditManager.prototype.updateByline = function (byline, credit) {
        for (var i = 0; i < byline.children.length; i++) {
            byline.removeChild(byline.children[i]);
        }
        byline.textContent = null;
        byline.innerHTML = credit.innerHtml;
    };
    MediaCreditManager.prototype.installByline = function (dom) {
        if (!dom) {
            return;
        }
        dom = dom;
        if (!dom || dom.nodeName != "FIGURE") {
            return;
        }
        var existingByline = dom.querySelector(".byline-wrapper");
        if (existingByline != undefined) {
            return existingByline;
        }
        var byline = document.createElement("span", {});
        byline.classList.add("byline-wrapper");
        dom.append(byline);
        return byline;
    };
    MediaCreditManager.shared = new MediaCreditManager();
    return MediaCreditManager;
}());
(0, hooks_1.addFilter)("blocks.registerBlockType", "example/filter-blocks", function (settings) {
    if (settings.name !== "core/image") {
        return settings;
    }
    var newSettings = __assign(__assign({}, settings), { attributes: __assign({}, settings.attributes), edit: function (props) { return (React.createElement(ImageWrapper, { id: props.attributes.id, attributes: props.attributes }, settings.edit(props))); } });
    return newSettings;
});
var ImageWrapper = /** @class */ (function (_super) {
    __extends(ImageWrapper, _super);
    function ImageWrapper() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    ImageWrapper.prototype.render = function () {
        return this.props.children;
    };
    ImageWrapper.prototype.componentDidUpdate = function () {
        MediaCreditManager.shared.hydrate();
    };
    return ImageWrapper;
}(React.Component));
(0, hooks_1.addFilter)("editor.BlockEdit", "webpress/media-credit", (0, compose_1.createHigherOrderComponent)(function (BlockEdit) {
    return function (props) {
        if ("core/image" !== props.name) {
            return React.createElement(BlockEdit, __assign({}, props));
        }
        var _a = props, attributes = _a.attributes, setAttributes = _a.setAttributes;
        var _b = (0, element_1.useState)(false), userLocked = _b[0], setUserLocked = _b[1];
        var _c = MediaCreditManager.shared.creditForUrl(attributes.url), byline = _c[0], setByline = _c[1];
        var _d = (0, core_data_1.useEntityProp)("postType", "attachment", "meta", attributes.id), meta = _d[0], setMeta = _d[1];
        /*
        if ( && !byline) {
          mediaManager.creditForUrl(attributes.url).then((loadedByline) => {
            if (!byline) {
              setByline(loadedByline);
            }
          });
  
          return <Fragment>"loading..."</Fragment>;
        }
        */
        return (React.createElement(element_1.Fragment, null,
            React.createElement(BlockEdit, __assign({}, props)),
            React.createElement(block_editor_1.InspectorControls, null,
                React.createElement(components_1.PanelBody, { title: "Attribution" },
                    React.createElement(components_1.SelectControl, { label: "Byline User", value: byline ? byline.author_id : "", options: __spreadArray([{ label: "", value: "" }], webpress_users.users, true), onChange: function (newBylineId) { return __awaiter(void 0, void 0, void 0, function () {
                            return __generator(this, function (_a) {
                                MediaCreditManager.shared.save(attributes.id, newBylineId, "The Badger Herald", attributes.url);
                                setByline(__assign(__assign({}, byline), { author_id: newBylineId, author: "The Badger Herald" }));
                                setUserLocked(true);
                                return [2 /*return*/];
                            });
                        }); } }),
                    React.createElement("a", { style: {
                            color: "red",
                            fontSize: "0.8em",
                            position: "relative",
                            top: "-20px",
                            cursor: "pointer",
                        }, onClick: function (_) { return __awaiter(void 0, void 0, void 0, function () {
                            return __generator(this, function (_a) {
                                setByline(undefined);
                                setUserLocked(false);
                                MediaCreditManager.shared.save(attributes.id, "", "", attributes.url);
                                return [2 /*return*/];
                            });
                        }); } }, "Remove byline"),
                    React.createElement(components_1.TextControl, { label: "Credit", className: "exa-user-select", onChange: function (newCreditLine) {
                            setByline(__assign(__assign({}, byline), { creditLine: newCreditLine }));
                            MediaCreditManager.shared.save(attributes.id, "", newCreditLine, attributes.url);
                        }, type: "text", value: byline ? byline.creditLine : "", disabled: userLocked })))));
    };
}, "withInspectorControl"));


/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ (function(module) {

module.exports = window["React"];

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ (function(module) {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ (function(module) {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/compose":
/*!*********************************!*\
  !*** external ["wp","compose"] ***!
  \*********************************/
/***/ (function(module) {

module.exports = window["wp"]["compose"];

/***/ }),

/***/ "@wordpress/core-data":
/*!**********************************!*\
  !*** external ["wp","coreData"] ***!
  \**********************************/
/***/ (function(module) {

module.exports = window["wp"]["coreData"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ (function(module) {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/hooks":
/*!*******************************!*\
  !*** external ["wp","hooks"] ***!
  \*******************************/
/***/ (function(module) {

module.exports = window["wp"]["hooks"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module is referenced by other modules so it can't be inlined
/******/ 	var __webpack_exports__ = __webpack_require__("./src/wordpress-script/index.tsx");
/******/ 	
/******/ })()
;
//# sourceMappingURL=index.js.map