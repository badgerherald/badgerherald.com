import { Config } from "@stencil/core";
import { sass } from "@stencil/sass";

export const config: Config = {
  namespace: "badgerherald",
  outputTargets: [
    {
      type: "www",
      serviceWorker: null,
      buildDir: "app",
      dir: "bin/wp-content/themes/badgerherald.com/",
      copy: [
        { src: "theme/", dest: "" },
        { src: "media-kit/", dest: "./../../../media-kit" },
        {
          src: "../node_modules/@webpress/core/dist/collection/theme-overlay/functions.php",
          dest: "functions.php",
        },
        {
          src: "../node_modules/@webpress/core/dist/collection/theme-overlay/etc",
          dest: "etc",
        },
        {
          src: "../node_modules/@badgerherald/donate/dist/donate/functions",
          dest: "etc",
        },
        {
          src: "../node_modules/@broadsheet.technology/analytics-bridge/dist/analytics-bridge/functions",
          dest: "etc/",
        },
      ],
    },
    {
      type: "stats",
      file: "bin/stencil-stats.json",
    },
  ],
  plugins: [sass({ injectGlobalPaths: ["src/global/sass/foundations.scss"] })],
};
