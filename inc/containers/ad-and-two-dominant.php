<?php 
/**
 * 
 * 
 */

global $OnCampus;
$container = $GLOBALS['container'] ?: new container('header');

?>

<div class="<?php echo $container->classes(); ?>">
	<div class="wrapper">
		<div class="sidekick-ad">
		<?php 
			$OnCampus->place_ad(
				array(
					'mobile'=>'homepage-sidekick',
					'tablet'=>'',
					'desktop'=>'homepage-sidekick',
					)
				); 
		?>
    	</div>

    	<div class="feature">
    	
		<?php

		$query_args = array(
			'showposts' 	=> 2,
			'post_status'	=> 'publish',
			'post__not_in'	=> Exa::shownIds(),
			'tax_query' => array(
				array(
				    'taxonomy' => 'importance',
				    'field' => 'slug',
				    'terms' => array('featured','cover')
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