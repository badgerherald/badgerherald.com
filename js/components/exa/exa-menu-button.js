/*! Built with http://stenciljs.com */
const { h } = window.exa;

import { ExaMenuFontSize, ExaMenuLinkColor, ExaMenuDirection, ExaMenuDropdownStyle } from './chunk1.js';

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

class ExaNameplate {
    constructor() {
        this.menuOpen = false;
    }
    handleScroll() {
        const screenWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        if (screenWidth < 760) {
            this.isMobile = true;
        }
        else {
            this.isMobile = false;
        }
    }
    componentDidLoad() {
        this.handleScroll();
    }
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
        return (h("exa-search-form", null));
    }
    toggleMenu() {
        this.menuOpen = !this.menuOpen;
    }
    renderMobileMenuButton() {
        if (this.isMobile) {
            return (h("exa-menu-button", { active: this.menuOpen, onClick: () => this.toggleMenu() }));
        }
    }
    render() {
        console.log(this.isMobile);
        return (h("div", { class: this.isMobile ? "nameplate" : "nameplate desktop" },
            h("a", { class: "logo", href: "<?php bloginfo('url'); ?>" },
                h("img", { src: exa.themedir + "/js/components/svg/vertical-herald-logo.png" })),
            this.renderMobileMenuButton(),
            h("div", { class: this.menuOpen ? "menus active" : "menus" },
                this.renderPrimaryMenu(),
                this.renderSearchForm(),
                this.renderSocialMenu(),
                this.renderSecondaryMenu()),
            h("div", { class: "clearfix" })));
    }
    static get is() { return "exa-nameplate"; }
    static get properties() { return { "isMobile": { "state": true }, "menuOpen": { "state": true }, "primaryMenu": { "type": Number, "attr": "primary-menu" }, "searchQuery": { "type": String, "attr": "search-query" }, "secondaryMenu": { "type": Number, "attr": "secondary-menu" }, "socialMenu": { "type": Number, "attr": "social-menu" } }; }
    static get style() { return "\@charset \"UTF-8\";\n*, *:before, *:after {\n  box-sizing: inherit; }\n\n/*  Fonts */\n/** v0.3.5 colors — preferred use. \n * (modifier)colorObjectOnBackgroundcolorAction \n * lightblueLinkOnBrownHover \n */\n/**\n * //todo: colors other than blue\n * Mixin for link hover states\n */\n/**\n * Definitions for vertical grid system, as applicable on different displays.\n *\n * Columns are 60 each with 20px gutters. Depending on screen size, a different number\n * of columns are available.\n *\n * Note: mobile and tablet should always be in flex() pixels. \n *\n *  - mobile: 4 Columns\n *  - tablet: 9 Columns\n *  - desktop: 13 Columns\n *  - xl: 15 Columns.\n *\n */\n/**\n * Mixin for breakpoints.\n */\ndiv.nameplate {\n  border-bottom: 5px solid #3c74b9;\n  padding-bottom: 12px; }\n  div.nameplate a.logo {\n    width: 53.33333%;\n    height: auto;\n    display: block;\n    padding-right: 6.66667%; }\n    div.nameplate a.logo img {\n      height: 100%;\n      width: 100%; }\n  div.nameplate div.menus {\n    display: none;\n    position: absolute;\n    background: white;\n    width: 103.33333%;\n    margin-left: -1.66667%;\n    margin-top: 6px;\n    z-index: 9999; }\n    div.nameplate div.menus.active {\n      display: block; }\n    div.nameplate div.menus exa-menu {\n      display: block;\n      padding: 8.33333% 8.33333% 0 8.33333%; }\n    div.nameplate div.menus exa-search-form {\n      padding-top: 8.33333%; }\n    div.nameplate div.menus exa-menu:last-child {\n      padding-bottom: 20%; }\n    div.nameplate div.menus exa-menu.social {\n      clear: right; }\n\n\@media (min-width: 760px) {\n  div.nameplate.desktop {\n    position: relative; }\n    div.nameplate.desktop a.logo {\n      width: 29.72973%;\n      padding-right: 2.7027%; }\n    div.nameplate.desktop div.menus {\n      background: transparent;\n      display: block;\n      top: 0px;\n      height: 100%;\n      margin-left: 29.72973%;\n      margin-top: 0px;\n      bottom: 20px;\n      padding: 0;\n      margin-top: -12px;\n      width: 70.27027%; }\n      div.nameplate.desktop div.menus exa-menu {\n        display: inline;\n        padding: 0; }\n      div.nameplate.desktop div.menus exa-menu.primary {\n        position: absolute;\n        bottom: 0;\n        width: 100%; }\n      div.nameplate.desktop div.menus exa-menu.secondary {\n        float: right; }\n      div.nameplate.desktop div.menus exa-menu.social {\n        float: right;\n        height: 20px; }\n      div.nameplate.desktop div.menus exa-search-form {\n        position: absolute;\n        width: 100%;\n        padding: 0;\n        right: 0;\n        bottom: 0; } }\n\n\@media (min-width: 880px) {\n  div.nameplate.desktop a.logo {\n    max-width: 240px;\n    padding-right: 2.27273%; }\n  div.nameplate.desktop div.menus {\n    display: block;\n    margin-left: 27.27273%;\n    width: 72.72727%; } }\n\n\@media (min-width: 1060px) {\n  div.nameplate.desktop a.logo {\n    max-width: 240px;\n    padding-right: 1.88679%; }\n  div.nameplate.desktop div.menus {\n    margin-left: 22.64151%;\n    width: 77.35849%; } }\n\n\@media (min-width: 1220px) {\n  div.nameplate.desktop a.logo {\n    max-width: 240px;\n    padding-right: 1.63934%; }\n  div.nameplate.desktop div.menus {\n    margin-left: 19.67213%;\n    width: 80.32787%; } }"; }
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

export { ExaMenuButton, ExaNameplate, ExaSearchForm };
