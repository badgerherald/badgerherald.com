<?php
/**
 * Exa Functions file
 */

/** Taxonomies */
include_once('inc/functions/topics.php');
include_once('inc/functions/layout.php');
include_once('inc/functions/importance.php');

/** Other stuff */
include_once('inc/functions/dev.php');
include_once('inc/functions/dates-and-times.php');
include_once('inc/functions/oncampus.php');
include_once('inc/functions/html-tags.php');
include_once('inc/functions/analytic-dashboard.php');
include_once('inc/functions/containers.php');
include_once('inc/functions/headlines.php');
include_once('inc/functions/embeds.php');
include_once('inc/functions/authors.php');
include_once('inc/functions/popular-post-widget.php');
include_once('inc/functions/pullquotes.php');
include_once('inc/functions/social.php');
include_once('inc/functions/admin.php');
include_once('inc/functions/services.php');
include_once('inc/functions/sections.php');
include_once('inc/functions/staff.php');
if( class_exists('Popular_Post_Widget') ) {
	include_once('inc/functions/popular-post-widget.php');
}

/** Production site ----------------------------------------------------- */
/*                                                                        */
/* Used for development. Is this site the production site or not?         */
/*                                                                        */
/* ---------------------------------------------------------------------- */

/**
 * Is this a production environment?
 * Default: TRUE.
 */
if ( ! defined( 'EXA_PRODUCTION' ) )
	define( 'EXA_PRODUCTION', TRUE );

/**
 * Is this a herald development enviornment?
 * 
 * 	// todo: we should move this and the related functionality 
 * 			 (functions-dev.php) to the child theme.
 * 
 * Default: TRUE.
 */
if ( ! defined( 'EXA_DEV' ) )
	define( 'EXA_DEV', TRUE );

/**
 * Returns whether the site is a production site or not.
 * as defined (currently) in the WP_CONFIG file.
 *
 * @since v0.2
 */
function hrld_is_production() {
	return HRLD_PRODUCTION;
}

/**
 * Turn comments on by default
 *
 * @see http://wordpress.stackexchange.com/questions/38405/why-are-the-comments-disabled-by-default-on-my-custom-post-types
 */
function hrld_default_comments_on( $data ) {

	$data['comment_status'] = 'open';
	return $data;
	
}
add_filter( 'wp_insert_post_data', 'hrld_default_comments_on' );


/**
 * Holds static global information about the theme and page loading.
 *
 * @since v0.3
 */
class Exa {

	/**
	 * Array of WordPress ids already loaded on the page.
	 * @since v0.3
	 * @var Array
	 */
	private static $shownIds = array();

	private static $actionsAdded = false;

	/**
	 * Add a value to the array of shown WordPress ids already
	 * loaded on the page.
	 * 
	 * @since v0.3
	 * @param $ids int|Array The values shown.
	 */
	public static function addShownId($ids) {
		if( is_array($ids) ) {
			self::$shownIds = array_merge(self::$shownIds,$ids);
		}
		else {
			self::$shownIds[] = $ids;
		}
	}

	/**
	 * Returns an array of WordPress ids already loaded on
	 * the page.
	 * 
	 * @since v0.3
	 * @return array List of ids shown on the page.
	 */
	public static function shownIds() {
		return self::$shownIds;
	}

}


/**
 * Sets up the content width value based on the theme's design.
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 690;

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
	add_editor_style( 'css/fontastic/styles.css' );
	add_editor_style( 'css/editor-style.css' );

	/* Adds RSS feed links to <head> for posts and comments. */
	add_theme_support( 'automatic-feed-links' );

	/* This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages. */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 860, 470, true );

	/* Register custom image size for image post formats. */
	add_image_size( 'cover', 1290, 600, true );
	add_image_size( 'feature', 860, 470, true );
	add_image_size( 'small-thumbnail', 345, 225, true );
	add_image_size( 'large-thumbnail', 690, 450, true );

	add_image_size( 'square', 160, 160, true );

	/* For Mugs */
	add_image_size( 'exa-mug', 480, 320, true );

	/* Nav menus */

	//add_theme_support('menus');

	// header
	register_nav_menu( 'header-primary', __("Header Primary") );
	register_nav_menu( 'header-secondary', __("Header Secondary") );
	register_nav_menu( 'footer-primary', __("Footer Primary") );
	register_nav_menu( 'footer-secondary', __("Footer Secondary") );
	/* This theme uses its own gallery styles. 
	add_filter( 'use_default_gallery_style', '__return_false' ); */

}
add_action( 'after_setup_theme', 'exa_setup' );



function __depricated_image_sizes($image, $attachment_id, $size, $icon) {
	if(!$image && $size=="cover") {
		return wp_get_attachment_image_src('feature');
	}
		return $image;
}
apply_filters('wp_get_attachment_image_src',10,4);

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
		wp_enqueue_style( 'exa-icons', get_template_directory_uri() . '/css/fontastic/styles.css?v=5' );

		/* Load google font. */
		wp_enqueue_style( 'exa-fonts', 'https://fonts.googleapis.com/css?family=Noto+Serif:400,700,400italic,700italic|Yanone+Kaffeesatz:400,300,700|Open+Sans|PT+Sans+Narrow:400,700');

		/* Load main stylesheet. */
		$mtime = filemtime(dirname(__FILE__) . '/style.css');
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
 * Filter options other than p, h3 and h4 from the editor screen, because editors have 
 * enough options already.
 *
 * @param array $settings tiny_mce settings passed in by filter.
 * @return array tiny_mce settings.
 */
function exa_TinyMCE_customformat($settings) {

	// Add block format elements you want to show in dropdown
	$settings['block_formats'] = 'Paragraph=p;Top Header (h2)=h2;Subhead (h3)=h3;Explainer (h4)=h4';
	return $settings;

}
add_filter('tiny_mce_before_init', 'exa_TinyMCE_customformat' );


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
function exa_short_url($post = null) {

	$post = get_post($post);
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
 * Prints open graph tags to the head of wordpress pages.
 *
 * @since 0.1
 * @author Will Haynes
 * 
 * @see http://ogp.me
 */
function exa_open_graph_tags() {

	global $post;

	if( !$post )
		return;

	$output = "\n<!-- Open Graph Tags: http://ogp.me -->\n";

	/* 1. Title (string) */

	$title = single_post_title( null, false );
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
 * @since 0.1
 * 
 * @see http://wordpress.stackexchange.com/questions/26729/get-excerpt-using-get-the-excerpt-outside-a-loop
 */
function exa_get_meta_excerpt($post_id = null) {

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
 * Up the number of posts on banter pages
 * 
 * @since v0.5
 */
function banter_post_count($query) {
	if ( !is_admin() && $query->is_main_query() ) {

		if ($query->is_category && $query->query_vars["category_name"] == "banter" ) {
			$query->set('posts_per_page', (2*3) * 3);
		}
	}
	return $query;
}
add_action('pre_get_posts','banter_post_count');

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
 * @author Jason Chan
 */
function exa_social_url($url = "", $newVersion = true){

	$date_change_category = 1422622800; //Fri 30 Jan, 2015 07:00:00 CT
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
