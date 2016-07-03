<header class="block section-header">
	<h1><?php single_cat_title(); ?></h1>
	<?php if(category_description()!="") : ?>
	<h3><?php echo category_description(); ?></h3>
	<?php endif; ?>
</header>