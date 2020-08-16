<?php
/**
 * This was stripped out of an old implementation and could use
 * some future clean up.
 * 
 * A shortcode is registered that builds DOM for displaying userdata.
 * 
 * Use the shortcode like:
 * 
 * 		[displaystaff users="whaynes,tgolshan,kcaron"]
 * 
 */

/**
 * Shortcode for displaying pretty mugs on the staff page.
 * 
 * @param array $atts attributes passed into shortcode.
 * @return string DOM string for insertion of staff.
 */
function hexa_dispaystaff( $atts ) {

    $a = shortcode_atts( array(
        'users' => '',
    ), $atts );

    $staffArray = explode(',',$a['users']);

    $return = "<div class='staff-container'>";
    
	foreach($staffArray as $staff) :

		// Turn usernames to ids.
		if( is_string($staff) ) {
			$user = get_user_by('login', $staff);
			if (!$user) {
				continue;
			}
			$staff = $user->ID;
		}

		$return .= "<div class='staff-box'>";
		$muglink = exa_mug_src($staff, 'small-thumbnail');
		
		// Mug
		$return .= "<img class='mug' src='$muglink' />";

		$return .= "<div class='profile'>";

		// Name
		$return .= "<h2 class='name'>" . get_the_author_meta("display_name",$staff);

			if(hrld_author_has("hrld_twitter_handle",$staff)) {
				$twitter_handle = get_hrld_author("hrld_twitter_handle",$staff);
				$return .= "<a href='https://twitter.com/$twitter_handle' class='icon-twitter-bird'></a>";
			}

		$return .= "</h2>";
		
		// Position
		$return .= "<h3 class='position'>";
			$return .= get_hrld_author("hrld_current_position",$staff);	
			if(hrld_author_has("hrld_staff_semesters",$staff)) {
				$return .= " &middot; " . _hexa_semesterify(get_hrld_author("hrld_staff_semesters",$staff));
			}		
		$return .= "</h3>";

		// Twitter and more:

		if(hrld_author_has("hrld_staff_description",$staff)) {
			$return .= "<p class='staff-box-more-description'>";
			$return .= get_hrld_author("hrld_staff_description",$staff);
			$return .= "</p>";
		}

		$return .= "<p><a href='mailto:" . get_the_author_meta( "email", $staff ) . "'>" . get_the_author_meta( "email", $staff ) . "</a></p>";

		

		
		
		$return .= "</div>";
		$return .= "<div class='clearfix'></div>";
		$return .= "</div>";
		
	endforeach;

	$return .= "</div>";

	return $return;

}
add_shortcode( 'displaystaff', 'hexa_dispaystaff' );

// Add a body class to target styling.
function about_class($classes) {
	
	global $post;

	if($post->post_parent == 0 && $post->post_name != "about") 
		return $classes;

  	$post_data = get_post($post->post_parent);

	if($post_data->post_name == "about" || $post->post_name == "about") {
		$classes[] = 'about-page';
	}
	return $classes;

} add_filter('body_class','about_class');


function _hexa_semesterify($semesters) {
	switch ($semesters) {
		case '1':
			return "1st semester at the Herald";
			break;
		case '2':
			return "2nd semester at the Herald";
			break;
		case '3':
			return "3rd semester at the Herald";
			break;	
		default:
			return $semesters . "th semester at the Herald";
			break;
	}
}
/**
 * 
 * An old function that when called will list contributors that
 * have had 3 stories published in the past semester in the
 * given section.
 * 
 * Could use some major cleanup. Here just as an example.
 * 
 */ /*
function listWriters($section,$exclude = null) {

	// people like staff, editorial board, &c.
	$globalExclude = array(1023,4,2792,2857,2858);
	if(!$exclude) {
		$exclude = array();
	} else {
		// support usernames passed in instead of ids.
		foreach($exclude as $i => $e) {
			if ( is_string($e) ) {
			$user = get_userdatabylogin($e);
			$exclude[$i] = $user->ID;
			}
		}
	}
	$exclude = array_merge($globalExclude,$exclude);

	$sdate = new DateTime();				// Time now.
	$sdate->sub(new DateInterval('P4M'));	// Subtract 4 months.


	if( class_exists('hrld_get_writers') ) {

		echo "Writers: ";
		$newsWriters = new hrld_get_writers();
		$newsWriters->section($section);
		$newsWriters->num_published(3,'more',$sdate);
		$writers = $newsWriters->query();
		$first = true;
		foreach($writers as $w) {
			if( !in_array($w->user_id,$exclude) ) :
				if(!$first) {
					echo ", ";
				} $first = false;
				echo "<a href='" . get_author_posts_url( $w->user_id ) . "'>$w->display_name</a>";
			endif;
		}
	}

}
*/
