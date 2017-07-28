<?php 

$container = $GLOBALS['container'] ?: new container('masthead');
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
				'menu_class' => 'menu ' . $classes
				)
			);
		} else {
			echo "No menu found";
		}
	}
endif;

?>

<div class="<?php echo $container->classes(); ?>">
	<div class="wrapper">
		
		<a id="logo" href="<?php bloginfo('url'); ?>">
			<?php if($container->args['background'] == 'black') : ?>
				<img src="<?php bloginfo('template_url') ?>/img/logo/header-horizontal-white.png" />
			<?php else : ?>
				<img src="<?php bloginfo('template_url') ?>/img/logo/header-horizontal.png" />
			<?php endif; ?>
		</a>

		<?php printDropdownMenu('header-primary','menu-primary'); ?>
		<?php printDropdownMenu('header-secondary','menu-secondary'); ?>

		<form class="search" action="/" method="get">
			<?php $query = get_search_query(); ?>
			<input type="text" name="s" placeholder="Search..." value="<?php echo $query ?>"></input>
			<input type="submit" value="Submit"></input>
		</form>
		
	</div>
</div>
