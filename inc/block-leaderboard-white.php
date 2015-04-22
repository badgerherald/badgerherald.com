<?php global $DoubleClick ?>

<div class="block leaderboard-block" style="background:#fff;padding:24px 0; margin:0;border-bottom:1px solid rgb(224, 234, 238);">
	
	<div class="wrapper">
	
		<div class="logo">
			<img src="<?php bloginfo('template_directory'); ?>/img/logo/vertical-herald-logo.png"
				 style="width:260px;height:90px;float:left"
				>
		</div>

		<div class="ad leaderboard-ad" style="float:right;">
			<?php $DoubleClick->place_ad('bh:billboard','728x90',array('tablet','desktop','xl')); ?> 
			<?php $DoubleClick->place_ad('bh:billboard','320x50',array('mobile')); ?> 
		</div>

		<div class="clearfix"></div>

	</div>

</div>