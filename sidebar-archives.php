<?php
/**
 * The general sidebar for an archive or taxonomy page
 *
 * @package WordPress
 * @subpackage exa
 * @since 9/30/2013
 */

?>
<div id="sidebar">
<div class="sidebar-inner">

<h1 class="most-recent-headline">Most read this week</h1>

<div class="sidebar-scroll">

<?php wpp_get_mostpopular("range=weekly&post_type=sports,oped,artsetc,news&stats_comments=0&limit=10&wpp_start='<ul class=\"sidebar-posts\">'&post_html='<li class=\"post-in-sidebar\"><a class=\"post-permalink trending-story\" href=\"{url}\">{text_title}</li>'"); ?>

</div><!-- class="sidebar-scroll" -->
</div><!-- class="inner-sidebar" -->
</div><!-- id="sidebar" -->