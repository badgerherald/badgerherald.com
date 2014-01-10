<?php
/**
 * exa functions file.
 *
 * Contents:
 *
 * 
 *
 *
 *
 */

/**
 * Sets up the content width value based on the theme's design.
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 690;

/**
 * Require the ads function.
 */
require_once('inc/ads.php');

/**
 * Exa should run on WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require( get_template_directory() . '/inc/back-compat.php' );

global $shortcode_tags;
if ( !array_key_exists( 'media-credit', $shortcode_tags ) )
    add_shortcode('media-credit', 'ignore_media_credit_shortcode' );

/**
 * Calls methods to set up various elements of exa.
 *
 * @author Will Haynes
 * @since 29 Nov 2013
 * @return void
 */
function exa_setup() {

	/* Register News, Sports, Opinion & ArtsEtc. sections. */
	add_action( 'init', 'register_sections' );

	/* Register different size thumbnail images */
	add_theme_support('post-thumbnails');

	/* Include custom editor styles, so the backend looks like
	 * the front end. */
	add_editor_style( 'css/editor-style.css' );

	/* Adds RSS feed links to <head> for posts and comments. */
	add_theme_support( 'automatic-feed-links' );

	/* This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages. */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 690, 450, true );

	/* Register custom image size for image post formats. */
	add_image_size( 'image-post-size', 860, 470, false );
	add_image_size( 'small-thumbnail', 345, 225, true );
	add_image_size( 'large-thumbnail', 690, 450, true );

	/* For Mugs */
	add_image_size( 'square', 160, 160, true );

	/* This theme uses its own gallery styles. 
	add_filter( 'use_default_gallery_style', '__return_false' ); */

}
add_action( 'after_setup_theme', 'exa_setup' );


/**
 * Enqueues scripts and styles for front end.
 *
 * @author Will Haynes
 * @since 29 Nov 2013
 * @return void
 */
function exa_scripts_styles() {
	
	global $wp_styles;

	/* Load main stylesheet. */
	wp_enqueue_style( 'exa-style', get_stylesheet_uri() );

	/* Load swipe library */
	/* TODO: only homepage */
	wp_enqueue_script( 'swipe', get_template_directory_uri() . '/js/Swipe/swipe.js', array(), '2.0', true );

	/* Load fastclick library */
	wp_enqueue_script( 'fastclick', get_template_directory_uri() . '/js/fastclick/lib/fastclick.js', array(), '0.6.11', true );	
	
}
add_action( 'wp_enqueue_scripts', 'exa_scripts_styles' );



/**
 * Switches default core markup for search form to output valid HTML5.
 *
 * @param string $format Expected markup format, default is `xhtml`
 * @return string 'html5'
 */
function exa_search_form_format( $format ) {
	return 'html5';
}
add_filter( 'search_form_format', 'exa_search_form_format' );


/**
 * Changes the default exerpt tag to include a permalink, and class of class="exerpt-more"
 *
 * Added: July 2013
 * 
 * @param $more 
 * @return Anchor tag exerpt link 
 */
function new_excerpt_more( $more ) {
	return ' <span class="excerpt-more">...</span>';
}
add_filter('excerpt_more', 'new_excerpt_more');


/**
 * Alters the query for different post pages.
 *
 * @author Will Haynes
 * @since Oct 2013
 * @return void
 */
function alter_queries( $query ) {

	$all_sections = array( 'news', 'oped', 'artsetc', 'sports' );
	/* Return if this is not the main query, or if it is a back end query */
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( is_front_page() ) {
 		$query->set( 'post_type',  $all_sections );
		$query->set('posts_per_page', 25);
        $query->set( 'tax_query',
            array(
                array(
                    'taxonomy' => 'importance',
                    'field' => 'slug',
                    'terms' => array('featured','stream'),
                    'operator' => 'IN'
                )
            )
        );

        return;
    } else {
		$query->set('posts_per_page', 25);
    } 

    if( $query->is_author ) {
    	$query->set( 'post_type', $all_sections  );
    }

    if( is_search() ) {
    	if (isset($_GET['section'])) {
	    	$section = array(strtolower($_GET['section']));
	    	if ($section == array('all') || !in_array($section[0], $all_sections)) {
	    		$section = $all_sections;
	    	}
	    } else {
	    	$section = $all_sections;
	    }
    	$query->set('post_type', $section);

    	if (isset($_GET['date_range'])) {
    		$date_range = $_GET['date_range'];
    		if ($date_range == 'This month') {
    			$query->set('year', date('Y'));
    			$query->set('monthnum', date('m'));
    		} elseif ($date_range == 'This year') {
    			$query->set('year', date('Y'));
    		}
    	}
    }

    return;
}
add_action( 'pre_get_posts', 'alter_queries', 1 );


