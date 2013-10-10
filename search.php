<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); 

hrld_top_leaderboard_ad();

?>

	<div id="primary" class="content-area">

		<header class="page-header">
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentythirteen' ), get_search_query() ); ?></h1>
			<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                <input type="hidden" name="section"
                <?php if (isset($section_query_var)) {
                    echo 'value="'.$section_query_var.'"';
                } else {
                    echo 'value="All"';
                }
                ?> />
                <input type="hidden" name="date_range" 
                <?php if (isset($dates_query_var)) { 
                    echo 'value="'.$dates_query_var.'"';
                } else {
                    echo 'value="All time"';
                }
                ?> />
                <input type="search" class="search-field" placeholder="<?php the_search_query(); ?>" value="<?php the_search_query(); ?>" name="s" title="Search for:" />
                <input type="submit" class="search-submit" value="Search" />
            </form>
		</header>

		<div id="stream">
		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'summary-instream' ); ?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
		<hr />
		<h2>We couldn't find anything with your search terms!</h2>
		<?php endif; ?>

		</div><!-- #stream -->
		
		<?php get_sidebar('search'); ?>

	</div><!-- #primary -->

<?php get_footer(); ?>