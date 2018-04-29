/*! Built with http://stenciljs.com */
const { h } = window.exa;

import { ExaMenuDirection, ExaMenuLinkColor, ExaMenuFontSize } from './chunk1.js';

class ExaMenu {
    constructor() {
        this.imgLoaded = false;
    }
    componentDidLoad() {
        if (this.menu != null) {
            return;
        }
        var wp = new WPAPI({ endpoint: exa.api_url });
        wp.menus = wp.registerRoute('wp-api-menus/v2', '/menus/(?P<id>)');
        wp.menus().id(this.menuId).then(this.loadDidFinish.bind(this)).catch(this.loadDidFail.bind(this));
    }
    loadDidFinish(data) {
        this.menu = data;
    }
    loadDidFail(err) {
        console.log(err);
    }
    menuStyleClass() {
        switch (this.menuDirection) {
            case ExaMenuDirection.Vertical:
                return "vertical";
            case ExaMenuDirection.Horizontal:
                return "horizontal";
        }
    }
    menuFontClass() {
        switch (this.menuFontSize) {
            case ExaMenuFontSize.Big:
                return "big";
            case ExaMenuFontSize.Normal:
                return "normal";
        }
    }
    menuColorClass() {
        switch (this.menuLinkColor) {
            case ExaMenuLinkColor.Black:
                return "black";
            case ExaMenuLinkColor.White:
                return "white";
            case ExaMenuLinkColor.Blue:
                return "blue";
        }
    }
    menuClasses() {
        return this.menuStyleClass() + " " + this.menuColorClass() + " " + this.menuFontClass();
    }
    render() {
        if (this.menu == null) {
            return;
        }
        return (h("menu", { class: this.menuClasses() }, this.menu.items.map((menuItem, i) => h("exa-menu-item", { childmenuitems: menuItem.children, debug: this.debug && i == 0, url: menuItem.url, title: menuItem.title, dropdownStyle: this.menuDropdown, category: menuItem.object_id, iconClass: menuItem.classes }))));
    }
    static get is() { return "exa-menu"; }
    static get properties() { return { "debug": { "type": Boolean, "attr": "debug" }, "imgLoaded": { "state": true }, "menu": { "state": true }, "menuDirection": { "type": "Any", "attr": "menu-direction" }, "menuDropdown": { "type": "Any", "attr": "menu-dropdown" }, "menuFontSize": { "type": "Any", "attr": "menu-font-size" }, "menuId": { "type": String, "attr": "menu-id" }, "menuLinkColor": { "type": "Any", "attr": "menu-link-color" }, "tag_id": { "type": String, "attr": "tag_id" }, "title": { "type": String, "attr": "title" } }; }
    static get style() { return "\@charset \"UTF-8\";\n*, *:before, *:after {\n  box-sizing: inherit; }\n\n/*  Fonts */\n/** v0.3.5 colors — preferred use. \n * (modifier)colorObjectOnBackgroundcolorAction \n * lightblueLinkOnBrownHover \n */\n/**\n * //todo: colors other than blue\n * Mixin for link hover states\n */\n/**\n * Definitions for vertical grid system, as applicable on different displays.\n *\n * Columns are 60 each with 20px gutters. Depending on screen size, a different number\n * of columns are available.\n *\n * Note: mobile and tablet should always be in flex() pixels. \n *\n *  - mobile: 4 Columns\n *  - tablet: 9 Columns\n *  - desktop: 13 Columns\n *  - xl: 15 Columns.\n *\n */\n/**\n * Mixin for breakpoints.\n */\nmenu {\n  width: 100%;\n  list-style-type: none;\n  font-family: \"PT Sans Narrow\", Helvetica, Arial, Sans-Serif;\n  line-height: 1.4em;\n  padding: 0;\n  margin: 0; }\n  menu.horizontal exa-menu-item > li {\n    display: inline; }\n  menu exa-menu-item > li a {\n    text-decoration: none; }\n  menu.horizontal exa-menu-item > li a {\n    display: inline-block;\n    padding-top: 6px;\n    padding-bottom: 6px; }\n  menu.vertical exa-menu-item > li a {\n    border-bottom: 1px solid #eff4f6;\n    display: block;\n    padding: 12px 0px; }\n  menu.vertical exa-menu-item:first-child > li a {\n    border-top: 1px solid #eff4f6; }\n  menu exa-menu-item > li a {\n    font-size: 15px; }\n  menu.big exa-menu-item > li a {\n    font-size: 19px; }\n  menu.blue exa-menu-item > li a {\n    color: #3c74b9; }\n    menu.blue exa-menu-item > li a:hover {\n      color: #3a97f7; }\n  menu.black exa-menu-item > li a {\n    color: #191919; }\n    menu.black exa-menu-item > li a:hover {\n      color: #3c74b9; }\n  menu li.social {\n    min-height: 54px;\n    margin-right: 10px;\n    display: block; }\n    menu li.social a {\n      margin-bottom: 12px;\n      width: 34px;\n      height: 34px;\n      display: inline;\n      position: relative; }\n      menu li.social a:before {\n        font-family: exa;\n        font-size: 24px;\n        line-height: 35px;\n        color: #ffffff;\n        text-align: center;\n        width: 100%;\n        display: block;\n        width: 34px;\n        height: 34px;\n        border-radius: 2px; }\n    menu li.social.twitter a:before {\n      content: \"t\";\n      background: #0892E3; }\n    menu li.social.facebook a:before {\n      content: \"f\";\n      background: #425F9E; }\n    menu li.social.linkedin a:before {\n      content: \"l\";\n      background: #0078b6; }\n    menu li.social.instagram a:before {\n      content: \"i\";\n      background: #cd486b; }\n\n\@media (min-width: 760px) {\n  menu li.social {\n    margin-right: 0;\n    margin-left: 10px;\n    position: relative;\n    top: -3px; }\n    menu li.social a {\n      width: 24px;\n      height: 24px; }\n    menu li.social a:before {\n      font-size: 16px;\n      line-height: 26px;\n      width: 24px;\n      height: 24px; } }\n\n\@media (min-width: 1060px) {\n  menu.big exa-menu-item > li a {\n    font-size: 24px; }\n  menu exa-menu-item > li a {\n    font-size: 18px; } }"; }
}

