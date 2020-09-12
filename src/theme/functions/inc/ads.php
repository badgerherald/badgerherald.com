<?php
/**
 * Deal with ads in our theme.
 * 
 * Mostly ads are served with the help of a DoubleClick plugin for WordPress.
 * 
 * @see https://github.com/inn/DoubleClick-for-Wordpress
 * @since v0.6
 */

/**
 * Setup doubleclick breakpoints and network codes.
 * 
 * @see https://github.com/inn/DoubleClick-for-Wordpress
 */
function hexa_dfw_setup() {

	global $DoubleClick;

	if( true || hrld_is_production() ) {
		// Production networkCode:
		$DoubleClick->networkCode = "8653162";
	} else {
		// Test networkCode:
		$DoubleClick->networkCode = "64222555";
	}

	/* breakpoints */
	$DoubleClick->register_breakpoint('mobile',		array('minWidth'=>0,'maxWidth'=>720));
	$DoubleClick->register_breakpoint('phone',		array('minWidth'=>0,'maxWidth'=>720));
	$DoubleClick->register_breakpoint('tablet',		array('minWidth'=>760,'maxWidth'=>1060));
	$DoubleClick->register_breakpoint('desktop',	array('minWidth'=>1060,'maxWidth'=>1220));
	$DoubleClick->register_breakpoint('xl',			array('minWidth'=>1220,'maxWidth'=>9999));

}
add_action('dfw_setup','hexa_dfw_setup');

/**
 * Filters content and ads an adspot for phone and tablet devices.
 * 
 * Registered in exa_register_content_adslot()
 * 
 * @uses exa_insert_after_graph
 * 
 * @param string $content The post content is passed in.
 * @since v0.6
 */
function _exa_register_content_adslot($content) {
	
	global $DoubleClick;
	
	if( !isset($DoubleClick) ) {
		return;
	}

	$sizes = array(
		'phone' => '300x250',
		'desktop' =>'1x1'
		);

	if ( is_single() ) {
		
		$ad = $DoubleClick->get_ad_placement('badgerherald.com-upper-sidekick',$sizes);
		$ad = "<div class='ad ad-in-content' style='display:none;'>" . $ad . "</div>";
		$content = exa_insert_after_graph( $ad, $content, 2 );

		$ad2 = $DoubleClick->get_ad_placement('badgerherald.com-lower-sidekick',$sizes);
		$ad2 = "<div class='ad ad-in-content' style=\"display:none;\">" . $ad2 . "</div>";
		$content = exa_insert_after_graph( $ad2, $content, 6 );

	}
	return $content;
}
add_filter('the_content','_exa_register_content_adslot');

/**
 * Inserts a string in between paragraphs.
 * 
 * @param string $insertion The string to insert.
 * @param string $content The content to insert into.
 * @param int $graph The paragraph to insert after.
 * @since v0.6
 */
function exa_insert_after_graph( $insertion, $content, $graph ) {
	
	$graphs = explode( '</p>', $content );
	foreach ($graphs as $i => $p) {
	    if ( trim( $p ) ) {
	        $graphs[$i] .= '</p>';
	    }
	    if ( $graph == $i + 1 ) {
	        $graphs[$i] .= $insertion;
	    }
	}
	return implode( '', $graphs );
}

/**
 * Support DoubleClick for WordPress even when it's not
 * installed.
 */
if( !class_exists('DoubleClick') && !is_admin() ) {
	class DoubleClick {
		public function __construct($networkCode = null) {}
		public function place_ad($identifier,$sizes,$args = null) {}
		public function get_ad_placement($identifier,$sizes,$args = null) {}
	}
	$DoubleClick = new DoubleClick();
}

/** 
 * Enqueue flytedesk script
 */
function hexa_flytedesk_footer_enqueue() {
    //echo '<p>This is inserted at the bottom</p>';
}
add_action( 'wp_footer', 'hexa_flytedesk_footer_enqueue' );


