<?php


add_action( 'init', 'exa_tinymce_buttons' );
function exa_tinymce_buttons() {
    add_filter( "mce_external_plugins", "exa_tinymce_add_buttons" );
    add_filter( 'mce_buttons', 'exa_tinymce_register_buttons' );
}
function exa_tinymce_add_buttons( $plugin_array ) {
    $plugin_array['exa_pullquote'] = get_template_directory_uri() . '/js/exa-tinymce.js';
    return $plugin_array;
}
function exa_tinymce_register_buttons( $buttons ) {
    array_push( $buttons, 'pullquote' ); // dropcap', 'recentposts
    return $buttons;
}


?>