<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Exa
 * @since v0.5
 */

get_header();
exa_container('menu-search-bar');

while ( have_posts() ) : the_post(); 
	
	exa_container('header',array('breakpoints' => array('mobile')));
	exa_container('hero'); 

	exa_container('content-two-column',array('hide-hero' => true, 'layout' => exa_layout()) ); 

endwhile;

get_footer();