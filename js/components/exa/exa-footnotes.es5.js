var __extends = (this && this.__extends) || (function () {
    var extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
/*! Built with http://stenciljs.com */
exa.loadBundle('exa-footnotes', ['exports', './chunk1.js'], function (exports, __chunk1_js) {
    var h = window.exa.h;
    var ExaFootnotes = /** @class */ (function () {
        function ExaFootnotes() {
        }
        ExaFootnotes.prototype.render = function () {
            var services = ExaSocialServiceFactory.socialServices(this.shareurl, this.shareheadline);
            return (h("div", null, h("exa-publish-time-meta", { published: "March 04, 2018 21:24:00", modified: "March 10, 2018 02:24:00" }), h("ul", null, services.map(function (service) { return h("li", null, h("exa-social-button", { shareurl: service.shareurl, title: service.name, classname: service.classname, description: "" })); }))));
        };
        Object.defineProperty(ExaFootnotes, "is", {
            get: function () { return "exa-footnotes"; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaFootnotes, "encapsulation", {
            get: function () { return "shadow"; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaFootnotes, "properties", {
            get: function () { return { "post": { "state": true }, "postid": { "type": String, "attr": "postid" }, "shareheadline": { "type": String, "attr": "shareheadline" }, "shareurl": { "type": String, "attr": "shareurl" } }; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaFootnotes, "style", {
            get: function () { return "ul {\n  list-style-type: none;\n  padding: 0;\n  margin-bottom: 60px; }\n\nli {\n  margin-right: 10px;\n  display: inline; }\n\nexa-publish-time-meta div {\n  margin-top: 24px; }"; },
            enumerable: true,
            configurable: true
        });
        return ExaFootnotes;
    }());
    var ExaSocialServices;
    (function (ExaSocialServices) {
        ExaSocialServices[ExaSocialServices["Facebook"] = 0] = "Facebook";
        ExaSocialServices[ExaSocialServices["Twitter"] = 1] = "Twitter";
    })(ExaSocialServices || (ExaSocialServices = {}));
    var ExaSocialService = /** @class */ (function () {
        function ExaSocialService(articleUrl, shareheadline) {
            this.articleUrl = articleUrl;
            this.shareheadline = shareheadline;
        }
        Object.defineProperty(ExaSocialService, "is", {
            get: function () { return "exa-footnotes"; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaSocialService, "encapsulation", {
            get: function () { return "shadow"; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaSocialService, "properties", {
            get: function () { return { "post": { "state": true }, "postid": { "type": String, "attr": "postid" }, "shareheadline": { "type": String, "attr": "shareheadline" }, "shareurl": { "type": String, "attr": "shareurl" } }; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaSocialService, "style", {
            get: function () { return "/**style-placeholder:exa-footnotes:**/"; },
            enumerable: true,
            configurable: true
        });
        return ExaSocialService;
    }());
    var ExaSocialFacebook = /** @class */ (function (_super) {
        __extends(ExaSocialFacebook, _super);
        function ExaSocialFacebook(articleUrl, shareheadline) {
            var _this = _super.call(this, articleUrl, shareheadline) || this;
            _this.name = "Share";
            _this.classname = "facebook";
            _this.shareurl = "http://facebook.com/";
            _this.fbShareUrl = "https://www.facebook.com/sharer/sharer.php";
            _this.shareurl = _this.fbShareUrl +
                "?u=" +
                _this.articleUrl;
            return _this;
        }
        Object.defineProperty(ExaSocialFacebook, "is", {
            get: function () { return "exa-footnotes"; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaSocialFacebook, "encapsulation", {
            get: function () { return "shadow"; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaSocialFacebook, "properties", {
            get: function () { return { "post": { "state": true }, "postid": { "type": String, "attr": "postid" }, "shareheadline": { "type": String, "attr": "shareheadline" }, "shareurl": { "type": String, "attr": "shareurl" } }; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaSocialFacebook, "style", {
            get: function () { return "/**style-placeholder:exa-footnotes:**/"; },
            enumerable: true,
            configurable: true
        });
        return ExaSocialFacebook;
    }(ExaSocialService));
    var ExaSocialTwitter = /** @class */ (function (_super) {
        __extends(ExaSocialTwitter, _super);
        function ExaSocialTwitter(articleUrl, shareheadline) {
            var _this = _super.call(this, articleUrl, shareheadline) || this;
            _this.name = "Tweet";
            _this.classname = "twitter";
            _this.shareurl = "http://twitter.com/";
            _this.webIntentUrl = "https://twitter.com/intent/tweet";
            _this.shareurl = _this.webIntentUrl +
                "?text=" +
                _this.shareheadline +
                "&url=" +
                _this.articleUrl;
            return _this;
        }
        Object.defineProperty(ExaSocialTwitter, "is", {
            get: function () { return "exa-footnotes"; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaSocialTwitter, "encapsulation", {
            get: function () { return "shadow"; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaSocialTwitter, "properties", {
            get: function () { return { "post": { "state": true }, "postid": { "type": String, "attr": "postid" }, "shareheadline": { "type": String, "attr": "shareheadline" }, "shareurl": { "type": String, "attr": "shareurl" } }; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaSocialTwitter, "style", {
            get: function () { return "/**style-placeholder:exa-footnotes:**/"; },
            enumerable: true,
            configurable: true
        });
        return ExaSocialTwitter;
    }(ExaSocialService));
    var ExaSocialServiceFactory = /** @class */ (function () {
        function ExaSocialServiceFactory() {
        }
        ExaSocialServiceFactory.socialServices = function (articleUrl, shareheadline) {
            var twitter = ExaSocialServiceFactory.socialService(ExaSocialServices.Twitter, articleUrl, shareheadline);
            var fb = ExaSocialServiceFactory.socialService(ExaSocialServices.Facebook, articleUrl, shareheadline);
            return [fb, twitter];
        };
        ExaSocialServiceFactory.socialService = function (service, articleUrl, shareheadline) {
            switch (service) {
                case ExaSocialServices.Facebook:
                    return new ExaSocialFacebook(articleUrl, shareheadline);
                case ExaSocialServices.Twitter:
                    return new ExaSocialTwitter(articleUrl, shareheadline);
            }
        };
        Object.defineProperty(ExaSocialServiceFactory, "is", {
            get: function () { return "exa-footnotes"; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaSocialServiceFactory, "encapsulation", {
            get: function () { return "shadow"; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaSocialServiceFactory, "properties", {
            get: function () { return { "post": { "state": true }, "postid": { "type": String, "attr": "postid" }, "shareheadline": { "type": String, "attr": "shareheadline" }, "shareurl": { "type": String, "attr": "shareurl" } }; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaSocialServiceFactory, "style", {
            get: function () { return "/**style-placeholder:exa-footnotes:**/"; },
            enumerable: true,
            configurable: true
        });
        return ExaSocialServiceFactory;
    }());
    var ExaNameplate = /** @class */ (function () {
        function ExaNameplate() {
            this.menuOpen = false;
        }
        ExaNameplate.prototype.handleScroll = function () {
            var screenWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;
            if (screenWidth < 760) {
                this.isMobile = true;
            }
            else {
                this.isMobile = false;
            }
        };
        ExaNameplate.prototype.componentDidLoad = function () {
            this.handleScroll();
        };
        ExaNameplate.prototype.renderPrimaryMenu = function () {
            if (this.isMobile) {
                return (h("exa-menu", { class: "primary", "menu-id": this.primaryMenu, menuDropdown: __chunk1_js.ExaMenuDropdownStyle.None, menuDirection: __chunk1_js.ExaMenuDirection.Vertical, menuLinkColor: __chunk1_js.ExaMenuLinkColor.Blue, menuFontSize: __chunk1_js.ExaMenuFontSize.Big }));
            }
            else {
                return (h("exa-menu", { class: "primary", "menu-id": this.primaryMenu, menuDropdown: __chunk1_js.ExaMenuDropdownStyle.Teasers, menuDirection: __chunk1_js.ExaMenuDirection.Horizontal, menuLinkColor: __chunk1_js.ExaMenuLinkColor.Blue, menuFontSize: __chunk1_js.ExaMenuFontSize.Big }));
            }
        };
        ExaNameplate.prototype.renderSecondaryMenu = function () {
            if (this.isMobile) {
                return (h("exa-menu", { class: "secondary", "menu-id": this.secondaryMenu, menuDropdown: __chunk1_js.ExaMenuDropdownStyle.None, menuDirection: __chunk1_js.ExaMenuDirection.Vertical, menuLinkColor: __chunk1_js.ExaMenuLinkColor.Black, menuFontSize: __chunk1_js.ExaMenuFontSize.Normal }));
            }
            else {
                return (h("exa-menu", { class: "secondary", "menu-id": this.secondaryMenu, menuDropdown: __chunk1_js.ExaMenuDropdownStyle.Simple, menuDirection: __chunk1_js.ExaMenuDirection.Horizontal, menuLinkColor: __chunk1_js.ExaMenuLinkColor.Black, menuFontSize: __chunk1_js.ExaMenuFontSize.Normal }));
            }
        };
        ExaNameplate.prototype.renderSocialMenu = function () {
            if (this.isMobile) {
                return (h("exa-menu", { class: "social", "menu-id": this.socialMenu, menuDropdown: __chunk1_js.ExaMenuDropdownStyle.None, menuDirection: __chunk1_js.ExaMenuDirection.Horizontal, menuLinkColor: __chunk1_js.ExaMenuLinkColor.Blue, menuFontSize: __chunk1_js.ExaMenuFontSize.Normal }));
            }
            else {
                return (h("exa-menu", { class: "social", "menu-id": this.socialMenu, menuDropdown: __chunk1_js.ExaMenuDropdownStyle.None, menuDirection: __chunk1_js.ExaMenuDirection.Horizontal, menuLinkColor: __chunk1_js.ExaMenuLinkColor.Blue, menuFontSize: __chunk1_js.ExaMenuFontSize.Normal }));
            }
        };
        ExaNameplate.prototype.renderSearchForm = function () {
            return (h("exa-search-form", null));
        };
        ExaNameplate.prototype.toggleMenu = function () {
            this.menuOpen = !this.menuOpen;
        };
        ExaNameplate.prototype.renderMobileMenuButton = function () {
            var _this = this;
            if (this.isMobile) {
                return (h("exa-menu-button", { active: this.menuOpen, onClick: function () { return _this.toggleMenu(); } }));
            }
        };
        ExaNameplate.prototype.render = function () {
            return (h("div", { class: this.isMobile ? "nameplate" : "nameplate desktop" }, h("a", { class: "logo", href: "https://badgerherald.com/" }, h("img", { src: exa.themedir + "/js/components/svg/vertical-herald-logo.png" })), this.renderMobileMenuButton(), h("div", { class: this.menuOpen ? "menus active" : "menus" }, this.renderPrimaryMenu(), this.renderSearchForm(), this.renderSocialMenu(), this.renderSecondaryMenu()), h("div", { class: "clearfix" })));
        };
        Object.defineProperty(ExaNameplate, "is", {
            get: function () { return "exa-nameplate"; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaNameplate, "encapsulation", {
            get: function () { return "shadow"; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaNameplate, "properties", {
            get: function () { return { "isMobile": { "state": true }, "menuOpen": { "state": true }, "primaryMenu": { "type": Number, "attr": "primary-menu" }, "searchQuery": { "type": String, "attr": "search-query" }, "secondaryMenu": { "type": Number, "attr": "secondary-menu" }, "socialMenu": { "type": Number, "attr": "social-menu" } }; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaNameplate, "style", {
            get: function () { return "\@charset \"UTF-8\";\n*, *:before, *:after {\n  box-sizing: inherit; }\n\n/*  Fonts */\n/** v0.3.5 colors — preferred use. \n * (modifier)colorObjectOnBackgroundcolorAction \n * lightblueLinkOnBrownHover \n */\n/**\n * //todo: colors other than blue\n * Mixin for link hover states\n */\n/**\n * Definitions for vertical grid system, as applicable on different displays.\n *\n * Columns are 60 each with 20px gutters. Depending on screen size, a different number\n * of columns are available.\n *\n * Note: mobile and tablet should always be in flex() pixels. \n *\n *  - mobile: 4 Columns\n *  - tablet: 9 Columns\n *  - desktop: 13 Columns\n *  - xl: 15 Columns.\n *\n */\n/**\n * Mixin for breakpoints.\n */\ndiv.nameplate {\n  border-bottom: 5px solid #3c74b9;\n  padding-bottom: 12px; }\n  div.nameplate a.logo {\n    width: 53.33333%;\n    height: auto;\n    display: block;\n    padding-right: 6.66667%; }\n    div.nameplate a.logo img {\n      height: 100%;\n      width: 100%; }\n  div.nameplate div.menus {\n    display: none;\n    position: absolute;\n    background: white;\n    width: 103.33333%;\n    margin-left: -1.66667%;\n    margin-top: 6px;\n    z-index: 9999; }\n    div.nameplate div.menus.active {\n      display: block; }\n    div.nameplate div.menus exa-menu {\n      display: block;\n      padding: 8.33333% 8.33333% 0 8.33333%; }\n    div.nameplate div.menus exa-search-form {\n      padding-top: 8.33333%; }\n    div.nameplate div.menus exa-menu:last-child {\n      padding-bottom: 20%; }\n    div.nameplate div.menus exa-menu.social {\n      clear: right; }\n\n\@media (min-width: 760px) {\n  div.nameplate.desktop {\n    position: relative; }\n    div.nameplate.desktop a.logo {\n      width: 29.72973%;\n      padding-right: 2.7027%; }\n    div.nameplate.desktop div.menus {\n      background: transparent;\n      display: block;\n      top: 0px;\n      height: 100%;\n      margin-left: 29.72973%;\n      margin-top: 0px;\n      bottom: 20px;\n      padding: 0;\n      margin-top: -12px;\n      width: 70.27027%; }\n      div.nameplate.desktop div.menus exa-menu {\n        display: inline;\n        padding: 0; }\n      div.nameplate.desktop div.menus exa-menu.primary {\n        position: absolute;\n        bottom: 0;\n        width: 100%; }\n      div.nameplate.desktop div.menus exa-menu.secondary {\n        float: right; }\n      div.nameplate.desktop div.menus exa-menu.social {\n        float: right;\n        height: 20px; }\n      div.nameplate.desktop div.menus exa-search-form {\n        position: absolute;\n        width: 100%;\n        padding: 0;\n        right: 0;\n        bottom: 0; } }\n\n\@media (min-width: 880px) {\n  div.nameplate.desktop a.logo {\n    max-width: 240px;\n    padding-right: 2.27273%; }\n  div.nameplate.desktop div.menus {\n    display: block;\n    margin-left: 27.27273%;\n    width: 72.72727%; } }\n\n\@media (min-width: 1060px) {\n  div.nameplate.desktop a.logo {\n    max-width: 240px;\n    padding-right: 1.88679%; }\n  div.nameplate.desktop div.menus {\n    margin-left: 22.64151%;\n    width: 77.35849%; } }\n\n\@media (min-width: 1220px) {\n  div.nameplate.desktop a.logo {\n    max-width: 240px;\n    padding-right: 1.63934%; }\n  div.nameplate.desktop div.menus {\n    margin-left: 19.67213%;\n    width: 80.32787%; } }"; },
            enumerable: true,
            configurable: true
        });
        return ExaNameplate;
    }());
    exports.ExaFootnotes = ExaFootnotes;
    exports.ExaNameplate = ExaNameplate;
    Object.defineProperty(exports, '__esModule', { value: true });
});
