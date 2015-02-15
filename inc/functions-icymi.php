<?php
/**
 * Functionality to create the ICYMI taxonomy for resurfacing
 * old content.
 *  
 * @package exa
 * @since v0.2
 */


/**
 * Registers a new taxonomy
 * 
 * @since v0.2
 */
function exa_register_icymi_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Icymi option', 'Taxonomy General Name', 'exa' ),
		'singular_name'              => _x( 'Icymi option', 'Taxonomy Singular Name', 'exa' ),
		'menu_name'                  => __( 'Icymi', 'exa' ),
		'all_items'                  => __( 'All options', 'exa' ),
		'parent_item'                => __( 'Parent option', 'exa' ),
		'parent_item_colon'          => __( 'Parent option:', 'exa' ),
		'new_item_name'              => __( 'New Option Name', 'exa' ),
		'add_new_item'               => __( 'Add New Option', 'exa' ),
		'edit_item'                  => __( 'Edit Option', 'exa' ),
		'update_item'                => __( 'Update Option', 'exa' ),
		'separate_items_with_commas' => __( 'Separate options with commas', 'exa' ),
		'search_items'               => __( 'Search options', 'exa' ),
		'add_or_remove_items'        => __( 'Add or remove options', 'exa' ),
		'choose_from_most_used'      => __( 'Choose from the most used options', 'exa' ),
		'not_found'                  => __( 'Not Found', 'exa' ),
	);

	/** 
	 * @see http://codex.wordpress.org/Roles_and_Capabilities 
	 */
	$capabilities = array(
		'manage_terms'				 => 'edit_theme_options',		// aka, administrators.
		'edit_terms'				 => 'edit_theme_options',
		'delete_terms'				 => 'edit_theme_options',
		'assign_terms'				 => 'edit_posts'				// aka, authors.
	);

	$args = array(
		'labels'                     => $labels,
		'capabilities'				 => $capabilities,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
	);

	register_taxonomy( 'icymi', array( 'post' ), $args );

}
add_action( 'init', 'exa_register_icymi_taxonomy', 0 );


/**
 * Returns a WP_Query of posts that have "aged" to
 * the point of ICYMI status.
 * 
 * The posts will be in a random order.
 * 
 * Notes: 
 * 
 *   - this is a combination of multiple WP_Query objects,
 *     using array_merge to set WP_Query->posts on a fresh object.
 *   - if there are no ICYMI posts matching the options, we query
 *     $count number of posts older than the most recent $count number 
 *     of posts. These are also in a random order.
 * 
 * @since v0.2
 * 
 * @param int $count the number of 
 * @return WP_Query a fresh WP_Query object with a randomized list of posts set
 *         in WP_Query->posts
 */
function exa_icymi_query($count = 10) {

	// This will store all our icymi posts.
	$icymiQuery = new WP_Query( );
	$icymiQuery->posts = array();

	$periods = get_terms('icymi');

	foreach ($periods as $period) :

		// split 2wk into array('1wk','1','wk')
		preg_match("/(^\d+)([d|wk|m|yr]+)/", $period->slug, $parts);
		
		// Assign a lower and upper bound to query between.
		// We become more lenient the older the icymi range is.

		$days = 24 * 60 * 60;
		$weeks = $days * 7;
		$months = $days * 30;
		$year = $days * 365;

		switch($parts[2]) {

			case 'd':
				// for days, allow between x and two days before x.
				$upper = getdate( time() - ($parts[1] * $days));
				$lower = getdate( time() - (($parts[1] *$days) + (2 * $days)));
				break;
			case 'wk':
				// for weeks, allow between x and three days before x.
				$upper = getdate( time() - ($parts[1] * $weeks));
				$lower = getdate( time() - (($parts[1] * $weeks) + (3*$days)));
				break;
			case 'm':
				// for months, allow between x and five days before x.
				$upper = getdate( time() - ($parts[1] * $months));
				$lower = getdate( time() - (($parts[1] * $months) + (5 * $days)) );
				break;
			case 'yr':
				// for year, allow between x and seven days before x.
				$upper = getdate( time() - ($parts[1] * 24 * $year));
				$lower = getdate( time() - (($parts[1] * $year) + (7 * $days)) );
				break;

			default:
				// default is to make the query not return anything.
				// this actually hasn't been tested so it might only work in theory.
				$upper = 0;
				$lower = 0;
				break;

		}

		$args = array(	

			'post_type' => 'post',
			'orderby'   => 'rand',
			'posts_per_page' => -1,

			/* Only return posts within the icymi taxonomy. */
			'tax_query' => array(
				array(
					'taxonomy' => 'icymi',
					'field'    => 'slug',
				),
			),  

			/* between our upper and lower bounds */
			'date_query' => array(

				array(
					'year'  	=> $lower['year'],
					'month' 	=> $lower['mon'],
					'day'   	=> $lower['mday'],
					'compare'	=> '>=',
				),

				array(
					'year'  	=> $upper['year'],
					'month' 	=> $upper['mon'],
					'day'   	=> $upper['mday'],
					'compare'	=> '<=',
				),

			),

		);

		$query = new WP_Query( $args );

		// Merge this query into our current query.
		$icymiQuery->post_count = $icymiQuery->post_count + $query->post_count;
		$icymiQuery->posts = array_merge($query->posts,$icymiQuery->posts);

	endforeach;

	// Account for no posts found. Still return something. In this case,
	// just a grouping of posts.
	if(sizeof($icymiQuery->posts)==0) {
		$args = array(
			'posts_per_page' => 20,
			'paged' => 2
		);
		$icymiQuery = new WP_Query( $args );
	} 

	shuffle($icymiQuery->posts);

	// We were only asked for $count number of posts!
	$icymiQuery->posts = array_slice($icymiQuery->posts,0,$count);
	$icymiQuery->post_count = $count;
	
	return $icymiQuery;

}


