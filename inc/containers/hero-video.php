<?php
/**
 * Retrieve and display feature-image, in this case the video (hero).
 * 
 */

global $container;
if(!$container) {
	$container = new container('hero-video');
}

?>
<div class="<?php echo $container->classes(); ?>">
	<div class="wrapper">
	
	<div class="video-box">
		<?php echo wp_oembed_get(exa_video_link()); ?>
	</div>

	</div>
</div>