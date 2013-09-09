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
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>
		<?php /*
		<a class="meta-author-link" title="<?php echo exa_properize(get_the_author()); ?> Profile" href="<?php exa_the_author_link() ?>"><div class="tiny-avatar">
				<?php echo get_wp_user_avatar(get_the_author_meta('ID'), 'square'); ?>
		</div></a>
		*/ ?>
		<?php exa_list_categories(true); ?>

		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>


	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->


</article><!-- #post -->
