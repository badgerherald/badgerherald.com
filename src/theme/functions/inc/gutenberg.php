<?php

/*
Plugin Name: My Gutenberg Block
*/
function my_custom_block_register_block()
{

    // Register JavasScript File build/index.js
    wp_register_script(
        'webpress-features',
        get_template_directory_uri() . '/scripts/index.js',
        array('wp-blocks', 'wp-element', 'wp-editor'),
        filemtime(plugin_dir_path(__FILE__) . 'build/index.js')
    );

    // Register your block
    register_block_type('myguten-block/test-block', array(
        'editor_script' => 'webpress-features',
        'editor_style' => 'my-custom-block-editor-style',
        'style' => 'my-custom-block-frontend-style',
    ));
}

add_action('init', 'my_custom_block_register_block');