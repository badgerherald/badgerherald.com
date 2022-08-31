import { Component, Prop, State, h } from "@stencil/core";
import { Connection, Menu, Query, Template, Theme } from "@webpress/core";
import "@webpress/theme";

@Component({
  tag: "exa-nameplate",
  styleUrl: "exa-nameplate.scss",
})
export class ExaNameplate {
  @Prop() global: Connection.Context;

  @Prop() query: Template.Query;
  @Prop() theme: Theme;

  @Prop() searchQuery: string;

  @State() menuOpen: boolean = false;

  componentWillRender() {
    if (!this.global || this.query) {
      return;
    }

    let connection = new Connection(this.global.serverInfo);

    this.theme = new Theme(connection, this.global.theme);
    this.query = new Template.Query(connection, {
      path: window.location.pathname,
    });
  }

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
        <wp-menu
          class="primary"
          query={
            new Query<Menu>(
              this.query.connection,
              Menu.QueryArgs({
                location: "exa_main_menu",
              })
            )
          }
        />
        <wp-menu
          class="social"
          query={
            new Query<Menu>(
              this.query.connection,
              Menu.QueryArgs({ location: "exa_social_media_menu" })
            )
          }
          options={{
            classForMenuItem: (item) => "social " + item.slug,
            domForItem: (item) => <span class="hidden">{item.title}</span>,
          }}
        />
        <wp-menu
          class="secondary black"
          query={
            new Query<Menu>(
              this.query.connection,
              Menu.QueryArgs({
                location: "exa_secondary_menu",
              })
            )
          }
        />
      </div>,
      <div class="clearfix"></div>,
    ];
  }
}
