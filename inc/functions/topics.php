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