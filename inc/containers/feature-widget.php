<?php  

global $container;
if(!$container) {
	$container = new container('feature-widget');
}

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
					    'terms' => 'dominant'
					)
				)
			);
			$my_query = new WP_Query( $query_args );

			if ( $my_query->have_posts() ) {
				while ( $my_query->have_posts() ) : $my_query->the_post(); Exa::addShownId(get_the_ID()); ?>

				<a href="<?php the_permalink(); ?>" class="story">
				
					<div class="dotted-overlay-container">
						<?php the_post_thumbnail('post-thumbnail'); ?>
					</div>

					<div class="title-container">
						
						<div class="container-headline-container">
							<h1 class="container-headline"><span><?php the_title(); ?></span></h1>
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
						<?php the_title(); ?><time><?php echo exa_human_time_diff(get_the_time('U')) ?></time>
					</div>
					<div class="clearfix"></div>
				</a>
				

			<?php endwhile ?>

		</div>

		<div class="clearfix"></div>

	</div>
</div>