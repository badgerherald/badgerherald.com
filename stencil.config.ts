import { Config } from '@stencil/core'
import { sass } from '@stencil/sass'

export const config: Config = {
  namespace: 'badgerherald',
  outputTargets: [
    {
      type: 'www',
      serviceWorker: null,
      buildDir: 'app',
      dir:'wp-content/themes/badgerherald.com/',
      copy: [
        { src: 'style.css' },
        { src: 'style.css.map' },
        { src: '**/*.php' },
        { src: 'js/' },
        { src: 'blocks/' },
        { src: 'assets/' },
        { src: 'theme-definition.json' },
        { src: '../node_modules/@webpress/core/dist/collection/theme-overlay/functions.php', dest: 'functions.php'},
        { src: '../node_modules/@webpress/core/dist/collection/theme-overlay/etc', dest: 'etc'},
        { src: '../node_modules/@badgerherald/donate/dist/collection/functions.php', dest: 'functions/donate.php'},
        { src: '../node_modules/@badgerherald/donate/dist/collection/lib/', dest: 'functions/lib'}
      ]
    }
  ],
  plugins: [ 
    sass({ injectGlobalPaths: ["src/global/sass/foundations.scss"] })
  ]
};
