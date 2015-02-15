<?php global $DoubleClick ?>

<div class="block leaderboard-block">
	<span class="context-label">LEADERBOARD BLOCK</span>
	<div class="wrapper">
	
		<div class="ad leaderboard-ad">
			<?php $DoubleClick->place_ad('bh:billboard','728x90',array('tablet','desktop','xl')); ?> 
			<?php $DoubleClick->place_ad('bh:billboard','320x50',array('mobile')); ?> 
		</div>

		<div class="icymi-box">

			<?php

				/**
				 * Query for and display one ICYMI post.
				 */

				$query = exa_icymi_query(1);

				if ( $query->have_posts() ) : $query->the_post(); ?>
					
					<h4>in case you missed it...</h4>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?><br/>
					<span class='time'><?php echo exa_human_time_diff(get_the_time('U')); ?></span>
					</a>
				
				<?php else :

					echo "none";
					// No ICYMI posts found.

				endif;

				wp_reset_postdata();

			?>

		</div>

		<div class="clearfix"></div>

	</div>

</div>