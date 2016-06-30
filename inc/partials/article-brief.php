<div class="post-box post-%id%">
	<?php if(has_post_thumbnail()): ?>
	<div class="thumbnail">
		<?php the_post_thumbnail(); ?>
	</div>
	<?php endif; ?>
	<h2><?php the_title(); ?></h2>
	<h3><?php the_excerpt(); ?></h3>
</div>