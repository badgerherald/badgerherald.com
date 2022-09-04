<?php
/**
 * Template for displaying the masthead post type
 *
 * @since v0.6
 */

global $post;

?>

<?php

get_header();

?>


<hrld-preflight style='height:180px'></hrld-preflight>

<?php
exa_container('nameplate');

if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
		exa_container('masthead');
	endwhile; 
else :
	_e( '<p>Something went wrong.</p>' );
endif;

get_template_part('footer');