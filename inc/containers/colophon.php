<?php 

$container = $GLOBALS['container'] ?: new container('colophon');

?>

<div class="<?php echo $container->classes() ?>">
	<div class="wrapper">
		<div class="left-rail rail">
			<img class="logo" src="<?php bloginfo('template_url') ?>/img/logo/header-horizontal-white.png" />
		</div>
		<div class="middle-rail rail">
			<?php
			if ( has_nav_menu( 'footer-primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'footer-primary'
					)
				);
			} else {
				echo "No footer-primary menu defined. Please define a menu for this location.";
			}

			?>
			?>
		</div>
		<div class="right-rail rail">
			<?php 

			if ( has_nav_menu( 'footer-secondary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'footer-secondary'
					)
				);
			} else {
				echo "No footer-secondary menu defined. Please define a menu for this location.";
			}

			?>
		</div>
		<div class="clearfix"></div>
		<div class="fine-print">
			<p class="description"><?php echo get_bloginfo('description') ?></p>
			<p>All Content &copy; The Badger Herald, 1995 - <?php echo date("Y"); ?></p>
		</div>
	</div>
</div>

