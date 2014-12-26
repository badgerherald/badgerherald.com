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


<article id="post-<?php the_ID(); ?>" <?php post_class("stream-post featured-stream-post endless-flow"); ?>>

	<a class="summary-post-link endless-flow-link" href="<?php the_permalink(); ?>" post_id="<?php the_ID(); ?>" rel="bookmark">

	<header class="entry-header">
		<h3 class="entry-title">
			<?php the_title(); ?>
		</h3>

	</header><!-- .entry-header -->
	<?php 
		$thumbnail = wp_get_attachment_image($post->ID); 
		if( $thumbnail != ''){
			echo '<div class="entry-thumbnail">'.$thumbnail.'</div>';
		}else{
			$thumbnail = get_the_post_thumbnail($post->ID);
			if( $thumbnail != ''){
				echo '<div class="entry-thumbnail">'.$thumbnail.'</div>';
			}			
		}
	?>

	<div class="entry-summary">
		<p> <span class="summary-time-stamp"><?php echo exa_human_time_diff(get_the_time('U')) ?> ago &middot; </span><?php echo get_the_excerpt(); ?></p>
	</div><!-- .entry-summary -->

	</a>

	<div class="clearfix"></div>

</article><!-- #post -->
