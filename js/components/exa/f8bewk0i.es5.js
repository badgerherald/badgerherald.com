/*! Built with http://stenciljs.com */
exa.loadBundle("f8bewk0i",["exports","./chunk1.js"],function(e,t){var i=window.exa.h,n=function(){function e(){this.posts=new Array,this.imgLoaded=!1}return e.prototype.loadFeaturedMedia=function(){var e=this;this.imgLoaded||this.posts&&this.posts.map(function(t){e.loadFeaturedMediaForPost(t)})},e.prototype.loadFeaturedMediaForPost=function(e){var t=this;e.featured_media&&!e.imgsrc&&(this.imgLoaded=!0,new WPAPI({endpoint:exa.api_url}).media().id(e.featured_media).then(function(i){return t.mediaLoadDidFinish(i,e)}).catch(this.mediaLoadDidFail.bind(this)))},e.prototype.mediaLoadDidFinish=function(e,t){t.imgsrc=e.media_details.sizes["post-thumbnail"]?e.media_details.sizes["post-thumbnail"].source_url:"",this.imgsrc=t.imgsrc},e.prototype.mediaLoadDidFail=function(e){console.log(e)},e.prototype.render=function(){return this.imgLoaded||this.loadFeaturedMedia(),i("div",null,i("h4",null,this.title),i("div",{class:"menu"},i("ul",null,this.menuItems.map(function(e){return i("li",null,i("a",{href:"#"},e.title))}))),i("ul",{class:"teasers"},this.posts.map(function(e){return i("li",null,i("exa-teaser",{imgsrc:e.imgsrc,url:e.link,title:e.title.rendered,subhead:e.subhead?e.subhead:e.excerpt.rendered}))})),i("div",{class:"clearfix"}))},Object.defineProperty(e,"is",{get:function(){return"exa-menu-dropdown"},enumerable:!0,configurable:!0}),Object.defineProperty(e,"properties",{get:function(){return{imgsrc:{state:!0},menuItems:{type:"Any",attr:"menu-items"},posts:{type:"Any",attr:"posts"},subhead:{type:String,attr:"subhead"},title:{type:String,attr:"title"},url:{type:String,attr:"url"}}},enumerable:!0,configurable:!0}),Object.defineProperty(e,"style",{get:function(){return"\@charset \"UTF-8\";*,:after,:before{box-sizing:inherit}exa-menu-dropdown>div{position:absolute;left:0;background:#fff;width:100%;padding-bottom:30px}exa-menu-dropdown>div .clearfix{clear:both}exa-menu-dropdown>div ul{list-style-type:none;margin:0;padding:0}exa-menu-dropdown>div h4{margin:10px 0 0;padding:0;font-size:24px;padding:10px 1.92308% 10px;border-bottom:1px solid #eff4f6}exa-menu-dropdown>div .menu{float:left;width:26.92308%;padding:10px 0}exa-menu-dropdown>div .menu ul{font-size:16px;line-height:1.8em}exa-menu-dropdown>div .menu ul li a{display:block;font-size:16px;padding:0 7.14286%;margin-right:7.14286%;border-bottom:1px solid #eff4f6;color:#191919}exa-menu-dropdown>div .menu ul li a:hover{color:#3c74b9}exa-menu-dropdown>div ul.teasers{max-width:100%;width:73.07692%;display:block;margin:0;float:left;font-size:18px}exa-menu-dropdown>div ul.teasers li{font-size:1em;float:right;padding:12px 3.84615%;border-bottom:1px solid #eff4f6;font-family:\"PT Sans Narrow\",Helvetica,Arial,Sans-Serif}exa-menu-dropdown>div ul.teasers li a{color:#191919}exa-menu-dropdown>div ul.teasers li a:hover{color:#3c74b9}exa-menu-dropdown>div ul.teasers li img{width:42.30769%;float:right;padding-left:10px}\@media (min-width:1060px){exa-menu-dropdown>div{max-width:720px}}"},enumerable:!0,configurable:!0}),e}(),r=function(){function e(){}return e.prototype.loadTeasers=function(){this.posts||this.category&&this.dropdownStyle==t.ExaMenuDropdownStyle.Teasers&&(console.log("hi"),new WPAPI({endpoint:exa.api_url}).posts().param("per_page","3").categories(this.category).then(this.teaserLoadDidFinish.bind(this)).catch(this.teaserLoadDidFail.bind(this)))},e.prototype.teaserLoadDidFinish=function(e){this.posts=e},e.prototype.teaserLoadDidFail=function(e){console.log(e)},e.prototype.hasDropdown=function(){return this.childmenuitems&&this.dropdownStyle!=t.ExaMenuDropdownStyle.None},e.prototype.renderDropdown=function(){if(this.hasDropdown())return this.loadTeasers(),i("exa-menu-dropdown",{posts:this.posts,menuItems:this.childmenuitems,title:this.title})},e.prototype.render=function(){var e=(this.hasDropdown()?"dropdown":"")+(this.debug?" debug":"")+(this.iconClass?" "+this.iconClass:"");return i("li",{class:e},i("a",{href:this.url},this.title),this.renderDropdown())},Object.defineProperty(e,"is",{get:function(){return"exa-menu-item"},enumerable:!0,configurable:!0}),Object.defineProperty(e,"properties",{get:function(){return{category:{type:Number,attr:"category"},childmenuitems:{type:"Any",attr:"childmenuitems"},debug:{type:Boolean,attr:"debug"},dropdownStyle:{type:"Any",attr:"dropdown-style"},iconClass:{type:String,attr:"icon-class"},posts:{state:!0},title:{type:String,attr:"title"},url:{type:String,attr:"url"}}},enumerable:!0,configurable:!0}),Object.defineProperty(e,"style",{get:function(){return"\@charset \"UTF-8\";*,:after,:before{box-sizing:inherit}exa-menu-item>li:not(.social)>a{padding:0 6px}exa-menu-item>li.dropdown>a{padding-right:22px}exa-menu-item>li.dropdown>a:after{content:\"d\";font-size:12px;padding-left:2px;transition:margin .1s;font-family:exa;position:absolute}exa-menu-item>li exa-menu-dropdown>div{visibility:hidden;transition:all .15s ease-in-out;margin-top:-6px}exa-menu-item>li.debug exa-menu-dropdown>div,exa-menu-item>li:hover exa-menu-dropdown>div{visibility:visible;margin-top:0;transition:all .2s ease-in-out;transition-delay:.15s}exa-menu-item>li.debug.dropdown a,exa-menu-item>li:hover.dropdown a{background:#fff}exa-menu-item>li.debug.dropdown a>a:after,exa-menu-item>li:hover.dropdown a>a:after{margin-top:3px}exa-menu-item>li.debug.dropdown a>ul,exa-menu-item>li:hover.dropdown a>ul{display:block;position:absolute;top:100%;min-width:200px;background:#fff;list-style-type:none;padding:12px;font-size:18px}exa-menu-item>li.debug.dropdown a>ul a,exa-menu-item>li:hover.dropdown a>ul a{color:#191919}exa-menu-item>li.debug.dropdown a>ul a:hover,exa-menu-item>li:hover.dropdown a>ul a:hover{color:#787878}"},enumerable:!0,configurable:!0}),e}();e.ExaMenuDropdown=n,e.ExaMenuItem=r,Object.defineProperty(e,"__esModule",{value:!0})});