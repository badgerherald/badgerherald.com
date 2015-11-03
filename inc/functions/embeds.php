<?php

/**
 * SSL for video embeds.
 */
function add_secure_video_options($html) {
   if (strpos($html, "<iframe" ) !== false) {
    	$search = array('src="http://www.youtu','src="http://youtu');
		$replace = array('src="https://www.youtu','src="https://youtu');
		$html = str_replace($search, $replace, $html);

   		return $html;
   } else {
        return $html;
   }
}
add_filter('the_content', 'add_secure_video_options', 10);

/**
 * Gets the first embeded video
 */
function get_first_embedded_video($post_id) {

    $post = get_post($post_id);
    $content = do_shortcode( apply_filters( 'the_content', $post->post_content ) );
    $embeds = get_media_embedded_in_content( $content );

    if( !empty($embeds) ) {
        //check what is the first embed containg video tag, youtube or vimeo
        foreach( $embeds as $embed ) {
            if( strpos( $embed, 'video' ) || strpos( $embed, 'youtube' ) ) {
                return $embed;
            }
        }

    } else {
        //No video embedded found
        return false;
    }

}