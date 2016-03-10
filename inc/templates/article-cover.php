<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Exa
 * @since v0.5
 */

get_header();

while ( have_posts() ) : the_post(); 

	exa_block('mobile-header',null,array(
										'breakpoints' => array('mobile')
										)
			);

	get_template_part( 'inc/blocks/cover-hero' ); 

	exa_block( 'content-two-column', null, array('hide-hero' => true) ); 

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