class ExaMenuButton {
    constructor() {
        this.active = false;
    }
    render() {
        return (h("a", { class: this.active ? "active" : "" }, this.active ? "Close" : "Menu"));
    }
    static get is() { return "exa-menu-button"; }
    static get properties() { return { "active": { "type": Boolean, "attr": "active" } }; }
    static get style() { return "\@charset \"UTF-8\";\n*, *:before, *:after {\n  box-sizing: inherit; }\n\n/*  Fonts */\n/** v0.3.5 colors — preferred use. \n * (modifier)colorObjectOnBackgroundcolorAction \n * lightblueLinkOnBrownHover \n */\n/**\n * //todo: colors other than blue\n * Mixin for link hover states\n */\n/**\n * Definitions for vertical grid system, as applicable on different displays.\n *\n * Columns are 60 each with 20px gutters. Depending on screen size, a different number\n * of columns are available.\n *\n * Note: mobile and tablet should always be in flex() pixels. \n *\n *  - mobile: 4 Columns\n *  - tablet: 9 Columns\n *  - desktop: 13 Columns\n *  - xl: 15 Columns.\n *\n */\n/**\n * Mixin for breakpoints.\n */\nexa-menu-button a {\n  /* the menu icon */\n  color: #3c74b9;\n  padding: 12px 10% 18px 6.66667%;\n  font-size: 24px;\n  display: block;\n  line-height: 24px;\n  font-family: \"PT Sans Narrow\", Helvetica, Arial, Sans-Serif;\n  position: absolute;\n  right: 0;\n  bottom: 0;\n  transition: bottom .2s;\n  cursor: pointer;\n  margin-right: -1.66667%; }\n  exa-menu-button a:hover {\n    color: #3a97f7; }\n  exa-menu-button a:after {\n    content: \"d\";\n    font-size: 12px;\n    margin-left: 5px;\n    transition: transform .1s;\n    font-family: exa;\n    position: absolute; }\n  exa-menu-button a.active:after {\n    margin-top: 3px;\n    transform: rotate(180deg); }\n  exa-menu-button a.active {\n    background: #ffffff;\n    bottom: -6px; }"; }
}

