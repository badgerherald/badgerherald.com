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

get_template_part('inc/blocks/leaderboard');
get_template_part('inc/blocks/menu-search-bar');
get_template_part('inc/blocks/mobile-header');

if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
		get_template_part('inc/blocks/content','two-column');
	endwhile; 
else :
	_e( '<p>Something went wrong.</p>' );
endif;

get_template_part('footer');

