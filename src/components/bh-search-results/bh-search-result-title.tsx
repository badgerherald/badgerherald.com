import { Component, Prop, h } from "@stencil/core";
import { Post } from "@webpress/core";
import "@webpress/theme";

@Component({
  tag: "bh-search-result-title",
  styleUrl: "bh-search-result-title.scss",
})
export class BhrldSearchResultTitle {
  @Prop() result: Post;
  @Prop() searchQuery: String;

  render() {
    if (!this.result) {
      return "Loading...";
    }
    return (
      <wp-link object={this.result}>
        <wp-title post={this.result} el="h4" />
      </wp-link>
    );
  }
}
