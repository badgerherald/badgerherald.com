import { Component, Prop, h } from "@stencil/core";
import { SearchResult } from "@webpress/core";
import "@webpress/theme";
import { approxOccurances, annotatedOccurances } from "./bh-search-functions";

@Component({
  tag: "bh-search-result-title",
  styleUrl: "bh-search-result-title.scss",
})
export class BhrldSearchResultTitle {
  @Prop() result: SearchResult;
  @Prop() searchQuery: String;

  el: HTMLElement;

  _title;
  componentWillRender() {
    if (this.result && !this._title) {
      let tmp = document.createElement("DIV");
      tmp.innerHTML = this.result.title;
      this._title = tmp.textContent || tmp.innerText || "";
    }
  }
  render() {
    if (!this.result) {
      return "Loading...";
    }
    let occurances = approxOccurances(this._title, this.searchQuery);
    let html = this._title;
    if (occurances.length > 0) {
      html = annotatedOccurances(
        occurances,
        this._title,
        this.searchQuery,
        false
      );
    }
    return (
      <a href={this.result.url}>
        <h4 ref={(el) => (this.el = el)}>{html}</h4>
      </a>
    );
  }

  componentDidRender() {
    if (this.el) {
    }
  }
}
