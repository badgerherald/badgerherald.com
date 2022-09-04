<?php
/**
 * The default template for displaying content. Used for single.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */


get_header();

?>


<hrld-preflight style='height:180px'></hrld-preflight>

<?php

exa_container('nameplate');

if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
		exa_container('content-two-column',array('layout' => exa_layout()));
	endwhile; 
else :
	_e( '<p>Something went wrong.</p>' );
endif;

get_template_part('footer');