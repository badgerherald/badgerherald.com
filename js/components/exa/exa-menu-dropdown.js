/*! Built with http://stenciljs.com */
const { h } = window.exa;

import { ExaMenuDropdownStyle } from './chunk1.js';

class ExaMenuDropdown {
    constructor() {
        this.posts = new Array();
        this.imgLoaded = false;
    }
    loadFeaturedMedia() {
        if (this.imgLoaded) {
            return;
        }
        if (!this.posts) {
            return;
        }
        this.posts.map((post) => {
            this.loadFeaturedMediaForPost(post);
        });
    }
    loadFeaturedMediaForPost(post) {
        if (!post.featured_media || post.imgsrc) {
            return;
        }
        this.imgLoaded = true;
        var wp = new WPAPI({ endpoint: exa.api_url, });
        wp.media().id(post.featured_media).then((data) => this.mediaLoadDidFinish(data, post)).catch(this.mediaLoadDidFail.bind(this));
    }
    mediaLoadDidFinish(data, post) {
        post.imgsrc = data.media_details.sizes["post-thumbnail"] ? data.media_details.sizes["post-thumbnail"].source_url : "";
        this.imgsrc = post.imgsrc;
    }
    mediaLoadDidFail(err) {
        console.log(err);
    }
    render() {
        if (!this.imgLoaded) {
            this.loadFeaturedMedia();
        }
        return (h("div", null,
            h("h4", null, this.title),
            h("div", { class: "menu" },
                h("ul", null, this.menuItems.map((menuItem) => h("li", null,
                    h("a", { href: menuItem.url }, menuItem.title))))),
            h("ul", { class: "teasers" }, this.posts.map((post) => h("li", null,
                h("exa-teaser", { imgsrc: post.imgsrc, url: post.link, title: post.title.rendered, subhead: post.subhead ? post.subhead : post.excerpt.rendered })))),
            h("div", { class: "clearfix" })));
    }
    static get is() { return "exa-menu-dropdown"; }
    static get properties() { return { "imgsrc": { "state": true }, "menuItems": { "type": "Any", "attr": "menu-items" }, "posts": { "type": "Any", "attr": "posts" }, "subhead": { "type": String, "attr": "subhead" }, "title": { "type": String, "attr": "title" }, "url": { "type": String, "attr": "url" } }; }
    static get style() { return "\@charset \"UTF-8\";\n*, *:before, *:after {\n  box-sizing: inherit; }\n\n/*  Fonts */\n/** v0.3.5 colors — preferred use. \n * (modifier)colorObjectOnBackgroundcolorAction \n * lightblueLinkOnBrownHover \n */\n/**\n * //todo: colors other than blue\n * Mixin for link hover states\n */\n/**\n * Definitions for vertical grid system, as applicable on different displays.\n *\n * Columns are 60 each with 20px gutters. Depending on screen size, a different number\n * of columns are available.\n *\n * Note: mobile and tablet should always be in flex() pixels. \n *\n *  - mobile: 4 Columns\n *  - tablet: 9 Columns\n *  - desktop: 13 Columns\n *  - xl: 15 Columns.\n *\n */\n/**\n * Mixin for breakpoints.\n */\nexa-menu-dropdown > div {\n  position: absolute;\n  left: 0;\n  background: white;\n  width: 100%;\n  padding-bottom: 30px; }\n  exa-menu-dropdown > div .clearfix {\n    clear: both; }\n  exa-menu-dropdown > div ul {\n    list-style-type: none;\n    margin: 0;\n    padding: 0; }\n  exa-menu-dropdown > div h4 {\n    margin: 10px 0 0;\n    padding: 0px;\n    font-size: 24px;\n    padding: 10px 1.92308% 10px;\n    border-bottom: 1px solid #eff4f6; }\n  exa-menu-dropdown > div .menu {\n    float: left;\n    width: 26.92308%;\n    padding: 10px 0; }\n    exa-menu-dropdown > div .menu ul {\n      font-size: 16px;\n      line-height: 1.8em; }\n      exa-menu-dropdown > div .menu ul li a {\n        display: block;\n        font-size: 16px;\n        padding: 0 7.14286%;\n        margin-right: 7.14286%;\n        border-bottom: 1px solid #eff4f6;\n        color: #191919; }\n        exa-menu-dropdown > div .menu ul li a:hover {\n          color: #3c74b9; }\n  exa-menu-dropdown > div ul.teasers {\n    max-width: 100%;\n    width: 73.07692%;\n    display: block;\n    margin: 0;\n    float: left;\n    font-size: 18px; }\n    exa-menu-dropdown > div ul.teasers li {\n      font-size: 1em;\n      float: right;\n      padding: 12px 3.84615%;\n      border-bottom: 1px solid #eff4f6;\n      font-family: \"PT Sans Narrow\", Helvetica, Arial, Sans-Serif; }\n      exa-menu-dropdown > div ul.teasers li a {\n        color: #191919; }\n        exa-menu-dropdown > div ul.teasers li a:hover {\n          color: #3c74b9; }\n      exa-menu-dropdown > div ul.teasers li img {\n        width: 42.30769%;\n        float: right;\n        padding-left: 10px; }\n\n\@media (min-width: 1060px) {\n  exa-menu-dropdown > div {\n    max-width: 720px; } }"; }
}

