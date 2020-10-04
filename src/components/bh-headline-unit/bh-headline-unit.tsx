import { Component, Prop, h } from '@stencil/core';

@Component({
  tag: 'bh-headline-unit',
  styleUrl: 'bh-headline-unit.scss',
})
export class HeraldHeadlineUnit {

  @Prop() headline: string 
  @Prop() subhead: string 
  @Prop() imageSrc: string
  @Prop() hard: Boolean | "true" | "false"
  @Prop() url: string 
  @Prop() topic: string 
  @Prop() category: string 
  @Prop() time: string 
  @Prop() headerTag: "h1" | "h2" | "h3" | "h4"
  @Prop() subheadTag: "h1" | "h2" | "h3" | "h4"

  render() {
    let Tag = this.url ? "a" : "span"
    let SubheadTag = this.subheadTag || this.headerTag
    return <Tag class={"meta " + this.headerTag} href={this.url}>
        {this.imageSrc ? <span class="img"><img src={this.imageSrc} /></span> : ""}
        <span class="metadata">
          <span class="category">{this.category}</span>
          <span class="topic">{this.topic}</span> &middot;{" "}
          <span class="time">{this.time}</span>
        </span>
        <this.headerTag class={"head" + (this.hard === true || this.hard === "true" ? " hard" : "")}>
          {this.headline}
        </this.headerTag>
        {this.subhead ? 
        <SubheadTag class={"head sub"}>
          {this.subhead}
        </SubheadTag> : ""}
      </Tag>
    
  }

}
