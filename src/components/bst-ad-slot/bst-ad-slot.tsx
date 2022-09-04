import { Component, Prop, h } from "@stencil/core";
import { AdMapping } from "../model/AdMapping";

@Component({
  tag: "bst-ad-slot",
})
export class BroadsheetAdSlot {
  @Prop() adUnitPath!: string;
  @Prop() sizeMap!: AdMapping;

  @Prop() slotRenderEnded: (
    event: googletag.events.SlotRenderEndedEvent
  ) => any;

  private slot: googletag.Slot;
  private hash: string;
  private adEl: HTMLElement;
  componentWillLoad() {
    googletag.pubads().addEventListener("slotRenderEnded", (event) => {
      if (event.slot != this.slot) {
        // not our ad!!
        return;
      }
      this.adEl.style.width = event.size ? event.size[0] + "px" : "0";
      this.adEl.style.height = event.size ? event.size[1] + "px" : "0";
      this.slotRenderEnded(event);
    });
    this.hash = "ab-" + this.cyrb53(this.adUnitPath).toString(16);
    googletag.cmd.push(() => {
      this.slot = googletag
        .defineSlot("/64222555/" + this.adUnitPath, [300, 250], this.hash)
        .defineSizeMapping(this.sizeMap)
        .addService(googletag.pubads());
      googletag.enableServices();
    });
  }

  render() {
    return <div id={this.hash} ref={(el) => (this.adEl = el)} />;
  }

  componentDidRender() {
    if (!this.slot) {
      return;
    }
    googletag.cmd.push(() => {
      googletag.display(this.hash);
    });
  }

  cyrb53 = function (str, seed = 0) {
    let h1 = 0xdeadbeef ^ seed,
      h2 = 0x41c6ce57 ^ seed;
    for (let i = 0, ch; i < str.length; i++) {
      ch = str.charCodeAt(i);
      h1 = Math.imul(h1 ^ ch, 2654435761);
      h2 = Math.imul(h2 ^ ch, 1597334677);
    }
    h1 =
      Math.imul(h1 ^ (h1 >>> 16), 2246822507) ^
      Math.imul(h2 ^ (h2 >>> 13), 3266489909);
    h2 =
      Math.imul(h2 ^ (h2 >>> 16), 2246822507) ^
      Math.imul(h1 ^ (h1 >>> 13), 3266489909);
    return 4294967296 * (2097151 & h2) + (h1 >>> 0);
  };
}