class ExaSearchForm {
    render() {
        return (h("form", { class: "search", action: "/", method: "get" },
            h("input", { type: "text", name: "s", placeholder: "Search..." }),
            h("input", { type: "submit", value: "Submit" })));
    }
    static get is() { return "exa-search-form"; }
    static get style() { return "\@charset \"UTF-8\";\n*, *:before, *:after {\n  box-sizing: inherit; }\n\n/*  Fonts */\n/** v0.3.5 colors — preferred use. \n * (modifier)colorObjectOnBackgroundcolorAction \n * lightblueLinkOnBrownHover \n */\n/**\n * //todo: colors other than blue\n * Mixin for link hover states\n */\n/**\n * Definitions for vertical grid system, as applicable on different displays.\n *\n * Columns are 60 each with 20px gutters. Depending on screen size, a different number\n * of columns are available.\n *\n * Note: mobile and tablet should always be in flex() pixels. \n *\n *  - mobile: 4 Columns\n *  - tablet: 9 Columns\n *  - desktop: 13 Columns\n *  - xl: 15 Columns.\n *\n */\n/**\n * Mixin for breakpoints.\n */\nexa-search-form form.search {\n  width: 100%;\n  position: relative;\n  background: #eff4f6;\n  padding: 20px 5%;\n  margin-top: 30px; }\n  exa-search-form form.search input[type=text] {\n    width: 100%;\n    padding: 12px 3.33333%;\n    padding-right: 40px;\n    font-family: \"PT Sans Narrow\", Helvetica, Arial, Sans-Serif;\n    font-size: 24px;\n    outline: none;\n    border: 3px solid #eff4f6;\n    transition: all .3s;\n    font-size: 20px; }\n    exa-search-form form.search input[type=text]::placeholder {\n      color: #93a2aa; }\n    exa-search-form form.search input[type=text]:focus {\n      color: #191919;\n      border: 3px solid #3c74b9; }\n  exa-search-form form.search:after {\n    pointer-events: none;\n    content: \"s\";\n    font-family: exa;\n    padding: 4px 8px;\n    position: absolute;\n    top: 32px;\n    right: 8.33333%;\n    width: 30px;\n    height: 30px;\n    color: #3c74b9; }\n  exa-search-form form.search input[type=submit] {\n    display: none; }\n\n\@media (min-width: 760px) {\n  exa-search-form form.search {\n    background: transparent;\n    padding: 0;\n    right: 0;\n    margin-top: 0px; }\n    exa-search-form form.search input[type=text] {\n      bottom: -3px;\n      top: inherit;\n      position: absolute;\n      right: 0;\n      width: 36px;\n      padding: 6px 20px 6px 20px;\n      border-radius: 2px;\n      margin-right: 0px;\n      border: none; }\n      exa-search-form form.search input[type=text]::placeholder {\n        color: transparent; }\n      exa-search-form form.search input[type=text]:focus {\n        width: 100%;\n        border: none; }\n        exa-search-form form.search input[type=text]:focus::placeholder {\n          color: #93a2aa; }\n    exa-search-form form.search:after {\n      bottom: 1px;\n      right: 7px;\n      top: inherit;\n      font-size: 18px; } }"; }
}

export { ExaMenu, ExaMenuButton, ExaSearchForm };
