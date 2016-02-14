<?php
/**
 * Functions to aid local development,
 * particularly for Badger Herald developers.
 *
 * @package exa
 */


/**
 * @internal 
 * 
 * If EXA_DEV is set, replaces whatever (local)host an attachment_url
 * is using with badgerherald.com
 * 
 * @author Will Haynes
 */
function _exa_dev_attachment_url( $link ) {

	$url = parse_url( $link );
	if( EXA_DEV && !strpos( $url['host'], 'badgerherald.com') ) {
		$link = preg_replace('/.*uploads/', 'http://badgerherald.com/media', $link); 
	}
	return $link;

}
add_filter('wp_get_attachment_url', '_exa_dev_attachment_url');

function _exa_dev_calculate_image_srcset($sources) {

	// YOU WIN. TURN IMAGE SRCSET OFF FOR NOW.
	return;

	foreach($sources as $source) {
		print_r($source['url']);
		$source['url'] = _exa_dev_attachment_url( $source['url'] );
		print_r($source['url']);
	}

	return $sources;

}
add_filter('wp_calculate_image_srcset','_exa_dev_calculate_image_srcset',1);