<?php
/**
 * Retrieve and display feature-image (hero).
 * 
 */

global $DoubleClick;
global $post;

?>

<div class="block hero-block">
	<div class="wrapper">
	
	<?php
	$hide_feature = get_post_meta( get_the_ID(), '_exa_hide_featured_image', true);
	if ( has_post_thumbnail() && !($hide_feature == "true")) : ?>
			
		<div class="hero">
	
			<?php the_post_thumbnail('image-post-size'); ?>
			
			<aside class="hero-aside">
	
				<div class="hero-ad">
	
					<?php $DoubleClick->place_ad('bh:leaderboard','300x250',array('desktop','xl')); ?>
					
				</div>
	
				<?php exa_hero_caption(); ?>
	
			</aside>  
	
			<div class="clearfix"></div>
	
		</div>
	
	<?php endif; /* if has feature image */ ?>
	
	</div>
</div>