!function(){"use strict";var e={417:function(e,t,n){var o=this&&this.__assign||function(){return(o=Object.assign||function(e){for(var t,n=1,o=arguments.length;n<o;n++)for(var r in t=arguments[n])Object.prototype.hasOwnProperty.call(t,r)&&(e[r]=t[r]);return e}).apply(this,arguments)};Object.defineProperty(t,"__esModule",{value:!0});var r=n(997),i=n(521),a=n(804),u=n(804),c=n(799),s=n(791);function d(e){var t=e.isVideo,n=e.videoUrl,o=e.onSetIsVideo,i=e.onSetVideoUrl;return a.createElement(a.Fragment,null,a.createElement(r.CheckboxControl,{label:"Replace with YouTube Video?",checked:t,onChange:o}),t&&a.createElement(r.TextControl,{value:n,onChange:i}))}(0,c.addFilter)("editor.PostFeaturedImage","webpress/featured-image-as-video",(0,i.createHigherOrderComponent)((function(e){return function(t){var n=(0,s.useEntityProp)("postType","post","meta"),r=n[0],i=n[1];return a.createElement(u.Fragment,null,a.createElement(e,o({},t)),a.createElement(d,{isVideo:r._featured_image_is_video,videoUrl:r._featured_image_video_url,onSetIsVideo:function(e){return i(Object.assign({},r,{_featured_image_is_video:e}))},onSetVideoUrl:function(e){i(Object.assign({},r,{_featured_image_video_url:e}))}}))}}),"webpress/featured-image-as-video"))},708:function(e,t,n){var o=this&&this.__createBinding||(Object.create?function(e,t,n,o){void 0===o&&(o=n),Object.defineProperty(e,o,{enumerable:!0,get:function(){return t[n]}})}:function(e,t,n,o){void 0===o&&(o=n),e[o]=t[n]}),r=this&&this.__exportStar||function(e,t){for(var n in e)"default"===n||Object.prototype.hasOwnProperty.call(t,n)||o(t,e,n)};Object.defineProperty(t,"__esModule",{value:!0}),r(n(417),t)},804:function(e){e.exports=window.React},997:function(e){e.exports=window.wp.components},521:function(e){e.exports=window.wp.compose},791:function(e){e.exports=window.wp.coreData},799:function(e){e.exports=window.wp.hooks}},t={};!function n(o){var r=t[o];if(void 0!==r)return r.exports;var i=t[o]={exports:{}};return e[o].call(i.exports,i,i.exports,n),i.exports}(708)}();
//# sourceMappingURL=index.js.map