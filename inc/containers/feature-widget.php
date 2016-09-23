<?php  

$container = $GLOBALS['container'] ?: new container('feature-widget');
$container->default_args(
	array(
		'background' => 'grey',
		'breakpoint' => array(),
		'flex' => false
	)
);

?>

<div class="<?php echo $container->classes(); ?>">
	
	<div class="wrapper <?php echo $container->args['flex'] ? "flex": ""; ?>">

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
				)
			);
			$my_query = new WP_Query( $query_args );

			if ( $my_query->have_posts() ) {
				while ( $my_query->have_posts() ) : $my_query->the_post(); Exa::addShownId(get_the_ID()); ?>

				<a href="<?php the_permalink(); ?>" class="story">
				
					<div class="dotted-overlay-container">
					<?php
						if( has_post_thumbnail()) {
								the_post_thumbnail('post-thumbnail');
						} else {
							echo "<img " . 'class="attachment-post-thumbnail size-post-thumbnail wp-post-image" '.
									'style="height: 562px; background-color: #666;" />';
						}
					?>
					</div>

					<div class="title-container">
						
							<h1 class="headline"><span><?php the_title(); ?></span></h1>

						<div class="lede"><?php the_excerpt(); ?></div>

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
					
		<?php	
				endwhile;
			} else {
				echo "No Posts";
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