<?php
/** 
 * Most recent block.
 * 
 * Uses three columns for a most recent block on the right side.
 * 
 * 
 * 
 * 
 */

global $block;

?>

<div class="block most-recent-block">
	
	<div class="wrapper">

		<?php 
		$type = $block->args['display']; 
		$i = 1; 
		?>

		<?php if ( $block->query->have_posts() ) : while ( $block->query->have_posts() ) : $block->query->the_post(); ?>
		
			<?php 
			$burl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			?>
			<article class="<?php echo $type ?>-story story-<?php echo $i ?>">

				<a href="<?php the_permalink() ?>">
					<div class="img-box" style="background-image:url('<?php echo $burl ?>')"></div>
					
					<div class="overlay">
						<h2><?php the_title(); ?></h2>
					</div>
				</a>

			</article>

		<?php $i++; ?>

		<?php endwhile; endif; // loop  ?>

		<aside class="most-recent">

			<p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Aenean lacinia bibendum nulla sed consectetur.</p>
			<p>Vestibulum id ligula porta felis euismod semper. Maecenas faucibus mollis interdum. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Nulla vitae elit libero, a pharetra augue.</p>
		
		</aside>

		<div class="clearfix"></div>

	</div>

</div>