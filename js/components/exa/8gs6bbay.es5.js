/*! Built with http://stenciljs.com */
exa.loadBundle("8gs6bbay",["exports"],function(e){var t=window.exa.h,i=function(){function e(){this.imgLoaded=!1}return e.prototype.componentDidLoad=function(){null==this.posts&&new WPAPI({endpoint:exa.api_url}).posts().param("per_page","4").then(this.loadDidFinish.bind(this)).catch(this.loadDidFail.bind(this))},e.prototype.loadDidFinish=function(e){this.posts=e,this.loadFeaturedMedia(this.posts[0])},e.prototype.loadDidFail=function(e){console.log(e)},e.prototype.loadFeaturedMedia=function(e){e.featured_media&&new WPAPI({endpoint:exa.api_url}).media().id(e.featured_media).then(this.mediaLoadDidFinish.bind(this)).catch(this.mediaLoadDidFail.bind(this))},e.prototype.mediaLoadDidFinish=function(e){this.posts[0].imgsrc=e.media_details.sizes["post-thumbnail"].source_url,this.imgLoaded=!0},e.prototype.mediaLoadDidFail=function(e){console.log(e)},e.prototype.render=function(){if(null!=this.posts)return t("div",null,t("h1",null,"Next in ",t("a",{href:this.url},this.title)),t("ul",null,this.posts.map(function(e){return t("li",null,t("exa-teaser",{imgsrc:e.imgsrc,url:e.link,title:e.title.rendered,subhead:e.subhead?e.subhead:e.excerpt.rendered}))})))},Object.defineProperty(e,"is",{get:function(){return"exa-next-in"},enumerable:!0,configurable:!0}),Object.defineProperty(e,"encapsulation",{get:function(){return"shadow"},enumerable:!0,configurable:!0}),Object.defineProperty(e,"properties",{get:function(){return{imgLoaded:{state:!0},postid:{type:String,attr:"postid"},posts:{state:!0},tag_id:{type:String,attr:"tag_id"},title:{type:String,attr:"title"},url:{type:String,attr:"url"}}},enumerable:!0,configurable:!0}),Object.defineProperty(e,"style",{get:function(){return"\@charset \"UTF-8\";h1{font-family:\"Noto Serif\",Oalatino,Georgia,Serif;font-style:italic;font-size:36px;margin-bottom:0}h1 a{color:#3c74b9;text-decoration:none}h1 a:hover{color:#191919}h2{font-family:\"PT Sans Narrow\",Helvetica,Arial,Sans-Serif;font-style:italic;font-size:36px}h2 a{color:#3c74b9}h2 a:hover{color:#191919}ul{list-style:none;margin:0;margin-top:0;padding:0}ul li{color:#191919;border-top:1px solid #c7d0d5;padding:18px 0 3px}\@media (min-width:760px){h1{font-family:\"noto serif\";font-style:italic;font-size:42px}ul{margin-top:18px;border-top:1px solid #c7d0d5}ul li{width:380px;margin:0;position:relative;top:-1px}ul li:first-child{float:right;width:300px}}\@media (min-width:1060px){ul{max-width:680px}ul li{width:300px}}\@media (min-width:1220px){ul{max-width:780px}ul li{width:380px}}"},enumerable:!0,configurable:!0}),e}();e.ExaNextIn=i,Object.defineProperty(e,"__esModule",{value:!0})});