import { Component, Prop, h, State } from "@stencil/core";
import { Connection, Post, Query, Theme } from "@webpress/core";
import "@webpress/theme";

@Component({
  tag: "bh-search-results-page",
  styleUrl: "bh-search-results-page.scss",
})
export class BhrldSearchResults {
  @Prop() global: {
    // json set externally by index.php
    context: Connection.Context;
    theme: Theme.Definition;
  };

  render() {
    return (
      <div>
        <h1>Results for: {this.searchQuery}</h1>
        <bh-search-form focused={true} term={this.searchQuery} />
        <br />
        <bh-search-results connection={new Connection(this.global.context)} />
      </div>
    );
  }

  private get searchQuery() {
    let params = new URL(document.URL).searchParams;
    return params.get("s");
  }
}
