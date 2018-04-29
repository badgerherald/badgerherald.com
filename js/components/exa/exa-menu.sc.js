/*! Built with http://stenciljs.com */
const { h } = window.exa;

import { ExaMenuDirection, ExaMenuLinkColor, ExaMenuFontSize, ExaMenuDropdownStyle } from './chunk1.js';

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
        return (h("menu", { class: this.menuClasses() }, this.menu.items.map((menuItem, i) => h("exa-menu-item", { debug: this.debug && i == 0, url: menuItem.url, title: menuItem.title, childmenuitems: menuItem.children, dropdownStyle: this.menuDropdown, category: menuItem.object_id }))));
    }
    static get is() { return "exa-menu"; }
    static get encapsulation() { return "shadow"; }
    static get properties() { return { "debug": { "type": Boolean, "attr": "debug" }, "imgLoaded": { "state": true }, "menu": { "state": true }, "menuDirection": { "type": "Any", "attr": "menu-direction" }, "menuDropdown": { "type": "Any", "attr": "menu-dropdown" }, "menuFontSize": { "type": "Any", "attr": "menu-font-size" }, "menuId": { "type": String, "attr": "menu-id" }, "menuLinkColor": { "type": "Any", "attr": "menu-link-color" }, "tag_id": { "type": String, "attr": "tag_id" }, "title": { "type": String, "attr": "title" } }; }
    static get style() { return "\@charset \"UTF-8\";\n*[data-exa-menu], *[data-exa-menu]:before, *[data-exa-menu]:after {\n  box-sizing: inherit; }\n\n\n\n\n\n\nmenu[data-exa-menu] {\n  width: 100%;\n  list-style-type: none;\n  font-family: \"PT Sans Narrow\", Helvetica, Arial, Sans-Serif;\n  line-height: 1.4em;\n  padding: 0;\n  margin: 0; }\n  menu.horizontal[data-exa-menu]   exa-menu-item[data-exa-menu]    > li[data-exa-menu] {\n    float: left; }\n  menu[data-exa-menu]   exa-menu-item[data-exa-menu]    > li[data-exa-menu]   a[data-exa-menu] {\n    text-decoration: none; }\n  menu.horizontal[data-exa-menu]   exa-menu-item[data-exa-menu]    > li[data-exa-menu]   a[data-exa-menu] {\n    display: inline-block;\n    padding: 4px 6px; }\n  menu.vertical[data-exa-menu]   exa-menu-item[data-exa-menu]    > li[data-exa-menu]   a[data-exa-menu] {\n    border-bottom: 1px solid #eff4f6;\n    display: block;\n    padding: 12px 0px; }\n  menu.vertical[data-exa-menu]   exa-menu-item[data-exa-menu]:first-child    > li[data-exa-menu]   a[data-exa-menu] {\n    border-top: 1px solid #eff4f6; }\n  menu.big[data-exa-menu]   exa-menu-item[data-exa-menu]    > li[data-exa-menu]   a[data-exa-menu] {\n    font-size: 24px; }\n  menu.normal[data-exa-menu]   exa-menu-item[data-exa-menu]    > li[data-exa-menu]   a[data-exa-menu] {\n    font-size: 18px; }\n  menu.blue[data-exa-menu]   exa-menu-item[data-exa-menu]    > li[data-exa-menu]   a[data-exa-menu] {\n    color: #3c74b9; }\n  menu.black[data-exa-menu]   exa-menu-item[data-exa-menu]    > li[data-exa-menu]   a[data-exa-menu] {\n    color: #191919; }"; }
}

