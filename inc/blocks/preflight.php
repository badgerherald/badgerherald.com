<?php global $DoubleClick ?>

<div class="block preflight-block">
	<div class="wrapper">

		<div class="ad preflight-ad">
			<?php 

			// Preflight Size.
			$sizes = array(
        		'phone' => '300x340',
        		'tablet' => '760x340,300x340',
        		'desktop' => '1020x420',
        		'xl' => '1180x420,1020x420'
    		);

			$args = array(
        		'lazyLoad' => false,     // if set to true, the ad will load only once its within view on screen.
    		);

			$DoubleClick->place_ad('preflight',$sizes,$args);

			?>
		</div>
		<div class="scroll-view">
			Scroll to Dismiss
		</div>

	</div>

</div>