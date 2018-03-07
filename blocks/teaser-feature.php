<?php
/**
 * Teaser Feature
 * 
 */
?>

<a href="<?php the_permalink() ?>" class="block teaser-feature post-<?php the_id(); ?>">
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
		<?php if(exa_has_subhead()) : ?>
			<h3><?php exa_subhead(); ?></h3>
		<?php else: ?>
			<p><?php the_excerpt(); ?></p>
		<?php endif; ?>
	</header>
</a>
