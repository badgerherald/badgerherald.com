<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Exa
 * @since v0.5
 */

get_header();

while ( have_posts() ) : the_post(); 
	
	exa_block('header',array('breakpoints' => array('mobile')));
	get_template_part( 'inc/blocks/cover-hero' ); 

	exa_block('content-two-column',array('hide-hero' => true) ); 

	/**
	 * Called below the article, after main.
	 * 
	 * @since v0.3
	 */
	do_action('exa_below_article');

endwhile;

get_footer();