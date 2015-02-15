<?php
/**
 * The default template for displaying content. Used for single.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

global $DoubleClick;
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

					<h1 class="article-title"><?php the_title(); ?></h1>
				
				<?php if( hrld_has_subhead(get_the_ID()) ) : ?>
				
					<h2 class="article-subhead"><?php hrld_the_subhead(); ?></h2>
				
				<?php endif; ?>

					<div class="article-meta">

						<div class="article-mug-box">
							<?php exa_mug($post->user_id,'small-thumbnail') ?>
						</div>
						
						<span class="meta-author">
							by 
							<a href="<?php exa_the_author_link() ?>" title="<?php echo exa_properize(get_the_author()); ?> Profile">
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
						Pop Posts
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

					<a class="comment-button" href="#">Comments</a>
					<p>This article was published <strong><?php the_time("M j, Y") ?></strong> at <strong><?php the_time("g:i a"); ?></strong>, and last updated <strong><?php the_modified_time("M j, Y") ?></strong> at <strong><?php the_modified_time("g:i a"); ?></strong>.<p>

						
					<div class="comment-pane">
						<?php comments_template(); ?> 
					</div>

				</section>

			</main>
			
		</article><!-- #post -->

	</div><!-- .wrapper -->

</div><!-- .block -->

