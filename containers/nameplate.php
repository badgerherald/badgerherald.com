<?php 

$container = $GLOBALS['container'] ?: new container('nameplate');
$container->default_args(
	array(
		'background' => 'grey',
		'breakpoint' => array()
	)
);

?>

<div class="<?php echo $container->classes(); ?> flex">
	<div class="wrapper">
				
		<exa-nameplate id="nameplate" primary-menu="418" secondary-menu="1845" social-menu="8418" search-query="<?php echo $query ?>" is-mobile="true"></exa-nameplate>

		<script>
			jQuery(window).resize(function() {
				const screenWidth = jQuery(window).width();
				const nameplate = jQuery("#nameplate");
				if(screenWidth < 500) {
					nameplate.attr("is-mobile","true");
				} else {
					nameplate.attr("is-mobile","false");
				}
			}).resize()
		</script>

	</div>
</div>
