<?php
/**
 * exa functions file.
 *
 * Contents:
 *
 * 		#region: include other fuction files.
 * 		#region: general wordpress theme setup.
 * 		#region: filters that fix bugs and other things.
 */


/**
 * ================================================================================================
 *   #region: include other fuction files.
 * ================================================================================================
 */

/**
 * Load more functions for develop enviornment.
 * 
 * Contents:
 *   - exa_dev_attachment_url()				(filter: wp_get_attachment_url)
 */
include_once('inc/functions-dev.php');

/**
 * Auto-generated html tags for things like
 * author links, captions, &c.
 * 
 * Contents:
 * 	 - exa_hero_media_credit_tag()
 *   - exa_hero_caption_text()
 *   - exa_hero_caption()
 *   - exa_mug()
 *   - exa_round_mug()
 */
include_once('inc/functions-html-tags.php');

include_once('inc/functions-block.php');

include_once('inc/functions-embeds.php');

/**
 * Social links
 * 
 * Contents:
 *   - Currently nothing of importance is done in here.
 */
include_once('inc/functions-social.php');

/**
 * Register icymi taxonomy.
 * 
 * Contents:
 * 	 - exa_register_icymi_taxonomy()		(action: init)
 */
include_once('inc/functions-icymi.php');

/**
 * Registers Popular_Post_Widget
 * 
 * Contents:
 * 	 - exa_register_icymi_taxonomy()		(action: init)
 */
include_once('inc/functions-popular-post-widget.php');

/**
 * Register importance taxonomy.
 * 
 * Contents:
 *	 - // todo: list contents.
 */
include_once('inc/functions-importance.php');

/**
 * Ad setup and handling in exa.
 * 
 * Contents:
 *   - exa_ad_setup()						(action: dfw_setup)
 *   - exa_register_content_adslot()		(action: dfw_setup)
 *   - exa_insert_after_graph()
 */
include_once('inc/functions-ads.php');

/**
 * Do all the fun ajax-y things.
 * 
 * Contents:
 *   - Currently nothing of importance is done in here.
 */
include_once('inc/functions-ajax.php');

/**
 * Integrate 3rd party services that we use.
 * 
 * Contents:
 *   - 
 */
include_once('inc/functions-services.php');





/**
 * ================================================================================================
 *   #region: general wordpress theme setup.
 * ================================================================================================
 */

/**
 * Sets up the content width value based on the theme's design.
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 690;

/**
 * Exa should run on WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require( get_template_directory() . '/inc/back-compat.php' );

global $shortcode_tags;
if ( !array_key_exists( 'media-credit', $shortcode_tags ) )
    add_shortcode('media-credit', 'ignore_media_credit_shortcode' );

/**
 * Set up for various features of exa.
 *
 * @since 0.1
 */
