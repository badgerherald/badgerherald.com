import { Component, Prop, h } from "@stencil/core";
import { Query, SearchResult } from "@webpress/core";
import "@webpress/theme";

@Component({
  tag: "bh-search-pagination",
  styleUrl: "bh-search-pagination.scss",
})
export class BhrldSearchPagination {
  @Prop() pagination: Query.Pagination<SearchResult>;

  render() {
    return [
      <p>
        Page {this.pagination.page} of {this.pagination.totalPages} (
        {this.pagination.total} total results)
      </p>,
      this.renderList(),
    ];
  }

  listStructure() {
    if (this.pagination.totalPages < 8) {
      return [...Array(this.pagination.totalPages).keys()];
    } else if (
      this.pagination.page > 5 &&
      this.pagination.totalPages - this.pagination.page >= 5
    ) {
      return [
        1,
        0,
        ...[...Array(5).keys()].map(
          (index) => this.pagination.page - 2 + index
        ),
        0,
        this.pagination.totalPages,
      ];
    } else if (this.pagination.page <= 5) {
      return [
        ...[...Array(7).keys()].map((index) => index + 1),
        0,
        this.pagination.totalPages,
      ];
    } else {
      return [
        1,
        0,
        ...[...Array(7).keys()]
          .reverse()
          .map((index) => this.pagination.totalPages - index),
      ];
    }
  }

  renderList() {
    return (
      <ul>
        {this.listStructure().map((index) =>
          index == 0 ? this.renderDotDotDotLi() : this.renderPageLi(index)
        )}
        {this.renderNextLi()}
      </ul>
    );
  }

  renderDotDotDotLi() {
    return <li class="dotdotdot">...</li>;
  }

  renderNextLi() {
    return (
      <li class="next">
        <a
          href="#next"
          data-page={this.pagination.page + 1}
          onClick={(event) => this.pageClicked(event)}
        >
          Next
        </a>
      </li>
    );
  }

  pageClicked(event: MouseEvent) {
    event.preventDefault();

    // Build new URL
    let page = (event.target as HTMLAnchorElement).getAttribute("data-page");
    var queryParams = new URLSearchParams(window.location.search);
    queryParams.set("page", page);

    // Replace current querystring with the new one.
    history.pushState(null, null, "?" + queryParams.toString());
    window.location = window.location;
  }

  renderPageLi(index) {
    return (
      <li class={index == this.pagination.page ? "link current" : "link"}>
        <a
          href={"#" + index}
          data-page={index}
          onClick={(event) => this.pageClicked(event)}
          title={"Page " + index}
        >
          {index}
        </a>
      </li>
    );
  }
}
