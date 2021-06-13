import { Component, Prop, State, h } from "@stencil/core";
import { Template, Theme } from "@webpress/core";
import "@webpress/theme";

@Component({
  tag: "exa-nameplate",
  styleUrl: "exa-nameplate.scss",
})
export class ExaNameplate {
  @Prop() query: Template.Query;
  @Prop() theme: Theme;

  @Prop() searchQuery: string;

  @State() menuOpen: boolean = false;

  toggleMenu() {
    this.menuOpen = !this.menuOpen;
  }

  render() {
    return [
      <a class="logo" href="https://badgerherald.com/">
        <img
          src={
            "/wp-content/themes/badgerherald.com/assets/img/logo/header-horizontal.png"
          }
        />
      </a>,
      <exa-menu-button
        active={this.menuOpen}
        onClick={() => this.toggleMenu()}
      />,
      <div class={this.menuOpen ? "menus active" : "menus"}>
        <exa-search-form />
        <wp-menu class="primary" query={this.theme.getMenu("418")} />
        <wp-menu
          class="social"
          query={this.theme.getMenu("8418")}
          options={{
            classForMenuItem: (item) => "social " + item.slug,
            domForItem: (item) => <span class="hidden">{item.title}</span>,
          }}
        />
        <wp-menu class="secondary black" query={this.theme.getMenu("1845")} />
      </div>,
      <div class="clearfix"></div>,
    ];
  }
}
