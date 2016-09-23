<?php
/**
 * Template: Homepage
 * 
 * @since v0.1
 */

get_header();


exa_container('leaderboard');
exa_container('menu-search-bar',array('flex' => true));
exa_container('header',array('flex' => true));
exa_container('breaking-news',array('flex' => true));
exa_container('feature-widget',array('flex' => true));
exa_container('ad-and-two-dominant',array('flex' => true));
exa_container('list-and-banter');
exa_container('latest-videos');
exa_container('old-homepage');

get_footer();

?>

