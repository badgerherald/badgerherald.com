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


<article id="post-<?php the_ID(); ?>" <?php post_class("stream-post featured-stream-post featured-fullstream-post"); ?>>

	<a class="summary-post-link" href="<?php the_permalink(); ?>" rel="bookmark">

	<header class="entry-header">

			<?php if(has_post_thumbnail()){ ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
        <?php } ?>

	</header><!-- .entry-header -->

		
		
		<h2 class="entry-title">
			<?php the_title(); ?>
		</h2>



	<div class="entry-summary <?php if(!has_post_thumbnail()){ echo 'stream-no-thumbnail'; } ?>">
		<p> <span class="summary-time-stamp"><?php echo exa_human_time_diff(get_the_time('U')) ?> &middot; </span><?php echo get_the_excerpt(); ?></p>
	</div><!-- .entry-summary -->

	</a>

	<?php if(hrld_related_has_posts()) : ?>

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

