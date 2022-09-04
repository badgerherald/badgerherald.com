import { Component, h } from "@stencil/core";
import { HeraldAdMapping, HeraldAdSize } from "../model/HeraldAdSize";

@Component({
  tag: "hrld-homepage-sidekick",
  styleUrl: "hrld-homepage-sidekick.scss",
})
export class HeraldHomepageSidekick {
  private adEl: HTMLElement;
  private adjustSize(event: googletag.events.SlotRenderEndedEvent) {
    console.log("ad is", event);
    if (event.size == null) {
      this.adEl.classList.add("empty");
    } else if (event.size[1] <= 200) {
      this.adEl.classList.add("leaderboard");
    } else {
      this.adEl.classList.add("billboard");
    }
  }
  render() {
    return (
      <bst-ad-slot
        ref={(el) => (this.adEl = el)}
        adUnitPath="badgerherald.com-upper-sidekick"
        slotRenderEnded={(event) => this.adjustSize(event)}
        sizeMap={HeraldAdMapping({
          mobile: [HeraldAdSize.Sidekick],
        })}
      />
    );
  }
}
