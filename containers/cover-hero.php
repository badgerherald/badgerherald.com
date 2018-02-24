<?php

$container = $GLOBALS['container'] ?: new container('cover-hero');
$container->default_args(
	array('attachmentID' => null)
	);


$thumbnailHTML = empty($container->args['attachmentID']) ? 
						get_the_post_thumbnail(null, 'cover') : 
						wp_get_attachment_image($container->args['attachmentID'], 'cover');

$hide_feature = get_post_meta( get_the_ID(), '_exa_hide_featured_image', true);

if ( has_post_thumbnail() && !($hide_feature == "true")) : ?>

	<div class="<?php echo $container->classes(); ?>">
	
		<div class="hero">
			<?php echo $thumbnailHTML ?>
		</div>

	</div>

	<div class="container standalone-caption">
		<div class="wrapper">
			<?php exa_hero_caption(); ?>
		</div>
	</div>

<?php

endif;

