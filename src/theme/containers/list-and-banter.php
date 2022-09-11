<?php
/**
 * container: List & Banter
 * Description: Four posts on the left, and banter widget on
 * 				the right.
 *
 */

$container = $GLOBALS['container'] ?: new container('list-and-banter');

?>

<div class="<?php echo $container->classes(); ?>">
    <div class="wrapper">

        <div class="list">

            <?php
		if ( ! $my_query = wp_cache_get("exa_list-and-banter") ) {
			$query_args = array(
				'posts_per_page' => 10,
				'post_status'	=> 'publish',
				'tax_query' => array(
					array(
						'taxonomy' => 'importance',
						'field' => 'slug',
						'terms' => array('featured','cover')
					)
				)
			);
			$my_query = new WP_Query( $query_args );
			wp_cache_set("exa_list-and-banter",$my_query,'',0);
		}

		$count = 0;
		if ( $my_query->have_posts() ) :
			while ( $my_query->have_posts() ) : $my_query->the_post(); 
			if (Exa::postHasBeenSeen(get_the_ID())) {
				continue;
			}
			$count++;
			if ($count > 4) {
				continue;
			}
			Exa::addShownId(get_the_ID()); 
			?>

            <a href="<?php the_permalink(); ?>" class="story">
                <span class="topic"><?php exa_topic(); ?></span>

                <?php the_post_thumbnail('post-thumbnail'); ?>


                <h2><?php the_title(); ?></h2>
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
                <div class="clearfix"></div>
            </a>

            <?php 
			endwhile;
		endif; 
		
		?>

        </div>

        <div class="banter-widget">
            <div class="inner-banter">
                <h3><a href="<?php echo get_category_link( get_cat_ID( 'banter' ) ); ?>">UW Banter</h3>

                <?php
				
				if ( ! $my_query = wp_cache_get("exa_list-and-banter-banter") ) {
					$query_args = array(
						'post_status'	=> 'publish',
						'tax_query' => array(
							array(
								'taxonomy' => 'category',
								'field' => 'slug',
								'terms' => array('banter')
							)
						)
					);
					$my_query = new WP_Query( $query_args );
					wp_cache_set("exa_list-and-banter-banter",$my_query,'',0);
				}
				$count = 0;
				if ( $my_query->have_posts() ) :
					while ( $my_query->have_posts() ) : $my_query->the_post(); 
					if(Exa::postHasBeenSeen(get_the_ID())) {
						continue;
					}
					Exa::addShownId(get_the_ID()); 
					$count++;
					if($count > 12) {
						continue;
					}
				?>
                <a href="<?php the_permalink(); ?>" class="banter-link">
                    <?php the_post_thumbnail('post-thumbnail'); ?>
                    <span class="topic"><?php exa_topic(); ?></span>
                    <span class="title"><?php the_title(); ?></span>
                </a>

                <?php
					endwhile;
				endif;
				?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>