function exa_setup() {

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
 * @since v0.1
 */
function exa_scripts_styles() {
	
	global $wp_styles;

	if( ! is_singular('interactive') ) {
		
		/**
		 * Load fontastic font.
		 * @see ./css/fontastic/icon-reference.html 
		 */
		wp_enqueue_style( 'exa-icons', get_template_directory_uri() . '/css/fontastic/styles.css' );

		/* Load google font. */
		wp_enqueue_style( 'exa-fonts', 'https://fonts.googleapis.com/css?family=Noto+Serif:400,700,400italic,700italic|Yanone+Kaffeesatz:400,300,700|Open+Sans|PT+Sans+Narrow:400,700');

		$mtime = filemtime(dirname(__FILE__) . '/style.css');
		/* Load main stylesheet. */
		wp_enqueue_style( 'exa-style', get_template_directory_uri() . '/style.css', array(),$mtime );

		/* Load fastclick library */
		wp_enqueue_script( 'fastclick', get_template_directory_uri() . '/js/fastclick/lib/fastclick.js', array(), '0.6.11', true );	
		
		$mtime = filemtime(dirname(__FILE__) . '/js/exa.js');
		/* Load exa.js. (and jQuery, implicitly) */
		wp_enqueue_script('exa-script', get_template_directory_uri() . '/js/exa.js',array('jquery','fastclick'),$mtime,true);

		// Note that jQuery runs in no conflict mode — $ is not a valid function.
		
	} else {

		wp_enqueue_style( '', 'http://badgerherald.com/interactive/' . get_post_meta(get_the_ID(), '_hrld_interactive_include', true) . '/css/style.css' );

	}
	
	if (is_author() || is_single()){
		wp_enqueue_style('hrld-showcase-style');
		wp_enqueue_script( 'hrld-showcase-script-class');
		wp_enqueue_script('exa-hrld-showcase-init', get_template_directory_uri().'/js/hrld-showcase-init.js', array('hrld-showcase-script-class', 'jquery'));
	}
	
}
add_action( 'wp_enqueue_scripts', 'exa_scripts_styles' );

/**
 * Enqueues the scripts from the hrld-showcase plugin on author pages.
 */


/**
 * Enqueues scripts and styles for admin.
 *
 * @since 0.1
 */
function exa_admin_style() {

    wp_enqueue_style('exa-admin-style', get_template_directory_uri() . '/css/admin-style.css');

}
add_action('admin_enqueue_scripts', 'exa_admin_style');


/**
 * Switches default core markup for search form to output valid HTML5.
 *
 * @param string $format Expected markup format, default is `xhtml`
 * @since 0.1
 */
function exa_search_form_format( $format ) {
	return 'html5';
}
add_filter( 'search_form_format', 'exa_search_form_format' );


/**
 * Changes the default exerpt tag to include a permalink, and class of class="exerpt-more"
 * 
 * @param $more 
 * @since 0.1
 * @return Anchor tag excerpt link 
 */
function new_excerpt_more( $more ) {

	return ' <span class="excerpt-more">...</span>';

}
add_filter('excerpt_more', 'new_excerpt_more');


/**
 * ================================================================================================
 *   #region: filters that fix bugs and other things.
 * ================================================================================================
 */

/**
 * This function fixes a bug with the default image src.
 * 
 * @since v0.2
 */
function _fix_wpua_src($image_src_array, $attachment_id, $size='thumbnail', $icon=0) {

	global $wpua_avatar_default, $wpua_functions;

	// if we have a default avatar.
	if(!empty($wpua_avatar_default) && $wpua_functions->wpua_attachment_is_image($wpua_avatar_default)) {

		if( is_array($size) && is_string($size[0]) ) {
			$size = $size[0];
			$image = wp_get_attachment_image_src($attachment_id, $size, $icon);
			return $image;
		}
	}
	return $image_src_array;

}
add_filter('wpua_get_attachment_image_src', '_fix_wpua_src',10,4);



/**
 * Get the list of beats (topic taxonomy) for a post.
 * 
 * @since 0.1
 * @return Array List of beats.
 */
function exa_get_beats() {

	global $post;
	return wp_get_post_terms(get_the_ID(),"topic");

}

/**
 * Takes a string, and returns a string that denotes ownership.
 * 
 * ex: passing " John " returns " John's "
 *     passing " Ross " returns " Ross' " (without the last s)
 *
 * @since 0.1
 * @param String $name the name to 'propertize.'
 * @return string a 'propertized' version of $name
 */
function exa_properize($name) {
	return $name.'\''.($name[strlen($name) - 1] != 's' ? 's' : '');
}

/**
 * Filters the excerpt length to 24 words. 
 * 
 * @since 0.1
 * @param int $length current length passed by filter.
 * @return int 24
 */
function exa_custom_excerpt_length( $length ) {
	return 24;
}
add_filter( 'excerpt_length', 'exa_custom_excerpt_length', 999 );


/**
 * Filters the excerpt length to 24 words. 
 * 
 * TODO: this function could use work.
 * 
 * @uses current_time
 * @since 0.1
 * @param int $from Start time in seconds since Jan 1, 1970.
 * @param int $to (optional) End time in seconds since Jan 1, 1970.
 * @return string A readable representation of the time interval.
 */
function exa_human_time_diff( $from, $to = '' ) {
	$since = '';
	if ( empty( $to ) )
		$to = current_time( "timestamp" );
	$diff = (int) abs( $to - $from );
	if ( $diff <= HOUR_IN_SECONDS ) {
		$mins = round( $diff / MINUTE_IN_SECONDS );
		if ( $mins <= 1 ) {
			$mins = 1;
		}
		/* translators: min=minute */
		$since = sprintf( _n( '%s min ago', '%s mins ago', $mins ), $mins );
	} elseif ( ( $diff <= DAY_IN_SECONDS ) && ( $diff > HOUR_IN_SECONDS ) ) {
		$hours = round( $diff / HOUR_IN_SECONDS );
		if ( $hours <= 1 ) {
			$hours = 1;
		}
		$since = sprintf( _n( '%s hour ago', '%s hours ago', $hours ), $hours );
	} elseif ( $diff >= DAY_IN_SECONDS && $diff < DAY_IN_SECONDS * 7) {
		$days = round( $diff / DAY_IN_SECONDS );
		if ( $days <= 1 ) {
			$days = 1;
		}
		$since = sprintf( _n( '%s day ago', '%s days ago', $days ), $days );
	} elseif ( $diff >= DAY_IN_SECONDS * 7) {
		$since = gmdate("M d, Y D", $from);
	}

	return $since;
}


/**
 * Filters query_vars to register shoutout parameters
 * 
 * @since 0.1
 * @param array $qvars array of query variables passed by filter.
 * @return array array of query variables appended with shoutout query variables.
 */
function exa_add_query_vars($qvars) {

	$qvars[] = "so_page"; // represents the name of the product category as shown in the URL
	$qvars[] = "so_num"; // represents the name of the product category as shown in the URL
	return $qvars;

}
add_filter('query_vars', 'exa_add_query_vars');

/**
 * Adds rewrite rules for shoutouts.
 * 
 * @since 0.1
 * @param array $aRules rewrite rules passed in by filter.
 * @return array rewrite rules with shoutout rules appended.
 */
function exa_add_so_rewrite_rules($aRules) {

	$aNewRules = array('shoutouts/page/([^/]+)/?$' => 'index.php?pagename=shoutouts&so_page=$matches[1]');
	$aRules = $aNewRules + $aRules;

	$aNewRules = array('shoutouts/so/([^/]+)/?$' => 'index.php?pagename=shoutouts&so_num=$matches[1]');
	$aRules = $aNewRules + $aRules;

	return $aRules;

}
add_filter('rewrite_rules_array', 'exa_add_so_rewrite_rules');

/**
 * Returns array of beats for a passed in category.
 * 
 * @since 0.1
 * @param string $category The category to fetch beats for.
 * @return array List of beats.
 */
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
 * @since 0.1
 * @param string $html The embed html
 * @param string $url URL of the oembed
 * @param array $attr Attributes of the embed
 * @param int $post_id The post id of the post the embed appears in.
 * @return $html video embed surrounded in div.video-container dom.
 */
function hrld_responsive_embed_oembed_html($html, $url, $attr, $post_id) {
 
 	// Search for:
	//  - youtube.com
	//  - youtu.be
	if (strpos($url,'youtu')) {
		return '<div class="video-container">' . $html . '</div>';
	} else {
		return $html;
	}

}
add_filter('embed_oembed_html', 'hrld_responsive_embed_oembed_html', 10, 4);


/**
 * Returns the "topic" or top category of the post.
 *
 * @since 0.1
 * @param int $pid Post id.
 * @return string Top post cateogry or "Herald" if no category is set.
 */
function exa_topic($pid = null) {

	if( !$pid ) {
		global $post;
		$pid = $post->ID;
	}

	$beats = wp_get_post_terms($pid,"topic");
	$category_base = get_bloginfo('url')."/".get_post_type()."/";

	foreach ($beats as $beat) : 
		return $beat->name ; 
	endforeach;

	return "Herald";
}

/**
 * Filters and returns the dom for the post thumbnail.
 * 
 * If no thumbnail is available, will pick a suitable placer image.
 *
 * @param string $html The html generated by wordpress
 * @param int $post_id The post id
 * @param int $post_thumbnail_id The post id of the thumbnail post attachment.
 * @param ?? $size ?? Unused.
 * @param ?? $attr ?? Unused.
 * @since 0.1
 */
function exa_post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ){
	if($html){
		return $html;
	} else {
		return '<img src="'.get_template_directory_uri().'/img/temp/thumb.jpg'.'" height="'.get_option( 'thumbnail_size_w' ).'" width="'.get_option( 'thumbnail_size_h' ).'" />';
	}
	
}
add_filter( 'post_thumbnail_html', 'exa_post_thumbnail_html', 20, 5 );


