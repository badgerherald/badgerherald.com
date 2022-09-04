import { Component, h } from "@stencil/core";
import { HeraldAdMapping, HeraldAdSize } from "../model/HeraldAdSize";

@Component({
  tag: "hrld-preflight",
  styleUrl: "hrld-preflight.scss",
})
export class HeraldPreflight {
  render() {
    return (
      <div class="container">
        <div class="wrapper">
          <bst-ad-slot
            adUnitPath="badgerherald.com-billboard"
            sizeMap={HeraldAdMapping({
              mobile: [HeraldAdSize.Sidekick],
              tablet: [HeraldAdSize.Leaderboard, HeraldAdSize.Billboard],
              desktop: [HeraldAdSize.Leaderboard, HeraldAdSize.Billboard],
              desktopxl: [HeraldAdSize.Leaderboard, HeraldAdSize.Billboard],
            })}
          />
        </div>
      </div>
    );
  }
}
