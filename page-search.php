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
		<h1 class="page-title">Search for:</h1>
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




	<div id="clearfix"></div>

<?php get_footer(); ?>
