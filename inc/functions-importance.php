<?php
/**
 * Functionality to create the importance taxonomy for featuring
 * different types of content.
 *  
 * @package exa
 * @since v0.2
 */

/**
 * Returns a boolean specifying if the post is `featured` or not.
 * 
 * @since v0.1
 * @return boolean True if post is marked "featured", False if not.
 */
function exa_is_featured() {
	if(!$post) {
		global $post;
	}
	return (in_array("Featured",wp_get_post_terms($post->ID,importance,array("fields" => "names"))));
}

/**
 * Returns a boolean specifying if the post is marked `in_stream` or not.
 * 
 * @since v0.1
 * @return boolean True if post is marked "in stream", False if not.
 */
function exa_is_instream($post = null) {
	if(!$post) {
		global $post;
	}
	return (in_array("In Stream",wp_get_post_terms($post->ID,importance,array("fields" => "names"))));
}

/**
 * Returns a boolean specifying if the post is marked `cover` or not.
 * 
 * @since v0.2
 * @return boolean True if post is marked "in stream", False if not.
 */
function exa_is_cover($post = null) {

	if(!$post) {
		global $post;
	}
	return (in_array("Cover",wp_get_post_terms($post->ID,importance,array("fields" => "names"))));
}