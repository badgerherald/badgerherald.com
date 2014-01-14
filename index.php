<?php
/**
 *
 * BH Homepage Theme.
 * 
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header();

?>

	<?php $homepageSlider = true; /* Boolean to tell footer.php to load 
													   * the slider script. 
													   */ ?>

	<div id="above-fold" class="clearfix">

	<div  id="slider">

			<div id="swipe" class="swipe">

				<div class='swipe-wrap'>

				<?php $homepageSlider = true; /* Boolean to tell footer.php to load 
														   * the slider script. 
														   */ ?>
				<?php
		
				/* Build query for featured stories in news */

				$args = array();
				$args['tax_query'] = array(
		                array(
		                    'taxonomy' => 'importance',
		                    'field' => 'slug',
		                    'terms' => array('featured'),
		                    'operator' => 'IN'
		                )
		            );
				$args['posts_per_page'] = 4;

				$slider_query = new WP_Query( $args );

				?>

				<?php while( $slider_query->have_posts() ) : $slider_query->the_post();?>
					
				<div class="slide">
					<a href="<?php the_permalink() ?>">
					<?php the_post_thumbnail(); ?>
					</a>
					<div class="slider-content">
					<a href="<?php the_permalink() ?>">
						<h2><?php the_title(); ?></h2>
						<p><?php the_excerpt(); ?></p>
						</a>
						<?php if(hrld_related_has_posts()) : ?>
							<ul class="slider-related">
								<li><h4 class="slider-related-title"><?php hrld_related_topic() ?></h4></li>
								<?php $related = hrld_related_post_ids(); foreach($related as $relatedID) : ?>
									<li><a href="<?php echo get_permalink($relatedID) ?>"><?php echo get_the_title($relatedID) ?></a></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>

				<?php endwhile; ?>

				<?php
					// Restore original Post Data
					wp_reset_postdata();
				?>

				</div><!-- .swipe-wrap -->

				<ul class="slider-nav">
					<li><span>Slide 1</span></li>
					<li class="active"><span>Slide 2</span></li>
					<li><span>Slide 3</span></li>
					<li><span>Slide 4</span></li>
				</ul>

			</div> <!-- #swipe.swipe -->

		</div><!-- #slider -->


			<div id="middle-column">
				<div class="hp-square-ad">
					<?php dfp::hrld_sidebar_lower_ad(); ?>
				</div>
			

				<div class="todays-shoutout">

					<div class="bubble-box">
						<h3>SO of the Day</h3>
						<p>ASO to being so damn confused about a boy. Why can't life just tell you what you're supposed to do?</p>
					</div>

					<img class="hp-so-avatar" src="<?php bloginfo('template_url') ?>/img/icons/shoutout.png" />
					
					<div class="link-box">
						<a class="more" href="<?php bloginfo('url') ?>/shoutouts">More Shoutouts</a><br/>
						<a class="submit" href="<?php bloginfo('url') ?>/shoutouts/add">Add a Shoutout</a>
					</div>

				</div>
			
			</div> <!-- #middle-column -->


			<div id="top-posts">
			<h3>Top Picks</h3>
			<ul>
				<li><a href="http://badgerherald.com/news/2014/01/10/marijuana-legalization-appear-county-ballot/">Marijuana legalization to appear on Dane County spring ballot</a></li>
				<li><a href="http://badgerherald.com/news/2013/12/12/uw-alums-site-abodo-aims-simplify-housing-search/">UW alum’s site Abodo aims to simplify housing search</a></li>
				<li><a href="http://badgerherald.com/sports/2014/01/10/merschs-magic-propels-wisconsin-victory-michigan/">Mersch’s magic propels Wisconsin to victory over Michigan</a></li>
				<li><a href="http://badgerherald.com/sports/2013/12/21/penn-state-ends-wisconsins-cinderella-run/">Penn State ends Wisconsin’s post-season cinderella run</a></li>
				<li><a href="http://badgerherald.com/sports/2014/01/09/4-wisconsin-dominates-23-illinois-start-finish/">No. 4 Wisconsin dominates No. 23 Illinois from start to finish</a></li>
				<li><a href="http://badgerherald.com/artsetc/2013/12/12/top-five-shows-binge-watch-winter-break-es/">The top five shows to binge-watch over winter break</a></li>
				<li><a href="http://badgerherald.com/artsetc/2013/12/11/childish-gambino-needs-figure-internet-es/">Childish Gambino needs to figure out who he is on ‘Because the Internet’</a></li>			
				<li><a href="http://badgerherald.com/sports/2013/12/21/penn-state-ends-wisconsins-cinderella-run/">Penn State ends Wisconsin’s post-season cinderella run</a></li>
				<li><a href="http://badgerherald.com/artsetc/2013/12/18/inside-lleywn-davis-lies-beautiful-cyclical-folk-tale/">Inside ‘Lleywn Davis’ lies beautiful, cyclical folk tale</a></li>
			</ul>
			</div>



		</div>


	


	<div id="news" class="clearfix">

		<div class="section-banner section-banner-news">

			<h2>News</h2>

		</div>
        <div class="col-container clearfix">
		<div class="featured-container featured-container-news">
		
		<?php
		
			/* Build query for featured stories in news */

			$args = array();
			$args['tax_query'] = array(
	                array(
	                    'taxonomy' => 'importance',
	                    'field' => 'slug',
	                    'terms' => array('featured'),
	                    'operator' => 'IN'
	                )
	            );
			$args['post_type'] = 'news';
			$args['posts_per_page'] = 4;

			$news_featured = new WP_Query( $args );
			$excludenews = array();
		?>

		<?php while( $news_featured->have_posts() ) {
			$news_featured->the_post();
			if($news_featured->current_post == 0 && !is_paged()){
				get_template_part( 'content', 'summary-featured' );
			}
			else{
				if($news_featured->current_post == 1 && !is_paged()){
					echo '<ul class="featured-stream-list">';
				}
				echo '<li>';
				get_template_part( 'content', 'summary-instream' );
				echo '</li>';
			}
			$excludenews[] = $post->ID;
		} ?>
				</ul>
		<?php
			// Restore original Post Data
			wp_reset_postdata();
		?>
		</div> <!-- class="featured-container" -->
        

		<?php
		
			/* Build query for featured stories in news */
			$args = array();
			$args['post_type'] = 'news';
			$args['posts_per_page'] = 10;
			$args['post__not_in'] = $excludenews;

			$news_featured = new WP_Query( $args );
		
		?>
		
		<ul class="list-stories homepage-news-recent">
		<?php while( $news_featured->have_posts() ) : $news_featured->the_post(); ?>

			<li>

				<span class="topic"><?php echo exa_topic( $post->ID ); ?><span class="summary-time-stamp"> &middot; <?php echo exa_human_time_diff(get_the_time('U')) ?> ago</span></span>
				<h4><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo get_the_title( $post->ID ); ?></a></h4>

			</li>

		<?php endwhile; ?>
		</ul>

		<?php
			// Restore original Post Data
			wp_reset_postdata();
		?>
		</div>
		<div class="all-link all-link-news"><a href="<?php bloginfo('url'); ?>/news/">All News</a></div>
	</div><!-- id="news" -->


	<div id="opinion">

		<div class="section-banner section-banner-banter">

			<h2>Opinion</h2>

		</div>
        <div class="col-container clearfix">
		<div class="featured-container featured-container-banter">
		
		<?php
		
			/* Build query for featured stories in banter */

			$args = array();
			$args['tax_query'] = array(
	                array(
	                    'taxonomy' => 'importance',
	                    'field' => 'slug',
	                    'terms' => array('featured'),
	                    'operator' => 'IN'
	                )
	            );
			$args['post_type'] = 'oped';
			$args['posts_per_page'] = 4;

			$banter_featured = new WP_Query( $args );
			$excludebanter = array();
		?>

		<?php while( $banter_featured->have_posts() ) {
			$banter_featured->the_post();
			if($banter_featured->current_post == 0 && !is_paged()){
				echo '<ul class="featured-stream-list">';
				echo '<li>';
				get_template_part( 'content', 'summary-instream' );
				echo '</li>';
			}
			else{
				echo '<li>';
				get_template_part( 'content', 'summary-instream' );
				echo '</li>';
			}
			$excludebanter[] = $post->ID;
		} ?>
				</ul>
		<?php
			// Restore original Post Data
			wp_reset_postdata();
		?>
		</div> <!-- class="featured-container featured-container-banter" -->
        
        <div class="opinion-desk">
        <?php
			/* Build query for from opinion desk */
			$args = array();
			$args['tax_query'] = array(
	                array(
	                    'taxonomy' => 'oped-beats',
	                    'field' => 'slug',
	                    'terms' => array('opinion-desk'),
	                    'operator' => 'IN'
	                )
	            );
			$args['post_type'] = 'oped';
			$args['posts_per_page'] = 6;
			$args['post__not_in'] = $excludebanter;
			
			$banter_featured = new WP_Query( $args );
		?>
        <?php while( $banter_featured->have_posts() ) {
			$banter_featured->the_post();
			if($banter_featured->current_post == 0 && !is_paged()){
				echo '<ul class="opinion-desk-stream-list">';
				echo '<li>';
				get_template_part( 'content', 'summary-instream' );
				echo '</li>';
			}
			else{
				if($banter_featured->current_post == 1 && !is_paged()){
					
				}
				echo '<li>';
				get_template_part( 'content', 'summary-instream' );
				echo '</li>';
			}
			$excludebanter[] = $post->ID;
		} ?>
				</ul>
		<?php
			// Restore original Post Data
			wp_reset_postdata();
		?>
        </div>

		<?php
		
			/* Build query for featured stories in banter */
			$args = array();
			$args['post_type'] = 'oped';
			$args['posts_per_page'] = 10;
			$args['post__not_in'] = $excludebanter;

			$banter_featured = new WP_Query( $args );
		
		?>
		
		<ul class="list-stories homepage-banter-recent">
		<?php while( $banter_featured->have_posts() ) : $banter_featured->the_post(); ?>

			<li>

				<span class="topic"><?php echo exa_topic( $post->ID ); ?><span class="summary-time-stamp"> &middot; <?php echo exa_human_time_diff(get_the_time('U')) ?> ago</span></span>
				<h4><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo get_the_title( $post->ID ); ?></a></h4>

			</li>

		<?php endwhile; ?>
		</ul>

		<?php
			// Restore original Post Data
			wp_reset_postdata();
		?>
		</div>
		<div class="all-link all-link-banter"><a href="<?php bloginfo('url'); ?>/oped/">All Opinion</a></div>



	</div><!-- id="banter" -->

	<div id="artsetc">

		<div class="section-banner section-banner-artsetc">

			<h2>ArtsEtc.</h2>

		</div>
		<div class="col-container clearfix">
		<div class="featured-container featured-container-arts">
		
		<?php
		
			/* Build query for featured stories in arts */

			$args = array();
			$args['tax_query'] = array(
	                array(
	                    'taxonomy' => 'importance',
	                    'field' => 'slug',
	                    'terms' => array('featured'),
	                    'operator' => 'IN'
	                )
	            );
			$args['post_type'] = 'artsetc';
			$args['posts_per_page'] = 4;

			$arts_featured = new WP_Query( $args );
			$excludearts = array();
		?>

		<?php while( $arts_featured->have_posts() ) {
			$arts_featured->the_post();
			if($arts_featured->current_post == 0 && !is_paged()){
				get_template_part( 'content', 'summary-featured' );
			}
			else{
				if($arts_featured->current_post == 1 && !is_paged()){
					echo '<ul class="featured-stream-list">';
				}
				echo '<li>';
				get_template_part( 'content', 'summary-instream' );
				echo '</li>';
			}
			$excludearts[] = $post->ID;
		} ?>
				</ul>
		<?php
			// Restore original Post Data
			wp_reset_postdata();
		?>
		</div> <!-- class="featured-container featured-container-arts" -->

		<?php
		
			/* Build query for featured stories in news */
			$args = array();
			$args['post_type'] = 'artsetc';
			$args['posts_per_page'] = 10;
			$args['post__not_in'] = $excludearts;

			$arts_featured = new WP_Query( $args );
		
		?>
		
		<ul class="list-stories homepage-arts-recent">
		<?php while( $arts_featured->have_posts() ) : $arts_featured->the_post(); ?>

			<li>

				<span class="topic"><?php echo exa_topic( $post->ID ); ?><span class="summary-time-stamp"> &middot; <?php echo exa_human_time_diff(get_the_time('U')) ?> ago</span></span>
				<h4><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo get_the_title( $post->ID ); ?></a></h4>

			</li>

		<?php endwhile; ?>
		</ul>

		<?php
			// Restore original Post Data
			wp_reset_postdata();
		?>
		</div>
		<div class="all-link all-link-arts"><a href="<?php bloginfo('url'); ?>/artsetc/">All Artsetc.</a></div>



	</div><!-- id="artsetc" -->

	<div id="sports">

		<div class="section-banner section-banner-sports">

			<h2>Sports</h2>

		</div>
		<div class="col-container clearfix">
		<div class="featured-container featured-container-sports">
		
		<?php
		
			/* Build query for featured stories in sports */

			$args = array();
			$args['tax_query'] = array(
	                array(
	                    'taxonomy' => 'importance',
	                    'field' => 'slug',
	                    'terms' => array('featured'),
	                    'operator' => 'IN'
	                )
	            );
			$args['post_type'] = 'sports';
			$args['posts_per_page'] = 4;

			$sports_featured = new WP_Query( $args );
			$excludesports = array();
		?>

		<?php while( $sports_featured->have_posts() ) {
			$sports_featured->the_post();
			if($sports_featured->current_post == 0 && !is_paged()){
				get_template_part( 'content', 'summary-featured' );
			}
			else{
				if($sports_featured->current_post == 1 && !is_paged()){
					echo '<ul class="featured-stream-list">';
				}
				echo '<li>';
				get_template_part( 'content', 'summary-instream' );
				echo '</li>';
			}
			$excludesports[] = $post->ID;
		} ?>
				</ul>
		<?php
			// Restore original Post Data
			wp_reset_postdata();
		?>
		</div> <!-- class="featured-container" -->
        

		<?php
		
			/* Build query for featured stories in sports */
			$args = array();
			$args['post_type'] = 'sports';
			$args['posts_per_page'] = 10;
			$args['post__not_in'] = $excludesports;

			$sports_featured = new WP_Query( $args );
		
		?>
		
		<ul class="list-stories homepage-sports-recent">
		<?php while( $sports_featured->have_posts() ) : $sports_featured->the_post(); ?>

			<li>

				<span class="topic"><?php echo exa_topic( $post->ID ); ?><span class="summary-time-stamp"> &middot; <?php echo exa_human_time_diff(get_the_time('U')) ?> ago</span></span>
				<h4><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo get_the_title( $post->ID ); ?></a></h4>

			</li>

		<?php endwhile; ?>
		</ul>

		<?php
			// Restore original Post Data
			wp_reset_postdata();
		?>
		</div>
		<div class="all-link all-link-sports"><a href="<?php bloginfo('url'); ?>/sports/">All Sports</a></div>


	</div><!-- id="sports" -->




<?php get_footer(); ?>