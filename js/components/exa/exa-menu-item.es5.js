/*! Built with http://stenciljs.com */
exa.loadBundle('exa-menu-item', ['exports', './chunk1.js'], function (exports, __chunk1_js) {
    var h = window.exa.h;
    var ExaMenuItem = /** @class */ (function () {
        function ExaMenuItem() {
        }
        ExaMenuItem.prototype.loadTeasers = function () {
            if (this.posts) {
                return;
            }
            if (!this.category) {
                return;
            }
            if (this.dropdownStyle != __chunk1_js.ExaMenuDropdownStyle.Teasers) {
                return;
            }
            console.log("hi");
            var wp = new WPAPI({ endpoint: exa.api_url });
            wp.posts().param('per_page', '3').categories(this.category).then(this.teaserLoadDidFinish.bind(this)).catch(this.teaserLoadDidFail.bind(this));
        };
        ExaMenuItem.prototype.teaserLoadDidFinish = function (data) {
            this.posts = data;
        };
        ExaMenuItem.prototype.teaserLoadDidFail = function (err) {
            console.log(err);
        };
        ExaMenuItem.prototype.hasDropdown = function () {
            return this.childmenuitems && this.dropdownStyle != __chunk1_js.ExaMenuDropdownStyle.None;
        };
        ExaMenuItem.prototype.renderDropdown = function () {
            if (!this.hasDropdown()) {
                return;
            }
            this.loadTeasers();
            return (h("exa-menu-dropdown", { posts: this.posts, menuItems: this.childmenuitems, title: this.title }));
        };
        ExaMenuItem.prototype.render = function () {
            var classes = (this.hasDropdown() ? "dropdown" : "") + (this.debug ? " debug" : "") + (this.iconClass ? " " + this.iconClass : "");
            return (h("li", { class: classes }, h("a", { href: this.url }, this.title), this.renderDropdown()));
        };
        Object.defineProperty(ExaMenuItem, "is", {
            get: function () { return "exa-menu-item"; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaMenuItem, "properties", {
            get: function () { return { "category": { "type": Number, "attr": "category" }, "childmenuitems": { "type": "Any", "attr": "childmenuitems" }, "debug": { "type": Boolean, "attr": "debug" }, "dropdownStyle": { "type": "Any", "attr": "dropdown-style" }, "iconClass": { "type": String, "attr": "icon-class" }, "posts": { "state": true }, "title": { "type": String, "attr": "title" }, "url": { "type": String, "attr": "url" } }; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaMenuItem, "style", {
            get: function () { return "\@charset \"UTF-8\";\n*, *:before, *:after {\n  box-sizing: inherit; }\n\n/*  Fonts */\n/** v0.3.5 colors — preferred use. \n * (modifier)colorObjectOnBackgroundcolorAction \n * lightblueLinkOnBrownHover \n */\n/**\n * //todo: colors other than blue\n * Mixin for link hover states\n */\n/**\n * Definitions for vertical grid system, as applicable on different displays.\n *\n * Columns are 60 each with 20px gutters. Depending on screen size, a different number\n * of columns are available.\n *\n * Note: mobile and tablet should always be in flex() pixels. \n *\n *  - mobile: 4 Columns\n *  - tablet: 9 Columns\n *  - desktop: 13 Columns\n *  - xl: 15 Columns.\n *\n */\n/**\n * Mixin for breakpoints.\n */\nexa-menu-item > li:not(.social) > a {\n  padding: 0 6px; }\n\nexa-menu-item > li.dropdown > a {\n  padding-right: 22px; }\n  exa-menu-item > li.dropdown > a:after {\n    content: \"d\";\n    font-size: 12px;\n    padding-left: 2px;\n    transition: margin .1s;\n    font-family: exa;\n    position: absolute; }\n\nexa-menu-item > li exa-menu-dropdown > div {\n  visibility: hidden;\n  transition: all .15s ease-in-out;\n  margin-top: -6px; }\n\nexa-menu-item > li:hover exa-menu-dropdown > div, exa-menu-item > li.debug exa-menu-dropdown > div {\n  visibility: visible;\n  margin-top: 0px;\n  transition: all .2s ease-in-out;\n  transition-delay: .15s; }\n\nexa-menu-item > li:hover.dropdown a, exa-menu-item > li.debug.dropdown a {\n  background: white; }\n  exa-menu-item > li:hover.dropdown a > a:after, exa-menu-item > li.debug.dropdown a > a:after {\n    margin-top: 3px; }\n\nexa-menu-item > li:hover.dropdown a > ul, exa-menu-item > li.debug.dropdown a > ul {\n  display: block;\n  position: absolute;\n  top: 100%;\n  min-width: 200px;\n  background: white;\n  list-style-type: none;\n  padding: 12px;\n  font-size: 18px; }\n  exa-menu-item > li:hover.dropdown a > ul a, exa-menu-item > li.debug.dropdown a > ul a {\n    color: #191919; }\n    exa-menu-item > li:hover.dropdown a > ul a:hover, exa-menu-item > li.debug.dropdown a > ul a:hover {\n      color: #787878; }"; },
            enumerable: true,
            configurable: true
        });
        return ExaMenuItem;
    }());
    exports.ExaMenuItem = ExaMenuItem;
    Object.defineProperty(exports, '__esModule', { value: true });
});
