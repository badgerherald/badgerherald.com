<?php
/**
 * OpenX ad management
 * 
 * 
 */


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
	
	global $OnCampus;
/*
	if ( isset($OnCampus) && is_single() && ! is_admin() ) {
		$ad = $OnCampus->get_ad_placement(array('mobile' => 'upper-article-sidekick', 'desktop' => ''));
		$ad = "<div class='ad ad-in-content mobile-tablet'>" . $ad . "</div>";
        $content = exa_insert_after_graph( $ad, $content, 2 );
    }

	if ( isset($OnCampus) && is_single() && ! is_admin() ) {
		$ad = $OnCampus->get_ad_placement(array('mobile' => 'lower-article-sidekick', 'desktop' => ''));
		$ad = "<div class='ad ad-in-content mobile-tablet'>" . $ad . "</div>";
        $content = exa_insert_after_graph( $ad, $content, 8 );
    }
*/
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

