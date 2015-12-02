<?php
/**
 * Retrieve and display feature-image, in this case the iamge attachment (hero).
 * 
 */

global $DoubleClick;
global $post;

?>
<div class="block hero-block hero-image-block">
	<div class="wrapper">
	
	<div class="image-box">
		<?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>
		<?php echo "<p class='hero-caption'>" . exa_hero_caption_text() . exa_hero_media_credit_tag() ."</p>" ?>
	</div>


	</div>
</div>