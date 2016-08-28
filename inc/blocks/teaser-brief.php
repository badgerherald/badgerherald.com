<a href="<?php the_permalink() ?>" class="block teaser-brief post-<?php the_id(); ?>">
	<?php if(has_post_thumbnail()): ?>
	<div class="thumbnail">
		<?php the_post_thumbnail(); ?>
	</div>
	<?php endif; ?>
	<header>
		<span class="meta">
			<span class="charm topic-banner"><?php exa_topic(); ?></span>
			<time><?php exa_time(); ?></time>
		</span>
		<h2><?php the_title(); ?></h2>
		<h3><?php exa_subhead(); ?></h3>
	</header>
	<div class="clearfix"></div>
</a>
