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
?>
