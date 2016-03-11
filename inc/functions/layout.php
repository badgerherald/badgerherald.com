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
		'show_ui'                    => false,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'query_var'                  => 'exa_layout',
	);
	register_taxonomy( 'exa_layout', array( 'post' ), $args );

}
add_action( 'init', '_exa_register_layout_taxonomy', 0 );


/**
 * Saves default layout terms before saving the post

function exa_default_layout_terms($post_id) {
  
	$layout_terms = get_the_terms( $post_id, 'exa_layout' );

	if(empty($layout_terms)) {

		wp_set_object_terms($post_id,array('hero-standard','media-image'),'exa_layout');
	}

}
add_action( 'save_post', 'exa_default_layout_terms' );
 */

/**
 * 
 */
function exa_toggle_feature_boxes(){
	add_meta_box( '_exa_hide_featured_image', __('Layout'), 'exa_toggle_feature_box', 'post', 'side', 'default');
}

function exa_toggle_feature_box($post) {
	
	// Hero stuff:
	echo "<p>Choose how the hero (feature media) displays with the post:</p>";
	echo "<hr/><h2 style='padding:0'>Hero Style</h2>";
	echo "<p>";

	if(exa_hero_style($post->ID) == "standard") {
		echo "<input type='radio' name='layout-hero' value='hero-standard' checked> Standard<br>";
		echo "<input type='radio' name='layout-hero' value='hero-cover'> Cover<br>";
	} else {
		echo "<input type='radio' name='layout-hero' value='hero-standard'> Standard<br>";
		echo "<input type='radio' name='layout-hero' value='hero-cover'checked> Cover<br>";
	}
	echo "</p>";
	
	echo "<hr/><h2 style='padding:0'>Media Type</h2>";
	echo "<p>";

	if(exa_hero_media($post->ID) == "none") {
		echo "<input type='radio' name='layout-media' value='media-image'> Image<br>";
		echo "<input type='radio' name='layout-media' value='media-video'> Video<br>";
		echo "<input type='radio' name='layout-media' value='media-none' checked> None<br>";
	} else if(exa_hero_media($post->ID) == "image") {
		echo "<input type='radio' name='layout-media' value='media-image' checked> Image<br>";
		echo "<input type='radio' name='layout-media' value='media-video'> Video<br>";
		echo "<input type='radio' name='layout-media' value='media-none'> None<br>";
	} else if(exa_hero_media($post->ID) == "video") {
		echo "<input type='radio' name='layout-media' value='media-image'> Image<br>";
		echo "<input type='radio' name='layout-media' value='media-video' checked> Video<br>";
		echo "<input type='radio' name='layout-media' value='media-none'> None<br>";
	}
	echo "</p>";

}

function exa_toggle_feature_save($post_id, $post){

	$hero_style = isset($_POST['layout-hero']) ? $_POST['layout-hero'] : 'hero-standard';
	$hero_media = isset($_POST['layout-media']) ? $_POST['layout-media'] : 'media-image'; 

	wp_set_object_terms($post_id,array($hero_style,$hero_media),'exa_layout');

}

function exa_toggle_feature_setup(){

	add_action( 'add_meta_boxes', 'exa_toggle_feature_boxes' );

	add_action( 'save_post', 'exa_toggle_feature_save');
	add_action( 'pre_post_update', 'exa_toggle_feature_save');
	add_action( 'edit_post', 'exa_toggle_feature_save');
	add_action( 'publish_post', 'exa_toggle_feature_save');
	add_action( 'edit_page_form', 'exa_toggle_feature_save');


}
add_action( 'load-post.php', 'exa_toggle_feature_setup' );
add_action( 'load-post-new.php', 'exa_toggle_feature_setup' );


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

	if( !(exa_hero_media() == "video" && exa_hero_style() == "cover") ) {
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
 * Returns a string of the selected layout.
 * 
 * @since v0.4
 * 
 * @param mixed $post optional post id/object/&c.
 * @return string layout option (feature or standard)
 */
function exa_layout($post = null) {

	$post = get_post($post);
	
	if(has_term('layout-feature','exa_layout',$post)) {
		return 'feature';
	} else {
		return 'standard';
	}

	/*
	$post = get_post($post);
	$layout_terms = wp_get_post_terms($post->ID,'exa_layout');
	if(empty($layout_terms)) {
		return;
	} else {
		return $layout_terms[0]->slug;
	}
	*/
}

function exa_hero_style($post = null) {

	$post = get_post($post);

	// handle the old format for hiding heros.
	$hide_feature = get_post_meta( $post->ID, '_exa_hide_featured_image', "true");
	if($hide_feature == "true") {
		return 'none';
	}

	// new format for handling heros.
	if(has_term('hero-cover','exa_layout',$post)) {
		return 'cover';
	} else {
		return 'standard';
	}

}

function exa_hero_media($post = null) {

	$post = get_post($post);

	if(has_term('media-video','exa_layout',$post)) {
		return 'video';
	} else {
		return 'image';
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

