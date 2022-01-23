import { Component, State, h, Prop } from "@stencil/core";
import { Connection, Search, SearchResult, Query } from "@webpress/core";
import "@webpress/theme";

@Component({
  tag: "bh-search-results",
})
export class BhrldSearchResults {
  @State() results: SearchResult[];
  @State() pagination: Query.Pagination<SearchResult>;

  @Prop() connection: Connection;

  render() {
    if (!this.results) {
      return "Loading...";
    }

    if (this.results.length == 0) {
      return <p>No results found</p>;
    }
    return [
      <bh-search-pagination pagination={this.pagination} />,
      this.results.map((result) => (
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
      )),
      <br />,
      <bh-search-pagination pagination={this.pagination} />,
    ];
  }

  private get searchQuery() {
    let params = new URL(document.URL).searchParams;
    return params.get("s");
  }

  private get searchPage() {
    let params = new URL(document.URL).searchParams;
    return params.get("page") || "1";
  }

  async componentDidRender() {
    if (this.results) {
      return;
    }

    let query = new Query(
      this.connection,
      Search.QueryArgs({
        search: this.searchQuery,
        page: parseInt(this.searchPage, 10),
      })
    );

    this.pagination = await query.paging;
    this.results = await query.results;
  }
}
