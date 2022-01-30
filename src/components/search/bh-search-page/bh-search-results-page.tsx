import { Component, Prop, h } from "@stencil/core";
import { Connection } from "@webpress/core";
import "@webpress/theme";

@Component({
  tag: "bh-search-results-page",
  styleUrl: "bh-search-results-page.scss",
})
export class BhrldSearchResults {
  @Prop() global: Connection.Context;

  render() {
    return (
      <div>
        <header>
          <h1>Results for: {this.searchQuery}</h1>
          <bh-search-form focused={true} term={this.searchQuery} />
          <bh-search-results
            connection={new Connection(this.global.serverInfo)}
          />
        </header>
        <div class="sidebar">
          <bh-popular-posts global={this.global} />
        </div>
      </div>
    );
  }

  private get searchQuery() {
    let params = new URL(document.URL).searchParams;
    return params.get("s");
  }
}
