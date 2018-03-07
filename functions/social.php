<?php
/**
 * /functions/social.php
 * 
 * Functions that deal with social media integrations, like open graph tags
 * and twitter cards
 */


/**
 * Returns a url for social
 *
 * @since v0.2
 * @author Jason Chan
 */
function exa_social_url($url = "", $newVersion = true){

	$date_change_category = 1422622800; // Fri 30 Jan, 2015 07:00:00 CT
	if($url == "")
		$url = get_permalink($post -> ID);
	if( $url != false && $url != ''){
		$date = get_the_date('U');
	if( $newVersion){
		if( stripos($url, home_url("/oped")) === 0 )
			$url = str_replace("/oped", "/opinion", $url);
		} else if( !$newVersion && $date < $date_change_category){
			if( stripos($url, home_url("/opinion")) === 0 )
				$url = str_replace("/opinion", "/oped", $url);
			}
		} else {
			$url = home_url();
		}
	return $url;
}


/**
 * Prints open graph tags to the head of wordpress pages.
 *
 * @since v0.1
 * @author Will Haynes
 * 
 * @see http://ogp.me
 */
function exa_social_open_graph_tags() {

	global $post;

	if( !$post )
		return;

	$output = "\n<!-- Open Graph Tags: http://ogp.me -->\n";

	/* 1. Title (string) */

	$title = single_post_title( null, false );
	$output .= "<meta property='og:title' content='$title' />\n";

	/* 2. Description (string) */

	$excerpt = htmlspecialchars(_exa_social_get_description());
	$output .= '<meta property="og:description" content="'.$excerpt.'" />'."\n";

	/* 3. Site (string) */

	$site = "The Badger Herald";
	$output .= "<meta property='og:site_name' content='$site' />\n";

	/* 4. Type (enum) */
	
	// is_single: When any single Post (or attachment, or custom Post Type) page is being displayed. 
	// (todo) type of profile is also valid.

	if( is_single() ) {

		// type (enum)
		$output .= "<meta property='og:type' content='article' />\n";

		// article:published_time (datetime)
		$published = new DateTime($post->post_date_gmt,new DateTimeZone('GMT'));
		$published->setTimeZone( new DateTimeZone("America/Chicago") );
		$output .= "<meta property='og:article:published_time' content='{$published->format(DateTime::ISO8601)}' />\n";

		// article:modfied_time (datetime)
		$modified = new DateTime($post->post_modified_gmt,new DateTimeZone('GMT'));
		$modified->setTimeZone( new DateTimeZone("America/Chicago") );
		$output .= "<meta property='og:article:modified_time' content='{$modified->format(DateTime::ISO8601)}' />\n";

		// article:section (string)
		$section = get_the_category();
		if( $section ) {
			$section = $section[0]->name;
			$section = $section == 'oped' ? $section = 'opinion' : $section;
			$output .= "<meta property='og:article:section' content='$section' />\n";
		}

		// article:tag (string array)
		$tags = wp_get_post_terms($post->ID,'topic');
		if( $tags ) {
			foreach ($tags as $tag) {
				$output .= "<meta property='og:article:tag' content='{$tag->name}' />\n";
			}
		}
		// Currently unused (profile tag) (todo)
		// $output .= "<meta property='og:article:author' content='' />\n";

	} else {

		// type (enum)
		$output .= "<meta property='og:type' content='website' />\n";

	}

	/* 5. Url */

	$url = exa_social_url(get_permalink($post->ID), false);
	$output .= "<meta property='og:url' content='$url' />\n";
	

	/* 6. Image */

	$img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	if( $img ) {
		$output .= "<meta property='og:image' content='$img' />\n";
	} else {
		$img = get_template_directory_uri() . "/assets/img/misc/social-thumb.png";
		$output .= "<meta property='og:image' content='$img' />\n";
	}

	/* 7. Finish up */

	$output .= "\n";
	echo $output;

}
add_action('wp_head','exa_social_open_graph_tags');

/**
 * Prints twitter card text to the head of wordpress pages.
 *
 * @since v0.1
 * @author Will Haynes
 * 
 * @see https://dev.twitter.com/cards/
 */
function exa_social_twitter_card_tags() {

	global $post;

	if(!$post)
		return;

	$output = '';

	// Currently, we only have cards on 
	// single post pages.
	if( is_single() ) :

	$output .= "\n<!-- Twitter Card Tags: https://dev.twitter.com/cards/ -->\n";

	/* 1. Card type, and image */

	$img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

	if( $img ) {
		$output .= "<meta name='twitter:card' content='summary_large_image' />\n";
		$output .= "<meta name='twitter:image:src' content='$img' />\n";
	} else {
		$output .= "<meta name='twitter:card' content='summary' />\n";
	}

	/* 2. Title */

	$title = single_post_title( "", false );
	$output .= "<meta name='twitter:title' content='$title' />\n";

	/* 3. Excerpt */

	$excerpt = htmlspecialchars(_exa_social_get_description());
	$output .= '<meta name="twitter:description" content="' . $excerpt . '" />' . "\n";
	
	/* 4. Site */

	$output .= "<meta name='twitter:site' content='@badgerherald' />\n";
	
	/* 5. Creator */

	if(	hrld_author_has("hrld_twitter_handle") ) {
		$twitter = get_hrld_author("hrld_twitter_handle");
		$output .= "<meta name='twitter:creator' content='@$twitter' />\n";
	}
	
	endif;

	/* 6. Finish up */

	$output .= "\n";
	echo $output;

}
add_action('wp_head','exa_social_twitter_card_tags');

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

/**
 * The excerpt to serve to facebook, twitter, google, &c.
 *
 * @since v0.1
 * 
 * @see http://wordpress.stackexchange.com/questions/26729/get-excerpt-using-get-the-excerpt-outside-a-loop
 */
function _exa_social_get_description($post_id = null) {

    $the_post = get_post($post_id);

    if(!$the_post) {
    	return;
    }

    $post_id = $the_post->ID;

    if( exa_has_subhead($post_id) ) {
    	$the_excerpt = exa_get_subhead($post_id);
    } else {
    	$the_excerpt = $the_post->post_content; // Gets post_content to be used as a basis for the excerpt
    	$excerpt_length = 35; // Sets excerpt length by word count
    	$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); // Strips tags and images
    	$words = explode(' ', $the_excerpt, $excerpt_length + 1);

    	if(count($words) > $excerpt_length) :
    	    array_pop($words);
    	    array_push($words, '…');
    	    $the_excerpt = implode(' ', $words);
    	endif;
	}

    // replace all white space with single spaces.
    $the_excerpt = preg_replace("/\s+/", " ", $the_excerpt);

    return $the_excerpt; 
}

