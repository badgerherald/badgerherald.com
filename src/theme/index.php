<?php
/**
 * This template is called when the homepage is loaded
 * 
 * @since v0.1
 */

get_header();
?>

<hrld-preflight style='height:180px'></hrld-preflight>

<?php

exa_container('nameplate');

if ( ! $homepageHtml = wp_cache_get("exa_homepage-html") ) {
    ob_start();

    exa_container('breaking-news');
    exa_container('feature-widget');
    
    exa_container('ad-and-two-dominant');
    exa_container('list-and-banter');
    exa_container('old-homepage');

    $homepageHtml = ob_get_clean();
    wp_cache_set("exa_homepage-html", $homepageHtml, '', 0);
}

echo $homepageHtml;

get_footer();

?>