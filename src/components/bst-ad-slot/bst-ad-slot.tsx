import { Component, Prop, h } from "@stencil/core";
import { AdMapping } from "../model/AdMapping";

@Component({
  tag: "bst-ad-slot",
})
export class BroadsheetAdSlot {
  @Prop() adUnitPath!: string;
  @Prop() sizeMap!: AdMapping;

  private slot: googletag.Slot;
  private hash: string;

  componentWillLoad() {
    this.hash = "a-" + this.cyrb53(this.adUnitPath).toString(16);
    googletag.cmd.push(() => {
      this.slot = googletag
        .defineSlot("/8653162/" + this.adUnitPath, [300, 250], this.hash)
        .defineSizeMapping(this.sizeMap)
        .addService(googletag.pubads());
      googletag.enableServices();
    });
  }

  render() {
    console.log("size map", this.sizeMap);
    return [
      <div id={this.hash} />,
      <a onClick={(_) => googletag.openConsole()}>Advertisement</a>,
    ];
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
