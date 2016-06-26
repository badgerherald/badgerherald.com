<?php
/**
 * Retrieve and display feature-image, in this case the video (hero).
 * 
 */

global $block;
if(!$block) {
	$block = new Block('hero-video');
}

?>
<div class="<?php echo $block->classes(); ?>">
	<div class="wrapper">
	
	<div class="video-box">
		<?php echo wp_oembed_get(exa_video_link()); ?>
	</div>

	</div>
</div>