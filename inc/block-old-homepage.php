<?php global $DoubleClick; ?>

<div class="block old-homepage-block">
<div class="wrapper">

<div id="above-fold">

	<div id="slider">

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
				$args['posts_per_page'] = 1;

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
						<?php the_excerpt(); ?>
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



		</div><!-- #slider -->


			<div id="middle-column">
				<div class="hp-square-ad">
					<?php $DoubleClick->place_ad('bh:sidekick','300x250',array('desktop','xl')) ?>
				</div>
			

				<div class="todays-shoutout">
				<?php $DoubleClick->place_ad('bh:sidekick','300x250',array('desktop','xl')) ?>
				</div>
			
			</div> <!-- #middle-column -->

			<div id="most-recent">

				<h3>Most Recent</h3>

				<?php

				$args = array();
				$args['posts_per_page'] = 5;

				$slider_query = new WP_Query( $args ); 

				while( $slider_query->have_posts() ) : $slider_query->the_post(); ?>

					<a class="hp-most-recent" href="<?php the_permalink(); ?>">
						<time><?php echo exa_human_time_diff(get_the_time('U')) ?></time>
						<?php the_title(); ?>
						
					</a>


				<?php endwhile ?>


			</div>


		</div>

</div>
</div>
	<?php get_template_part('inc/block','billboard'); ?>

<div class="block">
<div class="wrapper">

	<?php

	//$beats_info is an array that holds beat names.
	$beats = array("news" => "news",
					"opinion" => "opinion",
					"artsetc" => "artsetc",
					"sports" => "sports");

	foreach($beats as $beat => $beat_name) {
		
		hrld_html_tag_open("div", $beat, array("clearfix"));
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
			$exclude = array();


			//loop_featured
			//also records which posts to exclude in following steps
			while( $featured->have_posts() ) : $featured->the_post(); 


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
			endwhile;
			
			// Restore original Post Data
			wp_reset_postdata();
			wp_reset_query();

			hrld_html_tag_close("ul");

			//close class="featured-container"
			hrld_html_tag_close("div");

			/* Build query for featured stories in news */
			$args = array();
			$args['posts_per_page'] = 10;
			$args['post__not_in'] = $exclude;
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

			hrld_html_tag_open("div","",array("all-link", "all-link-$beat"));
				hrld_html_tag_open("a","",array(),"All ".ucfirst($beat),true, array("href" => get_bloginfo('url')."/$beat/"));
			hrld_html_tag_close("div");
		hrld_html_tag_close("div");


	}


	?>

</div></div>