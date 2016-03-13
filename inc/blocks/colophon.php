<?php 

global $block;
if(!$block) {
	$block = new Block('colophon');
}

?>
<div class="<?php echo $block->classes() ?>">
	<div class="wrapper">
		<div class="left-rail rail">
			<img class="logo" src="<?php bloginfo('template_url') ?>/img/logo/header-horizontal-white.png" />
			<p class="description"><?php echo get_bloginfo('description') ?></p>
			<p>All Content &copy; The Badger Herald, 1995 - <?php echo date("Y"); ?></p>
		</div>
		<div class="middle-rail rail">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'footer-primary'
				)
			);
			?>
		</div>
		<div class="right-rail rail">
			<?php 
				wp_nav_menu( array(
						'theme_location' => 'footer-secondary'
					)
				);
			?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>