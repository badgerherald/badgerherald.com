<?php
/**
 * Retrieve and display feature-image, in this case the iamge attachment (hero).
 * 
 */

global $post;

if (exa_hero_style() == "standard") :

$container = $GLOBALS['container'] ?: new container('hero-image');
	
?>


<div class="<?php echo $container->classes(); ?>">
	<div class="wrapper">
	
	<div class="image-box">
		<?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>
		<?php echo "<p class='hero-caption'>" . "<span class='hero-caption-title'> " . get_the_title() . "</span>" . exa_hero_caption_text() . exa_hero_media_credit_tag() ."</p>" ?>
	</div>


	</div>
</div>

<?php 

endif;