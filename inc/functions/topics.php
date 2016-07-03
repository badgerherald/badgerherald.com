<?php

/**
 * Registeres a taxanomy used to select a post topic
 *
 * @since v0.1
 * @return void
 */
function exa_register_topic_taxonomy() {

		register_taxonomy("topic","post",array( 
							'hierarchical' => true,
							'label' => 'Topics',
							'public' => 'true',
							'show_in_nav_menus' => true,
							'show_admin_column' => true,
							'query_var' => true,
							'show_in_menu' => 'true',
							'singular_label' => 'Topic') 
	);

} 
add_action( 'init', 'exa_register_topic_taxonomy');

/**
 * Echos the topic
 *
 * @since v0.1
 * @param int|WP_Post $post post id or post object
 * @return string Top post cateogry or "Herald" if no category is set.
 */
function exa_topic($post = null) {
	echo exa_get_topic($post);
}

/**
 * Returns the "topic" of the post.
 *
 * @since v0.5
 * @param int|WP_Post $post post id or post object
 * @return string Top post cateogry or "Herald" if no category is set.
 */
function exa_get_topic($post = null) {

	$post = get_post($post);

	$beats = wp_get_post_terms($post->ID,"topic");
	$category_base = get_bloginfo('url')."/".get_post_type()."/";
	if( !empty($beats) ) {
		foreach ($beats as $beat) : 
			return $beat->name; 
		endforeach;
	}

	return "Herald";
}