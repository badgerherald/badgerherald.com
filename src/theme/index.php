<?php
/**
 * This template is called when the homepage is loaded
 * 
 * @since v0.1
 */

get_header();
exa_container('billboard');
exa_container('nameplate');
exa_container('breaking-news');

exa_container('above-the-fold');
exa_container('below-the-fold');

exa_container('old-homepage');

get_footer();

?>

