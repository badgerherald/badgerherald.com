<?php 
/**
 * Functions to allow editors to
 * control post and page layout.
 * 
 * Currently, this enables video
 * functionality.
 *
 * @since v0.4
 */


/**
 * Register taxonomy for layout options.
 * 
 * @since v0.4
 */
function _exa_register_layout_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Layout', 'Taxonomy General Name', 'exa' ),
		'singular_name'              => _x( 'Layout', 'Taxonomy Singular Name', 'exa' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true, // turn of to disable admin ui. that's it!
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'query_var'                  => 'exa_layout',
	);
	register_taxonomy( 'exa_layout', array( 'post' ), $args );

}
add_action( 'init', '_exa_register_layout_taxonomy', 0 );


/**
 * Returns video link for the passed in post.
 * Currently the top link in the post.
 * 
 * @since v0.4
 */
function exa_video_link($post = null) {

	$post = get_post($post);

	/* Get the first youtube link within the post */

	$firstWord = preg_split('/\s+/', $post->post_content);

	if(_exa_is_youtube_link($firstWord[0])) {
		return $firstWord[0];
	} else {
		return null;
	}

}

/**
 * Filter out youtube links that start posts,
 * but only if that post is a video post.
 * 
 * @since v0.4
 */
function exa_filter_video_link($html) {

	if(!exa_is_video_post()) {
		return $html;
	}

	global $post;
	
	$graphs = preg_split('/\n+/', $html);
	array_shift($graphs);

	return implode("\n",$graphs);

}
add_filter('the_content','exa_filter_video_link',1);

/**
 * Returns true if the given link is a youtube embed.
 * 
 * @since v0.4
 */
function _exa_is_youtube_link($link) {

	$rx = array(	
			'#http://((m|www)\.)?youtube\.com/watch.*#i',
			'#https://((m|www)\.)?youtube\.com/watch.*#i',
			'#http://((m|www)\.)?youtube\.com/playlist.*#i',
			'#https://((m|www)\.)?youtube\.com/playlist.*#i',
			'#http://youtu\.be/.*#i',
			'#https://youtu\.be/.*#i'
		);
	
	foreach($rx as $r) {
		if(preg_match($r, $link, $matches))
			return true;
	}

	return false;

}


/**
 * Returns true if the given post is a video.
 * 
 * @since v0.4
 * 
 * @param mixed $post optional post id/object/&c.
 * @return boolean true if the post is a video post, false otherwise.
 */
function exa_is_video_post($post = null) {

	$post = get_post($post);
	return has_term('video','exa_layout');
}


/**
 * Returns a string of the selected layout.
 * 
 * @since v0.4
 * 
 * @param mixed $post optional post id/object/&c.
 * @return string layout option (e.g. 'cover','two-column')
 */
function exa_layout($post = null) {
	$post = get_post($post);
	$layout_terms = wp_get_post_terms($post->ID,'exa_layout');

	if(empty($layout_terms)) {
		return;
	} else {
		return $layout_terms[0]->slug;
	}
}

function exa_hero_media_type($post = null) {
	if(exa_video_link()) {
		return "video";
	} else {
		$hide_feature = get_post_meta($post, '_exa_hide_featured_image', true);
		if ( has_post_thumbnail() && !($hide_feature == "true")) {
			return "image";
		}
	}
	return "";
}

