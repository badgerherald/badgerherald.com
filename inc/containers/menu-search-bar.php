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
					'theme_location' => 'header-primary'
					)
				);
			} else {
				echo "No header-primary menu defined. Please define a menu for this location.";
			}
		?>
		<div style="clear:both"></div>
		
		<form class="search" action="/" method="get">
			<?php $query = get_search_query(); ?>
			<input type="text" name="s" placeholder="Search..." value="<?php echo $query ?>"></input>
			<input type="submit" value="Submit"></input>
		</form>
		
    </div>
</div>
