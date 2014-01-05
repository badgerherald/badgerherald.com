<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); 
?>

<?php /* The loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content', get_post_format() ); ?>
	<div class="clearfix"></div>
	<?php comments_template(); ?>
    <?php if(exa_has_tweets_cache())exa_get_tweets_API(); ?>

<?php endwhile; ?>

<?php get_footer(); ?>