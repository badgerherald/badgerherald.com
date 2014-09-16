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

// Add a body class to target styling.

function about_class($classes) {
	$classes[] = 'about-page';
	return $classes;
} add_filter('body_class','about_class');

get_header('about'); ?>


	<div class="about-nav fixed-sidebar-container">
		<ul>
			<li><a href="<?php bloginfo("url") ?>/about/">About</a></li>
			<li><a href="<?php bloginfo("url") ?>/about/staff/">Staff</a></li>
			<li><a href="<?php bloginfo("url") ?>/about/get-involved/">Get Involved</a></li>
			<li><a href="<?php bloginfo("url") ?>/about/history/">History</a></li>
			<li class="active"><a href="<?php bloginfo("url") ?>/about/colophon/">Colophon</a></li>
			<li><a href="<?php bloginfo("url") ?>/about/copyright/">Copyright</a></li>
		</ul>
	</div>

	<div id="content" class="site-content article-content" role="main">

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					
				<div class="entry-content">
					<?php the_content() ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div><!-- .entry-content -->

			</article><!-- #post -->
		<?php endwhile; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
