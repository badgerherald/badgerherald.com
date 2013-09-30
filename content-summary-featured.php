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

	<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<a href="<?php the_permalink(); ?>" rel="bookmark">
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		</a>
		<?php endif; ?>
		<?php /*
		<a class="meta-author-link" title="<?php echo exa_properize(get_the_author()); ?> Profile" href="<?php exa_the_author_link() ?>"><div class="tiny-avatar">
				<?php echo get_wp_user_avatar(get_the_author_meta('ID'), 'square'); ?>
		</div></a>
		*/ ?>
		<?php exa_list_categories(true); ?>


	</header><!-- .entry-header -->

		<a class="summary-post-link" href="<?php the_permalink(); ?>" rel="bookmark">
		
		<h2 class="entry-title">
			<?php the_title(); ?>
		</h2>



	<div class="entry-summary">
		<p> <span class="summary-time-stamp"><?php echo exa_human_time_diff(get_the_time('U')) ?> ago &middot; </span><?php echo get_the_excerpt(); ?></p>
	</div><!-- .entry-summary -->
	</a>


	<?php if(hrld_related_has_posts()) : ?>
	<div class="related-posts related-posts-<?php hrld_related_post_count() ?>-count">
		
		<header class="related-header">
			<h3><?php hrld_related_topic($post); ?></h3>
		</header>
		<div class="related-post-articles">
		<?php 
			$related_posts = hrld_related_post_ids($post);
			foreach($related_posts as $related_post) : ?>
			
				<a class="related-post" href="<?php echo get_permalink($related_post); ?>">
					<?php
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($related_post), 'small-thumbnail' );
							$url = $thumb['0'];
						?>

					<div class="related-post-body">
					<?php if($url) : $hasImgClass = "has-image"; ?>
						<img class="thumbnail" src="<?php echo $url ?>" />
					<?php else : $hasImgClass = "no-image"; endif; ?>
						<div class="related-post-body-right <?php echo $hasImgClass; ?>">
							<span class="related-post-type"><?php echo get_post_type($related_post); ?></span>
							<?php echo get_the_title($related_post); ?>
							<span class="excerpt-more">...</span>
						</div>
					</div>
				</a>

			<?php endforeach; ?>
		</div>
		<div class="clearfix"></div>

	</div>
	<?php endif; // has related posts ?>


</article><!-- #post -->
