<?php 
/**
 * 
 */

global $wp_query;
$container = $GLOBALS['container'] ?: new container('banter');

?>

<div class="<?php echo $container->classes(); ?>">
	<div class="wrapper">

    	<div class="inner-banter">
    		<h1>UW Banter</h1>
    		<div class="clearfix"></div>
			<div class="fb-like" data-href="https://facebook.com/uwbanter" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
 			
 			<?php 
 			while ( have_posts() ) : the_post(); ?>
 				<?php 
 					//echo ($wp_query->current_post + 1) % 2;
 					$float_classes = "";
 					if( ($wp_query->current_post ) % 2 ) {
						// even
 						$float_classes .= " mult-2";
 					}
 					if( (($wp_query->current_post + 1) % 3) == 0) {
 						$float_classes .= " mult-3";
 					}
 				?>
				<a href="<?php the_permalink(); ?>" class="banter-link post-<?php $wp_query; echo $wp_query->current_post + 1; echo $float_classes; ?>">
					<?php the_post_thumbnail('post-thumbnail'); ?>
					<span class="topic"><?php exa_topic(); ?></span>
					<span class="title"><?php the_title(); ?></span>
				</a>

			<?php
			endwhile;
			?>
			<div class="clearfix"></div>
			<?php
			// Pagination:
			// Don't print empty markup if there's only one page.
			if ( ! ($wp_query->max_num_pages < 2) ) : ?>
			<nav class="paging-navigation" role="navigation">
					<?php if ( get_next_posts_link() ) : ?>
						<?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older', 'exa' ) ); ?>
					<?php endif; ?>
					<?php if ( get_previous_posts_link() ) : ?>
						<?php previous_posts_link( __( 'Newer <span class="meta-nav">&rarr;</span>', 'exa' ) ); ?>
					<?php endif; ?>
			</nav><!-- .navigation -->
			<?php endif;?>
			<div class="clearfix"></div>
		</div>
	</div>
</div>