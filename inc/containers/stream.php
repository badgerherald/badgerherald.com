<?php 

$container = $GLOBALS['container'] ?: new Container('stream');

?>

<div class="<?php echo $container->classes() ?>">
	<div class="wrapper">
		
		<div class="sidebar">
			<?php get_template_part('inc/blocks/section-header'); ?>
		</div>	

		<div class="stream">
		
			<?php 
			if ( have_posts() ) :
				
				while ( have_posts() ) {
	
					the_post();
		
					if(exa_is_featured()) {
						get_template_part( 'inc/blocks/teaser-feature' );
					} else {
						get_template_part( 'inc/blocks/teaser-brief' );
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