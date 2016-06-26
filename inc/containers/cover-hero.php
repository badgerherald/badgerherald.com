<?php

global $block;
if(!$block) {
	$block = new Block('cover-hero');
}

$hide_feature = get_post_meta( get_the_ID(), '_exa_hide_featured_image', true);
if ( has_post_thumbnail() && !($hide_feature == "true")) : ?>

	<div class="<?php echo $block->classes(); ?>">
	
		<div class="hero">
			<div class="wrapper">
				<div class="logo-shadow"></div>
				<a id="logo" href="<?php bloginfo('url'); ?>">
					<img src="<?php bloginfo('template_url') ?>/img/logo/header-horizontal-white.png" />
				</a>
			</div>
			<?php the_post_thumbnail('cover'); ?>

		</div>

	</div>

	<div class="block standalone-caption-block">
		<div class="wrapper">
			<?php exa_hero_caption(); ?>
		</div>
	</div>

<?php

endif;

