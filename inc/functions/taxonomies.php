<?php

/**
 * Registeres a taxanomy used to select a post topic
 *
 * @since 0.1
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