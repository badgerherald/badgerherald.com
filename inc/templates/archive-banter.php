<?php
/**
 * Banter Page
 * badgerherald.com/banter
 * 
 * @since v0.4
 */

global $AnalyticBridge;
global $post;

?>

<?php

get_header();

exa_container('leaderboard');
exa_container('menu-search-bar');
exa_container('header');
exa_container('banter');

get_template_part('footer');