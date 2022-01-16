<?php 

/**
 * End the normal content section for the donate form.
 */
function bhrld_donate_filter_shortcode( $string ) {
    return "</section><div style='margin-top:-36px'>" . $string . "</div><section class='article-text'>";
}
add_filter( 'bhrld_donate_form_shortcode', 'bhrld_donate_filter_shortcode');