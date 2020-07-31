import { Component, h } from '@stencil/core';

@Component({
  tag: 'wjh-home',
  styleUrl: 'wjh-home.scss',
})
export class WjhHome {
  render() {
    return <slot />
  }
}
