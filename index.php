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
		<?php $homepageslider = true; ?>
		<div id="swipe" class="swipe">

			<div class='swipe-wrap'>

			<div class="slide">

				<img src="<?php bloginfo('template_url') ?>/img/temp/cade.png" />
				<h2>Badger game’s streaker says he regrets his decision</h2>
				<p>Peregoy, a Wisconsin native studying landscape architecture, told The Badger Herald his side of the story about that game day.</p>
				<h4 class="slider-related-title">PENN STATE STREAKER</h4>
				<ul class="slider-related">
					<li><a href="#">Drunk student streaks, record number sent to detox at Penn State game</a></li>
					<li><a href="#">Penn State freshman ruins Wisconsin’s Senior Day</a></li>
				</ul>
			</div>

			<div class="slide">

				<img src="<?php bloginfo('template_url') ?>/img/temp/cade.png" />
				<h2>Badger game’s streaker says he regrets his decision</h2>
				<p>Peregoy, a Wisconsin native studying landscape architecture, told The Badger Herald his side of the story about that game day.</p>
				<h4 class="slider-related-title">PENN STATE STREAKER</h4>
				<ul class="slider-related">
					<li><a href="#">Drunk student streaks, record number sent to detox at Penn State game</a></li>
					<li><a href="#">Penn State freshman ruins Wisconsin’s Senior Day</a></li>
				</ul>
			</div>



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

				<img src="<?php bloginfo('template_url') ?>/img/icons/shoutout.png" />
				
				<div class="link-box">
					<a href="<?php bloginfo('url') ?>/shoutouts">More Shoutouts</a>
					<a href="<?php bloginfo('url') ?>/shoutouts/add">Add a Shoutout</a>
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
		<div class="featured-container">
		
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

		
	</div><!-- id="news" -->


	<div id="banter">

		<div class="section-banner section-banner-banter">

			<h2>Banter</h2>

		</div>

		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. </p>

		<p>Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Quisque volutpat condimentum velit. </p>

		<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. Suspendisse in justo eu magna luctus suscipit. </p>

		<p>Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. </p>

		<p>Curabitur sit amet mauris. Morbi in dui quis est pulvinar ullamcorper. Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus. Sed aliquet risus a tortor. Integer id quam. Morbi mi. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede. </p>



	</div><!-- id="banter" -->

	<div id="artsetc">

		<div class="section-banner section-banner-artsetc">

			<h2>ArtsEtc.</h2>

		</div>

		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. </p>

		<p>Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Quisque volutpat condimentum velit. </p>

		<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. Suspendisse in justo eu magna luctus suscipit. </p>

		<p>Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. </p>

		<p>Curabitur sit amet mauris. Morbi in dui quis est pulvinar ullamcorper. Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus. Sed aliquet risus a tortor. Integer id quam. Morbi mi. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede. </p>



	</div><!-- id="artsetc" -->

	<div id="sports">

		<div class="section-banner section-banner-sports">

			<h2>Sports</h2>

		</div>

		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. </p>

		<p>Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Quisque volutpat condimentum velit. </p>

		<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. Suspendisse in justo eu magna luctus suscipit. </p>

		<p>Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. </p>

		<p>Curabitur sit amet mauris. Morbi in dui quis est pulvinar ullamcorper. Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus. Sed aliquet risus a tortor. Integer id quam. Morbi mi. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede. </p>



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