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

get_header();
exa_container('menu-search-bar');
exa_container('header');
exa_container('stream');
get_footer(); 

?>
