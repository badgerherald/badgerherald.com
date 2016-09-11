<?php 

global $OnCampus;
$container = $GLOBALS['container'] ?: new container('leaderboard');
$container->default_args(
	array(
		'background' => 'grey',
		'breakpoint' => array(),
		'flex' => true
	)
);

?>

<div class="<?php echo $container->classes(); ?>">
	<div class="wrapper <?php echo $container->args['flex'] ? "flex": ""; ?>">
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