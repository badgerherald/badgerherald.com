/* eslint-disable */
/* tslint:disable */
/**
 * This is an autogenerated file created by the Stencil compiler.
 * It contains typing information for all components that exist in this project.
 */
import { HTMLStencilElement, JSXBase } from "@stencil/core/internal";
import { Connection, Template, Theme } from "@webpress/core";
export namespace Components {
    interface BhImports {
    }
    interface ExaMenuButton {
        "active": boolean;
    }
    interface ExaNameplate {
        "global": {
    // json set externally by index.php
    context: Connection.Context;
    theme: Theme.Definition;
  };
        "query": Template.Query;
        "searchQuery": string;
        "theme": Theme;
    }
    interface ExaSearchForm {
        "focused": boolean;
    }
    interface ExaSocialButton {
        "classname": string;
        "description": string;
        "shareurl": string;
        "title": string;
    }
}
declare global {
    interface HTMLBhImportsElement extends Components.BhImports, HTMLStencilElement {
    }
    var HTMLBhImportsElement: {
        prototype: HTMLBhImportsElement;
        new (): HTMLBhImportsElement;
    };
    interface HTMLExaMenuButtonElement extends Components.ExaMenuButton, HTMLStencilElement {
    }
    var HTMLExaMenuButtonElement: {
        prototype: HTMLExaMenuButtonElement;
        new (): HTMLExaMenuButtonElement;
    };
    interface HTMLExaNameplateElement extends Components.ExaNameplate, HTMLStencilElement {
    }
    var HTMLExaNameplateElement: {
        prototype: HTMLExaNameplateElement;
        new (): HTMLExaNameplateElement;
    };
    interface HTMLExaSearchFormElement extends Components.ExaSearchForm, HTMLStencilElement {
    }
    var HTMLExaSearchFormElement: {
        prototype: HTMLExaSearchFormElement;
        new (): HTMLExaSearchFormElement;
    };
    interface HTMLExaSocialButtonElement extends Components.ExaSocialButton, HTMLStencilElement {
    }
    var HTMLExaSocialButtonElement: {
        prototype: HTMLExaSocialButtonElement;
        new (): HTMLExaSocialButtonElement;
    };
    interface HTMLElementTagNameMap {
        "bh-imports": HTMLBhImportsElement;
        "exa-menu-button": HTMLExaMenuButtonElement;
        "exa-nameplate": HTMLExaNameplateElement;
        "exa-search-form": HTMLExaSearchFormElement;
        "exa-social-button": HTMLExaSocialButtonElement;
    }
}
declare namespace LocalJSX {
    interface BhImports {
    }
    interface ExaMenuButton {
        "active"?: boolean;
    }
    interface ExaNameplate {
        "global"?: {
    // json set externally by index.php
    context: Connection.Context;
    theme: Theme.Definition;
  };
        "query"?: Template.Query;
        "searchQuery"?: string;
        "theme"?: Theme;
    }
    interface ExaSearchForm {
        "focused"?: boolean;
    }
    interface ExaSocialButton {
        "classname"?: string;
        "description"?: string;
        "shareurl"?: string;
        "title"?: string;
    }
    interface IntrinsicElements {
        "bh-imports": BhImports;
        "exa-menu-button": ExaMenuButton;
        "exa-nameplate": ExaNameplate;
        "exa-search-form": ExaSearchForm;
        "exa-social-button": ExaSocialButton;
    }
}
export { LocalJSX as JSX };
declare module "@stencil/core" {
    export namespace JSX {
        interface IntrinsicElements {
            "bh-imports": LocalJSX.BhImports & JSXBase.HTMLAttributes<HTMLBhImportsElement>;
            "exa-menu-button": LocalJSX.ExaMenuButton & JSXBase.HTMLAttributes<HTMLExaMenuButtonElement>;
            "exa-nameplate": LocalJSX.ExaNameplate & JSXBase.HTMLAttributes<HTMLExaNameplateElement>;
            "exa-search-form": LocalJSX.ExaSearchForm & JSXBase.HTMLAttributes<HTMLExaSearchFormElement>;
            "exa-social-button": LocalJSX.ExaSocialButton & JSXBase.HTMLAttributes<HTMLExaSocialButtonElement>;
        }
    }
}
