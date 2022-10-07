<?php  
$container = $GLOBALS['container'] ?: new container('feature-widget');
?>

<div class="<?php echo $container->classes(); ?>">

    <div class="wrapper">

        <div class="feature">

            <?php

		$key = serialize($roles);

		$query_args = array(
			'post_status'	=> 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'importance',
					'field' => 'slug',
					'terms' => 'featured'
				)
			),
			'no_found_rows' => true,
		);

		if ( ! $my_query = wp_cache_get("exa_feature-widget-query") ) {
			$my_query = new WP_Query( $query_args );
			wp_cache_set("exa_feature-widget-query",$my_query,'',0);
		}
			$count = 0;
			if ( $my_query->have_posts() ) {
				
				while ( $my_query->have_posts() ) : $my_query->the_post(); 	
				if (Exa::postHasBeenSeen(get_the_ID())) {
					continue;
				}

				$count++;
				if ($count > 1) {
					break;
				}

				Exa::addShownId(get_the_ID()); 
				?>

            <a href="<?php the_permalink(); ?>" class="story">
                <div class="dotted-overlay-container">
                    <?php
						if( has_post_thumbnail()){
								the_post_thumbnail('post-thumbnail');
						}else{
							echo "<img " . 'class="attachment-post-thumbnail size-post-thumbnail wp-post-image" '.
									'style="height: 562px; background-color: #666;" />';
						}
					?>
                </div>
                <div class="title-container">

                    <div class="block-headline-container">
                        <h1 class="block-headline"><span><?php the_title(); ?></span></h1>
                    </div>

                    <div class="byline">
                        <div class="mug">
                            <?php exa_mug(get_the_author_meta('ID'),'small-thumbnail') ?>
                        </div>
                        <span class="author">
                            by
                            <span class="author-name"><?php the_author() ?></span>
                        </span>
                    </div>
                    <div class="lede"><?php the_excerpt(); ?></div>
                </div>

            </a>

            <?php	
				endwhile;
			} else {
				echo "No Posts";
			}
		?>

        </div>

        <div class="widget">
            <bh-popular-posts class="webpress-contextual" size="5"></bh-popular-posts>

        </div>

        <div class="clearfix"></div>

    </div>
</div>