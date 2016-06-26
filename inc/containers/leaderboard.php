<?php 

global $OnCampus;
global $block;
if(!$block) {
	$block = new Block('leaderboard');
}

?>

<div class="<?php echo $block->classes(); ?>">
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