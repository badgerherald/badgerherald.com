<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

// Set up ads for current page.
global $DoubleClick;

if( isset( $_REQUEST['sca']))
	get_header('interstellar'); 
else
	get_header('minimal');

get_template_part( 'inc/block', 'leaderboard' );
?>

<?php /* The loop */ ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content', 'shoutouts' ); ?>

    <div class="clearfix"></div>

    <?php get_template_part('inc/block','billboard'); ?>
    <?php // get_template_part('inc/block','cover'); ?>

    <div class="clearfix"></div>

<?php endwhile; ?>

<?php get_footer(); ?>