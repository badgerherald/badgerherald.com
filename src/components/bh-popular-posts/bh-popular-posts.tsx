import { Component, h, Prop } from "@stencil/core";
import { Connection } from "@webpress/core";

@Component({
  tag: "bh-popular-posts",
  styleUrl: "bh-popular-posts.scss",
})
export class BhrldPopularPosts {
  @Prop() global: Connection.Context;

  width(weight, maxWeight) {
    return (weight / maxWeight) * 100 + "%";
  }
  render() {
    return (
      <ol class="pop-posts">
        <h2>Popular Posts</h2>
        <ab-popular-posts
          size={8}
          global={this.global}
          renderPost={(post, weight, maxWeight) => (
            <li>
              <wp-title el="h4" post={post} permalink={true} />
              <span
                class="ribbon"
                style={{
                  width: this.width(weight, maxWeight),
                }}
              />
            </li>
          )}
        />
      </ol>
    );
  }
}
