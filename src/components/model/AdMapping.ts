export type AdMapping = googletag.SizeMappingArray;

export type AdSize = Array<number> | "fluid";

export type AdMapType = symbol | number | string;

export type AdMap<T extends AdMapType> = {
  [key in T]?: Array<AdSize> | AdSize;
};

export type ViewportSize = Array<number>;

export type AdMapSizeResolver<AdMappingType> = (
  type: AdMappingType
) => ViewportSize;

export const AdMapFactory = <T extends AdMapType>(
  map: AdMap<T>,
  sizeResolver: AdMapSizeResolver<T>
): AdMapping => {
  var builder = googletag.sizeMapping();
  for (const key in map) {
    builder.addSize(sizeResolver(key), map[key]);
  }
  return builder.build();
};
