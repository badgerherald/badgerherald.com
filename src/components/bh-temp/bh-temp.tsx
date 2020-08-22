import { Component } from "@stencil/core"
import '@badgerherald/donate'
import '@webpress/theme'

// Eventually, move the exa-component repo, but for now 
// the stencil compiler needs at least one component
// to find and bundle the rempte `@badgerherald/donate`
// components

@Component({
  tag: 'bh-temp',
  styleUrl: 'bh-temp.scss',
})
export class HeraldTemp {
  render() {
    return
  }
}
