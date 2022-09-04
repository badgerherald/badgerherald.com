<?php 
/**
 * 
 * 
 */

$container = $GLOBALS['container'] ?: new container('header');

?>
<div class="<?php echo $container->classes(); ?>">
    <div class="wrapper">
        <div class="sidekick-ad">
            <hrld-homepage-sidekick></hrld-homepage-sidekick>
        </div>

        <div class="feature">
            <?php
				$query_args = array(
					'post_status'	=> 'publish',
					'tax_query' => array(
						array(
							'taxonomy' => 'importance',
							'field' => 'slug',
							'terms' => array('featured','cover')
						)
					),
					'no_found_rows' => true,
				);

				if ( ! $my_query = wp_cache_get("exa_ad-two-dominant") ) {
					$my_query = new WP_Query( $query_args );
					wp_cache_set("exa_ad-two-dominant",$my_query,'',0);
				}

				$count = 0;
				if ( $my_query->have_posts() ) {
					while ( $my_query->have_posts() ) : $my_query->the_post(); 
						if(Exa::postHasBeenSeen(get_the_ID())) {
							continue;
						}
						
						$count++;
						if($count > 2) {
							continue;
						}
						Exa::addShownId(get_the_ID()); 
			?>

            <a href="<?php the_permalink(); ?>" class="story">

                <div class="dotted-overlay-container">
                    <?php
					if( has_post_thumbnail()){
						the_post_thumbnail('post-thumbnail');
					} else{
						echo "<img " . 'class="attachment-post-thumbnail size-post-thumbnail wp-post-image" '.
								'style="height: 250px; background-color: #666;" />';
					}
				?>
                </div>

                <div class="title-container">

                    <div class="block-headline-container">
                        <h2 class="block-headline"><span><?php the_title(); ?></span></h2>
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
                </div>
            </a>


            <?php	endwhile;
			} else {
				// todo: test this output.
				echo "No Posts";
			}
			?>

        </div>

        <div class="clearfix"></div>
    </div>
</div>

<hrld-homepage-leaderboard></hrld-homepage-leaderboard>