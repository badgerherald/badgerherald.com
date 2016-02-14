<?php 

global $block;
if(!$block) {
	$block = new Block('mobile-header');
}

/**
 * Block documentation:
 * 
 * $args: 	array (
 * 				"breakpoint" => array() of breakpoints to show block for.
 * 		  	)
 */

?>

<div class="<?php echo $block->classes(); ?>">
	<div class="wrapper">

    		<div class="inner-banter">
    			<h1>UW Banter</h1>
    			<div class="clearfix"></div>
				<div class="fb-like" data-href="https://facebook.com/wiscmemes" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
 				
 				<?php while ( have_posts() ) : the_post(); ?>

					<a href="<?php the_permalink(); ?>" class="banter-link post-<?php global $wp_query; echo $wp_query->current_post + 1; ?>">
						<?php the_post_thumbnail('post-thumbnail'); ?>
						<span class="topic"><?php echo exa_topic(); ?></span>
						<span class="title"><?php the_title(); ?></span>
					</a>
	
				<?php
				endwhile;
				?>

				<div class="clearfix"></div>
			</div>
    	</div>
	</div>
</div>