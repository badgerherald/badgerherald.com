import { Component, h, Prop, Element } from "@stencil/core";
import { Connection } from "@webpress/core";

@Component({
  tag: "bh-popular-posts",
  styleUrl: "bh-popular-posts.scss",
})
export class BhrldPopularPosts {
  @Prop() global: Connection.Context;

  render() {
    return (
      <ol class="pop-posts">
        <h2>Popular Posts</h2>
        <ab-popular-posts
          size={8}
          global={this.global}
          renderPost={(post, _) => (
            <li>
              <wp-title el="h4" post={post} permalink={true} />
            </li>
          )}
        />
      </ol>
    );
  }
}
