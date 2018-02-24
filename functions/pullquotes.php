<?php
/**
 * Tinymce things
 * 
 * stuff
 */


function exa_tinymce_buttons() {
    add_filter( "mce_external_plugins", "exa_tinymce_add_buttons" );
    add_filter( 'mce_buttons', 'exa_tinymce_register_buttons' );
}
add_action( 'init', 'exa_tinymce_buttons' );

function exa_tinymce_add_buttons( $plugin_array ) {
    $plugin_array['exa_pullquote'] = get_template_directory_uri() . '/js/exa-pullquote.js';
    return $plugin_array;
}

function exa_tinymce_register_buttons( $buttons ) {
    array_push( $buttons, 'pullquote' ); // dropcap', 'recentposts
    return $buttons;
}


/**
 * Register shortcode
 * 
 */
function _exa_pullquote_shortcode( $atts, $quote = "" ) {
    $a = shortcode_atts( array(
        'quote' => '',
        'cite' => '',
        'quotemarks' => '',
        'align' => 'aligncenter'
    ), $atts );


    $classes = $a['quotemarks']==1 ? "pullquote quotemarks {$a['align']}" : "pullquote {$a['align']}";


    $quoteDOM = "<q class='$classes'>";
    $quoteDOM .= $quote;

    if($a["cite"]) {
    	$quoteDOM .= "<cite>" . $a["cite"] . "</cite>";
    }

    $quoteDOM .= "</q>";

    return $quoteDOM;
}
add_shortcode( 'exa_pullquote', '_exa_pullquote_shortcode' );

