import { Component, Host, Element, h } from "@stencil/core";
import { HeraldAdMapping, HeraldAdSize } from "../model/HeraldAdSize";

@Component({
  tag: "hrld-preflight",
  styleUrl: "hrld-preflight.scss",
})
export class HeraldPreflight {
  @Element() el: HTMLElement;
  //private adEl: HTMLElement;
  private adjustSize(event: googletag.events.SlotRenderEndedEvent) {
    console.log("ad is", event);
    this.el.style.height = null;
    if (event.size == null) {
      this.el.classList.add("empty");
    } else if (event.size[1] <= 200) {
      this.el.classList.add("leaderboard");
    } else {
      this.el.classList.add("billboard");
    }
  }
  render() {
    return (
      <Host class="container">
        <div class="wrapper">
          <bst-ad-slot
            // ref={(el) => (this.adEl = el)}
            adUnitPath="badgerherald.com-billboard"
            slotRenderEnded={(event) => this.adjustSize(event)}
            sizeMap={HeraldAdMapping({
              mobile: [HeraldAdSize.Sidekick],
              tablet: [HeraldAdSize.Leaderboard, HeraldAdSize.Billboard],
            })}
          />
        </div>
      </Host>
    );
  }
}
