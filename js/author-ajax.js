jQuery(document).ready(function($) {
    /**
     * Changes the view between posts and photos on author pages.
     *
     * @since  v0.2
     */
    $(".author-info a.switch-view-link").click(function(event) {
        event.preventDefault();
        if ($(".author-media-block").length === 0) {
            loadMedia();
        } else {
            $(".author-posts-block").toggleClass("hidden");
            $(".author-media-block").toggleClass("hidden");
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
        $("body").append($('<div class="loading-block"><div class="loader"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>'));
        var media_data = {
            'action': 'hrld_media_credit_query',
            'posts_per': -1,
            'offset': 0,
            'user_nicename': hrld_author.user_nicename
        }
        $.post(hrld_author.ajaxurl, media_data)
            .done(function(response) {
                $(".author-posts-block").addClass("hidden");
                $(".author-media-link").addClass("hidden");
                $(".author-posts-link").removeClass("hidden");
                $(".loading-block").remove();
                var media_block = '<div class="block author-media-block showcase-block">';
                media_block += '<div class="wrapper">';
                media_block += '<div class="media-list">';
                media_block += '</div></div></div>';
                $(".author-info").after($(media_block));
                var media_thumbs = '';
                for (var i in response) {
                    if(response.hasOwnProperty(i)) {
                        media_thumbs += '<div class="media-thumbnail">';
                        media_thumbs += response[i].tag;
                        media_thumbs += '</div> ';
                    }
                }
                $(".author-media-block .wrapper .media-list").append($(media_thumbs));
                $(".showcase-block").hrld_showcase({imgs: "img.wp-post-image, img[class*='wp-image-']"});
            })
            .fail(function(response) {
                console.log("Post failed: " + response);
            });
    }
});