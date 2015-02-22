<?php
/**
 * The default template for displaying content. Used for single.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

global $DoubleClick;
global $post;
?>

<div class="block article-display-block">
	
	<span class="context-label">ARTICLE BLOCK</span>
	
	<div class="wrapper">
	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php
		/**
		 * Retrieve and display feature-image (hero).
		 * 
		 */
		if ( has_post_thumbnail() && ! post_password_required() ) : ?>
				
			<div class="hero">

				<?php the_post_thumbnail('image-post-size'); ?>
				
				
				<aside class="hero-aside">

					<div class="hero-ad">

						<?php $DoubleClick->place_ad('bh:leaderboard','300x250',array('desktop','xl')); ?>
						
					</div>

					<?php exa_hero_caption(); ?>

				</aside>  

				<div class="clearfix"></div>

			</div>

		<?php endif; /* if has feature image */ ?>

			<main>

				<?php 
				/**
			 	 * Header
				 */ 
				?>
				<header class="article-header">

					<!-- <a class="article-section"><?php echo exa_section(); ?></a> -->

					<?php echo exa_get_tweet_link(get_the_title(),null,'article-title',1); ?>
				
				<?php if( hrld_has_subhead(get_the_ID()) ) : ?>
				
					<h2 class="article-subhead"><?php hrld_the_subhead(); ?></h2>
				
				<?php endif; ?>

					<div class="article-meta">

						<aside class="aside-pane aside-author aside-pane-slim" style="margin-left: -560px; top: 728px; display: none;">
								
								<?php exa_round_mug( get_the_author_meta('ID') ); ?>
								<h3>Also by <?php the_author() ?></h3>

								<?php 
								// the query
								$the_query = new WP_Query( array("author" => get_the_author_meta('ID')) ); ?>
								
								<?php if ( $the_query->have_posts() ) : ?>
								
									<!-- pagination here -->
								
									<!-- the loop -->
									<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
										<p><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
									<?php endwhile; ?>
									<!-- end of the loop -->
								
									<!-- pagination here -->
								
									<?php wp_reset_postdata(); ?>
								
								<?php else : ?>
									<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
								<?php endif; ?>

						</aside>
						<div class="article-mug-box open-author-pane">
							<?php exa_mug(get_the_author_meta('ID'),'small-thumbnail') ?>
						</div>
						
						<span class="meta-author">
							by 
							<a class="author-link" href="<?php exa_the_author_link() ?>" title="<?php echo exa_properize(get_the_author()); ?> Profile">
								<?php the_author() ?>
							</a>
						</span> &middot;

						<span class="meta-time">
							<?php the_time("M j, Y") ?>
						</span>

					</div>

				</header>

				<?php 
				/**
			 	 * The sidebar to the post.
				 */ 
				?>
				<section class="lede-sidebar">
					
					<div class="ad sidebar-thing">
						<?php $DoubleClick->place_ad('bh:leaderboard','300x250',array('tablet','xl','desktop')); ?>
					</div>

					<div class="popular-posts sidebar-thing">
						<?php the_widget( "Popular_Post_Widget"); ?>
					</div>

					<div class="ad sidebar-thing">
						<?php $DoubleClick->place_ad('bh:leaderboard','300x250',array('xl','desktop')); ?>
					</div>

				</section>

				<?php 
				/**
			 	 * The article text.
				 */ 
				?>
				<section class="article-text">

					<?php the_content(); ?>

				</section>

				<section class="footnote-sidebar">
					Article tweets place.
				</section>

				<div class="clearfix"></div>


				<section class="article-footnotes">

					<hr/>

					<aside class="aside-pane comments-pane aside-pane-wide"><?php comments_template(); ?></aside>
					
					<a class="comment-button open-comments-pane" href="#">Comments</a>
					
					<p>This article was published <strong><?php the_time("M j, Y") ?></strong> at <strong><?php the_time("g:i a"); ?></strong>, and last updated <strong><?php the_modified_time("M j, Y") ?></strong> at <strong><?php the_modified_time("g:i a"); ?></strong>.<p>
					
				</section>

			</main>
			
		</article><!-- #post-xx -->

	</div><!-- .wrapper -->

</div><!-- .block -->

