<?php

// Libraries:
include( __DIR__ . '/lib/class.taxonomy-single-term.php');
include( __DIR__ . '/lib/walker.taxonomy-single-term.php');

/**
 * Echos the section
 * 
 * @since v0.2
 */
function exa_section($post = null) {
	echo exa_get_section($post);
}

/**
 * Returns the corresponding exa section
 * 
 * @since v0.5
 * @return string section.
 */
function exa_get_section($post = null) {
	$post = get_post($post);
	
	$section = get_the_category($post);
	
	if( !empty($section) && sizeof( $section) == 1)
		return $section[0]->slug;
	else
		return "Herald";
}

/**
 * Returns a url for the section.
 * 
 * @since v0.4
 * @return string section.
 */
function exa_section_permalink($post = null) {
	echo exa_get_section_permalink($post);
}

/**
 * Returns a url for the section.
 * 
 * @since v0.4
 * @return string section.
 */
function exa_get_section_permalink($post = null) {
	$post = get_post($post);
	
	$section = get_the_category($post);

	if( $section ) {
		return get_term_link($section[0]->term_id,"category");
	}

	return "";
}

function exa_convert_categories_to_section() {
	$sections_single_term = new Taxonomy_Single_Term( 'category' );

	// Set priority of metabox's vertical placement
	$sections_single_term->set( 'priority', 'high' ); // 'high', 'core', 'default' or 'low'
	
	// Set metabox position. (column placement)
	$sections_single_term->set( 'context', 'side' ); // 'normal', 'advanced', or 'side'
	
	// Custom title for your metabox
	$sections_single_term->set( 'metabox_title', __( 'Section', 'exa' ) );
	
	// Makes a selection required.
	$sections_single_term->set( 'force_selection', true );
	
	// Will keep radio elements from indenting for child-terms.
	$sections_single_term->set( 'indented', true );
	
	// Allows adding new terms from the metabox
	$sections_single_term->set( 'allow_new_terms', false );

	$sections_single_term->set('input_element', 'select' );

}
add_action('admin_init','exa_convert_categories_to_section');

/**
 * Save the default category before it's rendered to the user
 * @see https://plugins.trac.wordpress.org/browser/default-category/trunk/default-category.php
 */
function exa_default_section_save($post_ID) {
 
  $post_categories = wp_get_post_categories( $post_ID);

  if(empty($post_categories)) {

    // Get current user
    $user = wp_get_current_user();

    // Get user field data for 'default_category_id_for_user'
    $default_category_id_for_user = get_user_meta( $user->ID, 'default_category_id_for_user', TRUE );

    // Check if field has any data
    if(is_array($default_category_id_for_user)){
     
      // Save categories to new post
      wp_set_post_categories( $post_ID, $default_category_id_for_user );
    }
    else { 
      if(get_option('default_category_id')) { 
        $default_category_id = get_option('default_category_id'); 
        wp_set_post_categories( $post_ID, $default_category_id['default_category_id'] ); 
      }
    }
  }

}
add_action( 'save_post', 'exa_default_section_save' );