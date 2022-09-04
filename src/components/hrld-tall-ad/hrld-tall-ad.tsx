import { Component, h } from "@stencil/core";
import { HeraldAdMapping, HeraldAdSize } from "../model/HeraldAdSize";

@Component({
  tag: "hrld-tall-ad",
})
export class HeraldHomepageSidekick {
  render() {
    return (
      <bst-ad-slot
        adUnitPath="badgerherald.com-footnote-sidekick"
        sizeMap={HeraldAdMapping({
          mobile: [0, 0],
          desktop: [HeraldAdSize.Sidekick, HeraldAdSize.TallSidekick],
        })}
      />
    );
  }
}
