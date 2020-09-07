<?php

while ( have_posts() ) : the_post();
	include($_SERVER["DOCUMENT_ROOT"] . '/interactive/'.get_post_meta(get_the_ID(), '_hrld_interactive_include', true).'/index.php');
endwhile;

?>