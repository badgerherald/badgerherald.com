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
				
		<exa-nameplate id="nameplate" primary-menu="418" secondary-menu="1845" social-menu="8418" is-mobile="true"></exa-nameplate>

	</div>
</div>
