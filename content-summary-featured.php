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

		<?php 
			$beats = exa_get_beats(); 
			$category_base = get_bloginfo('url')."/".get_post_type()."/";
			$post_type = get_post_type_object(get_post_type());
		?>
		
		<?php exa_list_categories(true); ?>

		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>

		<?php /*
		<div class="entry-meta">

			<span class="meta-author">
			<a title="<?php echo exa_properize(get_the_author()); ?> Profile" href="<?php the_author_link() ?>">
			<div class="tiny-avatar">
				<?php echo get_wp_user_avatar(get_the_author_meta('ID'), 'square'); ?>
			</div>
			</a>
			<a title="<?php echo exa_properize(get_the_author()); ?> Profile" href="<?php the_author_link() ?>"><?php the_author() ?></a>
			</span>

			<?php edit_post_link( __( 'Edit Post', 'twentythirteen' ), '<span class="meta-edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta --> */ ?>

	</header><!-- .entry-header -->


	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php /* else : ?>

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; */?>

</article><!-- #post -->
