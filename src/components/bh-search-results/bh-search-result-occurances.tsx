import { Component, Prop, h, State } from "@stencil/core";
import { SearchResult, Query, Post } from "@webpress/core";
import "@webpress/theme";
import { annotatedOccurances, approxOccurances } from "./bh-search-functions";

@Component({
  tag: "bh-search-result-occurances",
  styleUrl: "bh-search-result-occurances.scss",
})
export class BhrldSearchResultOccurances {
  @Prop() result: SearchResult;
  @Prop() searchQuery: String;
  @State() resultObject: Post;

  private _content: string;

  async componentDidRender() {
    if (!this.resultObject && this.result.subtype == "post") {
      this.resultObject = await new Query(
        this.result.connection,
        Post.QueryArgs({
          id: this.result.id,
        })
      ).result;
    }
  }
  render() {
    if (!this.resultObject) {
      return;
    }
    if (!this._content) {
      let tmp = document.createElement("DIV");
      tmp.innerHTML = this.resultObject.content;
      this._content = tmp.textContent || tmp.innerText || "";
    }

    let occurances = approxOccurances(this._content, this.searchQuery);
    if (occurances.length == 0) {
      return (
        <p>
          {<wp-date post={this.resultObject} />}—
          <span class="excerpt" innerHTML={this.resultObject.excerpt} />{" "}
        </p>
      );
    }

    return (
      <p>
        {[
          <wp-date post={this.resultObject} />,
          "—",
          annotatedOccurances(occurances, this._content, this.searchQuery),
        ]}
      </p>
    );
  }
}
