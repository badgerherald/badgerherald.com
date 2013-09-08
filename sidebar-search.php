<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

?>

<div id="sidebar">
    <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
        <label>
            <span class="screen-reader-text">Refine your search:</span>
            <input type="search" class="search-field" placeholder="Search …" value="" name="s" title="Search for:" />
        </label>
        <input type="hidden" name="search_refined" value="<?php the_search_query(); ?>" />
        <input type="submit" class="search-submit" value="Search" />
    </form>
</div><!-- id="sidebar" -->