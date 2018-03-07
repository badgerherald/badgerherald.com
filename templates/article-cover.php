<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Exa
 * @since v0.5
 */

get_header();
exa_container('nameplate');

while ( have_posts() ) : the_post(); 
	
	exa_container('cover-hero'); 

	exa_container('content-two-column',array('hide-hero' => true, 'layout' => exa_layout()) ); 

endwhile;

get_footer();