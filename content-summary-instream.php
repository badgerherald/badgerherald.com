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


	<header class="entry-header">
		
		<?php exa_list_categories(true); ?>

		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>

	</header><!-- .entry-header -->


	<?php if ( has_post_thumbnail() && ! post_password_required() ) : $full_width = true; ?>
		
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>

	<?php endif; ?>


	<div class="entry-summary <?php if(!$full_width) { echo "entry-summary-full"; } ?>">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<div class="clearfix"></div>

</article><!-- #post -->
