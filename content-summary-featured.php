<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<?php ?>


<article id="post-<?php the_ID(); ?>" <?php post_class("stream-post featured-stream-post"); ?>>

	<a class="summary-post-link" href="<?php the_permalink(); ?>" rel="bookmark">

	<header class="entry-header">

			<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>

	</header><!-- .entry-header -->

		
		
		<h2 class="entry-title">
			<?php the_title(); ?>
		</h2>



	<div class="entry-summary">
		<p> <span class="summary-time-stamp"><?php echo exa_human_time_diff(get_the_time('U')) ?> &middot; </span><?php echo get_the_excerpt(); ?></p>
	</div><!-- .entry-summary -->

	</a>

	<div class="clearfix"></div>

</article><!-- #post -->

