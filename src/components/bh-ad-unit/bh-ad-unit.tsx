import { Component, h } from '@stencil/core';

@Component({
  tag: 'bh-ad-unit',
  styleUrl: 'bh-ad-unit.scss',
})
export class HeraldAdUnit {
  render() {
    return (<div>
      <slot />
      <p>Reach UW students by <a href="http://advertise.badgerherald.com">advertising on The Badger Herald</a></p>
    </div>)
  }

}
