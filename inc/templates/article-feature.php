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

get_header('');

?>

<?php /* The loop */ ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content', 'feature' ); ?>

	<?php
	/**
	 * Called below the article, after main.
	 * 
	 * @since v0.3
	 */
	do_action('exa_below_article');

	?>


    <div class="clearfix"></div>

    <?php get_template_part('inc/blocks/billboard'); ?>

    <div class="clearfix"></div>

<?php endwhile; ?>

<?php get_footer(); ?>