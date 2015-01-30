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

get_header(); 

?>	
	
	<header id="section-header" class="<?php echo $classes ?> clearfix">
		
		<?php $category = single_cat_title( '', false); ?>
		<div class="section-banner section-banner-<?php echo strtolower($category); ?>">

			<h2><?php echo $category; ?></h2>

		</div>
	</header>
	<div id="stream">

	<?php if ( have_posts() ) : ?>

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php if(exa_is_featured()) : ?>
				<?php get_template_part( 'content', 'summary-fullstream-featured' ); ?>
				<hr />
			<?php else : ?>
				<?php get_template_part( 'content', 'summary-fullstream' ); ?>
				<hr />
			<?php endif; ?>
			


		<?php endwhile; ?>

		<div class="all-link pagination-link"><?php next_posts_link( 'Older' ); ?></div>

	<?php elseif ($query->is_archive) : ?>
		<?php //get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>

	</div><!-- id="stream" -->


	<div id="clearfix"></div>

<?php get_footer(); ?>
