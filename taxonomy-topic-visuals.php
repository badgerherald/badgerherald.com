<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 *
 * @package Exa
 * @since v0.1
 */

get_header();
exa_container('nameplate');

$query_args = array(
	'showposts' 	=> 1,
	'post_status'	=> 'publish',
	'post__not_in'	=> Exa::shownIds(),
	'tax_query' => array(
		array(
		    'taxonomy' => 'importance',
		    'field' => 'slug',
		    'terms' => array('featured','cover')
		),
		array(
			'taxonomy' => 'topic',
			'field' => 'slug',
			'terms' => 'madison'
		)
	)
);
$featuredQuery = new WP_Query( $query_args );

exa_container('stream', array('background' => 'black'));
get_footer(); 

?>
