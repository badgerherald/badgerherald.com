<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 *
 * @package Exa
 * @since v0.1
 */


//Store the micro time so that we know
//when our script started to run.
$executionStartTime = microtime(true);

get_header();
exa_container('nameplate');
exa_container('stream');
get_footer(); 

?>
