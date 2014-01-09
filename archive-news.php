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
	<?php 
		$classes = "";
		if( is_post_type_archive() ) {
			$classes.="section-header-".strtolower(post_type_archive_title("",false));
		}
		?>
	<header id="section-header" class="<?php echo $classes ?> clearfix">
		<div class="section-banner section-banner-news">

			<h2>News</h2>

		</div>
	</header>
    <a class="to-categories" href="#categories-headline">Categories</a>
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

		<?php // twentythirteen_paging_nav(); ?>

	<?php elseif ($query->is_archive) : ?>
		<?php //get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>

	</div><!-- id="stream" -->

	<?php get_sidebar('archive'); ?>

	<div id="clearfix"></div>

<?php get_footer(); ?>
