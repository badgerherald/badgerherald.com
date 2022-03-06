<?php 
/**
 * enqueue.php
 * 
 * @package Exa
 * 
 * Enqueues scripts and stylesheets for main Exa framework files 
 * CSS and JS for supplementary features should live in their 
 * respective "./functions/*.php"
 */


/**
 * Enqueues scripts and styles for front end.
 * @since v0.1
 */
function _exa_enqueue_scripts_styles() {
	$json = file_get_contents( "/srv/stencil-stats.json");
    $version;
    if ($json) {
        $decoded = json_decode($json);
        $version = "?v=" . substr(md5($decoded->timestamp),0,8);
    } else {
        $version = "";
    }
	
	/**
	 * Load fontastic font.
	 * @see ./assets/css/fontastic/icon-reference.html 
	 */
	wp_enqueue_style( 'exa-icons', get_template_directory_uri() . '/assets/css/fontastic/styles.css?v=12' );

	/** Google Fonts */
	wp_enqueue_style( 'exa-fonts', 'https://fonts.googleapis.com/css?family=Noto+Serif:400,700,400italic,700italic|PT+Sans+Narrow:400,700');

	/** Load main stylesheet. */
	wp_enqueue_style( 'exa-style', get_template_directory_uri() . '/style.css', array(), $version );
	
	/** Load exa.js. (and jQuery, implicitly) */
	wp_enqueue_script('exa-script', get_template_directory_uri() . '/js/exa.js',array('jquery'), $version, true );
}
add_action( 'wp_enqueue_scripts', '_exa_enqueue_scripts_styles' );


/**
 * add cache busting to legacy editor style
 */
function wpse33318_tiny_mce_before_init( $mce_init ) {
	$json = file_get_contents( "/srv/stencil-stats.json");
    $version;
    if ($json) {
        $decoded = json_decode($json);
        $version = substr(md5($decoded->timestamp),0,8);
    } else {
        $version = "";
    }
	
    $mce_init['cache_suffix'] = 'v=' . $version;
    return $mce_init;    
}
add_filter( 'tiny_mce_before_init', 'wpse33318_tiny_mce_before_init' );