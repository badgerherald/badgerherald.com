<?php
/**
 * Template: Homepage
 * 
 * @since v0.1
 */

get_header();

get_template_part('inc/blocks/leaderboard');
get_template_part('inc/blocks/menu-search-bar');
get_template_part('inc/blocks/header');
//get_template_part('inc/blocks/dirty-bird');
get_template_part('inc/blocks/breaking-news');
get_template_part('inc/blocks/feature-widget');
get_template_part('inc/blocks/ad-and-two-dominant');
get_template_part('inc/blocks/list-and-banter');
get_template_part('inc/blocks/latest-videos');
get_template_part('inc/blocks/old-homepage');



get_template_part('inc/blocks/new-sports');
get_footer();

?>

