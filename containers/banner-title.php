<?php 

$container = $GLOBALS['container'] ?: new Container('banner-title');

?>

<div class="<?php echo $container->classes() ?>">
	<div class="wrapper">
		
		<div class="sidebar">
			<?php get_template_part('blocks/section-header'); ?>
		</div>	

		<div class="feature">
		
			<?php 
			if ( have_posts() ) :
				
				while ( have_posts() ) {
	
					the_post();
		
					if(exa_is_featured()) {
						get_template_part( 'blocks/teaser-feature' );
					} else {
						get_template_part( 'blocks/teaser-brief' );
					}
				}
				?>
		
				<div class="all-link pagination-link"><?php next_posts_link( 'Older' ); ?></div>
		
			<?php elseif ($query->is_archive) : ?>
				<?php //get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
	
		</div>

		<div class="clearfix"></div>
	</div>
</div>