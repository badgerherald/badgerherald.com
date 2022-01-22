import { Component, h, Prop, Element } from "@stencil/core";

@Component({
  tag: "bh-search-form",
  styleUrl: "bh-search-form.scss",
})
export class BhrldSearchForm {
  @Prop() focused: boolean;
  @Prop() term: string;

  @Element() el;

  render() {
    return (
      <form
        class={this.focused ? "search focused" : "search"}
        action="/"
        method="get"
      >
        <input
          type="text"
          name="s"
          placeholder="Search..."
          class={this.focused ? "focused" : ""}
          value={this.term}
          onFocus={(_) => this.el.classList.add("focused")}
          onBlur={(_) => this.focused || this.el.classList.remove("focused")}
        ></input>
        <input type="submit" value="Submit"></input>
        <div class="clearfix" />
      </form>
    );
  }
}
