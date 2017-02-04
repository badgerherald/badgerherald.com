<?php
/*
Plugin Name: 	Hrld Inline Links
Description: 	Makes URLs pasted on their own line inline links that can be styled as desired.
Author: 		Will Haynes
Author URI: 	http://badgerherald.com
License: 		Copyright (c) 2013 The Badger Herald


TODO:

 - This plugin should be extended to also include links to any other article on the web, using
   embed.ly's embedding service.

*/


/**
 * Enqueue's scripts and styles for plugin operation.
 * 
 * @since v0.6
 */
function exa_inline_link_embed_enqueue () {
	global $post;

	wp_enqueue_style( 'exa_inline_link_style', plugins_url( 'css/css.css', __FILE__ ), false, '1.0.0' );
	
	// tiny mce:
	add_editor_style( plugins_url( 'css/css.css', __FILE__ ) );

	wp_enqueue_script( 'exa_inline_click_script', plugins_url( 'js/count-clicks.js', __FILE__ ), array( 'jquery' ));
    wp_localize_script( 'exa_inline_click_script', 'exa_inline_click', array(
        'ajaxurl'       => admin_url( 'admin-ajax.php' ),
        'id'			=> $post->ID,
        'nonce'    	 	=> wp_create_nonce( 'exa-count-click' ))
    );
} 
add_action( 'wp_enqueue_scripts', 'exa_inline_link_embed_enqueue' );


/**
 * Ajax handler called when the user clicks an inline herald link
 *
 * The purpose of this ajax call is to gather some basic stats that we can then
 * present to editors.
 *
 * $_POST[] Variables:
 * 		hrld_inline_url - the url clicked.
 *		hrld_inline_id 	- the id of the post.
 * 
 * @since v0.6
 */
function hrld_inline_click_submit_handler() {
	
	global $wpdb;

	$nonce = $_POST['nonce']; 	
	if ( ! wp_verify_nonce( $nonce, 'hrld-count-click' ) )
		die ( 'Nice Try' );

	$pid = $_POST["hrld_inline_id"];

	// Only count clicks from users who can't edit the post.
	if( ! current_user_can('edit_post',$pid) ) {
	
		$key = "_hrld-inline-click-" . $_POST["hrld_inline_url"];
	
		$curClicks = get_post_meta($pid,$key,true);

		if($curClicks == "" ) {
			add_post_meta($pid,$key,1,true);
		} else {
			update_post_meta($pid,$key,$curClicks+1);
		}
	}

	return;

}
add_action( 'wp_ajax_ajax-hrld_inline_click_script', 'hrld_inline_click_submit_handler' );
add_action( 'wp_ajax_nopriv_ajax-hrld_inline_click_script', 'hrld_inline_click_submit_handler' );

/**
 * Parses the passed in http://badgerherald.com url and returns output 'embed' code.
 *
 * To support development environment, we alter the URL to include the local
 * site url.
 *
 * @since v0.6
 * 
 * @param $matches array — the part of the url that was matched by the regex.
 * @param $attr array - sizing info for the embed.
 * @param $url string - the url to embed.
 * @param $rawattr array - other attributes passed in.
 * 
 * @return embed code.
 */
function exa_inline_embed( $matches, $attr, $url, $rawattr ) {
	global $post;

	$inline_post = _exa_inline_post_from_url( $url );

	return _exa_inline_embed_article( $inline_post );
}
wp_embed_register_handler( 'exa-inline-link', '*(?:http|https)://badgerherald.com/*', 'exa_inline_embed' );

function _exa_inline_embed_article( $post ) {
	$post = get_post($post);

	$thumb_src = _exa_inline_post_thumbnail_src( $inline_post, 'small-thumbnail' );
	$excerpt = _exa_inline_link_embed_excerpt( $inline_post );

	$ret = "<a target='_BLANK' class='snippet inline' href='$url'>";

	/* Image */
	$ret .= $thumb_src ? "<img class='thumbnail' src='$thumb_src' />" : "";

	/* Title */
	$ret .=	"<span class='title'>";
	$ret .= _exa_inline_embed_clicks_string( $post, $url );
	$ret .= $inline_post->post_title . "</span>";

	/* Excerpt */
	$ret .= "<span class='excerpt'>" . $excerpt . "</span>";

	$ret .= "</a>";

	return $ret;
}

function _exa_inline_link_embed_excerpt( $post ) {
	$post = get_post($post);
	$excerpt = $post->post_content;
	$excerpt = strip_shortcodes( $excerpt );

	$re2='((?:http|https)(?::\\/{2}[\\w]+)(?:[\\/|\\.]?)(?:[^\\s"]*))';	
	$excerpt = preg_replace( "/".$re2."/is", "", $excerpt );

	$excerpt = wp_trim_words($excerpt, 20, ' <span class="more">Read...</span>');
	return $excerpt;
}

function _exa_inline_embed_clicks_string( $post, $url ) {
	$post = get_post($post);
	$clicks = exa_inline_clicks($post,$url);

	if( is_user_logged_in() && current_user_can('edit_post') && $clicks != "") { 
		$ret = "<span class='exa-inline-click-count'>" . $clicks . " Click";
		$ret .= $clicks == 1 ? "" : "s";
		$ret .= "</span> | ";
	}

	return $ret;
}

function exa_inline_clicks($post,$url) {
	$post = get_post($post);
	$key = "_exa-inline-click-" . $url;
	return get_post_meta($post->ID,$key,true);
}

/**
 * @return WP Post | null
 */
function _exa_inline_post_from_url($url) {
	$post_id = url_to_postid($url);
	return get_post($post_id);
}

/**
 * Returns a thumbnails src if it exists, otherwise returns null.
 * 
 * @return string | null
 */
function _exa_inline_post_thumbnail_src($post,$size) {
	$post = get_post($post);

	$thumb_id = get_post_thumbnail_id( $post );
	$thumb = wp_get_attachment_image_src( $thumb_id, $size );

	return $thumb ? $thumb['0'] : null;
}
