<?php 
/**
 * Header
 */ 

global $container;
if(!$container) {
	$container = new container('headline');
}

$container->default_args(array('center'=>false));
?>

<header class="<?php echo $container->classes(); echo $container->args['center'] ? ' center' : ''; ?> ">
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