function exa_get_beats() {

	global $post;
	return wp_get_post_terms(get_the_ID(),get_post_type()."-beats");

}

function exa_is_featured() {

	global $post;
	return (in_array("Featured",wp_get_post_terms(get_the_ID(),importance,array("fields" => "names"))));

}

function exa_is_instream() {

	global $post;
	return (in_array("In Stream",wp_get_post_terms(get_the_ID(),importance,array("fields" => "names"))));

}

/**
 * Takes a string, and returns a string that denotes ownership.
 * 
 * ex: passing "John" returns "John's"
 *     passing "Ross" returns "Ross'" (without the last s)
 *
 * @author Will Haynes
 * @since Oct 2013
 * @param String $name the name to 'propertize.'
 * @return a 'propertized' version of $name
 */
function exa_properize($name) {
	return $name.'\''.($name[strlen($name) - 1] != 's' ? 's' : '');
}


function custom_excerpt_length( $length ) {
	return 24;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


function exa_human_time_diff( $from, $to = '' ) {
	if ( empty( $to ) )
		$to = current_time( "timestamp" );
	$diff = (int) abs( $to - $from );
	if ( $diff <= HOUR_IN_SECONDS ) {
		$mins = round( $diff / MINUTE_IN_SECONDS );
		if ( $mins <= 1 ) {
			$mins = 1;
		}
		/* translators: min=minute */
		$since = sprintf( _n( '%s min', '%s mins', $mins ), $mins );
	} elseif ( ( $diff <= DAY_IN_SECONDS ) && ( $diff > HOUR_IN_SECONDS ) ) {
		$hours = round( $diff / HOUR_IN_SECONDS );
		if ( $hours <= 1 ) {
			$hours = 1;
		}
		$since = sprintf( _n( '%s hour', '%s hours', $hours ), $hours );
	} elseif ( $diff >= DAY_IN_SECONDS ) {
		$days = round( $diff / DAY_IN_SECONDS );
		if ( $days <= 1 ) {
			$days = 1;
		}
		$since = sprintf( _n( '%s day', '%s days', $days ), $days );
	}
	return $since;
}


/*
 * Exa register Shoutout parameters
 *
 */
function add_query_vars($aVars) {
	$aVars[] = "so_page"; // represents the name of the product category as shown in the URL
	$aVars[] = "so_num"; // represents the name of the product category as shown in the URL
	return $aVars;
}
 
// hook add_query_vars function into query_vars
add_filter('query_vars', 'add_query_vars');

function add_rewrite_rules($aRules) {
	$aNewRules = array('shoutouts/page/([^/]+)/?$' => 'index.php?pagename=shoutouts&so_page=$matches[1]');
	$aRules = $aNewRules + $aRules;

	$aNewRules = array('shoutouts/so/([^/]+)/?$' => 'index.php?pagename=shoutouts&so_num=$matches[1]');
	$aRules = $aNewRules + $aRules;

	return $aRules;
}
 
// hook add_rewrite_rules function into rewrite_rules_array
add_filter('rewrite_rules_array', 'add_rewrite_rules');


/*
 * Add sidebar for refining search results to search pages.
 * By Zach Thomae - 9/7/13
 */
if ( function_exists ('register_sidebar') ) {
	register_sidebar('search');
}



add_filter( 'wp_insert_post_data', 'hrld_default_comments_on' );

// Massively ugly, but beats should be kept out of the templates
function exa_get_beats_slug_list($category) {
	if ($category == 'news') {
		$beats_slug_list = array('madison','higher-edu','wisconsin','student-gov','us','campus','uw-research','uw-system');
	} elseif ($category == 'oped') {
		$beats_slug_list = array('column','editorial','opinion-desk','letter','public-editor','oped-top-story');
	} elseif ($category == 'sports') {
		$beats_slug_list = array('baseball','sports-column','football','mens-basketball','mens-hockey','mens-swimming','softball','volleyball','womens-basketball','womens-hockey','womens-swimming');
	} elseif ($category == 'artsetc') {
		$beats_slug_list = array('art','corner','books','chew-on-this','arts-column','film','food','herald-arcade','hump-day','low-fat-tue','arts-media','music','arts-point-counterpoint','tv');
	} else {
		$beats_slug_list = array();
	}
	return $beats_slug_list;
}

/**
 * Add container to video embeds
 *
 * By Matthew Neil
 */
function hrld_responsive_embed_oembed_html($html, $url, $attr, $post_id) {
 
 if (strpos($url,'youtu')) {
 	return '<div class="video-container">' . $html . '</div>';
 } else {
 	return $html;
 }

}
add_filter('embed_oembed_html', 'hrld_responsive_embed_oembed_html', 10, 4);



/**
 * returns the "topic" (currently just a category) of the post.
 *
 *
 */
function exa_topic($pid = null) {

	if( !$pid ) {
		global $post;
		$pid = $post->ID;
	}

	$beats = wp_get_post_terms($pid,get_post_type($pid)."-beats");
	$category_base = get_bloginfo('url')."/".get_post_type()."/";

	foreach ($beats as $beat) : 
		return $beat->name ; 
	endforeach;

	return "Herald";
}
/*
function exa_the_date() {

	the_time("M j, Y")

}

function exa_get_the_date() {

} */

/**
 * Prints the post thumbnail of the post.
 * If no thumbnail is available, will pick a suitable placer image.
 *
 */
function exa_post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ){
	if($html){
		return $html;
	} elseif(is_home()){
		return '<img src="'.get_template_directory_uri().'/thumb-fill.png'.'" height="'.get_option( 'thumbnail_size_w' ).'" width="'.get_option( 'thumbnail_size_h' ).'" />';
	} else{
		return $html;
	}
	
}
add_filter( 'post_thumbnail_html', 'exa_post_thumbnail_html', 20, 5 );


