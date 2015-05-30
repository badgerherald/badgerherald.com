<?php
/**
 * Functions to aid local development,
 * particularly for Badger Herald developers.
 *
 * @package exa
 */


/**
 * If EXA_DEV is set, replaces whatever (local)host an attachment_url
 * is using with badgerherald.com
 * 
 * @author Will Haynes
 */
function exa_dev_attachment_url( $link ) {

	$url = parse_url( $link );
	if( EXA_DEV && !strpos( $url['host'], 'badgerherald.com') ) {
		$link = preg_replace('/.*uploads/', 'http://badgerherald.com/media', $link); 
	}
	return $link;

}
add_filter('wp_get_attachment_url', 'exa_dev_attachment_url');
