<?php 

global $DoubleClick;
$container = $GLOBALS['container'] ?: new container('preflight');

?>

<div class="<?php echo $container->classes(); ?> flex">
	<div class="ad preflight-ad wrapper">

		<?php 
		$DoubleClick->place_ad(
			'badgerherald.com-preflight',
			array(
				'phone' => '300x340,320x250',
				'tablet' => '760x340,970x250,728x90',
				'desktop' => '1020x420,970x250,728x90,970x50',
				'xl' => '1180x420,970x250,728x90',
				),
			array (
				'lazyLoad' => false
				)
			); 
		?> 

	</div>

	<div class="scroll-view">
		Scroll to Dismiss
	</div>
</div>