/**
 * Remove options from the editor screen, because
 * editors have enough options already.
 *
 */

function hrld_customformatTinyMCE($init) {
	// Add block format elements you want to show in dropdown
	$init['theme_advanced_blockformats'] = 'p,h3,h4';

	// Add elements not included in standard tinyMCE doropdown p,h1,h2,h3,h4,h5,h6
	//$init['extended_valid_elements'] = 'code[*]';

	return $init;
}

// Modify Tiny_MCE init
add_filter('tiny_mce_before_init', 'hrld_customformatTinyMCE' );

/**
 * Plugin Name: Remove Attachment Link-To and set to value 'none' 
 */

add_action( 'admin_footer-post-new.php', 'wpse_76214_script' );
add_action( 'admin_footer-post.php', 'wpse_76214_script' );
function wpse_76214_script() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready( function($) {
        $( 'li.attachment' ).live( 'click', function( event ) {
            $( ".link-to > [value='none']").attr( "selected", true ); // selected none in select field
            $( ".link-to-custom" ).val( '' ); // clear input field for target of link
            $( '.media-sidebar div.setting' ).remove(); // remove link field
        });
    } );
    </script>
    <?php
}

// filter a-Tag in data, there was send to edit; fallback
add_filter( 'media_send_to_editor', 'wpse_76214_send_to_editor', 10, 3 );
function wpse_76214_send_to_editor( $html, $id, $attachment ) {

    $html = preg_replace( '@\<a([^>]*)>(.*?)\<\/a>@i', '$2', $html );

    return $html;
}


