<?php
/**
 * The default template for displaying content. Used for single.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

global $AnalyticBridge;
global $post;

?>

<?php

get_header();

exa_container('leaderboard');
exa_container('menu-search-bar');
exa_container('header');

if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
		exa_container('content-two-column',array('layout' => exa_layout()));
	endwhile; 
else :
	_e( '<p>Something went wrong.</p>' );
endif;

get_template_part('footer');

