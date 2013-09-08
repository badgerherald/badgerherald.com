<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Thirteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	

	<?php if ( have_posts() ) : ?>
    <?php get_template_part('author', 'bio'); ?>
	<div id="stream">
		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'summary-featured' ); ?>
		<?php endwhile; ?>

		<?php twentythirteen_paging_nav(); ?>

	<?php elseif ($query->is_archive) : ?>
		<?php //get_template_part( 'content', 'none' ); ?>
	

	</div><!-- id="stream" -->
	<?php endif; ?>
	<?php get_sidebar(get_post_type() ); ?>

	<div id="clearfix"></div>

<?php get_footer(); ?>