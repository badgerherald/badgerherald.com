<?php
/**
 * OpenX ad management
 * 
 * 
 */

function oncampus_footer_tag() {
	echo "";
}
add_action("wp_footer","openx_footer_tag");


function oncampus_serve_ad($size) {


}


/**
 * Deal with ads in our theme.
 * 
 * Mostly ads are served with the help of a DoubleClick plugin for WordPress.
 * 
 * @see https://github.com/inn/DoubleClick-for-Wordpress
 * @since v0.2
 */


/**
 * Setup doubleclick breakpoints and network codes.
 * 
 * @see https://github.com/inn/DoubleClick-for-Wordpress
 * @since v0.2
 */
function exa_ad_setup() {

	global $DoubleClick;

	/* breakpoints */
	$DoubleClick->register_breakpoint('mobile',		array('minWidth'=>0,'maxWidth'=>720));
	$DoubleClick->register_breakpoint('phone',		array('minWidth'=>0,'maxWidth'=>720));
	$DoubleClick->register_breakpoint('tablet',		array('minWidth'=>760,'maxWidth'=>1060));
	$DoubleClick->register_breakpoint('desktop',	array('minWidth'=>1060,'maxWidth'=>1220));
	$DoubleClick->register_breakpoint('xl',			array('minWidth'=>1220,'maxWidth'=>9999));

}
add_action('dfw_setup','exa_ad_setup');




/**
 * Filters content and ads an adspot for phone and tablet devices.
 * 
 * Registered in exa_register_content_adslot()
 * 
 * @uses exa_insert_after_graph
 * 
 * @param string $content The post content is passed in.
 * @since v0.2
 */
function _exa_register_content_adslot($content) {
	
	global $DoubleClick;

	if ( isset($DoubleClick) && is_single() && ! is_admin() ) {
		$ad = $DoubleClick->get_ad_placement('bh:sidekick','300x250',array('mobile','tablet'));
		$ad = "<div class='ad ad-in-content mobile-tablet'>" . $ad . "</div>";
        $content = exa_insert_after_graph( $ad, $content, 2 );
    }

	if ( isset($DoubleClick) && is_single() && ! is_admin() ) {
		$ad = $DoubleClick->get_ad_placement('bh:sidekick2','300x250',array('mobile','tablet'));
		$ad = "<div class='ad ad-in-content mobile-tablet'>" . $ad . "</div>";
        $content = exa_insert_after_graph( $ad, $content, 8 );
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
 * @since v0.2
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
