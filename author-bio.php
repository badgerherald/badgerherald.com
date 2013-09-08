<?php
/**
 * The template for displaying Author bios.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<?php $author = get_user_by('id', get_query_var('author')); ?>
<div class="author-info">
	<div class="author-avatar">
		<?php echo get_avatar( $author->user_email, apply_filters( 'twentythirteen_author_bio_avatar_size', 74 ) ); ?>
	</div><!-- .author-avatar -->
	<div class="author-description">
		<h2 class="author-title"><?php printf( __( 'About %s', 'twentythirteen' ), $author->display_name ); ?></h2>
		<p class="author-bio">
			<?php echo $author->description; ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentythirteen' ), $author->display_name ); ?>
			</a>
		</p>
	</div><!-- .author-description -->
</div><!-- .author-info -->