<?php
/**
 * container: menu search bar container
 * Description: Things my container does.
 *
 */

$container = $GLOBALS['container'] ?: new container('menu-search-bar');


$container->default_args(
	array(
		'background' => 'grey',
		'breakpoint' => array()
	)
);

?>

<div class="<?php echo $container->classes(); echo " " . $container->args['background']; ?>">
    <div class="wrapper">
		<?php 
			if ( has_nav_menu( 'header-primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'header-primary',
					'menu_class' => 'menu menu-primary'
					)
				);
			} else {
				echo "No 'Header Primary' menu defined. Please define a menu for this location.";
			}
		?>

		
		

	
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

		<div style="clear:both"></div>
		
    </div>
</div>
