<?php
/**
 * Functions that deal with social stuff.
 * 
 * 
 */


/**
 * Generate a link that is tweetable.
 * 
 * @since v0.2
 * 
 * @param String $title the title of the link.
 * @param String $tweet (optional) the text of the tweet. Defaults to the same as title.
 * @param String $classes (optional) a class string to add to the link.
 * @param String $header (optional) if this should be a header link (<h1>,<h2>,&c.) include a 
 *               number of that size. 0 and null will both
 */
function exa_get_tweet_link($title, $tweet = null, $classes = null, $header = null) {

	if($tweet === null) {
		$tweet = $title;
	}

	$tweet = str_replace(' ',"%20",$tweet);
	$dom = "<a ";

	$dom .= "target='blank' ";
	$dom .= "class='tweet-link $classes' ";
	$dom .= "href='https://twitter.com/intent/tweet/?text=$tweet' ";
	
	$dom .= ">";

	if( $isheader = (is_int($header) && 0 < $header && $header < 7) ) {
		$dom .= "<h" . $header . ">";
	}

	$dom .= $title;

	if($isheader) {
		$dom .= "</h" . $header . ">";
	}
	$dom .= "</a>";

	return $dom;

}