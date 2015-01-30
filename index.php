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

// Set up ads for current page.
global $DoubleClick;
// Done ads.

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
					<?php $DoubleClick->place_ad('bh:sidekick','300x250') ?>
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


	


	<?php

	//$beats_info is an array that holds beat names.
	$beats = array("news" => "news",
					"oped" => "opinion",
					"artsetc" => "artsetc",
					"sports" => "sports");

	foreach($beats as $beat => $beat_name){
		
		hrld_html_tag_open("div", $beat, "clearfix");
			hrld_html_tag_open("div","",array("section-banner", "section-banner-$beat"));
				hrld_html_tag_open("h2","",array(),$beat_name,true);
			hrld_html_tag_close("div");
			hrld_html_tag_open("div","",array("col-container", "clearfix"));
			hrld_html_tag_open("div","",array("featured-container", "featured-container-$beat"));


			//query_featured
			$args = array();
			$args['tax_query'] = array(
	                array(
	                    'taxonomy' => 'category',
	                    'field' => 'slug',
	                    'terms' => array($beat),
	                    'operator' => 'IN'
	                ), array(
	                    'taxonomy' => 'importance',
	                    'field' => 'slug',
	                    'terms' => array('featured'),
	                    'operator' => 'IN'
	                )
	            );
			$args['posts_per_page'] = 4;

			$featured = new WP_Query( $args );
			$excludenews = array();

			//loop_featured
			//also records which posts to exclude in following steps
			while( $featured->have_posts() ) {
				$featured->the_post();
				if($featured->current_post == 0 && !is_paged()){
					get_template_part( 'content', 'summary-featured' );
				}else{

					if($featured->current_post == 1 && !is_paged()){
						hrld_html_tag_open("ul","",array("featured-stream-list"));
					}
					hrld_html_tag_open("li");
						get_template_part( 'content', 'summary-instream' );
					hrld_html_tag_close("li");
				}
				$exclude[] = $post->ID;
			}
			hrld_html_tag_close("ul");
			
			// Restore original Post Data
			wp_reset_postdata();

			//close class="featured-container"
			hrld_html_tag_close("div");

			/* Build query for featured stories in news */
			$args = array();
			$args['posts_per_page'] = 10;
			$args['post__not_in'] = $excludenews;
			$args['tax_query'] = array(
		        array(
		            'taxonomy' => 'category',
		            'field' => 'slug',
		            'terms' => array($beat),
		            'operator' => 'IN'
		        )
		    );
			$featured = new WP_Query( $args );

			hrld_html_tag_open("ul","",array("list-stories", "homepage-$beat-recent"));

			while( $featured->have_posts() ) : $featured->the_post();

				hrld_html_tag_open("li");
					hrld_html_tag_open("span","",array("topic"));
						echo exa_topic( $post->ID );
						hrld_html_tag_open("span","",array("summary-time-stamp"));
							echo " &middot; ";
							echo exa_human_time_diff(get_the_time('U'));
						hrld_html_tag_close("span");
					hrld_html_tag_close("span");
					hrld_html_tag_open("h4");
						hrld_html_tag_open("a","",array(""),get_the_title( $post->ID ),true, array( "href" => get_permalink( $post->ID )));
					hrld_html_tag_close("h4");
				hrld_html_tag_close("li");

			endwhile;

			hrld_html_tag_close("ul");
			wp_reset_postdata();
			hrld_html_tag_close("div");

			hrld_html_tag_open("div","",array("all-link", "all-link-news"));
				hrld_html_tag_open("a","",array(),"All ".ucfirst($beat),true, array("href" => get_bloginfo('url')."/$beat/"));
			hrld_html_tag_close("div");
		hrld_html_tag_close("div");


	}


	?>




<?php get_footer(); ?>