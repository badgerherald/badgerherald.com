jQuery(document).ready(function($) {
    /**
     * Changes the view between posts and photos on author pages.
     *
     * @since  v0.2
     */
    $(".author-info a.switch-view-link").click(function(event) {
        event.preventDefault();
        if ($(".author-media-container").length === 0) {
            loadMedia();
        } else {
            $(".author-posts-container").toggleClass("hidden");
            $(".author-media-container").toggleClass("hidden");
            $(".author-media-link").toggleClass("hidden");
            $(".author-posts-link").toggleClass("hidden");
        }
    });
    
    /**
     * Loads author media with ajax and cahnges to its view
     *
     * @since  v0.2
     */
    var loadMedia = function() {
        $("body").append($('<div class="loading-container"><div class="loader"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>'));
        var media_data = {
            'action': 'hrld_media_credit_query',
            'posts_per': -1,
            'offset': 0,
            'user_nicename': hrld_author.user_nicename
        }
        $.post(hrld_author.ajaxurl, media_data)
            .done(function(response) {
                $(".author-posts-container").addClass("hidden");
                $(".author-media-link").addClass("hidden");
                $(".author-posts-link").removeClass("hidden");
                $(".loading-container").remove();
                var media_container = '<div class="container author-media-container showcase-container">';
                media_container += '<div class="wrapper">';
                media_container += '<div class="media-list">';
                media_container += '</div></div></div>';
                $(".author-info").after($(media_container));
                var media_thumbs = '';
                for (var i in response) {
                    if(response.hasOwnProperty(i)) {
                        media_thumbs += '<div class="media-thumbnail">';
                        media_thumbs += response[i].tag;
                        media_thumbs += '</div> ';
                    }
                }
                $(".author-media-container .wrapper .media-list").append($(media_thumbs));
                $($.fn.showcase.defaults.container).showcase({
                    slideHtml: function(img) {
                        var html = '';
                            var hasCaption = '';
                            if (img.caption === "" && img.media_credit === "") {
                                hasCaption = ' no-caption';
                            }
                            html += '<div class="showcase-slide' + hasCaption + '">';
                            html += '<div class="showcase-img" style="width:' + img.width + 'px; height:' + img.height + 'px;">';
                            html += '<img src="' + img.src + '" alt="' + img.alt + '" title="' + img.title + '" />';
                            html += '</div>';
                            if (hasCaption === '') {
                                html += '<div class="showcase-content">';
                                html += '<div class="showcase-caption">' + img.caption;
                                html += '<div class="showcase-credit">' + img.media_credit + '</div>';
                                html += '</div>';
                                html += '</div>';                    
                            }
                            html += '</div>';
                            return html;
                    }
                });
            })
            .fail(function(response) {
                console.log("Post failed: " + response);
            });
    }
});