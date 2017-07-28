<?php 

/*

// TODO:
 - SVG the logo

*/

$container = $GLOBALS['container'] ?: new container('header');
$container->default_args(
	array(
		'background' => 'grey',
		'breakpoint' => array()
	)
);

?>

<div class="<?php echo $container->classes(); ?>">
	<div class="wrapper">
		
		<div class="header">
		
		<a id="home-link" class="logo" href="<?php bloginfo('url'); ?>">
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

		<?php 
			if ( has_nav_menu( 'header-secondary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'header-secondary',
					'menu_class' => 'menu menu-secondary'
					)
				);
			}
		?>



		</div>

	</div>
</div>