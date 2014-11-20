<?php
/**
 * The template for displaying image attachments.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

the_post();

/**
 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
 */
$attachments = array_values( get_children( array(
	'post_parent' => $post->post_parent,
	'post_status' => 'inherit',
	'post_type' => 'attachment',
	'post_mime_type' => 'image',
	'order' => 'ASC',
	'orderby' => 'menu_order ID'
) ) );

foreach ( $attachments as $k => $attachment ) :
if ( $attachment->ID == $post->ID )
	break;
endforeach;

$k++;
// If there is more than 1 attachment in a gallery
if ( count( $attachments ) > 1 ) :
	if ( isset( $attachments[ $k ] ) ) :
		// get the URL of the next image attachment
		$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
	else :
		// or get the URL of the first image attachment
		$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	endif;
else :
	// or, if there's only 1 image, get the URL of the image
	$next_attachment_url = wp_get_attachment_url();
endif;

get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
<?php $hrld_credit_user = get_hrld_media_credit_user($post->ID); ?>
<div class="post-sidebar">
			<div class="post-sidebar-scroll fixed-sidebar-container">
			<div class="meta-author">
				<a class="meta-author-avatar" title="<?php echo exa_properize($hrld_credit_user->display_name); ?> Profile" href="<?php echo get_bloginfo('url').'/author/'.$hrld_credit_user->user_login ?>">
					<?php echo get_wp_user_avatar($hrld_credit_user->ID, 'small-thumbnail'); ?>
				</a>
				<span class="author">by <a href="<?php echo get_bloginfo('url').'/author/'.$hrld_credit_user->user_login ?>" title="<?php echo exa_properize($hrld_credit_user->display_name); ?> Profile"><?php echo $hrld_credit_user->display_name; ?></a></span>
				<span class="author-position">The Badger Herald</span>
				<?php // If twitter
				if(hrld_author_has("hrld_twitter_handle",$hrld_credit_user->ID)) {
					$twitter_handle = get_hrld_author("hrld_twitter_handle",$hrld_credit_user->ID);
					echo "<a href='https://twitter.com/$twitter_handle' class='twitter-follow-button' data-show-count='false'>Follow @$twitter_handle</a>";
					echo "<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>";
				} ?>
			</div>

			<div class="post-sidebar-ad">
				<?php dfp::small_sidekick(); ?>
			</div>
			</div>

		</div>
		<article class="article-post">
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php
				$published_text  = __( '<span class="attachment-meta">Published on <time class="entry-date" datetime="%1$s">%2$s</time> in <a href="%3$s" title="Return to %4$s" rel="gallery">%5$s</a></span>', 'twentythirteen' );
				$post_title = get_the_title( $post->post_parent );
				if ( empty( $post_title ) || 0 == $post->post_parent )
					$published_text  = '<span class="attachment-meta"><time class="entry-date" datetime="%1$s">%2$s</time></span>';

				printf( $published_text,
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					esc_url( get_permalink( $post->post_parent ) ),
					esc_attr( strip_tags( $post_title ) ),
					$post_title
				);
				?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">

		<div class="entry-attachment">
			<div class="attachment">
				<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
				$attachment_size = apply_filters( 'twentythirteen_attachment_size', array( 724, 724 ) );
				echo wp_get_attachment_image( $post->ID, $attachment_size );
				?></a>

				<?php if ( ! empty( $post->post_excerpt ) ) : ?>
				<div class="entry-caption">
					<?php the_excerpt(); ?>
				</div>
				<?php endif; ?>
			</div><!-- .attachment -->

		</div><!-- .entry-attachment -->

		<?php if ( ! empty( $post->post_content ) ) : ?>
		<div class="entry-description">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentythirteen' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-description -->
		<?php endif; ?>

	</div><!-- .entry-content -->
</article>
</article><!-- #post -->
<div class="clearfix"></div>
			<?php comments_template(); ?>

<?php get_footer(); ?>