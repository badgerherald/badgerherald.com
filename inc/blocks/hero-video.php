<?php
/**
 * Retrieve and display feature-image, in this case the video (hero).
 * 
 */

global $DoubleClick;
global $post;

?>
<div class="block hero-video-block">
	<div class="wrapper">
	
	<div class="video-box">
		<?php echo wp_oembed_get(exa_video_link()); ?>
	</div>

	</div>
</div>