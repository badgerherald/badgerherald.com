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
	
	/**
	 * Load fontastic font.
	 * @see ./assets/css/fontastic/icon-reference.html 
	 */
	wp_enqueue_style( 'exa-icons', get_template_directory_uri() . '/assets/css/fontastic/styles.css?v=12' );

	/** Google Fonts */
	wp_enqueue_style( 'exa-fonts', 'https://fonts.googleapis.com/css?family=Noto+Serif:400,700,400italic,700italic|PT+Sans+Narrow:400,700');

	/** Load main stylesheet. */
	$mtime = file_exists(dirname(__FILE__) . '/../style.css') ? filemtime(dirname(__FILE__) . '/../style.css') : "";
	wp_enqueue_style( 'exa-style', get_template_directory_uri() . '/style.css', array(), $mtime );
	
	/** Load exa.js. (and jQuery, implicitly) */
	$mtime = filemtime(dirname(__FILE__) . '/../js/exa.js');
	wp_enqueue_script('exa-script', get_template_directory_uri() . '/js/exa.js',array('jquery'), $mtime, true );

	/** Load stencil.js. (and jQuery, implicitly) */
	$mtime = filemtime(dirname(__FILE__) . '/../../js/components/exa.js');
	wp_register_script('exa-wpapi', get_template_directory_uri() . '/js/vendor/bundle.js','', $mtime, true );
	wp_enqueue_script('exa-stencil', get_template_directory_uri() . '/js/components/exa.js',array('exa-wpapi'), $mtime, false );
	
}
add_action( 'wp_enqueue_scripts', '_exa_enqueue_scripts_styles' );

