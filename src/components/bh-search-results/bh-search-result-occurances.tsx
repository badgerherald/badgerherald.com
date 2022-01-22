import { Component, Prop, h } from "@stencil/core";
import { Post } from "@webpress/core";
import "@webpress/theme";
import { approxOccurances } from "./bh-search-functions";

@Component({
  tag: "bh-search-result-occurances",
  styleUrl: "bh-search-result-occurances.scss",
})
export class BhrldSearchResultOccurances {
  @Prop() result: Post;
  @Prop() searchQuery: String;

  private _content: string;

  wrappedWord(word: String) {
    let match = this.searchQuery
      .split(" ")
      .find((part) =>
        word.toLocaleLowerCase().includes(part.toLocaleLowerCase())
      );
    if (!match) {
      return word;
    }
    let index = word.toLocaleLowerCase().indexOf(match.toLocaleLowerCase());
    let pre = word.substr(0, index - 1);
    let part = word.substr(index, match.length);
    let post = word.substr(index + match.length);

    return (
      <span class="match">{[pre, <span class="part">{part}</span>, post]}</span>
    );
  }
  render() {
    if (!this._content) {
      let tmp = document.createElement("DIV");
      tmp.innerHTML = this.result.content;
      this._content = tmp.textContent || tmp.innerText || "";
    }

    let occurances = [...approxOccurances(this._content, this.searchQuery)];
    if (occurances.length == 0) {
      return (
        <p>
          {<wp-date post={this.result} />}—
          <span class="excerpt" innerHTML={this.result.excerpt} />{" "}
        </p>
      );
    }

    return (
      <p>
        {[
          <wp-date post={this.result} />,
          "—",
          occurances.map((occurance, index) => {
            if (index > 1) {
              return undefined;
            }
            var words = this._content
              .slice(occurance - 24, occurance + 60)
              .split(" ")
              .splice(1);

            return [
              words.map((word) => {
                return this.searchQuery
                  .split(" ")
                  .find((part) =>
                    word.toLocaleLowerCase().includes(part.toLocaleLowerCase())
                  )
                  ? [this.wrappedWord(word), " "]
                  : word + " ";
              }),
              "... ",
            ];
          }),
        ]}
      </p>
    );
  }
}
