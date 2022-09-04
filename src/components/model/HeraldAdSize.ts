import { AdMap, AdMapFactory } from "./AdMapping";
import { HeraldBreakpoint } from "./HeraldBreakpoints";

export const HeraldAdSize = {
  Billboard: [970, 250],
  Leaderboard: [728, 90],
  Sidekick: [300, 250],
};

export const HeraldAdMapping = (map: AdMap<HeraldBreakpoint>) =>
  AdMapFactory(map, HeraldBreakpoint.minViewport);
