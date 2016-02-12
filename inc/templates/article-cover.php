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

	<?php 

	exa_block('mobile-header',null,array(
		'breakpoints' => array('mobile')
		));
	get_template_part( 'inc/blocks/cover-hero' ); 

	?>
	<?php exa_block( 'content-two-column', null, array('hide-hero' => true) ); ?>

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