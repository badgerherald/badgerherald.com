/*! Built with http://stenciljs.com */
const { h } = window.exa;

class ExaFootnotesPost {
    render() {
        const img = this.imgsrc ? h("img", { src: this.imgsrc }) : null;
        return (h("a", { href: this.url },
            img,
            h("h3", { class: "title", innerHTML: this.title }),
            h("p", { class: "subhead", innerHTML: this.subhead })));
    }
    static get is() { return "exa-teaser"; }
    static get properties() { return { "imgsrc": { "type": String, "attr": "imgsrc" }, "subhead": { "type": String, "attr": "subhead" }, "title": { "type": String, "attr": "title" }, "url": { "type": String, "attr": "url" } }; }
    static get style() { return "\@charset \"UTF-8\";\n*, *:before, *:after {\n  box-sizing: inherit; }\n\n/*  Fonts */\n/** v0.3.5 colors — preferred use. \n * (modifier)colorObjectOnBackgroundcolorAction \n * lightblueLinkOnBrownHover \n */\n/**\n * //todo: colors other than blue\n * Mixin for link hover states\n */\n/**\n * Definitions for vertical grid system, as applicable on different displays.\n *\n * Columns are 60 each with 20px gutters. Depending on screen size, a different number\n * of columns are available.\n *\n * Note: mobile and tablet should always be in flex() pixels. \n *\n *  - mobile: 4 Columns\n *  - tablet: 9 Columns\n *  - desktop: 13 Columns\n *  - xl: 15 Columns.\n *\n */\n/**\n * Mixin for breakpoints.\n */\nexa-teaser h3 {\n  font-family: 'pt sans narrow';\n  font-weight: bold !important;\n  font-size: .9em;\n  line-height: 1.1em;\n  margin: 0px; }\n\nexa-teaser p {\n  margin: 9px 0 12px 0;\n  font-size: .9em;\n  line-height: 1.1em;\n  font-family: 'pt sans narrow'; }\n\nexa-teaser a {\n  color: #191919;\n  font-family: 'Pt sans narrow';\n  text-decoration: none; }\n  exa-teaser a:hover {\n    color: #3c74b9; }\n\nexa-teaser a img {\n  width: 100%;\n  height: auto;\n  padding-bottom: 12px; }"; }
}

export { ExaFootnotesPost as ExaTeaser };
