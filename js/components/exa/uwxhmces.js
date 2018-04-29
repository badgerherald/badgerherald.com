/*! Built with http://stenciljs.com */
const{h:e}=window.exa;import{ExaMenuDirection as t,ExaMenuLinkColor as n,ExaMenuFontSize as i}from"./chunk1.js";class s{constructor(){this.imgLoaded=!1}componentDidLoad(){if(null==this.menu){var e=new WPAPI({endpoint:exa.api_url});e.menus=e.registerRoute("wp-api-menus/v2","/menus/(?P<id>)"),e.menus().id(this.menuId).then(this.loadDidFinish.bind(this)).catch(this.loadDidFail.bind(this))}}loadDidFinish(e){this.menu=e}loadDidFail(e){console.log(e)}menuStyleClass(){switch(this.menuDirection){case t.Vertical:return"vertical";case t.Horizontal:return"horizontal"}}menuFontClass(){switch(this.menuFontSize){case i.Big:return"big";case i.Normal:return"normal"}}menuColorClass(){switch(this.menuLinkColor){case n.Black:return"black";case n.White:return"white";case n.Blue:return"blue"}}menuClasses(){return this.menuStyleClass()+" "+this.menuColorClass()+" "+this.menuFontClass()}render(){if(null!=this.menu)return e("menu",{class:this.menuClasses()},this.menu.items.map((t,n)=>e("exa-menu-item",{childmenuitems:t.children,debug:this.debug&&0==n,url:t.url,title:t.title,dropdownStyle:this.menuDropdown,category:t.object_id,iconClass:t.classes})))}static get is(){return"exa-menu"}static get properties(){return{debug:{type:Boolean,attr:"debug"},imgLoaded:{state:!0},menu:{state:!0},menuDirection:{type:"Any",attr:"menu-direction"},menuDropdown:{type:"Any",attr:"menu-dropdown"},menuFontSize:{type:"Any",attr:"menu-font-size"},menuId:{type:String,attr:"menu-id"},menuLinkColor:{type:"Any",attr:"menu-link-color"},tag_id:{type:String,attr:"tag_id"},title:{type:String,attr:"title"}}}static get style(){return"\@charset \"UTF-8\";*,:after,:before{box-sizing:inherit}menu{width:100%;list-style-type:none;font-family:\"PT Sans Narrow\",Helvetica,Arial,Sans-Serif;line-height:1.4em;padding:0;margin:0}menu.horizontal exa-menu-item>li{display:inline}menu exa-menu-item>li a{text-decoration:none}menu.horizontal exa-menu-item>li a{display:inline-block;padding-top:6px;padding-bottom:6px}menu.vertical exa-menu-item>li a{border-bottom:1px solid #eff4f6;display:block;padding:12px 0}menu.vertical exa-menu-item:first-child>li a{border-top:1px solid #eff4f6}menu exa-menu-item>li a{font-size:15px}menu.big exa-menu-item>li a{font-size:19px}menu.blue exa-menu-item>li a{color:#3c74b9}menu.blue exa-menu-item>li a:hover{color:#3a97f7}menu.black exa-menu-item>li a{color:#191919}menu li.social{min-height:54px;margin-right:10px;display:block}menu li.social a{margin-bottom:12px;width:34px;height:34px;display:inline;position:relative}menu li.social a:before{font-family:exa;font-size:24px;line-height:35px;color:#fff;text-align:center;width:100%;display:block;width:34px;height:34px;border-radius:2px}menu li.social.twitter a:before{content:\"t\";background:#0892e3}menu li.social.facebook a:before{content:\"f\";background:#425f9e}menu li.social.linkedin a:before{content:\"l\";background:#0078b6}menu li.social.instagram a:before{content:\"i\";background:#cd486b}\@media (min-width:760px){menu li.social{margin-right:0;margin-left:10px;position:relative;top:-3px}menu li.social a{width:24px;height:24px}menu li.social a:before{font-size:16px;line-height:26px;width:24px;height:24px}}\@media (min-width:1060px){menu.big exa-menu-item>li a{font-size:24px}menu exa-menu-item>li a{font-size:18px}}"}}class r{constructor(){this.active=!1}render(){return e("a",{class:this.active?"active":""},this.active?"Close":"Menu")}static get is(){return"exa-menu-button"}static get properties(){return{active:{type:Boolean,attr:"active"}}}static get style(){return"\@charset \"UTF-8\";*,:after,:before{box-sizing:inherit}exa-menu-button a{color:#3c74b9;padding:12px 10% 18px 6.66667%;font-size:24px;display:block;line-height:24px;font-family:\"PT Sans Narrow\",Helvetica,Arial,Sans-Serif;position:absolute;right:0;bottom:0;transition:bottom .2s;cursor:pointer;margin-right:-1.66667%}exa-menu-button a:hover{color:#3a97f7}exa-menu-button a:after{content:\"d\";font-size:12px;margin-left:5px;transition:transform .1s;font-family:exa;position:absolute}exa-menu-button a.active:after{margin-top:3px;transform:rotate(180deg)}exa-menu-button a.active{background:#fff;bottom:-6px}"}}class a{render(){return e("form",{class:"search",action:"/",method:"get"},e("input",{type:"text",name:"s",placeholder:"Search..."}),e("input",{type:"submit",value:"Submit"}))}static get is(){return"exa-search-form"}static get style(){return"\@charset \"UTF-8\";*,:after,:before{box-sizing:inherit}exa-search-form form.search{width:100%;position:relative;background:#eff4f6;padding:20px 5%;margin-top:30px}exa-search-form form.search input[type=text]{width:100%;padding:12px 3.33333%;padding-right:40px;font-family:\"PT Sans Narrow\",Helvetica,Arial,Sans-Serif;font-size:24px;outline:0;border:3px solid #eff4f6;transition:all .3s;font-size:20px}exa-search-form form.search input[type=text]::placeholder{color:#93a2aa}exa-search-form form.search input[type=text]:focus{color:#191919;border:3px solid #3c74b9}exa-search-form form.search:after{pointer-events:none;content:\"s\";font-family:exa;padding:4px 8px;position:absolute;top:32px;right:8.33333%;width:30px;height:30px;color:#3c74b9}exa-search-form form.search input[type=submit]{display:none}\@media (min-width:760px){exa-search-form form.search{background:0 0;padding:0;right:0;margin-top:0}exa-search-form form.search input[type=text]{bottom:-3px;top:inherit;position:absolute;right:0;width:36px;padding:6px 20px 6px 20px;border-radius:2px;margin-right:0;border:none}exa-search-form form.search input[type=text]::placeholder{color:transparent}exa-search-form form.search input[type=text]:focus{width:100%;border:none}exa-search-form form.search input[type=text]:focus::placeholder{color:#93a2aa}exa-search-form form.search:after{bottom:1px;right:7px;top:inherit;font-size:18px}}"}}export{s as ExaMenu,r as ExaMenuButton,a as ExaSearchForm};