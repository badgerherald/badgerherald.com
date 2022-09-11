<?php

Global $wp_query;


get_header();
exa_container('leaderboard');
exa_container('nameplate');
exa_container('stream');
get_footer();  
error_log(print_r($wp_query, true));
?>