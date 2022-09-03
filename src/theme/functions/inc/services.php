<?php
/**
 * Functions to integrate outside services into exa.
 * 
 *  
 * @package exa
 * @since v0.2
 */


/**
 * Outputs javascript code for Google Analytics tracking in the footer.
 * 
 * Strings are assigned with HEREDOC format.
 * @see http://www.tuxradar.com/practicalphp/2/6/3
 * 
 * @since v0.4
 */
function exa_register_google_analytics() {

	$js = <<<"GTAG"

	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-2337436-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-2337436-1');

		gtag('config', 'UA-2337436-1', {
			'custom_map': {
				'dimension1': 'days_old',
			}
		});

GTAG;

	$days_old = ( current_time('timestamp') - get_the_time('U') ) / ( 24 * 60 * 60 );
	$days_old = intval($days_old);
	$js .= "\t\tgtag('event', 'load', { 'days_old': $days_old });";
	$js .= "\t</script>";
	
	echo $js;

}
add_action('wp_footer','exa_register_google_analytics');