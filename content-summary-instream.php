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
	<a class="summary-post-link clearfix" href="<?php the_permalink(); ?>" rel="bookmark">
		
		
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
					<p> <span class="summary-time-stamp"><?php echo exa_human_time_diff(get_the_time('U')) ?> &middot; </span><?php echo get_the_excerpt(); ?></p>
		</div><!-- .entry-summary -->

	</a>
    <?php if(hrld_related_has_posts() && !is_home()) : ?>

	<div class="hp-feature-related-posts">
		
		<header class="related-header">
			<h3><?php hrld_related_topic($post); ?></h3>
		</header>

		<ul class="related-post-articles">

		<?php $related_posts = hrld_related_post_ids($post);
			foreach($related_posts as $related_post) : ?>
			
				<li>
					<a  href="<?php echo get_permalink($related_post); ?>">
						<?php echo get_the_title($related_post); ?>

					</a>
				</li>

			<?php endforeach; ?>
		</ul>

		<div class="clearfix"></div>

	</div><!-- .hp-feature-related-posts -->

	<?php endif; // has related posts ?>

	<div class="clearfix"></div>


</article><!-- #post -->
