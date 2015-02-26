<?php
/**
 * Deal with ads in our theme.
 * 
 * Mostly ads are served with the help of a DoubleClick plugin for WordPress.
 * 
 * @see https://github.com/willhaynes/DoubleClick-for-Wordpress
 * @since v0.2
 */


/**
 * Setup doubleclick breakpoints and network codes.
 * 
 * @see https://github.com/willhaynes/DoubleClick-for-Wordpress
 * @since 0.2
 */
function exa_ad_setup() {

	global $DoubleClick;
	$DoubleClick->networkCode = "8653162";

	if( !hrld_is_production() )
		$DoubleClick->debug = true;

	/* breakpoints */
	$DoubleClick->register_breakpoint('mobile',		array('minWidth'=>0,'maxWidth'=>720));
	$DoubleClick->register_breakpoint('phone',		array('minWidth'=>0,'maxWidth'=>720));
	$DoubleClick->register_breakpoint('tablet',		array('minWidth'=>760,'maxWidth'=>1040));
	$DoubleClick->register_breakpoint('desktop',	array('minWidth'=>1040,'maxWidth'=>1220));
	$DoubleClick->register_breakpoint('xl',			array('minWidth'=>1220,'maxWidth'=>9999));

}
add_action('dfw_setup','exa_ad_setup');



/**
 * Adds filter to content to display in the middle of content on mobile devices.
 * 
 * @since 0.2
 */
function exa_register_content_adslot() {

	global $DoubleClick;
	if ( is_single() && ! is_admin() ) {
		add_filter('the_content','_exa_register_content_adslot');
	}

}
add_action('dfw_setup','exa_register_content_adslot');



/**
 * Filters content and ads an adspot for phone and tablet devices.
 * 
 * Registered in exa_register_content_adslot()
 * 
 * @uses exa_insert_after_graph
 * 
 * @param string $content The post content is passed in.
 * @since 0.2
 */
function _exa_register_content_adslot($content) {
	
	global $DoubleClick;

	if ( is_single() && ! is_admin() ) {
		$ad = $DoubleClick->get_ad_placement('bh:sidekick','300x250',array('phone','tablet'));
		$ad = "<div class='ad ad-in-content mobile-tablet'>" . $ad . "</div>";
        return exa_insert_after_graph( $ad, $content, 3 );
    }
    return $content;
}



/**
 * Inserts a string in between paragraphs.
 * 
 * @param string $insertion The string to insert.
 * @param string $content The content to insert into.
 * @param int $graph The paragraph to insert after.
 * @since 0.2
 */
function exa_insert_after_graph( $insertion, $content, $graph ) {
	
	$graphs = explode( '</p>', $content );
	foreach ($graphs as $i => $p) {
	    if ( trim( $p ) ) {
	        $graphs[$i] .= '</p>';
	    }
	    if ( $graph_id == $i + 1 ) {
	        $graphs[$i] .= $insertion;
	    }
	}
	return implode( '', $graphs );
	
}