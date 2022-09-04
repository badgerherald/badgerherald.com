import { Component, h } from "@stencil/core";
import { HeraldAdMapping, HeraldAdSize } from "../model/HeraldAdSize";

@Component({
  tag: "hrld-article-sidebar",
  styleUrl: "hrld-article-sidebar.scss",
})
export class HeraldArticleSidebar {
  /*
  private adjustUpperSize(event: googletag.events.SlotRenderEndedEvent) {
    console.log("ad is", event);
    if (event.size == null) {
      this.adEl.classList.add("empty");
    } else if (event.size[1] <= 200) {
      this.adEl.classList.add("leaderboard");
    } else {
      this.adEl.classList.add("billboard");
    }
  }
  */
  render() {
    return (
      <div>
        <bst-ad-slot
          adUnitPath="badgerherald.com-upper-sidekick"
          sizeMap={HeraldAdMapping({
            mobile: [],
            desktop: [HeraldAdSize.Sidekick, HeraldAdSize.TallSidekick],
          })}
        />
        <bst-ad-slot
          adUnitPath="badgerherald.com-lower-sidekick"
          sizeMap={HeraldAdMapping({
            mobile: [],
            desktop: [HeraldAdSize.Sidekick, HeraldAdSize.TallSidekick],
          })}
        />
      </div>
    );
  }
}
