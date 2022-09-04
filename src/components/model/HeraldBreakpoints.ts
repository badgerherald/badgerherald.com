export enum HeraldBreakpoint {
  mobile = "mobile",
  mobilexl = "mobilexl",
  tablet = "tablet",
  desktop = "desktop",
  desktopxl = "desktopxl",
}

export namespace HeraldBreakpoint {
  export const maxWidth = (breakpoint: HeraldBreakpoint): number => {
    switch (breakpoint) {
      case HeraldBreakpoint.mobile:
        return 300;
      case HeraldBreakpoint.mobilexl:
        return 620;
      case HeraldBreakpoint.tablet:
        return 930;
      case HeraldBreakpoint.desktop:
        return 1240;
      case HeraldBreakpoint.desktopxl:
        return 1580;
    }
  };

  export const startingWidth = (breakpoint: HeraldBreakpoint): number => {
    switch (breakpoint) {
      case HeraldBreakpoint.mobile:
        return 1;
      case HeraldBreakpoint.mobilexl:
        return 301;
      case HeraldBreakpoint.tablet:
        return 621;
      case HeraldBreakpoint.desktop:
        return 931;
      case HeraldBreakpoint.desktopxl:
        return 1241;
    }
  };

  export const minViewport = (breakpoint) => [startingWidth(breakpoint), 0];
}
