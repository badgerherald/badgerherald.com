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
exa_block('menu-search-bar');
exa_block('header');

?>
	
	<?php 
		$classes = "";
		if( is_post_type_archive() ) {
			$classes.="section-header-".strtolower(post_type_archive_title("",false));
		}
		?>
	<header id="section-header" class="<?php echo $classes ?>">
		<h1 class="archive-title">
		<?php
			if ( is_day() ) :
				printf( __( 'Daily Archives: %s', 'twentythirteen' ), get_the_date() );
			elseif ( is_month() ) :
				printf( __( 'Monthly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentythirteen' ) ) );
			elseif ( is_year() ) :
				printf( __( 'Yearly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentythirteen' ) ) );
			elseif ( is_post_type_archive() ) :
				printf( '%s', post_type_archive_title() );
				else :
					_e( 'Archives', 'twentythirteen' );
				endif;
				?>
		</h1>
	</header>
	<div id="stream">

	<?php if ( have_posts() ) : ?>

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php if(exa_is_featured()) : ?>
				<?php get_template_part( 'content', 'summary-featured' ); ?>
				<hr />
			<?php else : //if(exa_is_instream()) : ?>
				<?php get_template_part( 'content', 'summary-instream' ); ?>
				<hr />
			<?php endif; ?>
			
		<?php endwhile; ?>

		<?php twentythirteen_paging_nav(); ?>

	<?php elseif ($query->is_archive) : ?>
		<?php //get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>

	</div><!-- id="stream" -->

	<div id="clearfix"></div>

<?php get_footer(); ?>