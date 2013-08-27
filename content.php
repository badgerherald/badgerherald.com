<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; /* has post thumbnail */ ?>
	</header><!-- .entry-header -->

		<div id="post-sidebar">

			<span class="meta-time"><?php the_time("F m, Y \a\\t g:i:sa") ?></span>
		
			<div class="meta-author">

				<div class="meta-author-left">
					<a class="meta-author-link" title="<?php echo exa_properize(get_the_author()); ?> Profile" href="<?php exa_the_author_link() ?>"><?php the_author() ?></a><br/>
					<span class="meta-author-role">The Badger Herald</span>
				</div><!-- class="meta-author-left" -->

				<div class="meta-author-right">
					<a class="meta-author-avatar" title="<?php echo exa_properize(get_the_author()); ?> Profile" href="<?php exa_the_author_link() ?>">
						<?php echo get_wp_user_avatar(get_the_author_meta('ID'), 'square'); ?>
					</a>
				</div><!-- class="meta-author-right" -->
			<div class="clearfix"></div>
			</div><!-- class="meta-author -->

			<?php exa_include_article_square_ad() ?>



		</div><!-- id="post-sidebar" -->
		<div id="content">
			<?php exa_list_categories(true) ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>

			<div class="article-content">
			<?php the_content() ?>
			</div>

			<div class="entry-meta">
				<?php twentythirteen_entry_meta(); ?>
				<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-meta -->
		</div><!-- id="content" -->
	<?php /*
	<footer class="entry-meta">
		<?php if ( comments_open() && ! is_single() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
	*/ ?>
</article><!-- #post -->
