<?php
/**
 * container: List & Banter
 * Description: Four posts on the left, and banter widget on
 * 				the right.
 *
 */

global $container;
if(!$container) {
	$container = new container('list-and-banter');
}

?>

<div class="<?php echo $container->classes(); ?>">    
    <div class="wrapper">
    	
    	<div class="list">

		<?php
		$query_args = array(
			'showposts' 	=> 4,
			'post_status'	=> 'publish',
			'post__not_in'	=> Exa::shownIds(),
			'tax_query' => array(
				array(
				    'taxonomy' => 'importance',
				    'field' => 'slug',
				    'terms' => array('dominant','hard')
				)
			)
		);
		$my_query = new WP_Query( $query_args );

		if ( $my_query->have_posts() ) :
			while ( $my_query->have_posts() ) : $my_query->the_post(); Exa::addShownId(get_the_ID()); 
			?>

			<a href="<?php the_permalink(); ?>" class="story">
				<span class="topic"><?php echo exa_topic(); ?></span>
				
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
			<div class="fb-like" data-href="https://facebook.com/uwbanter" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>

 			<?php
				$query_args = array(
					'showposts' 	=> 12,
					'post_status'	=> 'publish',
					'post__not_in'	=> Exa::shownIds(),
					'tax_query' => array(
						array(
						    'taxonomy' => 'category',
						    'field' => 'slug',
						    'terms' => array('banter')
						)
					)
				);
				$my_query = new WP_Query( $query_args );
	
				if ( $my_query->have_posts() ) :
					while ( $my_query->have_posts() ) : $my_query->the_post(); Exa::addShownId(get_the_ID	());    	
				?>
				<a href="<?php the_permalink(); ?>" class="banter-link">
				<?php the_post_thumbnail('post-thumbnail'); ?>
				<span class="topic"><?php echo exa_topic(); ?></span>
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