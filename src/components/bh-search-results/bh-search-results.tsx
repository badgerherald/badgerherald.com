import { Component, State, h, Prop } from "@stencil/core";
import { Connection, Post, Query } from "@webpress/core";
import "@webpress/theme";

@Component({
  tag: "bh-search-results",
})
export class BhrldSearchResults {
  @State() results: Post[];

  @Prop() connection: Connection;

  render() {
    if (!this.results) {
      return "Loading...";
    }
    return this.results.map((result) => (
      <div>
        <bh-search-result-title
          result={result}
          searchQuery={this.searchQuery}
        />
        <bh-search-result-occurances
          result={result}
          searchQuery={this.searchQuery}
        />
      </div>
    ));
  }

  private get searchQuery() {
    let params = new URL(document.URL).searchParams;
    return params.get("s");
  }

  async componentDidRender() {
    if (this.results) {
      return;
    }

    let query = new Query(
      this.connection,
      Post.QueryArgs({
        search: this.searchQuery,
      } as Post.QueryParams)
    );

    this.results = await query.results;
  }
}
