<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

include("shoutouts/functions.php");
get_header(); 



if(isset($wp_query->query_vars['so_page'])) {

	$so_page = $wp_query->query_vars['so_page'];

} // End if

if(!$so_page) {
	$so_page = 1;
}

$shoutouts = new ShoutoutList($so_page,40);


?>
	
	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<header class="entry-header about-header">
			<h1 class="entry-title"> <?php the_title(); ?></h1>
			<h2 class="shoutout-tagline">Madison's other daily page since 2004</h2>
		</header><!-- .entry-header -->



		<!-- Navigation -->



		<ul>
			<li><a href="#">Masthead</a></li>
			<li><a href="#">History</a></li>
			<li><a href="#">Staff</a></li>
		</ul>


		<!-- About -->


		<article>




		</article>




		<!-- Staff -->









		<!-- History -->








	<?php endwhile; // Wordpress while ?>

<?php get_footer(); ?>