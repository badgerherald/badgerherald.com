<?php 

global $OnCampus;
global $container;
if(!$container) {
	$container = new container('leaderboard');
}

?>

<div class="<?php echo $container->classes(); ?>">
	<div class="wrapper">
		<div class="ad">
	
			<?php 

			$OnCampus->place_ad(array(
								'mobile' => 'mobile-leaderboard',
								'tablet' => 'leaderboard'
								)); 

			?>
			 
		</div>
	</div>
</div>