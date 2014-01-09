<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage exa
 * @since Twenty Thirteen 1.0
 */

?>

<div id="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-scroll">
            <input type="hidden" name="cantseeme" value="wat"/>
            <fieldset>
                <?php
                    $section_query_var = $_GET['section'];
                    $dates_query_var = $_GET['date_range'];
                ?>
                <legend class="screen-reader-text">Improve your search</legend>
                <ol>
                    <li>
                        <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                            <input type="hidden" name="s" value="<?php the_search_query(); ?>" />
                            <input type="hidden" name="date_range"
                            <?php if (isset($dates_query_var)) {
                                echo 'value="'.$dates_query_var.'"';
                            } else {
                                echo 'value="All time"';
                            }
                            ?> />
                            <label for="section">Section</label>
                            <ul>
                                <li><input type="submit" name="section" value="All" /></li>
                                <li><input type="submit" name="section" value="News" /></li>
                                <li><input type="submit" name="section" value="OpEd" /></li>
                                <li><input type="submit" name="section" value="ArtsEtc" /></li>
                                <li><input type="submit" name="section" value="Sports" /></li>               
                            </ul>
                        </form>
                    </li>
                    <li>
                        <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                            <input type="hidden" name="s" value="<?php the_search_query(); ?>" />
                            <input type="hidden" name="section"
                            <?php if (isset($section_query_var)) {
                                echo 'value="'.$section_query_var.'"';
                            } else {
                                echo 'value="All"';
                            }
                            ?> />
                            <label for="date_range">Date range</label>
                            <ul>
                                <li><input type="submit" name="date_range" value="All time" /></li>
                                <li><input type="submit" name="date_range" value="This month" /></li>
                                <li><input type="submit" name="date_range" value="This year" /></li>
                            </ul>
                        </form>
                    </li>
                </ol>
            </fieldset>
            </form>
            <?php

            dfp::hrld_sidebar_ad();

            dfp::hrld_sidebar_lower_ad();

            ?>
        </div><!-- class="sidebar-scroll" -->
    </div><!-- class="sidebar-inner" -->
</div><!-- id="sidebar" -->