/**
 * Filter options other than p, h3 and h4 from the editor screen, because editors have 
 * enough options already.
 *
 * @param array $settings tiny_mce settings passed in by filter.
 * @return array tiny_mce settings.
 */
function hrld_customformatTinyMCE($settings) {

	// Add block format elements you want to show in dropdown
	$settings['theme_advanced_blockformats'] = 'p,h2,h3,h4';
	return $settings;

}
add_filter('tiny_mce_before_init', 'hrld_customformatTinyMCE' );

/**
 * Remove Attachment Link-To and set to value 'none'
 * 
 * Uses javascript to remove some of the options on the instert media screen.
 * 
 * @author Frank Bueltge
 * @see https://wordpress.stackexchange.com/questions/76214/set-media-upload-attachment-link-to-none-and-hide-it-in-wp-v3-5
 * @since 0.1
 */
function exa_remove_media_link_to() {
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
add_action( 'admin_footer-post-new.php', 'exa_remove_media_link_to' );
add_action( 'admin_footer-post.php', 'exa_remove_media_link_to' );


/**
 * Remove links set to the editor.
 * 
 * @author Frank Bueltge
 * @see https://wordpress.stackexchange.com/questions/76214/set-media-upload-attachment-link-to-none-and-hide-it-in-wp-v3-5
 * @since 0.1
 * 
 * @param string $html The unslashed HTML to send to the editor.
 * @param in $id The attachment id.
 * @param array $attachment An array of attachment attributes.
 * 
 * @return string The filtered HTML sent to the editor.
 */
function exa_send_to_editor( $html, $id, $attachment ) {

    $html = preg_replace( '@\<a([^>]*)>(.*?)\<\/a>@i', '$2', $html );

    return $html;
}
add_filter( 'media_send_to_editor', 'exa_send_to_editor', 10, 3 );


/**
 * Resize images dynamically using wp built in functions
 * 
 *
 * php 5.2+
 *
 * Exemple use:
 * 
 * <?php 
 * $thumb = get_post_thumbnail_id(); 
 * $image = hrld_resize( $thumb,'' , 140, 110, true );
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 * @since 0.1
 * @author Victor Teixeira
 * @see https://gist.github.com/seedprod/1367237
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
 */
function hrld_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {

	// this is an attachment, so we have the ID
	if ( $attach_id ) {
	
		$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
		$file_path = get_attached_file( $attach_id );
	
	// this is not an attachment, let's use the image url
	} else if ( $img_url ) {
		
		$file_path = parse_url( $img_url );
		$file_path = ltrim( $file_path['path'], '/' );
		$file_path = $_SERVER["DOCUMENT_ROOT"] .  "/" . $file_path;

		$orig_size = getimagesize( $file_path );
		
		$image_src[0] = $img_url;
		$image_src[1] = $orig_size[0];
		$image_src[2] = $orig_size[1];
	}
	
	$file_info = pathinfo( $file_path );
	$extension = '.'. $file_info['extension'];

	// the image path without the extension
	$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

	$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

	// checking if the file size is larger than the target size
	// if it is smaller or the same size, stop right here and return
	if ( $image_src[1] > $width || $image_src[2] > $height ) {

		// the file is larger, check if the resized version already exists (for crop = true but will also work for crop = false if the sizes match)
		if ( file_exists( $cropped_img_path ) ) {

			$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
			
			$hrld_image = array (
				'url' => $cropped_img_url,
				'width' => $width,
				'height' => $height
			);
			
			return $hrld_image;
		}

		// crop = false
		if ( $crop == false ) {
		
			// calculate the size proportionaly
			$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
			$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;			

			// checking if the file already exists
			if ( file_exists( $resized_img_path ) ) {
			
				$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

				$hrld_image = array (
					'url' => $resized_img_url,
					'width' => $new_img_size[0],
					'height' => $new_img_size[1]
				);
				
				return $hrld_image;
			}
		}

		// no cached files - let's finally resize it
		$new_img_editor = wp_get_image_editor($file_path);
		if ( ! is_wp_error( $new_img_editor ) ) {
			$new_img_editor->set_quality(100);
		    $new_img_editor->resize( $width, $height, $crop );
		    $new_img_editor->save( $cropped_img_path );
			$new_img_size = getimagesize( $cropped_img_path);
			$new_img = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );

			// resized output
			$hrld_image = array (
				'url' => $new_img,
				'width' => $new_img_size[0],
				'height' => $new_img_size[1]
			);
			
			return $hrld_image;
		}
	}

	// default output - without resizing
	$hrld_image = array (
		'url' => $image_src[0],
		'width' => $image_src[1],
		'height' => $image_src[2]
	);
	
	return $hrld_image;
}


