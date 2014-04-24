<?php
while ( have_posts() ) : the_post();
	include('/interactive/'.get_post_meta(get_the_ID(), '_hrld_interactive_include', true));
endwhile;
?>