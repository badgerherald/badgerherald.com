<?php 

global $container;
$container = $container ?: new Container('stream');

?>

<div class="container stream">
	<div class="wrapper">
		<?php get_template_part('inc/blocks/section-header'); ?>
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

		<div class="sidebar">

		</div>

		<div class="clearfix"></div>
	</div>
</div>