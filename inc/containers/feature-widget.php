<?php  

$container = $GLOBALS['container'] ?: new container('feature-widget');

?>

<div class="<?php echo $container->classes(); ?>">
	<div class="wrapper">
		<div class="feature">

		<?php
			$query_args = array(
				'showposts' 	=> 1,
				'post_status'	=> 'publish',
				'post__not_in'	=> Exa::shownIds(),
				'tax_query' => array(
					array(
					    'taxonomy' => 'importance',
					    'field' => 'slug',
					    'terms' => 'featured'
					)
				),
				'no_found_rows' => true
			);
			$my_query = new WP_Query( $query_args );

			if ( $my_query->have_posts() ) {
				while ( $my_query->have_posts() ) {
					$my_query->the_post(); 
					Exa::addShownId(get_the_ID()); 
					get_template_part( 'inc/blocks/teaser-feature' );
				}
			} else {
				echo "Add a featured post!";
			}
		?>

		</div>

		<div class="widget">

			<h3 class="title">Most Recent</h3>

			<?php

			$args = array();
			$args['posts_per_page'] = 4;
			$slider_query = new WP_Query( $args ); 

			while( $slider_query->have_posts() ) : $slider_query->the_post(); ?>

				<a class="most-recent-post" href="<?php the_permalink(); ?>">
        			
        			<?php if(has_post_thumbnail()) : ?>
        				<div class="thumbnail">
            				<?php the_post_thumbnail(); ?>
        				</div>
        			<?php endif; ?>
        			
        			<div class="title">
						<?php the_title(); ?><time><?php exa_time() ?></time>
					</div>
					<div class="clearfix"></div>
				</a>
				

			<?php endwhile ?>

		</div>

		<div class="clearfix"></div>

	</div>
</div>