/*! Built with http://stenciljs.com */
const{h:t}=window.exa;class e{render(){console.log("here");const e=n.socialServices(this.shareurl,this.shareheadline);return t("div",null,t("exa-publish-time-meta",{published:"March 04, 2018 21:24:00",modified:"March 10, 2018 02:24:00"}),t("ul",null,e.map(e=>t("li",null,t("exa-social-button",{shareurl:e.shareurl,title:e.name,classname:e.classname,description:""})))))}static get is(){return"exa-footnotes"}static get encapsulation(){return"shadow"}static get properties(){return{post:{state:!0},postid:{type:String,attr:"postid"},shareheadline:{type:String,attr:"shareheadline"},shareurl:{type:String,attr:"shareurl"}}}static get style(){return"ul{list-style-type:none;padding:0;margin-bottom:60px}li{margin-right:10px;display:inline}exa-publish-time-meta div{margin-top:24px}"}}var s;!function(t){t[t.Facebook=0]="Facebook",t[t.Twitter=1]="Twitter"}(s||(s={}));class r{constructor(t,e){this.articleUrl=t,this.shareheadline=e}static get is(){return"exa-footnotes"}static get encapsulation(){return"shadow"}static get properties(){return{post:{state:!0},postid:{type:String,attr:"postid"},shareheadline:{type:String,attr:"shareheadline"},shareurl:{type:String,attr:"shareurl"}}}static get style(){return"/**style-placeholder:exa-footnotes:**/"}}class a extends r{constructor(t,e){super(t,e),this.name="Share",this.classname="facebook",this.shareurl="http://facebook.com/",this.fbShareUrl="https://www.facebook.com/sharer/sharer.php",this.shareurl=this.fbShareUrl+"?u="+this.articleUrl}static get is(){return"exa-footnotes"}static get encapsulation(){return"shadow"}static get properties(){return{post:{state:!0},postid:{type:String,attr:"postid"},shareheadline:{type:String,attr:"shareheadline"},shareurl:{type:String,attr:"shareurl"}}}static get style(){return"/**style-placeholder:exa-footnotes:**/"}}class i extends r{constructor(t,e){super(t,e),this.name="Tweet",this.classname="twitter",this.shareurl="http://twitter.com/",this.webIntentUrl="https://twitter.com/intent/tweet",this.shareurl=this.webIntentUrl+"?text="+this.shareheadline+"&url="+this.articleUrl}static get is(){return"exa-footnotes"}static get encapsulation(){return"shadow"}static get properties(){return{post:{state:!0},postid:{type:String,attr:"postid"},shareheadline:{type:String,attr:"shareheadline"},shareurl:{type:String,attr:"shareurl"}}}static get style(){return"/**style-placeholder:exa-footnotes:**/"}}class n{static socialServices(t,e){var r=n.socialService(s.Twitter,t,e);return[n.socialService(s.Facebook,t,e),r]}static socialService(t,e,r){switch(t){case s.Facebook:return new a(e,r);case s.Twitter:return new i(e,r)}}static get is(){return"exa-footnotes"}static get encapsulation(){return"shadow"}static get properties(){return{post:{state:!0},postid:{type:String,attr:"postid"},shareheadline:{type:String,attr:"shareheadline"},shareurl:{type:String,attr:"shareurl"}}}static get style(){return"/**style-placeholder:exa-footnotes:**/"}}class o{constructor(){this.imgLoaded=!1,this.teasers=new Map}componentDidLoad(){if(null==this.posts){var t=new WPAPI({endpoint:exa.api_url});t.menus=t.registerRoute("wp-api-menus/v2","/menus/(?P<id>)"),t.menus().id(418).then(this.loadDidFinish.bind(this)).catch(this.loadDidFail.bind(this))}}loadDidFinish(t){this.menu=t}loadDidFail(t){console.log(t)}render(){if(null!=this.menu)return t("menu",null,this.menu.items.map(e=>t("exa-menu-item",{url:e.url,title:e.title,childmenuitems:e.children,category:e.object_id})))}static get is(){return"exa-menu"}static get encapsulation(){return"shadow"}static get properties(){return{imgLoaded:{state:!0},menu:{state:!0},postid:{type:String,attr:"postid"},posts:{state:!0},tag_id:{type:String,attr:"tag_id"},teasers:{state:!0},title:{type:String,attr:"title"},url:{type:String,attr:"url"}}}static get style(){return"\@charset \"UTF-8\";menu{list-style-type:none;padding:0;font-family:\"PT Sans Narrow\",Helvetica,Arial,Sans-Serif;line-height:36px;font-size:24px;margin:18px 0}menu li{float:left}"}}export{e as ExaFootnotes,o as ExaMenu};