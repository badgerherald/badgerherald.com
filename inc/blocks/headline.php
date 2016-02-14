<?php 
/**
 * Header
 */ 

global $block;
if(!$block) {
	$block = new Block('headline');
}
?>

<header class="block <?php echo $block->classes() ?>">
	<div class="wrapper">
		
			<ul class="topics">
				<li>
					<a href="<?php echo exa_section_permalink() ?>" class="section">
					<?php echo exa_section(); ?>
					</a>
				</li>
				<li><span><?php echo exa_topic(); ?></span></li>
			</ul>
		
			<div class="clearfix"></div>
				
			<h1 class="title"><?php the_title() ?></h1>
			
			<?php if( hrld_has_subhead(get_the_ID()) ) : ?>
				<h2 class="subhead"><?php hrld_the_subhead(); ?></h2>
			<?php endif; ?>
	
	</div>
	
</header>