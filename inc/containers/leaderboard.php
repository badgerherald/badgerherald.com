<?php 

global $DoubleClick;
$container = $GLOBALS['container'] ?: new container('leaderboard');

?>

<div class="<?php echo $container->classes(); ?>">
	<div class="wrapper">
		<div class="ad">
	
			<?php 

			$DoubleClick->place_ad(
				'badgerherald.com-leaderboard',
				array(
					'phone' => '300x50',
					'tablet' => '728x90,970x300',
					),
				array (
					'lazyLoad' => false
					)
				); 
			?> 
			 
		</div>
	</div>
</div>