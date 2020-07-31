<?php 


$container = $GLOBALS['container'] ?: new container('old-homepage');

?>

<div class="<?php echo $container->classes(); ?>">
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
	                    'terms' => array('featured','cover'),
	                    'operator' => 'IN'
	                )
	            );
			$args['posts_per_page'] = 3;
			$args['no_found_rows'] = true;

			$featured = new WP_Query( $args );

			//loop_featured
			//also records which posts to exclude in following steps
			while( $featured->have_posts() ) : $featured->the_post(); 


				if($featured->current_post == 0 && !is_paged()){
					get_template_part( 'blocks/teaser', 'feature' );
				} else {
					get_template_part( 'blocks/teaser', 'brief' );
				}
				
				$exclude[] = $post->ID;
			endwhile;
			
			// Restore original Post Data
			wp_reset_postdata();
			wp_reset_query();



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
		    $args['no_found_rows'] = true;
			$featured = new WP_Query( $args );

			hrld_html_tag_open("ul","",array("list-stories", "homepage-$beat-recent"));

			while( $featured->have_posts() ) : $featured->the_post();

				hrld_html_tag_open("li");
					hrld_html_tag_open("span","",array("topic"));
						exa_topic( $post->ID );
						hrld_html_tag_open("span","",array("summary-time-stamp"));
							echo " &middot; ";
							exa_time();

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

</div>
</div>