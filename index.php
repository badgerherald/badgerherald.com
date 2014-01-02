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
			
				<?php the_post_thumbnail(); ?>
				<div class="slider-content">
					<h2><?php the_title(); ?></h2>
					<p><?php the_excerpt(); ?></p>
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

		</div>

		<ul class="slider-nav">
			<li><span>Slide 1</span></li>
			<li class="active"><span>Slide 2</span></li>
			<li><span>Slide 3</span></li>
			<li><span>Slide 4</span></li>
		</ul>

	</div>

	</div>

		<div id="middle-column">
			<div class="hp-square-ad">
				<?php hrld_sidebar_lower_ad(); ?>
			</div>
		

			<div class="todays-shoutout">

				<div class="bubble-box">
					<h3>SO of the Day</h3>
					<p>SO to girls. You have to suck dick and birth babies. That must blow.</p>
				</div>

				<img class="hp-so-avatar" src="<?php bloginfo('template_url') ?>/img/icons/shoutout.png" />
				
				<div class="link-box">
					<a class="more" href="<?php bloginfo('url') ?>/shoutouts">More Shoutouts</a><br/>
					<a class="submit" href="<?php bloginfo('url') ?>/shoutouts/add">Add a Shoutout</a>
				</div>

			</div>
		
		</div> <!-- #middle-column -->


		<div id="top-posts">
		<h3>Top Posts</h3>
		<ul>
			<li><a href="#">Democrat to run for Schultz’ senate seat</a></li>
			<li><a href="#">AirBnB, ‘tourist rooming houses’ renters given stricter regulations</a></li>
			<li><a href="#">Soglin says Madison Public Market to split, open in 2017</a></li>
			<li><a href="#">Walker leads 2016 presidential election polls</a></li>
			<li><a href="#">Man robs elderly couple after offering a helping hand</a></li>
			<li><a href="#">Nurses outraged over MTV’s new show</a></li>
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


	<div id="banter">

		<div class="section-banner section-banner-banter">

			<h2>Banter</h2>

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
		<div class="all-link all-link-banter"><a href="<?php bloginfo('url'); ?>/oped/">All Banter</a></div>



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


	<?php /* ?>
	<?php if ( have_posts() ) : ?>

		<?php /* The loop  ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php if(exa_is_featured()) : ?>
				<?php get_template_part( 'content', 'summary-featured' ); ?>
			<?php elseif(exa_is_instream()) : ?>
				<?php get_template_part( 'content', 'summary-instream' ); ?>
			<?php endif; ?>
			<hr />
			
		<?php endwhile; ?>

	<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>

	<?php */ ?>

	

	<?php get_sidebar(); ?>

	<div id="clearfix"></div>



<?php get_footer(); ?>