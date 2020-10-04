import { Component, Prop, h } from '@stencil/core';

@Component({
  tag: 'bh-archive-grouping-header',
  styleUrl: 'bh-archive-grouping-header.scss',
})
export class HeraldArchiveGroupingHeader {
  @Prop() headerText: string

  render() {
    return <h3>{this.headerText}</h3>
  }

}
