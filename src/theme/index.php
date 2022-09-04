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
exa_container('breaking-news');
exa_container('feature-widget');

exa_container('ad-and-two-dominant');
exa_container('list-and-banter');
exa_container('old-homepage');

get_footer();

?>