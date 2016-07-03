<?php

/**
 * Echos the section
 * 
 * @since v0.2
 */
function exa_section($post = null) {
	echo exa_get_section($post);
}

/**
 * Returns the corresponding exa section
 * 
 * @since v0.5
 * @return string section.
 */
function exa_get_section($post = null) {
	$post = get_post($post);
	
	$section = get_the_category($post);
	$section = apply_filters('exa_section',$section,$post);

	return $section;
}

/**
 * Returns a url for the section.
 * 
 * @since v0.4
 * @return string section.
 */
function exa_section_permalink($post = null) {
	echo exa_get_section_permalink($post);
}

/**
 * Returns a url for the section.
 * 
 * @since v0.4
 * @return string section.
 */
function exa_get_section_permalink($post = null) {
	$post = get_post($post);
	
	$section = get_the_category($post);

	if( $section ) {
		return get_term_link($section[0]->term_id,"category");
	}

	return "";
}