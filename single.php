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

get_header('minimal'); 
get_template_part( 'inc/block', 'leaderboard' );
?>

<?php /* The loop */ ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content', get_post_format() ); ?>
	
    <div class="clearfix"></div>

    <php get_template_part('inc/block','billboard'); ?>

	<?php comments_template(); ?>
    <?php exa_get_tweets_API(); ?>

    <div class="clearfix"></div>

<?php endwhile; ?>

<?php get_footer(); ?>