<?php
/**
 * The default template for displaying content. Used for single.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

global $AnalyticBridge;
global $DoubleClick;
global $post;

?>

<?php
	get_header();

//	if( true ) {
//		get_template_part('inc/blocks/preflight');
//	} else {
		get_template_part('inc/blocks/leaderboard');
//	}
	get_template_part('inc/blocks/menu-search-bar');
	get_template_part('inc/blocks/mobile-header');
	get_template_part('inc/blocks/header');
	get_template_part('inc/blocks/hero');

?>
<div class="block article-display-block showcase-block">
	
	<div class="wrapper">
	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<main>

				<?php 
				/**
			 	 * Header
				 */ 
				?>
				<header class="article-header">

					<!-- <a class="article-section"><?php echo exa_section(); ?></a> -->
					
					<h1 class="article-title"><?php the_title() ?></h1>
					
				
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
							<!---<a class="author-link" href="<?php exa_the_author_link() ?>" title="<?php echo exa_properize(get_the_author()); ?> Profile">
								<?php the_author() ?>
							</a> -->
							<?php //the_author(); 
								echo hrld_bylines_the_authors('', true, array('class' => 'author-link'));
							?>
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

</div><!-- .block -->

<div class="block read-next-block" style="border-top: 1px solid #c7d0d5; margin-top: 64px;">
	<div class="wrapper" style="text-align: center;margin-top: 42px; ">
			<h2 style=" font-family: pt serif; text-transform: uppercase; font-style: italic; background: #2379d0; color: #fff; font-size: 42px; display:inline-block; padding: 12px 20px; line-height: 54px; text-align: center; margin: 0 auto;">Read Next</h2>
	</div>
</div>

<?php 

Exa::addShownId(get_the_ID());

?>

<?php get_template_part('inc/blocks/feature-widget'); ?>
<?php get_template_part('inc/blocks/ad-and-two-dominant'); ?>
<?php get_template_part('inc/blocks/list-and-banter'); ?>

<?php get_template_part('footer');

