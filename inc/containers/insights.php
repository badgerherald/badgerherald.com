<?php 
/**
 * container: menu search bar container
 * Description: Things my container does.
 *
 */

if (is_single()) :
$container = $GLOBALS['container'] ?: new container('insights');

?>

<div class="<?php echo $container->classes() ?>">
	<div class="wrapper">


	</div>
</div>

<?php
endif;