<?php

$hide_feature = get_post_meta( get_the_ID(), '_exa_hide_featured_image', true);
if ( has_post_thumbnail() && !($hide_feature == "true")) : ?>

	<div class="block cover-hero-block">
		<div class="hero">
			<?php the_post_thumbnail('image-post-size'); ?>
		</div>
	</div>
	
<?php

elseif (true) :


endif;

