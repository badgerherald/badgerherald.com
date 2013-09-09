<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<?php $author = get_user_by('id', get_query_var('author')); ?>
<div id="sidebar">
<div class="sidebar-inner">
<div class="author-avatar">
		<?php echo get_avatar( $author->user_email, apply_filters( 'twentythirteen_author_bio_avatar_size', 148 ) ); ?>
</div><!-- .author-avatar -->
<h2 class="author-title"><?php printf( __( '%s', 'twentythirteen' ), $author->display_name ); ?></h2>
<div class="sidebar-scroll">
<div class="author-description">
		<p class="author-bio">
			<?php echo $author->description; ?>
		</p>
	</div><!-- .author-description -->
</div><!-- .author-info -->

</div><!-- class="sidebar-scroll" -->
</div><!-- class="inner-sidebar" -->
</div><!-- id="sidebar" -->