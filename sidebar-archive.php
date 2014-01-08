<?php
/**
 * The sidebar for the front page, archive pages and taxonomy pages.
 * Listing of the top stories of the week, via the Wordpress
 * Popular Posts plugin.
 *
 * @package WordPress
 * @subpackage exa
 * @since 9/30/2013
 */

?>
<div id="sidebar" class="stream-sidebar">
<div class="sidebar-inner">

<?php hrld_sidebar_ad(); ?>

<h1 class="most-recent-headline">Top Posts</h1>

<div class="sidebar-scroll">

<?php 

    $wpp_query = array(
        'range=daily'
    ,   'post_type=sports,oped,artsetc,news'
    ,   'stats_comments=0'
    ,   'limit=10'
    ,   "wpp_start='<ul class=\"sidebar-posts\">'"
    ,   "post_html='
            <li class=\"post-in-sidebar\">
                <a class=\"post-permalink trending-story\" href=\"{url}\">{text_title}</a>
            </li>'"
    );
    $wpp_query_string = join('&', $wpp_query);

    wpp_get_mostpopular($wpp_query_string);

?>

<?php hrld_sidebar_lower_ad(); ?>

</div><!-- class="sidebar-scroll" -->

</div><!-- class="inner-sidebar" -->
</div><!-- id="sidebar" -->