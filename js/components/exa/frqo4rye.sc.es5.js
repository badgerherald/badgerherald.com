/*! Built with http://stenciljs.com */
var __extends=this&&this.__extends||function(){var e=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(e,t){e.__proto__=t}||function(e,t){for(var r in t)t.hasOwnProperty(r)&&(e[r]=t[r])};return function(t,r){function n(){this.constructor=t}e(t,r),t.prototype=null===r?Object.create(r):(n.prototype=r.prototype,new n)}}();exa.loadBundle("frqo4rye",["exports"],function(e){var t,r=window.exa.h,n=function(){function e(){}return e.prototype.render=function(){console.log("here");var e=u.socialServices(this.shareurl,this.shareheadline);return r("div",null,r("exa-publish-time-meta",{published:"March 04, 2018 21:24:00",modified:"March 10, 2018 02:24:00"}),r("ul",null,e.map(function(e){return r("li",null,r("exa-social-button",{shareurl:e.shareurl,title:e.name,classname:e.classname,description:""}))})))},Object.defineProperty(e,"is",{get:function(){return"exa-footnotes"},enumerable:!0,configurable:!0}),Object.defineProperty(e,"encapsulation",{get:function(){return"shadow"},enumerable:!0,configurable:!0}),Object.defineProperty(e,"properties",{get:function(){return{post:{state:!0},postid:{type:String,attr:"postid"},shareheadline:{type:String,attr:"shareheadline"},shareurl:{type:String,attr:"shareurl"}}},enumerable:!0,configurable:!0}),Object.defineProperty(e,"style",{get:function(){return"ul[data-exa-footnotes]{list-style-type:none;padding:0;margin-bottom:60px}li[data-exa-footnotes]{margin-right:10px;display:inline}exa-publish-time-meta[data-exa-footnotes]   div[data-exa-footnotes]{margin-top:24px}"},enumerable:!0,configurable:!0}),e}();!function(e){e[e.Facebook=0]="Facebook",e[e.Twitter=1]="Twitter"}(t||(t={}));var i=function(){function e(e,t){this.articleUrl=e,this.shareheadline=t}return Object.defineProperty(e,"is",{get:function(){return"exa-footnotes"},enumerable:!0,configurable:!0}),Object.defineProperty(e,"encapsulation",{get:function(){return"shadow"},enumerable:!0,configurable:!0}),Object.defineProperty(e,"properties",{get:function(){return{post:{state:!0},postid:{type:String,attr:"postid"},shareheadline:{type:String,attr:"shareheadline"},shareurl:{type:String,attr:"shareurl"}}},enumerable:!0,configurable:!0}),Object.defineProperty(e,"style",{get:function(){return"/**style-placeholder:exa-footnotes:**/"},enumerable:!0,configurable:!0}),e}(),o=function(e){function t(t,r){var n=e.call(this,t,r)||this;return n.name="Share",n.classname="facebook",n.shareurl="http://facebook.com/",n.fbShareUrl="https://www.facebook.com/sharer/sharer.php",n.shareurl=n.fbShareUrl+"?u="+n.articleUrl,n}return __extends(t,e),Object.defineProperty(t,"is",{get:function(){return"exa-footnotes"},enumerable:!0,configurable:!0}),Object.defineProperty(t,"encapsulation",{get:function(){return"shadow"},enumerable:!0,configurable:!0}),Object.defineProperty(t,"properties",{get:function(){return{post:{state:!0},postid:{type:String,attr:"postid"},shareheadline:{type:String,attr:"shareheadline"},shareurl:{type:String,attr:"shareurl"}}},enumerable:!0,configurable:!0}),Object.defineProperty(t,"style",{get:function(){return"/**style-placeholder:exa-footnotes:**/"},enumerable:!0,configurable:!0}),t}(i),a=function(e){function t(t,r){var n=e.call(this,t,r)||this;return n.name="Tweet",n.classname="twitter",n.shareurl="http://twitter.com/",n.webIntentUrl="https://twitter.com/intent/tweet",n.shareurl=n.webIntentUrl+"?text="+n.shareheadline+"&url="+n.articleUrl,n}return __extends(t,e),Object.defineProperty(t,"is",{get:function(){return"exa-footnotes"},enumerable:!0,configurable:!0}),Object.defineProperty(t,"encapsulation",{get:function(){return"shadow"},enumerable:!0,configurable:!0}),Object.defineProperty(t,"properties",{get:function(){return{post:{state:!0},postid:{type:String,attr:"postid"},shareheadline:{type:String,attr:"shareheadline"},shareurl:{type:String,attr:"shareurl"}}},enumerable:!0,configurable:!0}),Object.defineProperty(t,"style",{get:function(){return"/**style-placeholder:exa-footnotes:**/"},enumerable:!0,configurable:!0}),t}(i),u=function(){function e(){}return e.socialServices=function(r,n){var i=e.socialService(t.Twitter,r,n);return[e.socialService(t.Facebook,r,n),i]},e.socialService=function(e,r,n){switch(e){case t.Facebook:return new o(r,n);case t.Twitter:return new a(r,n)}},Object.defineProperty(e,"is",{get:function(){return"exa-footnotes"},enumerable:!0,configurable:!0}),Object.defineProperty(e,"encapsulation",{get:function(){return"shadow"},enumerable:!0,configurable:!0}),Object.defineProperty(e,"properties",{get:function(){return{post:{state:!0},postid:{type:String,attr:"postid"},shareheadline:{type:String,attr:"shareheadline"},shareurl:{type:String,attr:"shareurl"}}},enumerable:!0,configurable:!0}),Object.defineProperty(e,"style",{get:function(){return"/**style-placeholder:exa-footnotes:**/"},enumerable:!0,configurable:!0}),e}(),s=function(){function e(){this.imgLoaded=!1,this.teasers=new Map}return e.prototype.componentDidLoad=function(){if(null==this.posts){var e=new WPAPI({endpoint:exa.api_url});e.menus=e.registerRoute("wp-api-menus/v2","/menus/(?P<id>)"),e.menus().id(418).then(this.loadDidFinish.bind(this)).catch(this.loadDidFail.bind(this))}},e.prototype.loadDidFinish=function(e){this.menu=e},e.prototype.loadDidFail=function(e){console.log(e)},e.prototype.render=function(){if(null!=this.menu)return r("menu",null,this.menu.items.map(function(e){return r("exa-menu-item",{url:e.url,title:e.title,childmenuitems:e.children,category:e.object_id})}))},Object.defineProperty(e,"is",{get:function(){return"exa-menu"},enumerable:!0,configurable:!0}),Object.defineProperty(e,"encapsulation",{get:function(){return"shadow"},enumerable:!0,configurable:!0}),Object.defineProperty(e,"properties",{get:function(){return{imgLoaded:{state:!0},menu:{state:!0},postid:{type:String,attr:"postid"},posts:{state:!0},tag_id:{type:String,attr:"tag_id"},teasers:{state:!0},title:{type:String,attr:"title"},url:{type:String,attr:"url"}}},enumerable:!0,configurable:!0}),Object.defineProperty(e,"style",{get:function(){return"\@charset \"UTF-8\";menu[data-exa-menu]{list-style-type:none;padding:0;font-family:\"PT Sans Narrow\",Helvetica,Arial,Sans-Serif;line-height:36px;font-size:24px;margin:18px 0}menu[data-exa-menu]   li[data-exa-menu]{float:left}"},enumerable:!0,configurable:!0}),e}();e.ExaFootnotes=n,e.ExaMenu=s,Object.defineProperty(e,"__esModule",{value:!0})});