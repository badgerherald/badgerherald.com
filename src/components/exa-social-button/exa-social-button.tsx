import { Component, Prop, h } from '@stencil/core';


@Component({
  tag: 'exa-social-button',
  styleUrl: 'exa-social-button.scss',
})
export class ExaSocialButton {

  @Prop() shareurl: string;
  @Prop() title: string = "sup";
  @Prop() description: string = "";
  @Prop() classname: string = "";    //todo: this sucks

  render() {
    return (
      <a target="_blank" href={this.shareurl} title={this.description} class={this.classname}>
         {this.title}
      </a>
    );   
  } 

}
