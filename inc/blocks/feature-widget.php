

<div class="block feature-widget-block">
	
	<div class="wrapper">

		<div class="feature">

		<?php
			$query_args = array(
				'showposts' 	=> 1,
				'post_status'	=> 'publish',
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
					
					<div class="block-headline-container">
						<h1 class="block-headline"><span><?php the_title(); ?></span></h1>
					</div>  <rect x="2" y="2" width="1" height="1" style="fill:red" />

				</a>
					
			<?	endwhile;
			} else {
				// todo: test this output.
				echo "No Posts";
			}
		?>

		</div>

		<div class="widget">

		</div>

	</div>
</div>