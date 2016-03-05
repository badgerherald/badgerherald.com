<?php 


global $DoubleClick;
global $block;
if(!$block) {
	$block = new Block('article-display');
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php 
exa_block('headline');
?>

<div class="block article-display-block showcase-block">
	<div class="wrapper">
	
			<main class="article-content">

				<div class="meta">

					<?php /* Mug: */ ?>
					<div class="mug-box">
						<?php exa_mug(get_the_author_meta('ID'),'small-thumbnail') ?>
					</div>
					
					<?php /* Byline: */ ?>
					<span class="byline">
						by <a class="author-link" href="<?php exa_the_author_link() ?>" title="<?php echo exa_properize(get_the_author()); ?> Profile">
							   <?php the_author() ?>
						   </a>
					</span> &middot; <span class="meta-time"><?php the_time("M j, Y") ?></span>

					<?php /* Facebook: */ ?>
					<div class="facebook">
					<div  class="fb-like" 
						  data-href="<?php echo exa_social_url(get_permalink($post->ID), false); ?>" 
						  data-layout="button_count" 
						  data-action="like" 
						  data-width="90"
						  data-show-faces="false" 
						  data-share="true">
					</div>
					</div>
			
					<?php /* Twitter: */ ?>
					<div class="twitter">
					<a  href="https://twitter.com/share" 
						class="twitter-share-button " 
						data-url="<?php echo exa_social_url(get_permalink($post->ID), false); ?>" 
						data-text="<?php echo the_title(); ?>." 
						data-via="badgerherald" 
						data-related="badgerherald">Tweet</a>
					</div>

				</div>

				<?php

				/* Hero */

				$hide_feature = get_post_meta( get_the_ID(), '_exa_hide_featured_image', true);
				$hide_feature = $hide_feature && $block->option('hide-hero');
				$coverLayout = exa_layout() == "video" || exa_layout() == "cover";
				if ( has_post_thumbnail() && !($hide_feature == "true") && !$coverLayout) : ?>
						
				<div class="hero">
				
					<?php the_post_thumbnail('image-post-size'); ?>
					<?php exa_hero_caption(); ?>
	
					<div class="clearfix"></div>
					
				</div>
				
				<?php 

				endif; 

				/* End Hero */

				?>

				<section class="article-text">

					<?php the_content(); ?>
					
					<div class="article-footnotes">

						<?php exa_sharebar(); ?>
	
						<hr/>
	
						<aside class="aside-pane comments-pane aside-pane-wide"><?php comments_template(); ?></aside>
						
						<a class="comment-button open-comments-pane" href="#">Comments</a>
						
						<?php /* LTE Disclaimer */ ?>
						<?php if( get_the_author() == "Letter to the Editor" ) : ?>
							<p class="letter-to-editor-disclaimer"><em><strong>Letters to the editor</strong> are published on the discretion of the opinion desk and editor. They may not reflect the views of the Herald. Email your own letters to the editor to oped@badgerherald.com</em></p>
						<?php endif; ?>
	
						<p>This article was published <strong><?php the_time("M j, Y") ?></strong> at <strong><?php the_time("g:i a"); ?></strong>, and last updated <strong><?php the_modified_time("M j, Y") ?></strong> at <strong><?php the_modified_time("g:i a"); ?></strong>.<p>
					</div>

				</section>

			</main>

				
				<aside class="sidebar">

				<div class="ad sidebar-thing">
				<?php 
				
					$sizes = '300x250';
					$args = array(
			    		'lazyLoad' => true 
					);
		
					$DoubleClick->place_ad('post-sidebar-2',$sizes,$args);
	
				?>
				</div>

				<div class="popular-posts sidebar-thing">
					<?php the_widget( "Popular_Post_Widget"); ?>
				</div>
	
				<div class="ad sidebar-thing">
				<?php 
				
					$sizes = '300x250';
					$args = array(
			    		'lazyLoad' => true 
					);
		
					$DoubleClick->place_ad('post-sidebar-2',$sizes,$args);
	
				?>
				</div>
		
				</aside>
	
				<div class="clearfix"></div>



		

	</div><!-- .wrapper -->

</div><!-- .block -->


</article><!-- #post-xx -->