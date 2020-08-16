<?php

/**
 * Register built in Exa navigation menus.
 *
 * @since v0.6
 */
function exa_menus_register() {
	// todo: should this be commented?
	// add_theme_support('menus');

	register_nav_menu( 'exa_main_menu', "Main Menu" );
	register_nav_menu( 'exa_secondary_menu', "Secondary Menu" );
	register_nav_menu( 'exa_social_media_menu', "Social Media Menu" );
}
add_action( 'after_setup_theme', 'exa_menus_register' );
add_action( 'init', 'exa_menus_register' );


function _exa_menus_add_social_media_inner_span( $args ) {
	if ($args['theme_location'] === 'exa_social_media_menu') {
    	$args['link_before'] = '<span class="hide">';
    	$args['link_after'] = '</span>';
    }
    return $args;
}
add_filter( 'wp_nav_menu_args', '_exa_menus_add_social_media_inner_span' );

function _exa_menus_add_social_media_classname( $atts, $item, $args ) {

	$mapping = array(
		'twitter.com' => 'twitter',
		'facebook.com' => 'facebook',
		'linkedin.com' => 'linkedin',
		'instagram.com' => 'instagram',
		);
    if ($args->theme_location === 'exa_social_media_menu') {
    	foreach($mapping as $domain => $class) {
    		if (strpos($atts['href'], $domain) !== false) {
    			$classes = array_key_exists('class',$atts) ? $atts['class'] . " " : ""; 
    			$atts['class'] = $classes . $class;
			}
    	}
    }
    //print_r($args);
    return $atts;
}
add_filter( 'nav_menu_link_attributes', '_exa_menus_add_social_media_classname', 10, 3 );

