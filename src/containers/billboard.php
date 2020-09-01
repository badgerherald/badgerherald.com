<?php 

global $DoubleClick;
$container = $GLOBALS['container'] ?: new container('billboard');

?>

<div class="<?php echo $container->classes(); ?> flex">
	<div class="wrapper">
		<div class="ad">
	
			<?php 

			$DoubleClick->place_ad(
				'badgerherald.com-billboard',
				array(
					'phone' => '320x250,300x50',
					'tablet' => '970x250',
					),
				array (
					'lazyLoad' => false
					)
				); 
			?> 
			 
		</div>
	</div>
</div>