/**
 * Prints the author link
 * 
 * @since 0.1
 */
function exa_the_author_link() {
	echo get_bloginfo('url')."/author/".get_the_author_meta("user_nicename");
}

/**
 * Retrieve the short url for the post
 *
 * Checks if the bit.ly service is enabled and returns the short url from bit.ly 
 * If bit.ly is not enabled, this function returns wordpresses default shorter
 * url.
 *
 * @since 0.1
 * 
 * @return string The shortlink for the post.
 */
function exa_short_url() {

	global $post;
	global $bitly;

	if( isset($bitly) ) { 
		$url = $bitly->get_bitly_link("",$post->ID);
	} else {
		$url = wp_get_shortlink();
	}
	return $url;

}

/**
 * Filter on wp_title() to generate the page title.
 *
 * We filter the wp_title to generate better SEO.
 *
 * @uses get_bloginfo()
 * @uses is_home()
 * @uses is_front_page()
 *
 * @see http://bavotasan.com/2012/filtering-wp_title-for-better-seo/
 * 
 * @param string $title The title passed in by the filter
 * @param string $sep (optional) A seperator to use. default: middot
 *
 * @return string filtered title.
 */
function exa_filter_wp_title( $title, $sep = "&middot;" ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	$site_description = get_bloginfo( 'description' );

	$filtered_title = $title . get_bloginfo( 'name' );
	$filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? $sep . $site_description: '';
	$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? $sep . sprintf( __( 'Page %s' ), max( $paged, $page ) ) : '';

	return $filtered_title;
}
add_filter( 'wp_title', 'exa_filter_wp_title' );



