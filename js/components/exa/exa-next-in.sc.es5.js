/*! Built with http://stenciljs.com */
exa.loadBundle('exa-next-in', ['exports'], function (exports) {
    var h = window.exa.h;
    var ExaCommentsFootnotes = /** @class */ (function () {
        function ExaCommentsFootnotes() {
            this.imgLoaded = false;
        }
        ExaCommentsFootnotes.prototype.componentDidLoad = function () {
            if (this.posts != null) {
                return;
            }
            var wp = new WPAPI({ endpoint: exa.api_url });
            wp.posts().param('per_page', '4').then(this.loadDidFinish.bind(this)).catch(this.loadDidFail.bind(this));
        };
        ExaCommentsFootnotes.prototype.loadDidFinish = function (data) {
            this.posts = data;
            this.loadFeaturedMedia(this.posts[0]);
        };
        ExaCommentsFootnotes.prototype.loadDidFail = function (err) {
            console.log(err);
        };
        ExaCommentsFootnotes.prototype.loadFeaturedMedia = function (post) {
            if (!post.featured_media) {
                return;
            }
            var wp = new WPAPI({ endpoint: exa.api_url, });
            wp.media().id(post.featured_media).then(this.mediaLoadDidFinish.bind(this)).catch(this.mediaLoadDidFail.bind(this));
        };
        ExaCommentsFootnotes.prototype.mediaLoadDidFinish = function (data) {
            this.posts[0].imgsrc = data.media_details.sizes["post-thumbnail"].source_url;
            this.imgLoaded = true;
        };
        ExaCommentsFootnotes.prototype.mediaLoadDidFail = function (err) {
            console.log(err);
        };
        ExaCommentsFootnotes.prototype.render = function () {
            if (this.posts == null) {
                return;
            }
            return (h("div", null, h("h1", null, "Next in ", h("a", { href: this.url }, this.title)), h("ul", null, this.posts.map(function (post) { return h("li", null, h("exa-teaser", { imgsrc: post.imgsrc, url: post.link, title: post.title.rendered, subhead: post.subhead ? post.subhead : post.excerpt.rendered })); }))));
        };
        Object.defineProperty(ExaCommentsFootnotes, "is", {
            get: function () { return "exa-next-in"; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaCommentsFootnotes, "encapsulation", {
            get: function () { return "shadow"; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaCommentsFootnotes, "properties", {
            get: function () { return { "imgLoaded": { "state": true }, "postid": { "type": String, "attr": "postid" }, "posts": { "state": true }, "tag_id": { "type": String, "attr": "tag_id" }, "title": { "type": String, "attr": "title" }, "url": { "type": String, "attr": "url" } }; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(ExaCommentsFootnotes, "style", {
            get: function () { return "\@charset \"UTF-8\";\n*[data-exa-next-in], *[data-exa-next-in]:before, *[data-exa-next-in]:after {\n  box-sizing: inherit; }\n\n\n\n\n\n\nh1[data-exa-next-in] {\n  font-family: \"Noto Serif\", Oalatino, Georgia, Serif;\n  font-style: italic;\n  font-size: 36px;\n  margin-bottom: 0px; }\n  h1[data-exa-next-in]   a[data-exa-next-in] {\n    color: #3c74b9;\n    text-decoration: none; }\n    h1[data-exa-next-in]   a[data-exa-next-in]:hover {\n      color: #191919; }\n\nh2[data-exa-next-in] {\n  font-family: \"PT Sans Narrow\", Helvetica, Arial, Sans-Serif;\n  font-style: italic;\n  font-size: 36px; }\n  h2[data-exa-next-in]   a[data-exa-next-in] {\n    color: #3c74b9; }\n    h2[data-exa-next-in]   a[data-exa-next-in]:hover {\n      color: #191919; }\n\nul[data-exa-next-in] {\n  list-style: none;\n  margin: 0;\n  margin-top: 0px;\n  padding: 0; }\n  ul[data-exa-next-in]   li[data-exa-next-in] {\n    color: #191919;\n    border-top: 1px solid #c7d0d5;\n    padding: 18px 0 3px; }\n\n\@media (min-width: 760px) {\n  h1[data-exa-next-in] {\n    font-family: \"noto serif\";\n    font-style: italic;\n    font-size: 42px; }\n  ul[data-exa-next-in] {\n    margin-top: 18px;\n    border-top: 1px solid #c7d0d5; }\n    ul[data-exa-next-in]   li[data-exa-next-in] {\n      width: 380px;\n      margin: 0;\n      position: relative;\n      top: -1px; }\n  ul[data-exa-next-in]   li[data-exa-next-in]:first-child {\n    float: right;\n    width: 300px; } }\n\n\@media (min-width: 1060px) {\n  ul[data-exa-next-in] {\n    max-width: 680px; }\n  ul[data-exa-next-in]   li[data-exa-next-in] {\n    width: 300px; } }\n\n\@media (min-width: 1220px) {\n  ul[data-exa-next-in] {\n    max-width: 780px; }\n  ul[data-exa-next-in]   li[data-exa-next-in] {\n    width: 380px; } }"; },
            enumerable: true,
            configurable: true
        });
        return ExaCommentsFootnotes;
    }());
    exports.ExaNextIn = ExaCommentsFootnotes;
    Object.defineProperty(exports, '__esModule', { value: true });
});
