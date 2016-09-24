<?php
/**
 * The default template for displaying content. Used for single.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

global $AnalyticBridge;
global $OnCampus;
global $post;

?>

<?php 

exa_container('hero');

?>
<div class="container article-display showcase-block">
	
	<div class="wrapper">
	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<main>

				<?php 
				/**
			 	 * Header
				 */ 
				?>
				<header class="article-header">
					
					<h1 class="article-title"><?php the_title() ?></h1>
					
				
				<?php if( exa_has_subhead(get_the_ID()) ) : ?>
				
					<h2 class="article-subhead"><?php exa_subhead(); ?></h2>
				
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
						<?php 
						$OnCampus->place_ad(array('tablet'=>'upper-sidekick')); 
						?>
					</div>

					<div class="popular-posts sidebar-thing">
						<?php is_active_widget('Popular_Post_Widget') ? the_widget( "Popular_Post_Widget") : 0; ?>
					</div>

					<div class="ad sidebar-thing">
						<?php 
						$OnCampus->place_ad(array('tablet'=>'lower-sidekick')); 
						?>
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

				<?php /*
				<section class="footnote-sidebar">
					Article tweets place.
				</section>
				*/ ?>

				<div class="clearfix"></div>


				<section class="article-footnotes">

					<?php exa_sharebar(); ?>

					<hr/>

					<aside class="aside-pane comments-pane aside-pane-wide"><?php comments_template(); ?></aside>
					
					<a class="comment-button open-comments-pane" href="#">Comments</a>
					
					<?php /* LTE Disclaimer */ ?>
					<?php if( get_the_author() == "Letter to the Editor" ) : ?>
						<p class="letter-to-editor-disclaimer"><em><strong>Letters to the editor</strong> are published on the discretion of the opinion desk and editor. They may not reflect the views of the Herald. Email your own letters to the editor to oped@badgerherald.com</em></p>
					<?php endif; ?>

					<p>This article was published <strong><?php the_time("M j, Y") ?></strong> at <strong><?php the_time("g:i a"); ?></strong>, and last updated <strong><?php the_modified_time("M j, Y") ?></strong> at <strong><?php the_modified_time("g:i a"); ?></strong>.<p>
					
				</section>

			</main>
			
		</article><!-- #post-xx -->

	</div><!-- .wrapper -->

</div>

