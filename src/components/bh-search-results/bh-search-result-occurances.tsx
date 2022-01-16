import { Component, Prop, h } from "@stencil/core";
import { Post } from "@webpress/core";
import "@webpress/theme";

@Component({
  tag: "bh-search-result-occurances",
  styleUrl: "bh-search-result-occurances.scss",
})
export class BhrldSearchResultOccurances {
  @Prop() result: Post;
  @Prop() searchQuery: String;

  private _content: string;

  get occurances() {
    if (!this._content) {
      let tmp = document.createElement("DIV");
      tmp.innerHTML = this.result.content;
      this._content = tmp.textContent || tmp.innerText || "";
    }

    var content = this._content.toLocaleLowerCase();
    var searchKeyword = this.searchQuery.toLocaleLowerCase();
    var startingIndices = [];

    var indexOccurence = content.indexOf(searchKeyword, 0);

    while (indexOccurence >= 0) {
      startingIndices.push(indexOccurence);

      indexOccurence = content.indexOf(searchKeyword, indexOccurence + 1);
    }

    return startingIndices;
  }

  get approxOccurances() {
    if (!this._content) {
      let tmp = document.createElement("DIV");
      tmp.innerHTML = this.result.content;
      this._content = tmp.textContent || tmp.innerText || "";
    }

    var content = this._content.toLocaleLowerCase();
    var searchKeywords = this.searchQuery.toLocaleLowerCase().split(" ");
    var startingIndices = [];
    searchKeywords.map((searchKeyword) => {
      var indexOccurence = content.indexOf(searchKeyword, 0);

      while (indexOccurence >= 0) {
        startingIndices.push(indexOccurence);

        indexOccurence = content.indexOf(searchKeyword, indexOccurence + 1);
      }
    });
    return startingIndices;
  }

  render() {
    let occurances = [...this.occurances, ...this.approxOccurances];
    if (!occurances) {
      return this.result.excerpt;
    }

    return (
      <p>
        {occurances.map((occurance, index) => {
          if (index > 1) {
            return undefined;
          }
          var words = this._content
            .slice(occurance - 24, occurance + 60)
            .split(" ")
            .splice(1);

          return [
            <wp-date post={this.result} />,
            "—",
            words.map((word) => {
              return this.searchQuery
                .split(" ")
                .find(
                  (part) => part.toLocaleLowerCase() == word.toLocaleLowerCase()
                )
                ? [<span class="match">{word}</span>, " "]
                : word + " ";
            }),
            "...",
          ];
        })}
      </p>
    );
  }
}
