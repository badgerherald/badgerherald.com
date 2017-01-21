<?php 

global $DoubleClick;
$container = $GLOBALS['container'] ?: new container('leaderboard');

?>

<div class="<?php echo $container->classes(); ?>">
	<div class="wrapper">
		<div class="ad">
	
			<?php 

			$DoubleClick->place_ad(
				'bhrld.dev-leaderboard',
				array(
					'phone' => '300x50',
					'tablet' => '728x90,970x300',
					'desktop' => '',
					),
				array (
					'lazyLoad' => false
					)
				); 
			?> 
			 
		</div>
	</div>
</div>