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
<article id="post-<?php the_ID(); ?>" <?php post_class("stream-post instream-stream-post attahment-fullstream-post"); ?>>
	<a class="summary-post-link" href="<?php the_permalink(); ?>" rel="bookmark">
		<div class="entry-thumbnail">
			<?php echo wp_get_attachment_image($post->ID, 'large-thumbnail'); ?>
		</div>

        
		<!-- <div class="clearfix"></div> -->

		<div class="entry-summary <?php if(!$full_width) { echo "entry-summary-full"; } ?> <?php if(!has_post_thumbnail()){ echo 'stream-no-thumbnail'; } ?>">
					<p> <span class="summary-time-stamp"><?php echo exa_human_time_diff(get_the_time('U')) ?> ago &middot; </span><?php echo get_the_excerpt(); ?></p>
		</div><!-- .entry-summary -->

	</a>

	<div class="clearfix"></div>


</article><!-- #post -->
