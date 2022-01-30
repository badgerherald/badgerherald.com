import { Component } from "@stencil/core";

// Import external component packages in an empty component
// in order to get Stencil to roll 'em up
import "@badgerherald/donate";
import "@webpress/theme";
import "@broadsheet.technology/analytics-bridge";

@Component({
  tag: "bh-imports",
})
export class HeraldTemp {
  render() {
    return;
  }
}
