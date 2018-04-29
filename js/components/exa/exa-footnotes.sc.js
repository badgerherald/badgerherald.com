/*! Built with http://stenciljs.com */
const { h } = window.exa;

import { ExaMenuFontSize, ExaMenuLinkColor, ExaMenuDirection, ExaMenuDropdownStyle } from './chunk1.js';

class ExaFootnotes {
    render() {
        const services = ExaSocialServiceFactory.socialServices(this.shareurl, this.shareheadline);
        return (h("div", null,
            h("exa-publish-time-meta", { published: "March 04, 2018 21:24:00", modified: "March 10, 2018 02:24:00" }),
            h("ul", null, services.map((service) => h("li", null,
                h("exa-social-button", { shareurl: service.shareurl, title: service.name, classname: service.classname, description: "" }))))));
    }
    static get is() { return "exa-footnotes"; }
    static get encapsulation() { return "shadow"; }
    static get properties() { return { "post": { "state": true }, "postid": { "type": String, "attr": "postid" }, "shareheadline": { "type": String, "attr": "shareheadline" }, "shareurl": { "type": String, "attr": "shareurl" } }; }
    static get style() { return "ul[data-exa-footnotes] {\n  list-style-type: none;\n  padding: 0;\n  margin-bottom: 60px; }\n\nli[data-exa-footnotes] {\n  margin-right: 10px;\n  display: inline; }\n\nexa-publish-time-meta[data-exa-footnotes]   div[data-exa-footnotes] {\n  margin-top: 24px; }"; }
}
var ExaSocialServices;
(function (ExaSocialServices) {
    ExaSocialServices[ExaSocialServices["Facebook"] = 0] = "Facebook";
    ExaSocialServices[ExaSocialServices["Twitter"] = 1] = "Twitter";
})(ExaSocialServices || (ExaSocialServices = {}));
class ExaSocialService {
    constructor(articleUrl, shareheadline) {
        this.articleUrl = articleUrl;
        this.shareheadline = shareheadline;
    }
    static get is() { return "exa-footnotes"; }
    static get encapsulation() { return "shadow"; }
    static get properties() { return { "post": { "state": true }, "postid": { "type": String, "attr": "postid" }, "shareheadline": { "type": String, "attr": "shareheadline" }, "shareurl": { "type": String, "attr": "shareurl" } }; }
    static get style() { return "/**style-placeholder:exa-footnotes:**/"; }
}
class ExaSocialFacebook extends ExaSocialService {
    constructor(articleUrl, shareheadline) {
        super(articleUrl, shareheadline);
        this.name = "Share";
        this.classname = "facebook";
        this.shareurl = "http://facebook.com/";
        this.fbShareUrl = "https://www.facebook.com/sharer/sharer.php";
        this.shareurl = this.fbShareUrl +
            "?u=" +
            this.articleUrl;
    }
    static get is() { return "exa-footnotes"; }
    static get encapsulation() { return "shadow"; }
    static get properties() { return { "post": { "state": true }, "postid": { "type": String, "attr": "postid" }, "shareheadline": { "type": String, "attr": "shareheadline" }, "shareurl": { "type": String, "attr": "shareurl" } }; }
    static get style() { return "/**style-placeholder:exa-footnotes:**/"; }
}
class ExaSocialTwitter extends ExaSocialService {
    constructor(articleUrl, shareheadline) {
        super(articleUrl, shareheadline);
        this.name = "Tweet";
        this.classname = "twitter";
        this.shareurl = "http://twitter.com/";
        this.webIntentUrl = "https://twitter.com/intent/tweet";
        this.shareurl = this.webIntentUrl +
            "?text=" +
            this.shareheadline +
            "&url=" +
            this.articleUrl;
    }
    static get is() { return "exa-footnotes"; }
    static get encapsulation() { return "shadow"; }
    static get properties() { return { "post": { "state": true }, "postid": { "type": String, "attr": "postid" }, "shareheadline": { "type": String, "attr": "shareheadline" }, "shareurl": { "type": String, "attr": "shareurl" } }; }
    static get style() { return "/**style-placeholder:exa-footnotes:**/"; }
}
class ExaSocialServiceFactory {
    static socialServices(articleUrl, shareheadline) {
        var twitter = ExaSocialServiceFactory.socialService(ExaSocialServices.Twitter, articleUrl, shareheadline);
        var fb = ExaSocialServiceFactory.socialService(ExaSocialServices.Facebook, articleUrl, shareheadline);
        return [fb, twitter];
    }
    static socialService(service, articleUrl, shareheadline) {
        switch (service) {
            case ExaSocialServices.Facebook:
                return new ExaSocialFacebook(articleUrl, shareheadline);
            case ExaSocialServices.Twitter:
                return new ExaSocialTwitter(articleUrl, shareheadline);
        }
    }
    static get is() { return "exa-footnotes"; }
    static get encapsulation() { return "shadow"; }
    static get properties() { return { "post": { "state": true }, "postid": { "type": String, "attr": "postid" }, "shareheadline": { "type": String, "attr": "shareheadline" }, "shareurl": { "type": String, "attr": "shareurl" } }; }
    static get style() { return "/**style-placeholder:exa-footnotes:**/"; }
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
        return (h("div", { class: this.isMobile ? "nameplate" : "nameplate desktop" },
            h("a", { class: "logo", href: "https://badgerherald.com/" },
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
    static get encapsulation() { return "shadow"; }
    static get properties() { return { "isMobile": { "state": true }, "menuOpen": { "state": true }, "primaryMenu": { "type": Number, "attr": "primary-menu" }, "searchQuery": { "type": String, "attr": "search-query" }, "secondaryMenu": { "type": Number, "attr": "secondary-menu" }, "socialMenu": { "type": Number, "attr": "social-menu" } }; }
    static get style() { return "\@charset \"UTF-8\";\n*[data-exa-nameplate], *[data-exa-nameplate]:before, *[data-exa-nameplate]:after {\n  box-sizing: inherit; }\n\n\n\n\n\n\ndiv.nameplate[data-exa-nameplate] {\n  border-bottom: 5px solid #3c74b9;\n  padding-bottom: 12px; }\n  div.nameplate[data-exa-nameplate]   a.logo[data-exa-nameplate] {\n    width: 53.33333%;\n    height: auto;\n    display: block;\n    padding-right: 6.66667%; }\n    div.nameplate[data-exa-nameplate]   a.logo[data-exa-nameplate]   img[data-exa-nameplate] {\n      height: 100%;\n      width: 100%; }\n  div.nameplate[data-exa-nameplate]   div.menus[data-exa-nameplate] {\n    display: none;\n    position: absolute;\n    background: white;\n    width: 103.33333%;\n    margin-left: -1.66667%;\n    margin-top: 6px;\n    z-index: 9999; }\n    div.nameplate[data-exa-nameplate]   div.menus.active[data-exa-nameplate] {\n      display: block; }\n    div.nameplate[data-exa-nameplate]   div.menus[data-exa-nameplate]   exa-menu[data-exa-nameplate] {\n      display: block;\n      padding: 8.33333% 8.33333% 0 8.33333%; }\n    div.nameplate[data-exa-nameplate]   div.menus[data-exa-nameplate]   exa-search-form[data-exa-nameplate] {\n      padding-top: 8.33333%; }\n    div.nameplate[data-exa-nameplate]   div.menus[data-exa-nameplate]   exa-menu[data-exa-nameplate]:last-child {\n      padding-bottom: 20%; }\n    div.nameplate[data-exa-nameplate]   div.menus[data-exa-nameplate]   exa-menu.social[data-exa-nameplate] {\n      clear: right; }\n\n\@media (min-width: 760px) {\n  div.nameplate.desktop[data-exa-nameplate] {\n    position: relative; }\n    div.nameplate.desktop[data-exa-nameplate]   a.logo[data-exa-nameplate] {\n      width: 29.72973%;\n      padding-right: 2.7027%; }\n    div.nameplate.desktop[data-exa-nameplate]   div.menus[data-exa-nameplate] {\n      background: transparent;\n      display: block;\n      top: 0px;\n      height: 100%;\n      margin-left: 29.72973%;\n      margin-top: 0px;\n      bottom: 20px;\n      padding: 0;\n      margin-top: -12px;\n      width: 70.27027%; }\n      div.nameplate.desktop[data-exa-nameplate]   div.menus[data-exa-nameplate]   exa-menu[data-exa-nameplate] {\n        display: inline;\n        padding: 0; }\n      div.nameplate.desktop[data-exa-nameplate]   div.menus[data-exa-nameplate]   exa-menu.primary[data-exa-nameplate] {\n        position: absolute;\n        bottom: 0;\n        width: 100%; }\n      div.nameplate.desktop[data-exa-nameplate]   div.menus[data-exa-nameplate]   exa-menu.secondary[data-exa-nameplate] {\n        float: right; }\n      div.nameplate.desktop[data-exa-nameplate]   div.menus[data-exa-nameplate]   exa-menu.social[data-exa-nameplate] {\n        float: right;\n        height: 20px; }\n      div.nameplate.desktop[data-exa-nameplate]   div.menus[data-exa-nameplate]   exa-search-form[data-exa-nameplate] {\n        position: absolute;\n        width: 100%;\n        padding: 0;\n        right: 0;\n        bottom: 0; } }\n\n\@media (min-width: 880px) {\n  div.nameplate.desktop[data-exa-nameplate]   a.logo[data-exa-nameplate] {\n    max-width: 240px;\n    padding-right: 2.27273%; }\n  div.nameplate.desktop[data-exa-nameplate]   div.menus[data-exa-nameplate] {\n    display: block;\n    margin-left: 27.27273%;\n    width: 72.72727%; } }\n\n\@media (min-width: 1060px) {\n  div.nameplate.desktop[data-exa-nameplate]   a.logo[data-exa-nameplate] {\n    max-width: 240px;\n    padding-right: 1.88679%; }\n  div.nameplate.desktop[data-exa-nameplate]   div.menus[data-exa-nameplate] {\n    margin-left: 22.64151%;\n    width: 77.35849%; } }\n\n\@media (min-width: 1220px) {\n  div.nameplate.desktop[data-exa-nameplate]   a.logo[data-exa-nameplate] {\n    max-width: 240px;\n    padding-right: 1.63934%; }\n  div.nameplate.desktop[data-exa-nameplate]   div.menus[data-exa-nameplate] {\n    margin-left: 19.67213%;\n    width: 80.32787%; } }"; }
}

export { ExaFootnotes, ExaNameplate };
