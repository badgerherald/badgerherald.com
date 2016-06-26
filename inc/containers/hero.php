<?php
/**
 * Retrieve and display feature-image (hero).
 * 
 */

global $post;
global $block;
if(!$block) {
	$block = new Block('hero');
}

if (exa_hero_style() == "standard") :
?>

<div class="<?php echo $block->classes(); ?>">
	<div class="wrapper">
	
	<?php
	$hide_feature = get_post_meta( get_the_ID(), '_exa_hide_featured_image', true);
	if ( has_post_thumbnail() && !($hide_feature == "true")) : ?>
			
		<div class="hero">
	
			<?php the_post_thumbnail('image-post-size'); ?>
			
			<aside class="hero-aside">
	
				<?php exa_hero_caption(); ?>
	
			</aside>  
	
			<div class="clearfix"></div>
	
		</div>
	
	<?php endif; /* if has feature image */ ?>
	
	</div>
</div>

<?php 

endif;