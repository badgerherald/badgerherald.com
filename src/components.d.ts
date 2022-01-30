/* eslint-disable */
/* tslint:disable */
/**
 * This is an autogenerated file created by the Stencil compiler.
 * It contains typing information for all components that exist in this project.
 */
import { HTMLStencilElement, JSXBase } from "@stencil/core/internal";
import { Connection, Query, SearchResult, Template, Theme } from "@webpress/core";
export namespace Components {
    interface BhImports {
    }
    interface BhPopularPosts {
        "global": Connection.Context;
    }
    interface BhSearchForm {
        "focused": boolean;
        "term": string;
    }
    interface BhSearchPagination {
        "pagination": Query.Pagination<SearchResult>;
    }
    interface BhSearchResultOccurances {
        "result": SearchResult;
        "searchQuery": String;
    }
    interface BhSearchResultTitle {
        "result": SearchResult;
        "searchQuery": String;
    }
    interface BhSearchResults {
        "connection": Connection;
    }
    interface BhSearchResultsPage {
        "global": Connection.Context;
    }
    interface ExaMenuButton {
        "active": boolean;
    }
    interface ExaNameplate {
        "global": Connection.Context;
        "query": Template.Query;
        "searchQuery": string;
        "theme": Theme;
    }
}
declare global {
    interface HTMLBhImportsElement extends Components.BhImports, HTMLStencilElement {
    }
    var HTMLBhImportsElement: {
        prototype: HTMLBhImportsElement;
        new (): HTMLBhImportsElement;
    };
    interface HTMLBhPopularPostsElement extends Components.BhPopularPosts, HTMLStencilElement {
    }
    var HTMLBhPopularPostsElement: {
        prototype: HTMLBhPopularPostsElement;
        new (): HTMLBhPopularPostsElement;
    };
    interface HTMLBhSearchFormElement extends Components.BhSearchForm, HTMLStencilElement {
    }
    var HTMLBhSearchFormElement: {
        prototype: HTMLBhSearchFormElement;
        new (): HTMLBhSearchFormElement;
    };
    interface HTMLBhSearchPaginationElement extends Components.BhSearchPagination, HTMLStencilElement {
    }
    var HTMLBhSearchPaginationElement: {
        prototype: HTMLBhSearchPaginationElement;
        new (): HTMLBhSearchPaginationElement;
    };
    interface HTMLBhSearchResultOccurancesElement extends Components.BhSearchResultOccurances, HTMLStencilElement {
    }
    var HTMLBhSearchResultOccurancesElement: {
        prototype: HTMLBhSearchResultOccurancesElement;
        new (): HTMLBhSearchResultOccurancesElement;
    };
    interface HTMLBhSearchResultTitleElement extends Components.BhSearchResultTitle, HTMLStencilElement {
    }
    var HTMLBhSearchResultTitleElement: {
        prototype: HTMLBhSearchResultTitleElement;
        new (): HTMLBhSearchResultTitleElement;
    };
    interface HTMLBhSearchResultsElement extends Components.BhSearchResults, HTMLStencilElement {
    }
    var HTMLBhSearchResultsElement: {
        prototype: HTMLBhSearchResultsElement;
        new (): HTMLBhSearchResultsElement;
    };
    interface HTMLBhSearchResultsPageElement extends Components.BhSearchResultsPage, HTMLStencilElement {
    }
    var HTMLBhSearchResultsPageElement: {
        prototype: HTMLBhSearchResultsPageElement;
        new (): HTMLBhSearchResultsPageElement;
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
    interface HTMLElementTagNameMap {
        "bh-imports": HTMLBhImportsElement;
        "bh-popular-posts": HTMLBhPopularPostsElement;
        "bh-search-form": HTMLBhSearchFormElement;
        "bh-search-pagination": HTMLBhSearchPaginationElement;
        "bh-search-result-occurances": HTMLBhSearchResultOccurancesElement;
        "bh-search-result-title": HTMLBhSearchResultTitleElement;
        "bh-search-results": HTMLBhSearchResultsElement;
        "bh-search-results-page": HTMLBhSearchResultsPageElement;
        "exa-menu-button": HTMLExaMenuButtonElement;
        "exa-nameplate": HTMLExaNameplateElement;
    }
}
declare namespace LocalJSX {
    interface BhImports {
    }
    interface BhPopularPosts {
        "global"?: Connection.Context;
    }
    interface BhSearchForm {
        "focused"?: boolean;
        "term"?: string;
    }
    interface BhSearchPagination {
        "pagination"?: Query.Pagination<SearchResult>;
    }
    interface BhSearchResultOccurances {
        "result"?: SearchResult;
        "searchQuery"?: String;
    }
    interface BhSearchResultTitle {
        "result"?: SearchResult;
        "searchQuery"?: String;
    }
    interface BhSearchResults {
        "connection"?: Connection;
    }
    interface BhSearchResultsPage {
        "global"?: Connection.Context;
    }
    interface ExaMenuButton {
        "active"?: boolean;
    }
    interface ExaNameplate {
        "global"?: Connection.Context;
        "query"?: Template.Query;
        "searchQuery"?: string;
        "theme"?: Theme;
    }
    interface IntrinsicElements {
        "bh-imports": BhImports;
        "bh-popular-posts": BhPopularPosts;
        "bh-search-form": BhSearchForm;
        "bh-search-pagination": BhSearchPagination;
        "bh-search-result-occurances": BhSearchResultOccurances;
        "bh-search-result-title": BhSearchResultTitle;
        "bh-search-results": BhSearchResults;
        "bh-search-results-page": BhSearchResultsPage;
        "exa-menu-button": ExaMenuButton;
        "exa-nameplate": ExaNameplate;
    }
}
export { LocalJSX as JSX };
declare module "@stencil/core" {
    export namespace JSX {
        interface IntrinsicElements {
            "bh-imports": LocalJSX.BhImports & JSXBase.HTMLAttributes<HTMLBhImportsElement>;
            "bh-popular-posts": LocalJSX.BhPopularPosts & JSXBase.HTMLAttributes<HTMLBhPopularPostsElement>;
            "bh-search-form": LocalJSX.BhSearchForm & JSXBase.HTMLAttributes<HTMLBhSearchFormElement>;
            "bh-search-pagination": LocalJSX.BhSearchPagination & JSXBase.HTMLAttributes<HTMLBhSearchPaginationElement>;
            "bh-search-result-occurances": LocalJSX.BhSearchResultOccurances & JSXBase.HTMLAttributes<HTMLBhSearchResultOccurancesElement>;
            "bh-search-result-title": LocalJSX.BhSearchResultTitle & JSXBase.HTMLAttributes<HTMLBhSearchResultTitleElement>;
            "bh-search-results": LocalJSX.BhSearchResults & JSXBase.HTMLAttributes<HTMLBhSearchResultsElement>;
            "bh-search-results-page": LocalJSX.BhSearchResultsPage & JSXBase.HTMLAttributes<HTMLBhSearchResultsPageElement>;
            "exa-menu-button": LocalJSX.ExaMenuButton & JSXBase.HTMLAttributes<HTMLExaMenuButtonElement>;
            "exa-nameplate": LocalJSX.ExaNameplate & JSXBase.HTMLAttributes<HTMLExaNameplateElement>;
        }
    }
}
