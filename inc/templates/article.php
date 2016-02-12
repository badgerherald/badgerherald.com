<?php
/**
 * The default template for displaying content. Used for single.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

global $AnalyticBridge;
global $DoubleClick;
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

?>

<div class="block read-next-block" style="border-top: 1px solid #c7d0d5; margin-top: 64px;">
	<div class="wrapper" style="text-align: center;margin-top: 42px; ">
			<h2 style=" font-family: pt serif; text-transform: uppercase; font-style: italic; background: #2379d0; color: #fff; font-size: 42px; display:inline-block; padding: 12px 20px; line-height: 54px; text-align: center; margin: 0 auto;">Read Next</h2>
	</div>
</div>

<?php Exa::addShownId(get_the_ID()); ?>

<?php get_template_part('inc/blocks/feature-widget'); ?>
<?php get_template_part('inc/blocks/ad-and-two-dominant'); ?>
<?php get_template_part('inc/blocks/list-and-banter'); ?>

<?php get_template_part('footer');

