/*! Built with http://stenciljs.com */
const { h } = window.exa;

class ExaPublishTimeMeta {
    render() {
        const modified = new ExaDateFormat(this.modified);
        const published = new ExaDateFormat(this.published);
        const modifiedHTML = h("span", null,
            " \u00B7 Last modified ",
            modified.format());
        return (h("div", null,
            h("span", null,
                "Published ",
                published.format()),
            this.modified ? modifiedHTML : ""));
    }
    static get is() { return "exa-publish-time-meta"; }
    static get properties() { return { "modified": { "type": String, "attr": "modified" }, "published": { "type": String, "attr": "published" } }; }
    static get style() { return "\@charset \"UTF-8\";\n*, *:before, *:after {\n  box-sizing: inherit; }\n\n/*  Fonts */\n/** v0.3.5 colors — preferred use. \n * (modifier)colorObjectOnBackgroundcolorAction \n * lightblueLinkOnBrownHover \n */\n/**\n * //todo: colors other than blue\n * Mixin for link hover states\n */\n/**\n * Definitions for vertical grid system, as applicable on different displays.\n *\n * Columns are 60 each with 20px gutters. Depending on screen size, a different number\n * of columns are available.\n *\n * Note: mobile and tablet should always be in flex() pixels. \n *\n *  - mobile: 4 Columns\n *  - tablet: 9 Columns\n *  - desktop: 13 Columns\n *  - xl: 15 Columns.\n *\n */\n/**\n * Mixin for breakpoints.\n */\nexa-publish-time-meta div {\n  margin-bottom: 24px;\n  margin-top: -18px;\n  font-family: \"PT Sans Narrow\", Helvetica, Arial, Sans-Serif;\n  color: #93a2aa;\n  font-size: 18px;\n  position: relative;\n  line-height: 24px; }"; }
}
moment.fn.exaDateFormat = function () {
    if (Math.abs(moment().diff(this)) < (60 * 60 * 24 * 1000)) {
        return this.fromNow();
    }
    else if (Math.abs(moment().diff(this)) < (60 * 60 * 24 * 7 * 1000)) {
        return this.calendar(null, {
            sameDay: '[today]',
            nextDay: '[tomorrow]',
            nextWeek: 'dddd',
            lastDay: '[yesterday]',
            lastWeek: '[last] dddd',
            sameElse: 'DD/MM/YYYY'
        });
    }
    else {
        return this.format('MMMM D, YYYY');
    }
};
class ExaDateFormat {
    constructor(date) {
        this.date = date;
    }
    format() {
        return moment(this.date).exaDateFormat();
    }
    static get is() { return "exa-publish-time-meta"; }
    static get properties() { return { "modified": { "type": String, "attr": "modified" }, "published": { "type": String, "attr": "published" } }; }
    static get style() { return "/**style-placeholder:exa-publish-time-meta:**/"; }
}

class ExaSocialButton {
    constructor() {
        this.title = "sup";
        this.description = "";
        this.classname = ""; //todo: this sucks
    }
    render() {
        return (h("a", { target: "_blank", href: this.shareurl, title: this.description, class: this.classname }, this.title));
    }
    static get is() { return "exa-social-button"; }
    static get properties() { return { "classname": { "type": String, "attr": "classname" }, "description": { "type": String, "attr": "description" }, "shareurl": { "type": String, "attr": "shareurl" }, "title": { "type": String, "attr": "title" } }; }
    static get style() { return "\@charset \"UTF-8\";\n*, *:before, *:after {\n  box-sizing: inherit; }\n\n/*  Fonts */\n/** v0.3.5 colors — preferred use. \n * (modifier)colorObjectOnBackgroundcolorAction \n * lightblueLinkOnBrownHover \n */\n/**\n * //todo: colors other than blue\n * Mixin for link hover states\n */\n/**\n * Definitions for vertical grid system, as applicable on different displays.\n *\n * Columns are 60 each with 20px gutters. Depending on screen size, a different number\n * of columns are available.\n *\n * Note: mobile and tablet should always be in flex() pixels. \n *\n *  - mobile: 4 Columns\n *  - tablet: 9 Columns\n *  - desktop: 13 Columns\n *  - xl: 15 Columns.\n *\n */\n/**\n * Mixin for breakpoints.\n */\nexa-social-button a {\n  font-size: 16px;\n  padding: 6px 12px;\n  font-family: \"PT Sans Narrow\", Helvetica, Arial, Sans-Serif;\n  color: #fff;\n  text-decoration: none;\n  position: relative; }\n  exa-social-button a:before {\n    font-family: exa;\n    font-size: 14px;\n    padding-right: 4px;\n    top: 5px;\n    position: absolute;\n    left: 9px; }\n  exa-social-button a.twitter {\n    background: #059FF5;\n    padding-left: 28px; }\n    exa-social-button a.twitter:before {\n      content: 't';\n      padding-right: 6px; }\n    exa-social-button a.twitter:hover {\n      background: #191919; }\n  exa-social-button a.facebook {\n    background: #4965A2;\n    padding-left: 25px; }\n    exa-social-button a.facebook:before {\n      content: 'f';\n      top: 4px;\n      left: 7px; }\n    exa-social-button a.facebook:hover {\n      background: #191919; }\n  exa-social-button a:hover {\n    color: white; }"; }
}

export { ExaPublishTimeMeta, ExaSocialButton };
