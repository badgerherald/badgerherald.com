<?php
/**
 * Functions to aid local development,
 * particularly for Badger Herald developers.
 *
 * @package exa
 */

/**
 * Is this a production environment?
 * Default: TRUE.
 */
if ( ! defined( 'EXA_PRODUCTION' ) )
	define( 'EXA_PRODUCTION', TRUE );

/**
 * Is this a herald development enviornment?
 * 
 * Default: FALSE.
 */
if ( ! defined( 'EXA_DEV' ) )
	define( 'EXA_DEV', FALSE );

/**
 * if EXA_DEV defined, return that,
 * else if WP_DEBUG defined, return that,
 * else return false.
 * 
 *
 * @since v0.6
 */
function exa_dev() {
	if( defined( 'EXA_DEV') )
		return EXA_DEV;
	else if( defined('WP_DEBUG') )
		return WP_DEBUG;
	else
		return false;
   
}

function exa_log($error) {
	if( !EXA_PRODUCTION ) {
		error_log( print_r($error,1) );
	}
}

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