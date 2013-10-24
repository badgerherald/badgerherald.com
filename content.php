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
		
		<div class="entry-post-featured">
		<div class="entry-img-featured">
			<?php the_post_thumbnail('image-post-size'); ?>
		
			<?php
			$thumb_id = get_post_thumbnail_id($post->ID);
			$args = array(
				'post_type' => 'attachment',
				'post_status' => null,
				'post_parent' => $post->ID,
				'include'  => $thumb_id
			); 

   			$thumb_image = get_post($thumb_id);

   			$credit = get_media_credit($thumb_id);
   			$exerpt = $thumb_image->post_excerpt;
   			if($credit != "") : ?>
   			
   			<div class="entry-post-featured-credit <?php if($exerpt=="") echo "entry-post-featured-credit-no-caption"; ?>">
   				<span>
   					<?php echo $credit; ?>
   				</span>
   			</div>
   				
   			<?php endif; ?>

   		</div><!-- class="entry-img-featured" -->

   				<?php if($exerpt != "") : ?>
   					<div class="entry-post-featured-caption">
						<?php echo $exerpt; ?>
		  			</div><!-- class="entry-post-thumbnail-caption" -->
   				<?php endif; ?> 
   			
   		</div><!-- class="entry-post-featured" -->


	

		<?php endif; /* has post thumbnail */ ?>
	</header><!-- .entry-header -->

		<div id="post-sidebar">

			<span class="meta-time"><?php the_time("F j, Y \a\\t g:i:sa") ?></span>
		
			<div class="meta-author">

				<div class="meta-author-left">
					<a class="meta-author-link" title="<?php echo exa_properize(get_the_author()); ?> Profile" href="<?php exa_the_author_link() ?>"><?php the_author() ?></a><br/>
					<span class="meta-author-role">The Badger Herald</span> 
					<?php // hrld_author_twitter(); ?>
				</div><!-- class="meta-author-left" -->

				<div class="meta-author-right">
					<a class="meta-author-avatar" title="<?php echo exa_properize(get_the_author()); ?> Profile" href="<?php exa_the_author_link() ?>">
						<?php echo get_wp_user_avatar(get_the_author_meta('ID'), 'square'); ?>
					</a>
				</div><!-- class="meta-author-right" -->
			<div class="clearfix"></div>
			</div><!-- class="meta-author -->


			<div class="social">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_no_style">
					<ul>
						<li><span>Like this post</span><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> </li>
						<li><span>Tweet this post</span><a class="addthis_button_tweet"> </a></li>
						<li><span>Score Karma!</span><a class="addthis_button_reddit"></a> </li>
				
					</ul>
				</div>
				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50c156512b0bcb69"></script>
				<!-- AddThis Button END -->

			</div><!-- class="social" -->


			<?php hrld_sidebar_ad(); ?>

		</div><!-- id="post-sidebar" -->


		<div id="content">
			<?php exa_list_categories(true) ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>

			<div class="article-content">


			<?php if(hrld_related_has_posts()) : ?>
			<div class="related-posts related-posts-<?php hrld_related_post_count() ?>-count related-posts-list-style related-posts-in-article">
				
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
						<img class="thumbnail" src="<?php echo $url ?>" />
								<span class="related-post-type"><?php echo get_post_type($related_post); ?></span>
								<?php echo get_the_title($related_post); ?>
								<span class="excerpt-more">...</span>
	
						</a>

					<?php endforeach; ?>
				</div>
				<div class="clearfix"></div>

			</div>
			<?php endif; // has related posts ?>


			<?php the_content() ?>

			<?php if( get_the_author() == "Letter to the Editor" ) : ?>
				<p class="letter-to-editor-disclaimer"><em><strong>Letters to the editor</strong> are published on the descretion of the opinion desk and editor.  They may not reflect the views of the Herald.  Email your own letters to the editor to oped@badgerherald.com</em></p>
			<?php endif; ?>
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
