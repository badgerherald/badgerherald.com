<?php
/**
 * This template is called when the homepage is loaded
 * 
 * @since v0.1
 */

get_header();

global $rules;

function jp_debug_rewrite_rules($where = 'head') {
    // only do this on public side
    if( is_admin() ) return false;

    global $wp_rewrite, $wp, $template;

    if (!empty($wp_rewrite->rules)) { ?>

        <style>h5{background:#000!important;color:#fff!important;padding:1em!important;margin:1em!important}table{margin:1em!important}table td{border:1px solid silver;padding:5px}tr.matchedrule td{border-color:transparent}tr.matchedrule>td{background:HSLA(52,96%,67%,1)}tr.matchedrule+tr.matchedrule>td{background:HSLA(52,96%,67%,.5)}tr.matchedrule table td+td{font-weight:700}</style>

        <h5>Rewrite Rules</h5>
        <table>
            <thead>
                <tr>
                    <td>
                    <td>Rule
                    <td>Rewrite
                </tr>
            </thead>
            <tbody>
        <?php
        $i = 1;
        var_dump($wp);
        foreach ($wp_rewrite->rules as $name => $value) {
            
            if( $name == $wp->matched_rule ) {

                echo '<tr class="matchedrule">
                    <td>' . $i . '
                    <td>'.$name.'
                    <td>' . $value . '
                    </tr>
                    <tr class="matchedrule">
                    <td colspan="3">
                        <table>
                            <tr><td>Request
                                <td>' . $wp->request . '
                            <tr><td>Matched Rewrite Query
                                <td title="'.urldecode($wp->matched_query).'">' . $wp->matched_query . '
                            <tr><td>Loaded template
                                <td>'. basename($template) . '
                        </table>
                    </td>
                    </tr>';

            } else {
                echo '<tr>
                    <td>'.$i.'
                    <td>'.$name.'
                    <td>'.$value.'
                  </tr>';
            }
            $i++;
        }
        ?>
            </tbody>
        </table>

    <?php

    }
}
jp_debug_rewrite_rules();

exa_container('leaderboard');
exa_container('nameplate');
exa_container('breaking-news');
exa_container('feature-widget');
exa_container('ad-and-two-dominant');
exa_container('list-and-banter');
exa_container('latest-videos');
exa_container('old-homepage');

get_footer();

?>

