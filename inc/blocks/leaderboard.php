<?php global $DoubleClick ?>

<div class="block leaderboard-block">
	
	<div class="wrapper">
	
		<?php $DoubleClick->place_ad(
			'leaderboard',
			array(
				'phone' => "300x50",
				'tablet' => '728x90',
				'desktop' => '728x90',
				'xl' => '728x90',
				),
			array (
				'lazyLoad' => false
				)
			); ?> 

	</div>

</div>