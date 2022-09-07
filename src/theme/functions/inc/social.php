<?php
/**
 * /functions/social.php
 * 
 * Functions that deal with social media integrations, like open graph tags
 * and twitter cards
 */


/**
 * Returns a url for social
 */
function exa_social_url($url = "", $newVersion = true){
	$date_change_category = 1422622800; // Fri 30 Jan, 2015 07:00:00 CT
	
	if ($url == "")
		$url = get_permalink($post -> ID);
	if ( $url != false && $url != ''){
		$date = get_the_date('U');
	if ( $newVersion ) {
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
 * @see http://ogp.me
 */
function exa_social_open_graph_tags() {
	global $wp;
	global $post;

	if ( !$post ) {
		return;
	}

	/* 1. Title (string) */

	$title = "The Badger Herald";
	if ( is_single() ) {
		$title = single_post_title( null, false );
	} else if ( is_front_page() ) {
		$title = get_bloginfo('name');
	} else {
		$title = wp_title("&middot;", false, "right"); 
	}
	
	/* 2. Description (string) */

	$excerpt;
	if ( is_single() ) {
		if( exa_has_subhead( $post ) ) {
			$excerpt = exa_get_subhead( $post->ID );
		} else {
			$excerpt = strip_tags(get_the_excerpt());
		}
		
	} else if ( is_front_page() ) {
		$excerpt = get_bloginfo('description');
	} else {
		$excerpt = "";
	}

	/* 3. Site (string) */

	$site = "The Badger Herald";
	
	/* 4. Type (enum) */

	/* 5. Url */
	$url = home_url( add_query_arg( array(), $wp->request ) );
	
	/* 6. Image */
	$img = false;
	if ( is_single() ) {
		$img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	}
	if ( !$img ) {
		$img = get_template_directory_uri() . "/assets/img/misc/social-thumb.png";
	}

	
	
	$output = "<!-- Open Graph Tags: http://ogp.me -->\n";
	
	$output .= "<meta property='og:title' content='".$title."' />\n";
	$output .= '<meta property="og:description" content="'.$excerpt.'" />'."\n";
	$output .= "<meta property='og:site_name' content='$site' />\n";
	$output .= "<meta property='og:url' content='$url' />\n";
	$output .= "<meta property='og:image' content='$img' />\n";

	
	if ( is_single() ) {


		/* 2. Title */
		$title = single_post_title( "", false );
		$output .= "<!-- Twitter Card Tags: https://dev.twitter.com/cards/ -->\n";
		$output .= "<meta name='twitter:title' content='$title' />\n";
		$output .= '<meta name="twitter:description" content="' . $excerpt . '" />' . "\n";
		$output .= "<meta name='twitter:site' content='@badgerherald' />\n";
		if(	hrld_author_has("hrld_twitter_handle") ) {
			$twitter = get_hrld_author("hrld_twitter_handle");
			$output .= "<meta name='twitter:creator' content='@$twitter' />\n";
		}
		
		$output .= "\n";
	
		
	}
	if ( is_single() ) {
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
		$output .= "<meta property='og:type' content='website' />";
	}

	/* 7. Finish up */
	echo $output;
}
add_action('wp_head','exa_social_open_graph_tags');

/**
 * Generate a link that is tweetable.
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