/**
 * Returns a string with the section.
 * 
 * @since v0.2
 * @return string section.
 */
function exa_section() {
	global $post;

	$section = get_the_category();
	if( $section ) {
		$section = $section[0]->name;
		$section = $section == 'oped' ? $section = 'opinion' : $section;
	}
	return $section;
}

/**
 * Prints open graph tags to the head of wordpress pages.
 *
 * @since 0.1
 * @author Will Haynes
 * 
 * @see http://ogp.me
 */
function exa_open_graph_tags() {

	global $post;

	$output .= "\n<!-- Open Graph Tags: http://ogp.me -->\n";

	/* 1. Title (string) */

	$title = single_post_title( $prefix, false );
	$output .= "<meta property='og:title' content='$title' />\n";

	/* 2. Description (string) */

	$excerpt = exa_get_meta_excerpt();
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

	// todo: We should add some fancy images for other common pages like:
	//  · http://badgerherald.com/
	//  · http://badgerherald.com/news/
	//  · http://badgerherald.com/about/
	//  · http://badgerherald.com/shoutouts/

	$img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	if( $img ) {
		$output .= "<meta property='og:image' content='$img' />\n";
	} else {
		$img = get_template_directory_uri() . "/img/misc/social-thumb.png";
		$output .= "<meta property='og:image' content='$img' />\n";
	}

	/* 7. Finish up */

	$output .= "\n";
	echo $output;

}
add_action('wp_head','exa_open_graph_tags');


