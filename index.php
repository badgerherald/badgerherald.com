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

	
	<?php 

	if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/fold/fold.php")) {
		include($_SERVER["DOCUMENT_ROOT"] . "/fold/fold.php");
	}

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
					<?php dfp::small_sidekick(); ?>
				</div>
			

				<div class="todays-shoutout">

					<div class="bubble-box">
						<h3>SO of the Day</h3>

							<?php 

							if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/assets/so.php")) {
								include($_SERVER["DOCUMENT_ROOT"] . "/assets/so.php");
							}

							?>

					</div>

					<img class="hp-so-avatar" src="<?php bloginfo('template_url') ?>/img/icons/shoutout.png" />
					
					<div class="link-box">
						<a class="more" href="<?php bloginfo('url') ?>/shoutouts">More Shoutouts</a><br/>
						<a class="submit" href="<?php bloginfo('url') ?>/shoutouts/add">Add a Shoutout</a>
					</div>

				</div>
			
			</div> <!-- #middle-column -->

			<div id="interactive">
				<h3>Interactive</h3>

				<a href="http://badgerherald.com/interactive/2014/04/28/the-puzzle-of-the-student-athlete/">
				<img src="http://badgerherald.com/wordpress/media/2014/04/cover-718x470.jpg" />
				<h4>The puzzle of the student-athlete</h4>
				</a>
				<p class="athr">
					<a class="meta-author-avatar" title="Nick Daniels' Profile" href="http://badgerherald.com/author/ndaniels">
						<img src="http://badgerherald.com/wordpress/media/2013/11/img_9294-60x60.jpg" width="30px" height:"30px"/>
					</a>
					
					<span class="meta-author">By <a href="http://badgerherald.com/author/ndaniels" title="Nick Daniels' Profile">Nick Daniels</a></span>
				</p>
				<a href="http://badgerherald.com/interactive/2014/04/28/the-puzzle-of-the-student-athlete/">
					<p>Student-athletes across all sports must balance a full class schedule with an equally arduous practice schedule.</p>
				</a>
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

			/** Featured news is a combination of
			 *   a. In the taxonomy 'category' with the term 'news'
			 *   b. In the taxonomy 'importance' with the term 'featured'
			 */

			$args = array();
			$args['tax_query'] = array(
	                array(
	                    'taxonomy' => 'category',
	                    'field' => 'slug',
	                    'terms' => array('news'),
	                    'operator' => 'IN'
	                ), array(
	                    'taxonomy' => 'importance',
	                    'field' => 'slug',
	                    'terms' => array('featured'),
	                    'operator' => 'IN'
	                )
	            );
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
			$args['posts_per_page'] = 10;
			$args['post__not_in'] = $excludenews;
			$args['tax_query'] = array(
		        array(
		            'taxonomy' => 'category',
		            'field' => 'slug',
		            'terms' => array('news'),
		            'operator' => 'IN'
		        )
		    );
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
	                ), array(
	                    'taxonomy' => 'category',
	                    'field' => 'slug',
	                    'terms' => array('oped'),
	                    'operator' => 'IN'
	                ), 
	            );
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
	                    'taxonomy' => 'topic',
	                    'field' => 'slug',
	                    'terms' => array('opinion-desk'),
	                    'operator' => 'IN'
	                )
	            );
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

			$args['posts_per_page'] = 10;
			$args['post__not_in'] = $excludebanter;
			$args['tax_query'] = array(
	                array(
	                    'taxonomy' => 'category',
	                    'field' => 'slug',
	                    'terms' => array('oped'),
	                    'operator' => 'IN'
	                )
	            );
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
	                ), array(
	                    'taxonomy' => 'category',
	                    'field' => 'slug',
	                    'terms' => array('artsetc'),
	                    'operator' => 'IN'
	                )
	            );
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

			$args['posts_per_page'] = 10;
			$args['post__not_in'] = $excludearts;
			$args['tax_query'] = array(
	                array(
	                    'taxonomy' => 'category',
	                    'field' => 'slug',
	                    'terms' => array('artsetc'),
	                    'operator' => 'IN'
	                )
	            );
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
	                    'taxonomy' => 'category',
	                    'field' => 'slug',
	                    'terms' => array('sports'),
	                    'operator' => 'IN'
	                ), array(
	                    'taxonomy' => 'importance',
	                    'field' => 'slug',
	                    'terms' => array('featured'),
	                    'operator' => 'IN'
	                )
	            );
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
			$args['tax_query'] = array(
	                array(
	                    'taxonomy' => 'category',
	                    'field' => 'slug',
	                    'terms' => array('sports'),
	                    'operator' => 'IN'
	                )
	            );
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