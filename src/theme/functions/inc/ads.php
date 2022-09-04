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
//add_filter('the_content','_exa_register_content_adslot');

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