/**
 * Adds the favicon link to wp_head.
 * 
 * favicon.ico can be compiled using imagemagick using:
 * 
 * 		$ cd ./img/favicons/
 * 		$ convert -strip *.png favicon.ico
 * 
 * @since v0.2
 */
function exa_favicon() {
	echo "<link rel='icon' href='" . get_template_directory_uri() . "/img/favicons/favicon.ico' type='image/x-icon' />";
}
add_action('wp_head','exa_favicon');


/**
 * Prints twitter card text to the head of wordpress pages.
 *
 * @since 0.1
 * @author Will Haynes
 * 
 * @see https://dev.twitter.com/cards/
 */
function exa_twitter_card_tags() {


	global $post;

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

	$title = single_post_title( $prefix, false );
	$output .= "<meta name='twitter:title' content='$title' />\n";

	/* 3. Excerpt */

	$excerpt = exa_get_meta_excerpt();
	$output .= '<meta name="twitter:description" content="'.$excerpt.'" />'."\n";
	
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
add_action('wp_head','exa_twitter_card_tags');




/**
 * The excerpt to serve to facebook, twitter, google, &c.
 *
 * TODO: Add _hrld_subhead support. These are often more appropriate for the space than
 * 		 the lede.
 *
 * @since 0.1
 * 
 * @see http://wordpress.stackexchange.com/questions/26729/get-excerpt-using-get-the-excerpt-outside-a-loop
 * @author Will Haynes
 */
function exa_get_meta_excerpt($post_id = null) {

	global $post;

	if( !$post_id ) {
		$post_id = $post->ID;
	}

    $the_post = get_post($post_id); // Gets post ID

    // check if the hrld-setup plugin is active, and use subhead here instead.
    if( function_exists('hrld_has_subhead') && hrld_has_subhead($post_id) ) {
    	$the_excerpt = hrld_get_subhead($post_id);
    	// Make sure it ends in a period, or it looks weird on facebook.
    	$the_excerpt = rtrim($the_excerpt, '.') . '.';
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

    return addslashes($the_excerpt); 
}

/**
 * Filters the single_template source for posts with the interactive category.
 * 
 * @since 0.1
 * @author Matt Neil
 * 
 * @return string the template for the post.
 */
function exa_interactive_single_template($single_template) {
	global $post;
	if (in_category('interactive', $post->ID)) {
		return $_SERVER["DOCUMENT_ROOT"] . '/interactive/'.$post->post_name.'/index.php';
	}
	return $single_template;
}
add_filter('single_template', 'exa_interactive_single_template');

	
function hrld_html_tag_open($tag = "",$id = "",$class = array(''),$content = "",$close = false, $misc = array()){
	$result = "";
	if( $tag != ""){
		$result = "<$tag id=\"$id\" ";
		if( !empty($class) ){
			$result .= "class=\"";
			foreach($class as $class_name){
				$result .= $class_name." ";
			}
			$result .= "\" ";
			
		}
		if( !empty($misc) ){
			foreach($misc as $attr => $value){
				$result .= "$attr=\"$value\" ";
			}
		}
		if( $content != ""){
			$result .= " >";
			$result .= $content;
			if( $close)
				$result .= get_hrld_html_tag_close($tag);
		}else
			$result .= " >";
	}else
		$result = "";

	echo $result;
	return;

}
function hrld_html_tag_close($tag = ""){
	$result = "";
	if( $tag != ""){
		$result = "</".$tag.">";
	}

	echo $result;
	return;
}
function get_hrld_html_tag_close($tag = ""){
	$result = "";
	if( $tag != ""){
		$result = "</".$tag.">";
	}
	return $result;
}

/**
 * Filters pinned posts from the main author query so pagination works correctly
 * 
 * @param  [type] $query [description]
 * @return [type]        [description]
 */
function hrld_remove_pinned_author_posts($query){
	if (is_admin() || !$query->is_main_query()) {
		return;
	}

	if (is_author() && $query->is_main_query()) {
		$user = get_user_by('slug', $query->query_vars['author_name']);
		$pinned_posts = get_the_author_meta('_hrld_staff_best_posts', $user->ID);
		if (empty($pinned_posts)) {
			return;
		}
		$query->set('post__not_in', $pinned_posts);
		return;
	}
}
add_filter('pre_get_posts', 'hrld_remove_pinned_author_posts', 1);


/**
 * Unhide the kitchen sink for all users all the time.
 * 
 * @param array $args args passed in by WordPress 
 * @since v0.2
 */
function exa_unhide_kitchensink( $args ) {
	$args['wordpress_adv_hidden'] = false;
	return $args;
}
add_filter( 'tiny_mce_before_init', 'exa_unhide_kitchensink' );

/**
 * Remove p tag from around images
 * 
 * @see http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
 */
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

function exa_add_media_credit_showcase($attachments) {
	foreach ($attachments as & $attachment) {
		$credit = get_hrld_media_credit($attachment['ID']);
		if ($credit == null)
		{
			$attachment['media_credit'] = '';
		}
		if ($user = get_user_by('login', $credit)) {
			$attachment['media_credit'] = $user->display_name.'/The Badger Herald';
		} else {
			$attachment['media_credit'] = $credit;
		}
	}
	return $attachments;
}
add_filter('hrld_showcase_image_data', 'exa_add_media_credit_showcase');


/**
 * Returns a url for 
 *
 * @since v0.2
 * @param
 * @author Jason Chan
 */
function exa_social_url($url = "", $newVersion = true){
	$date_change_category = 1422622800; //Fri 30 Jan, 2015 07:00:00 CT
	if($url == "")
		$url = get_permalink($post -> ID);
	if( $url != false && $url != ''){
		$date = get_the_date('U', $post);
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
 * Filters post gallery generated 
 * 
 * @since 0.2
 * 
 * @param string $output
 * @param array $attr attributes defined in the shortcode
 * 
 * @return string filtered html output for the gallery. 
 */
function exa_post_gallery($output = '', $attr) {

	return "<div></div>";
	$post = get_post();
	wp_enqueue_script('swipe', get_template_directory_uri().'/js/Swipe/swipe.js', array('jquery'), false, true);
	wp_enqueue_script('exa_post_gallery_js', get_template_directory_uri().'/js/exa-post-gallery.js', array('jquery'), false, true);
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( ! $attr['orderby'] ) {
            unset( $attr['orderby'] );
        }
    }
    $html5 = current_theme_supports( 'html5', 'gallery' );
    $atts = shortcode_atts( array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post ? $post->ID : 0,
        'itemtag'    => $html5 ? 'figure'     : 'dl',
        'icontag'    => $html5 ? 'div'        : 'dt',
        'captiontag' => $html5 ? 'figcaption' : 'dd',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => '',
        'link'       => ''
    ), $attr, 'gallery' );
 
    $id = intval( $atts['id'] );
    if ( 'RAND' == $atts['order'] ) {
        $atts['orderby'] = 'none';
    }
 
    if ( ! empty( $atts['include'] ) ) {
        $_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
 
        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( ! empty( $atts['exclude'] ) ) {
        $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
    } else {
        $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
    }
 
    if ( empty( $attachments ) ) {
        return '';
    }
 
    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment ) {
            $output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
        }
        return $output;
    }
 
    $itemtag = tag_escape( $atts['itemtag'] );
    $captiontag = tag_escape( $atts['captiontag'] );
    $icontag = tag_escape( $atts['icontag'] );
    $valid_tags = wp_kses_allowed_html( 'post' );
    if ( ! isset( $valid_tags[ $itemtag ] ) ) {
        $itemtag = 'dl';
    }
    if ( ! isset( $valid_tags[ $captiontag ] ) ) {
        $captiontag = 'dd';
    }
    if ( ! isset( $valid_tags[ $icontag ] ) ) {
        $icontag = 'dt';
    }
 
    $columns = intval( $atts['columns'] );
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';
 
    $selector = "gallery-{$instance}";
 
    $gallery_style = '';
 
    /**
     * Filter whether to print default gallery styles.
     *
     * @since 3.1.0
     *
     * @param bool $print Whether to print default gallery styles.
     *                    Defaults to false if the theme supports HTML5 galleries.
     *                    Otherwise, defaults to true.
     */
    if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
        $gallery_style = "
        <style type='text/css'>
            #{$selector} {
                margin: auto;
            }
            #{$selector} .gallery-item {
                float: {$float};
                margin-top: 10px;
                text-align: center;
                width: {$itemwidth}%;
            }
            #{$selector} img {
                border: 2px solid #cfcfcf;
            }
            #{$selector} .gallery-caption {
                margin-left: 0;
            }
            /* see gallery_shortcode() in wp-includes/media.php */
        </style>\n\t\t";
    }
 
    $size_class = sanitize_html_class( $atts['size'] );
    // $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    $gallery_div = "<div id='slider'><div id='swipe' class='swipe'><div class='swipe-wrap'>";
 
    /**
     * Filter the default gallery shortcode CSS styles.
     *
     * @since 2.5.0
     *
     * @param string $gallery_style Default gallery shortcode CSS styles.
     * @param string $gallery_div   Opening HTML div container for the gallery shortcode output.
     */
    $output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );
 
    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
            $image_output = wp_get_attachment_link( $id, $atts['size'], false, false );
        } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
            $image_output = wp_get_attachment_image( $id, $atts['size'], false );
        } else {
            $image_output = wp_get_attachment_link( $id, $atts['size'], true, false );
        }
        $image_output = wp_get_attachment_image( $id, 'image-post-size', false );
        $image_meta  = wp_get_attachment_metadata( $id );
 
        $orientation = '';
        if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
            $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
        }
        $output .= "<div class='slide'>";
        $output .= "<div class='slide-image'>";
        $output .= $image_output;
        //$output .= "
        //    <{$icontag} class='gallery-icon {$orientation}'>
        //        $image_output
        //    </{$icontag}>";
		$output .= "</div>";
        
        $output .= "<div class='slider-content'>";
        if (trim($attachment->post_excerpt) ) {
            $output .= "
                <p>
                " . wptexturize($attachment->post_excerpt) . "
                </p>";
        }
        $credit = get_hrld_media_credit($id);
		if ($credit != "") {
				if(get_user_by('login', $credit)){
				$hrld_user = get_user_by('login', $credit);
				$output .= "<span class='hrld-media-credit'><span class='hrld-media-credit-name'><a href='".get_bloginfo('url')."/author/$credit'>$hrld_user->display_name</a></span><span class='hrld-media-credit-org'>/The Badger Herald</span></span>"; 
			} else{
				$hrld_credit_name_org = explode("/", $credit);
				if($hrld_credit_name_org[1]){
					$output .= "<span class='hrld-media-credit'><span class='hrld-media-credit-name'>$hrld_credit_name_org[0]</span><span class='hrld-media-credit-org'>/$hrld_credit_name_org[1]</span></span>";
				}
				else{
					$output .= "<span class='hrld-media-credit'><span class='hrld-media-credit-org'>$hrld_credit_name_org[0]</span></span>";
				}
			}
		}
        $output .= "</div>"; //class="slider-content"
        $output .= "</div>"; //class="slide"
    }
 
    $output .= "</div>"; //class="swipe-wrap"
    $output .= '<div class="swipe-slide-nav-page prev"></div><div class="swipe-slide-nav-page next"></div>';
    $output .= "</div>"; //class="swipe"
    $output .= '<div class="slider-nav-container">';
    $output .= "<ul class='slider-nav clearfix'>";
    foreach ($attachments as $id => $attachment) {
        $image_output = wp_get_attachment_image( $id, 'post-thumbnail', false );
        $output .= "<li>".$image_output."</li>";
    }
    $output .= "</ul>";
    $output .= '<div class="slider-nav-page prev"></div><div class="slider-nav-page next"></div>';
    $output .= '</div>';
    $output .= "</div>"; //id="slider"
 
    return $output;
}
//add_filter('post_gallery', 'exa_post_gallery', 10, 2);
