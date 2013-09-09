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
		<?php echo get_avatar( $author->user_email, apply_filters( 'twentythirteen_author_bio_avatar_size', 148 ) ); ?>
	</div><!-- .author-avatar -->
	<div class="author-description">
		<h2 class="author-title"><?php printf( __( '%s', 'twentythirteen' ), $author->display_name ); ?></h2>
		<p class="author-bio">
			<?php echo $author->description; ?>
		</p>
	</div><!-- .author-description -->
</div><!-- .author-info -->