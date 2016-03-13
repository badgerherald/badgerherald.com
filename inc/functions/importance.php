<?php
/**
 * Functionality to create the importance taxonomy for featuring
 * different types of content.
 *  
 * @package exa
 * @since v0.2
 */


/**
 * Registeres a taxanomy used to select the "importance" of a post.
 *
 * @since 0.1
 * @return void
 */
function exa_register_importance_taxanomy() {

	register_taxonomy("importance","post",array( 
							'hierarchical' => true,
							'label' => 'Importance',
							'public' => 'true',
							'show_in_nav_menus' => false,
							'show_admin_column' => false,
							'query_var' => true,
							'show_in_menu' => 'false',
							'singular_label' => 'Importance') 
	);

} add_action( 'init', 'exa_register_importance_taxanomy');

/**
 * Returns a boolean specifying if the post is `featured` or not.
 * 
 * @since v0.1
 * @return boolean True if post is marked "featured", False if not.
 */
function exa_is_featured($post = null) {
	$post = get_post($post);
	return (in_array("Featured",wp_get_post_terms($post->ID,"importance",array("fields" => "names"))));
}

/**
 * Returns a boolean specifying if the post is marked `in_stream` or not.
 * 
 * @since v0.1
 * @return boolean True if post is marked "in stream", False if not.
 */
function exa_is_instream($post = null) {
	$post = get_post($post);
	return (in_array("In Stream",wp_get_post_terms($post->ID,"importance",array("fields" => "names"))));
}

/**
 * Returns a boolean specifying if the post is marked `cover` or not.
 * 
 * @since v0.2
 * @return boolean True if post is marked "in stream", False if not.
 */
function exa_is_cover($post = null) {
	$post = get_post($post);
	return (in_array("Cover",wp_get_post_terms($post->ID,"importance",array("fields" => "names"))));
}