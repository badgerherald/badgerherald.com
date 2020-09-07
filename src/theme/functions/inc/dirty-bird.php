<?php 


/**
 * Add custom dirty bird templates
 */
function hexa_dirty_bird_template($single_template) {
     global $post;

     if ( exa_get_topic($post) == 'Dirty Bird' ) {
		$single_template = get_stylesheet_directory() . '/post-dirtybird.php';
     }

     return $single_template;
}
add_filter('single_template', 'hexa_dirty_bird_template');