class ExaNameplate {
    renderPrimaryMenu() {
        if (this.isMobile) {
            return (h("exa-menu", { class: "primary", "menu-id": this.primaryMenu, menuDropdown: ExaMenuDropdownStyle.None, menuDirection: ExaMenuDirection.Vertical, menuLinkColor: ExaMenuLinkColor.Blue, menuFontSize: ExaMenuFontSize.Big }));
        }
        else {
            return (h("exa-menu", { class: "primary", "menu-id": this.primaryMenu, menuDropdown: ExaMenuDropdownStyle.Teasers, menuDirection: ExaMenuDirection.Horizontal, menuLinkColor: ExaMenuLinkColor.Blue, menuFontSize: ExaMenuFontSize.Big }));
        }
    }
    renderSecondaryMenu() {
        if (this.isMobile) {
            return (h("exa-menu", { class: "secondary", "menu-id": this.secondaryMenu, menuDropdown: ExaMenuDropdownStyle.None, menuDirection: ExaMenuDirection.Vertical, menuLinkColor: ExaMenuLinkColor.Black, menuFontSize: ExaMenuFontSize.Normal }));
        }
        else {
            return (h("exa-menu", { class: "secondary", "menu-id": this.secondaryMenu, menuDropdown: ExaMenuDropdownStyle.Simple, menuDirection: ExaMenuDirection.Horizontal, menuLinkColor: ExaMenuLinkColor.Black, menuFontSize: ExaMenuFontSize.Normal }));
        }
    }
    renderSocialMenu() {
        if (this.isMobile) {
            return (h("exa-menu", { class: "social", "menu-id": this.socialMenu, menuDropdown: ExaMenuDropdownStyle.None, menuDirection: ExaMenuDirection.Horizontal, menuLinkColor: ExaMenuLinkColor.Blue, menuFontSize: ExaMenuFontSize.Normal }));
        }
        else {
            return (h("exa-menu", { class: "social", "menu-id": this.socialMenu, menuDropdown: ExaMenuDropdownStyle.None, menuDirection: ExaMenuDirection.Horizontal, menuLinkColor: ExaMenuLinkColor.Blue, menuFontSize: ExaMenuFontSize.Normal }));
        }
    }
    renderSearchForm() {
        return (h("form", { class: "search", action: "/", method: "get" },
            h("input", { type: "text", name: "s", placeholder: "Search...", value: this.searchQuery }),
            h("input", { type: "submit", value: "Submit" })));
    }
    renderMobileMenuButton() {
        if (this.isMobile) {
            return (h("exa-menu-button", null));
        }
    }
    render() {
        return (h("div", { class: this.isMobile ? "nameplate mobile" : "nameplate" },
            h("a", { class: "logo", href: "<?php bloginfo('url'); ?>" }),
            this.renderMobileMenuButton(),
            h("div", { class: "menus" },
                this.renderPrimaryMenu(),
                this.renderSearchForm(),
                this.renderSecondaryMenu(),
                this.renderSocialMenu()),
            h("div", { class: "clearfix" })));
    }
    static get is() { return "exa-nameplate"; }
    static get encapsulation() { return "shadow"; }
    static get properties() { return { "isMobile": { "type": Boolean, "attr": "is-mobile" }, "primaryMenu": { "type": Number, "attr": "primary-menu" }, "searchQuery": { "type": String, "attr": "search-query" }, "secondaryMenu": { "type": Number, "attr": "secondary-menu" }, "socialMenu": { "type": Number, "attr": "social-menu" } }; }
    static get style() { return "\@charset \"UTF-8\";\n*[data-exa-nameplate], *[data-exa-nameplate]:before, *[data-exa-nameplate]:after {\n  box-sizing: inherit; }\n\n\n\n\n\n\ndiv.nameplate[data-exa-nameplate]   a.logo[data-exa-nameplate] {\n  width: 53.33333%;\n  height: 100px;\n  display: block;\n  background: red; }\n\ndiv.nameplate[data-exa-nameplate]   div.menus[data-exa-nameplate] {\n  position: absolute;\n  background: white;\n  width: 103.33333%;\n  margin-left: -1.66667%;\n  padding: 20px 8.33333%; }\n\n\@media (min-width: 760px) {\n  div.nameplate[data-exa-nameplate] {\n    position: relative; }\n    div.nameplate[data-exa-nameplate]   a.logo[data-exa-nameplate] {\n      width: 29.72973%; }\n    div.nameplate[data-exa-nameplate]   div.menus[data-exa-nameplate] {\n      background: transparent;\n      top: 0px;\n      height: 100%;\n      margin-left: 29.72973%;\n      padding: 0;\n      width: 70.27027%; }\n      div.nameplate[data-exa-nameplate]   div.menus[data-exa-nameplate]   exa-menu.primary[data-exa-nameplate] {\n        position: absolute;\n        bottom: 0;\n        background: rgba(0, 0, 0, 0.1); }\n      div.nameplate[data-exa-nameplate]   div.menus[data-exa-nameplate]   exa-menu.secondary[data-exa-nameplate] {\n        float: right; }\n      div.nameplate[data-exa-nameplate]   div.menus[data-exa-nameplate]   exa-menu.social[data-exa-nameplate] {\n        float: right;\n        height: 20px; }\n      div.nameplate[data-exa-nameplate]   div.menus[data-exa-nameplate]   form.search[data-exa-nameplate] {\n        position: absolute;\n        right: 0;\n        bottom: 0; } }"; }
}

export { ExaMenu, ExaNameplate };
