<?php 
/**
 * container: menu search bar container
 * Description: Things my container does.
 *
 */

if (is_single()) :
	
global $container;
if(!$container) {
	$container = new container('insights');
}

?>

<div class="<?php echo $container->classes() ?>">
	<div class="wrapper">


	</div>
</div>

<?php
endif;