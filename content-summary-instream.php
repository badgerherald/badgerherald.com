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
<article id="post-<?php the_ID(); ?>" <?php post_class("stream-post instream-stream-post"); ?>>
	<a class="summary-post-link" href="<?php the_permalink(); ?>" rel="bookmark">
		
		
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>

        <header class="entry-header">
		
		<span class="topic"><?php echo exa_topic( $post->ID ); ?></span>

	</header><!-- .entry-header -->
		<h2 class="entry-title">
			<?php the_title(); ?>
		</h2>
		<!-- <div class="clearfix"></div> -->

		<div class="entry-summary <?php if(!$full_width) { echo "entry-summary-full"; } ?>">
					<p> <span class="summary-time-stamp"><?php echo exa_human_time_diff(get_the_time('U')) ?> ago &middot; </span><?php echo get_the_excerpt(); ?></p>
		</div><!-- .entry-summary -->

	</a>

	<div class="clearfix"></div>


</article><!-- #post -->
