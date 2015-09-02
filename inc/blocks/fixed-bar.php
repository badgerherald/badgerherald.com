<div class="fixed-bar-block-placeholder"></div>
<div class="fixed-bar-block block">

	<?php /* container for the mobile hamburger icon */ ?>

	<div class="wrapper bar-content">
		<?php 
			wp_nav_menu( array(
				'theme_location' => 'fixed-bar'
				)
			);
		?>
		<form class="search" action="/" method="get">
			<?php $query = get_search_query(); ?>
			<input type="text" name="s" placeholder="Search..." value="<?php echo $query ?>"></input>
			<input type="submit" value="Submit"></input>
		</form>
	</div>

	<div class="button"></div>

	<?php /* Progress Bar */ ?>
	<?php
	if (is_single()) { ?>
		<div class="progress">
		  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
		  </div>
		</div>
	<?php } ?>

</div><!-- block -->