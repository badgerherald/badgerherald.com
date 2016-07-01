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
		<p> <span class="summary-time-stamp"><?php exa_time() ?> &middot; </span><?php the_excerpt(); ?></p>
	</div><!-- .entry-summary -->

	</a>

	<div class="clearfix"></div>

</article><!-- #post -->

