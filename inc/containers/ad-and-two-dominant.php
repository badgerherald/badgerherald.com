<?php 
/**
 * 
 * 
 */

global $OnCampus;
$container = $GLOBALS['container'] ?: new container('header');
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
					<?php
						if( has_post_thumbnail()){
							the_post_thumbnail('post-thumbnail');
						}else{
							echo "<img " . 'class="attachment-post-thumbnail size-post-thumbnail wp-post-image" '.
									'style="height: 250px; background-color: #666;" />';
						}
					?>

					</div>
	
					<div class="title-container">
						
						<h2 class="headline"><span><?php the_title(); ?></span></h2>
	
						<span class="byline">
							
							<div class="mug">
								<?php exa_mug(get_the_author_meta('ID'),'small-thumbnail') ?>
							</div>
						
							<span class="author">
								by 
								<span class="author-name"><?php the_author() ?></span>
							</span>
	
						</span>
	
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