/*! Built with http://stenciljs.com */
const { h } = window.exa;

class ExaSearchForm {
    render() {
        return (h("form", { class: "search", action: "/", method: "get" },
            h("input", { type: "text", name: "s", placeholder: "Search..." }),
            h("input", { type: "submit", value: "Submit" })));
    }
    static get is() { return "exa-search-form"; }
    static get style() { return "\@charset \"UTF-8\";\n*, *:before, *:after {\n  box-sizing: inherit; }\n\n/*  Fonts */\n/** v0.3.5 colors — preferred use. \n * (modifier)colorObjectOnBackgroundcolorAction \n * lightblueLinkOnBrownHover \n */\n/**\n * //todo: colors other than blue\n * Mixin for link hover states\n */\n/**\n * Definitions for vertical grid system, as applicable on different displays.\n *\n * Columns are 60 each with 20px gutters. Depending on screen size, a different number\n * of columns are available.\n *\n * Note: mobile and tablet should always be in flex() pixels. \n *\n *  - mobile: 4 Columns\n *  - tablet: 9 Columns\n *  - desktop: 13 Columns\n *  - xl: 15 Columns.\n *\n */\n/**\n * Mixin for breakpoints.\n */\nexa-menu-button a {\n  /* the menu icon */\n  color: #3c74b9;\n  padding: 12px 10% 18px 6.66667%;\n  font-size: 24px;\n  background: white;\n  display: block;\n  line-height: 24px;\n  font-family: \"PT Sans Narrow\", Helvetica, Arial, Sans-Serif;\n  position: absolute;\n  right: 0;\n  bottom: 0;\n  transition: bottom .2s;\n  cursor: pointer;\n  margin-right: -1.66667%; }\n  exa-menu-button a:hover {\n    color: #3a97f7; }\n  exa-menu-button a:after {\n    content: \"d\";\n    font-size: 12px;\n    margin-left: 5px;\n    transition: transform .1s;\n    font-family: exa;\n    position: absolute; }\n  exa-menu-button a.active:after {\n    margin-top: 3px;\n    transform: rotate(180deg); }\n  exa-menu-button a.active {\n    background: #ffffff;\n    bottom: -6px; }"; }
}

export { ExaSearchForm };
