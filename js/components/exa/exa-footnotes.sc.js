/*! Built with http://stenciljs.com */
const{h:t}=window.exa;class e{render(){console.log("here");const e=o.socialServices(this.shareurl,this.shareheadline);return t("div",null,t("exa-publish-time-meta",{published:"March 04, 2018 21:24:00",modified:"March 10, 2018 02:24:00"}),t("ul",null,e.map(e=>t("li",null,t("exa-social-button",{shareurl:e.shareurl,title:e.name,classname:e.classname,description:""})))))}static get is(){return"exa-footnotes"}static get encapsulation(){return"shadow"}static get properties(){return{post:{state:!0},postid:{type:String,attr:"postid"},shareheadline:{type:String,attr:"shareheadline"},shareurl:{type:String,attr:"shareurl"}}}static get style(){return"ul[data-exa-footnotes]{list-style-type:none;padding:0;margin-bottom:60px}li[data-exa-footnotes]{margin-right:10px;display:inline}exa-publish-time-meta[data-exa-footnotes]   div[data-exa-footnotes]{margin-top:24px}"}}var s;!function(t){t[t.Facebook=0]="Facebook",t[t.Twitter=1]="Twitter"}(s||(s={}));class a{constructor(t,e){this.articleUrl=t,this.shareheadline=e}static get is(){return"exa-footnotes"}static get encapsulation(){return"shadow"}static get properties(){return{post:{state:!0},postid:{type:String,attr:"postid"},shareheadline:{type:String,attr:"shareheadline"},shareurl:{type:String,attr:"shareurl"}}}static get style(){return"/**style-placeholder:exa-footnotes:**/"}}class r extends a{constructor(t,e){super(t,e),this.name="Share",this.classname="facebook",this.shareurl="http://facebook.com/",this.fbShareUrl="https://www.facebook.com/sharer/sharer.php",this.shareurl=this.fbShareUrl+"?u="+this.articleUrl}static get is(){return"exa-footnotes"}static get encapsulation(){return"shadow"}static get properties(){return{post:{state:!0},postid:{type:String,attr:"postid"},shareheadline:{type:String,attr:"shareheadline"},shareurl:{type:String,attr:"shareurl"}}}static get style(){return"/**style-placeholder:exa-footnotes:**/"}}class i extends a{constructor(t,e){super(t,e),this.name="Tweet",this.classname="twitter",this.shareurl="http://twitter.com/",this.webIntentUrl="https://twitter.com/intent/tweet",this.shareurl=this.webIntentUrl+"?text="+this.shareheadline+"&url="+this.articleUrl}static get is(){return"exa-footnotes"}static get encapsulation(){return"shadow"}static get properties(){return{post:{state:!0},postid:{type:String,attr:"postid"},shareheadline:{type:String,attr:"shareheadline"},shareurl:{type:String,attr:"shareurl"}}}static get style(){return"/**style-placeholder:exa-footnotes:**/"}}class o{static socialServices(t,e){var a=o.socialService(s.Twitter,t,e);return[o.socialService(s.Facebook,t,e),a]}static socialService(t,e,a){switch(t){case s.Facebook:return new r(e,a);case s.Twitter:return new i(e,a)}}static get is(){return"exa-footnotes"}static get encapsulation(){return"shadow"}static get properties(){return{post:{state:!0},postid:{type:String,attr:"postid"},shareheadline:{type:String,attr:"shareheadline"},shareurl:{type:String,attr:"shareurl"}}}static get style(){return"/**style-placeholder:exa-footnotes:**/"}}class n{constructor(){this.imgLoaded=!1}componentDidLoad(){null==this.posts&&new WPAPI({endpoint:exa.api_url}).posts().param("per_page","4").then(this.loadDidFinish.bind(this)).catch(this.loadDidFail.bind(this))}loadDidFinish(t){this.posts=t,console.log(this.posts),console.log("sup!"),this.loadFeaturedMedia(this.posts[0])}loadDidFail(t){console.log(t)}loadFeaturedMedia(t){t.featured_media?(console.log(t.featured_media),new WPAPI({endpoint:exa.api_url}).media().id(t.featured_media).then(this.mediaLoadDidFinish.bind(this)).catch(this.mediaLoadDidFail.bind(this))):console.log(t.featured_media)}mediaLoadDidFinish(t){this.posts[0].imgsrc=t.media_details.sizes["post-thumbnail"].source_url,this.imgLoaded=!0}mediaLoadDidFail(t){console.log(t)}handleExpandClick(t){console.log(t)}render(){if(console.log(this.posts),null!=this.posts)return t("div",null,t("h1",null,"Next in ",t("a",{href:this.url},this.title)),t("ul",null,this.posts.map(e=>t("li",null,t("exa-next-in-post",{imgsrc:e.imgsrc,url:e.link,title:e.title.rendered,subhead:e.subhead?e.subhead:e.excerpt.rendered})))))}static get is(){return"exa-next-in"}static get encapsulation(){return"shadow"}static get properties(){return{imgLoaded:{state:!0},postid:{type:String,attr:"postid"},posts:{state:!0},tag_id:{type:String,attr:"tag_id"},title:{type:String,attr:"title"},url:{type:String,attr:"url"}}}static get style(){return"\@charset \"UTF-8\";h1[data-exa-next-in]{font-family:\"Noto Serif\",Oalatino,Georgia,Serif;font-style:italic;font-size:36px;margin-bottom:0}h1[data-exa-next-in]   a[data-exa-next-in]{color:#3c74b9;text-decoration:none}h1[data-exa-next-in]   a[data-exa-next-in]:hover{color:#191919}h2[data-exa-next-in]{font-family:\"PT Sans Narrow\",Helvetica,Arial,Sans-Serif;font-style:italic;font-size:36px}h2[data-exa-next-in]   a[data-exa-next-in]{color:#3c74b9}h2[data-exa-next-in]   a[data-exa-next-in]:hover{color:#191919}ul[data-exa-next-in]{list-style:none;margin:0;margin-top:0;padding:0}ul[data-exa-next-in]   li[data-exa-next-in]{color:#191919;border-top:1px solid #c7d0d5;padding:18px 0 3px}\@media (min-width:760px){h1[data-exa-next-in]{font-family:\"noto serif\";font-style:italic;font-size:42px}ul[data-exa-next-in]{margin-top:18px;border-top:1px solid #c7d0d5}ul[data-exa-next-in]   li[data-exa-next-in]{width:380px;margin:0;position:relative;top:-1px}ul[data-exa-next-in]   li[data-exa-next-in]:first-child{float:right;width:300px}}\@media (min-width:1060px){ul[data-exa-next-in]{max-width:680px}ul[data-exa-next-in]   li[data-exa-next-in]{width:300px}}\@media (min-width:1220px){ul[data-exa-next-in]{max-width:780px}ul[data-exa-next-in]   li[data-exa-next-in]{width:380px}}"}}export{e as ExaFootnotes,n as ExaNextIn};