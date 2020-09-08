import { Component, Prop, h } from '@stencil/core';

@Component({
  tag: 'exa-menu-button',
  styleUrl: 'exa-menu-button.scss',
})
export class ExaMenuButton {

@Prop() active: boolean = false
  render() {
    return (
      <a class={this.active ? "active" : ""}>{this.active ? "Close" : "Menu"}</a>
    );
  }

}
