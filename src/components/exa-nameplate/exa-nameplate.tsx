import { Component, Prop, State, h } from '@stencil/core';
import { Menu, Query } from '@webpress/core'

declare var exa:any; // Magic

@Component({
  tag: 'exa-nameplate',
  styleUrl: 'exa-nameplate.scss'
})
export class ExaNameplate {  
  @Prop() query: Query

  @State() mainMenu: Menu;
  @State() secondaryMenu: Menu;
  @State() socialMenu: Menu;

  @Prop() searchQuery: string;

  @State() menuOpen: boolean = false;

  async componentDidRender() {
    if(!this.mainMenu && this.query) {
      this.mainMenu = await this.query.connection.getMenu('418')
      this.secondaryMenu = await this.query.connection.getMenu('1845')
      this.socialMenu = await this.query.connection.getMenu('8418')
    }
    console.log(this.socialMenu)
  }

  toggleMenu() {
    this.menuOpen = !this.menuOpen;
  }

  render() {
    return [
        <a class="logo" href="https://badgerherald.com/">
          <img src={"/wp-content/themes/badgerherald.com/assets/img/logo/header-horizontal.png" } />
        </a>,
        <exa-menu-button active={this.menuOpen} onClick={() => this.toggleMenu()} />,
        <div class={this.menuOpen ? "menus active" : "menus"}>
          <exa-search-form />
          <wp-menu class="primary" menu={this.mainMenu} />  
           
          <wp-menu class="secondary black" menu={this.secondaryMenu} />  
          <wp-menu class="social" menu={this.socialMenu} options={ { classForMenuItem: item => "social " + item.slug, domForItem: item => <span class="hidden">{item.title}</span> }}/> 
        </div>,
        <div class="clearfix"></div>
    ]
  } 
}