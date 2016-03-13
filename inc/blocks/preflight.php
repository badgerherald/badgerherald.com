<?php 

global $OnCampus;

?>

<div class="block preflight-block">

		<div class="ad preflight-ad">

			<?php 
				$OnCampus->place_ad(array(
						'preflight-mobile' => 'preflight-mobile',
						'preflight-tablet' => 'preflight-tablet',
						'preflight-desktop' => 'preflight-desktop',
					)
				);
			?>
		</div>
		<div class="scroll-view">
			Scroll to Dismiss
		</div>


</div>