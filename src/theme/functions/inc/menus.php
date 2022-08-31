<?php

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
    return $atts;
}
add_filter( 'nav_menu_link_attributes', '_exa_menus_add_social_media_classname', 10, 3 );