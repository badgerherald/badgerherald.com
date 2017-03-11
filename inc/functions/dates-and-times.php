<?php

/**
 * Prints exa_get_time()
 * 
 * @see exa_get_time( $post )
 * @since  	v0.1
 * 			v0.5 - greatly improved	
 * @return string A readable representation of the time interval.
 */
function exa_time( $post = null ) {
	echo exa_get_time($post);
}

/**
 * Returns the relative time for a post up to the past 24 hours. 
 * Then returns exa_date():
 * 
 * e.g 	12 minutes ago 		(published in the past hour)
 * 		5 hours ago 		(published in the past day)
 * 		Yesterday			(published yesterday)
 * 		June 16 			(published in the past year)
 * 		June 16, 2015 		(published in previous years)
 * 
 * @since v0.5
 * @return string A readable representation of the time interval.
 */
function exa_get_time( $post = null ) {
	
	$post = get_post($post);
	$secondsSincePublishing = _exa_seconds_since_published( $post );

	$since = "";
	if( exa_is_published_today( $post ) ) {

		if ( $secondsSincePublishing <= HOUR_IN_SECONDS ) {
			$mins = round( $secondsSincePublishing / MINUTE_IN_SECONDS );
			if( $mins < 1)
				$mins = 1;
			$since = sprintf( _n('%s minute ago', '%s minutes ago', $mins, 'exa'), $mins);
		} else {
			$hours = round( $secondsSincePublishing / HOUR_IN_SECONDS );
			$since = sprintf( _n('%s hour ago', '%s hours ago', $hours, 'exa'), $hours);
		}
	}
	else if( exa_is_published_yesterday( $post ) ) {
		$since = "Yesterday";
	}
	else {
		$since = get_the_time("M j, Y",$post);
	}
	
	return $since;
}

function _exa_seconds_since_published( $post = null ) {

	$post = get_post($post);

	$from = get_the_time( 'U', $post );
	$to = current_time( "timestamp" );

	return (int) abs( $to - $from );

}

/**
 * Returns true if the post was published today
 * 
 * @since v0.5
 */
function exa_is_published_today( $post ) {
	$post = get_post($post);
	$postTime = get_post_time('U',true);
	$today = strtotime('midnight',current_time('timestamp'));
	return ($postTime >= $today);
}

/**
 * Returns true if the post was published yesterday
 * 
 * @since v0.5
 */
function exa_is_published_yesterday( $post ) {
	$post = get_post($post);
	$postTime = get_post_time('U',true);
	$firstDayOfYear = strtotime('yesterday',current_time('timestamp'));
	return ($postTime >= $firstDayOfYear);
}

/**
 * Returns true if the post was published yesterday
 * 
 * @since v0.5
 */
function exa_is_published_this_year( $post ) {
	$post = get_post($post);
	$postTime = strtotime($post->post_date);
	$firstDayOfYear = strtotime(date('Y-01-01'));
	return ($postTime >= $firstDayOfYear);
}

