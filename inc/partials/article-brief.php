<?php if(has_post_thumbnail()): ?>
<div class="thumbnail">
	<?php the_post_thumbnail(); ?>
</div>
<?php endif; ?>
<h4>Section</h4>
<h2><?php the_title(); ?></h2>
<h3><?php exa_subhead(); ?></h3>
