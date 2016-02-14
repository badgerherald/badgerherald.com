<?php
/**
 * Banter Page
 * badgerherald.com/banter
 * 
 * @since v0.4
 */

global $AnalyticBridge;
global $DoubleClick;
global $post;

?>

<?php

get_header();

get_template_part('inc/blocks/leaderboard');
get_template_part('inc/blocks/menu-search-bar');
get_template_part('inc/blocks/mobile-header');

exa_block('banter-header');