class ExaMenuItem {
    loadTeasers() {
        if (this.posts) {
            return;
        }
        if (!this.category) {
            return;
        }
        if (this.dropdownStyle != ExaMenuDropdownStyle.Teasers) {
            return;
        }
        var wp = new WPAPI({ endpoint: exa.api_url });
        wp.posts().param('per_page', '3').categories(this.category).then(this.teaserLoadDidFinish.bind(this)).catch(this.teaserLoadDidFail.bind(this));
    }
    teaserLoadDidFinish(data) {
        this.posts = data;
    }
    teaserLoadDidFail(err) {
        console.log(err);
    }
    hasDropdown() {
        return this.childmenuitems && this.dropdownStyle != ExaMenuDropdownStyle.None;
    }
    renderDropdown() {
        if (!this.hasDropdown()) {
            return;
        }
        this.loadTeasers();
        return (h("exa-menu-dropdown", { posts: this.posts, menuItems: this.childmenuitems, title: this.title }));
    }
    render() {
        const classes = (this.hasDropdown() ? "dropdown" : "") + (this.debug ? " debug" : "") + (this.iconClass ? " " + this.iconClass : "");
        return (h("li", { class: classes },
            h("a", { href: this.url }, this.title),
            this.renderDropdown()));
    }
    static get is() { return "exa-menu-item"; }
    static get properties() { return { "category": { "type": Number, "attr": "category" }, "childmenuitems": { "type": "Any", "attr": "childmenuitems" }, "debug": { "type": Boolean, "attr": "debug" }, "dropdownStyle": { "type": "Any", "attr": "dropdown-style" }, "iconClass": { "type": String, "attr": "icon-class" }, "posts": { "state": true }, "title": { "type": String, "attr": "title" }, "url": { "type": String, "attr": "url" } }; }
    static get style() { return "\@charset \"UTF-8\";\n*, *:before, *:after {\n  box-sizing: inherit; }\n\n/*  Fonts */\n/** v0.3.5 colors — preferred use. \n * (modifier)colorObjectOnBackgroundcolorAction \n * lightblueLinkOnBrownHover \n */\n/**\n * //todo: colors other than blue\n * Mixin for link hover states\n */\n/**\n * Definitions for vertical grid system, as applicable on different displays.\n *\n * Columns are 60 each with 20px gutters. Depending on screen size, a different number\n * of columns are available.\n *\n * Note: mobile and tablet should always be in flex() pixels. \n *\n *  - mobile: 4 Columns\n *  - tablet: 9 Columns\n *  - desktop: 13 Columns\n *  - xl: 15 Columns.\n *\n */\n/**\n * Mixin for breakpoints.\n */\nexa-menu-item > li:not(.social) > a {\n  padding: 0 6px; }\n\nexa-menu-item > li.dropdown > a {\n  padding-right: 22px; }\n  exa-menu-item > li.dropdown > a:after {\n    content: \"d\";\n    font-size: 12px;\n    padding-left: 2px;\n    transition: margin .1s;\n    font-family: exa;\n    position: absolute; }\n\nexa-menu-item > li exa-menu-dropdown > div {\n  visibility: hidden;\n  transition: all .15s ease-in-out;\n  margin-top: -6px; }\n\nexa-menu-item > li:hover exa-menu-dropdown > div, exa-menu-item > li.debug exa-menu-dropdown > div {\n  visibility: visible;\n  margin-top: 0px;\n  transition: all .2s ease-in-out;\n  transition-delay: .15s; }\n\nexa-menu-item > li:hover.dropdown a, exa-menu-item > li.debug.dropdown a {\n  background: white; }\n  exa-menu-item > li:hover.dropdown a > a:after, exa-menu-item > li.debug.dropdown a > a:after {\n    margin-top: 3px; }\n\nexa-menu-item > li:hover.dropdown a > ul, exa-menu-item > li.debug.dropdown a > ul {\n  display: block;\n  position: absolute;\n  top: 100%;\n  min-width: 200px;\n  background: white;\n  list-style-type: none;\n  padding: 12px;\n  font-size: 18px; }\n  exa-menu-item > li:hover.dropdown a > ul a, exa-menu-item > li.debug.dropdown a > ul a {\n    color: #191919; }\n    exa-menu-item > li:hover.dropdown a > ul a:hover, exa-menu-item > li.debug.dropdown a > ul a:hover {\n      color: #787878; }"; }
}

export { ExaMenuDropdown, ExaMenuItem };
