<?php 

$container = $GLOBALS['container'] ?: new container('nameplate');
$container->default_args(
	array(
		'background' => 'grey',
		'breakpoint' => array()
	)
);

if (!function_exists("printDropdownMenu")) :

	function printDropdownMenu($menuLocation,$classes = null) {
		if ( has_nav_menu( $menuLocation ) ) {
			wp_nav_menu( array(
				'theme_location' => $menuLocation,
				'menu_class' => 'menu ' . $classes,
				'container' => ''
				)
			);
		} else {
			echo "No menu found";
		}
	}
endif;

?>

<div class="container">
	<div class="wrapper">
		<exa-nameplate> </exa-nameplate>
	</div>
</div>

<div class="<?php echo $container->classes(); ?> flex">
	<div class="wrapper">
		
		<a class="logo" href="<?php bloginfo('url'); ?>">
			<?php if($container->args['background'] == 'black') : ?>
				<img src="<?php bloginfo('template_url') ?>/assets/img/logo/header-horizontal-white.png" />
			<?php else : ?>
				<img src="<?php bloginfo('template_url') ?>/assets/img/logo/header-horizontal.png" />
			<?php endif; ?>
		</a>

		<a class="menus-button">Menu</a>
		<div class="menus">
			<div class="mobile-right">
				<?php printDropdownMenu('exa_main_menu','main-menu'); ?>
				<?php printDropdownMenu('exa_social_media_menu','social-menu'); ?>
			</div>
			<?php printDropdownMenu('exa_secondary_menu','secondary-menu'); ?>
			
			<div class="clearfix"></div>
			
			<form class="search" action="/" method="get">
				<?php $query = get_search_query(); ?>
				<input type="text" name="s" placeholder="Search..." value="<?php echo $query ?>"></input>
				<input type="submit" value="Submit"></input>
		</form>
		</div>

	</div>
</div>
