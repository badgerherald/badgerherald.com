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

	foreach ($beats as $beat => $beat_name) { ?>
        <div id='<?php echo $beat_name ?>' class='clearfix'>
            <div class="section-banner section-banner-<?php echo $beat_name ?>">
                <h2><?php echo $beat_name; ?></h2>
            </div>

            <div class='col-container clearfix'>
                <div class="featured-container featured-container-<?php echo $beat_name ?>">
                    <?php 
							if ( ! $featured = wp_cache_get("exa_old-homepage-featured-" . $beat_name) ) {
								$args = array(); 
								$args['tax_query']=array( array( 'taxonomy'=> 'category',
									'field' => 'slug',
									'terms' => array($beat),
									'operator' => 'IN'
								), array(
									'taxonomy' => 'importance',
									'field' => 'slug',
									'terms' => array('featured','cover'),
									'operator' => 'IN'
								));
								$args['posts_per_page'] = 3;
								$args['no_found_rows'] = true;
								$featured = new WP_Query( $args );
								wp_cache_set("exa_old-homepage-featured-" . $beat_name ,$featured,'',0);
							}
					
							while ( $featured->have_posts() ) : $featured->the_post();
								if ( $featured->current_post == 0 && !is_paged() ) {
									get_template_part( 'blocks/teaser', 'feature' );
								} else {
									get_template_part( 'blocks/teaser', 'brief' );
								}
								$exclude[] = $post->ID;
							endwhile;
					
							// Restore original Post Data
							wp_reset_postdata();
							wp_reset_query();
						?>
                </div>
                <ul class="list-stories"> <?php 
					/* Build query for featured stories in news */
					if ( ! $featured = wp_cache_get("exa_old-homepage-sidebar-" . $beat_name) ) {
						$args = array();
						$args['posts_per_page'] = 10;
						$args['tax_query'] = array(
						array(
							'taxonomy' => 'category',
							'field' => 'slug',
							'terms' => array($beat),
							'operator' => 'IN'
						));
						$args['no_found_rows'] = true;
						$featured = new WP_Query( $args );
						wp_cache_set("exa_old-homepage-sidebar-" . $beat_name ,$featured,'',0);
					}

					while( $featured->have_posts() ) : $featured->the_post(); ?>
                    <li>
                        <span class='topic'><?php exa_topic( $post->ID ); ?><span class="summary-time-stamp"> &middot;
                                <?php exa_time() ?></span></span>
                        <h4>
                            <a href='<?php echo get_permalink($post->ID ); ?>'>
                                <?php the_title( ); ?>
                            </a>
                        </h4>
                    </li> <?php
					endwhile;
					?>
                </ul>

            </div>
        </div>
        <?php 
	} 
	?>
    </div>
</div>