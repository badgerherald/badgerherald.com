jQuery(document).ready(function($) {
    $("a.author-media").click(function(event) {
        event.preventDefault();
        var media_data = {
            'action': 'hrld_media_credit_query',
            'posts_per': -1,
            'offset': 0,
            'user_nicename': hrld_author.user_nicename
        }
        $(".author-posts-block").css({'visibility':'hidden'});
        $(".author-info").after($('<div class="block loading-block"><p class="wrapper">Loading...</p></div>'))
        $.post(hrld_author.ajaxurl, media_data)
            .done(function(response) {
                console.log(response);
                $(".author-posts-block").css({'display':'none'});
                $(".author-posts-block").css({'visibility':'visible'});
                $(".loading-block").remove();
                $(".author-info").after($('<div class="block media-thumb-block"><div class="wrapper"></div></div>'))
                for (var i in response) {
                    if(response.hasOwnProperty(i)) {
                        $(".media-thumb-block .wrapper").append(response[i].tag);
                    }
                }
            })
            .fail(function(response) {
                console.log("Post failed: " + response);
            });
    });
});