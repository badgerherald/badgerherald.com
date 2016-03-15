<?php 
/**
 * Header
 */ 

global $block;
if(!$block) {
	$block = new Block('headline');
}

$block->default_args(array('center'=>false));
?>

<header class="<?php echo $block->classes(); echo $block->args['center'] ? ' center' : ''; ?> ">
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