<?php
/**
 * Template for displaying the masthead post type
 *
 * @since v0.6
 */

global $post;

?>

<hrld-preflight style='height:180px'></hrld-preflight>

<?php

get_header();

if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
		exa_container('masthead');
	endwhile; 
else :
	_e( '<p>Something went wrong.</p>' );
endif;

get_template_part('footer');