<div class="fixed-bar-block-placeholder"></div>
<div class="fixed-bar-block block">

	<?php /* container for the mobile hamburger icon */ ?>
	<div class="nav-control" alt="Menu"></div>

	<div class="wrapper bar-content">
			
		<a href="<?php echo bloginfo("url"); ?>"><div class="bar-logo">The Badger Herald</div></a>
		
		<div class="fixed-bar-dock">
			
			<a class="category" href="">
			<?php
				if (!is_page()) {
					echo ucfirst($wp_query->query_vars['category_name']);
				} else {
					echo ucfirst($wp_query->query_vars['name']);
				}
			?>
			</a>

			<span class="title">
			<?php
			if (is_single()) :
				$post_author = get_userdata($post->post_author);
				echo $post->post_title;
			?>
			</span>
			<?php echo '<span class="byline">by <a href="'. $post_author->url .'">'.$post_author->display_name.'</a></span>'; ?>
			<?php endif; ?>
			
		</div>

	</div>

	<?php /* Progress Bar */ ?>
	<?php
	if (is_single()) { ?>
		<div class="progress">
		  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
		  </div>
		</div>
	<?php } ?>

</div><!-- block -->