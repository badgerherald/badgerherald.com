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

exa_block('leaderboard');
exa_block('menu-search-bar');
exa_block('header');
exa_block('banter');

get_template_part('footer');