<?php
/**
 * Twenty Thirteen functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/**
 * Sets up the content width value based on the theme's design.
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;

/**
 * Adds support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Twenty Thirteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require( get_template_directory() . '/inc/back-compat.php' );

/* Hide media credit, for now */
function ignore_media_credit_shortcode( $atts, $content = null ) {
    return $content;
}
global $shortcode_tags;
if ( !array_key_exists( 'media-credit', $shortcode_tags ) )
    add_shortcode('media-credit', 'ignore_media_credit_shortcode' );



/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function exa_setup() {

	/*
	 * Things added by will
	 */
//	add_action( 'init', 'register_featured_taxanomy' );
	add_action( 'init', 'register_sections' );


	/*
	 * Register different size thumbnail images
	 *
	 */
	add_theme_support('post-thumbnails');


//	add_image_size( 'full-post', 540, 10000, false );
//	add_image_size( 'side-post', 220, 5000, false );
	

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
	 */
	// TODO: Style for Herald.
	//add_editor_style( 'css/editor-style.css' );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	//add_theme_support( 'post-formats', array(
	//	'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	//) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'twentythirteen' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 540, 270, true );

	// Register custom image size for image post formats.
	add_image_size( 'image-post-size', 860, 470, false );
	add_image_size( 'small-thumbnail', 280, 140, true );
	add_image_size( 'large-thumbnail', 540, 270, true );

	// For the Mug
	add_image_size( 'square', 160, 160, true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

}
add_action( 'after_setup_theme', 'exa_setup' );


/**
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses twentythirteen_fonts_url() to get the Google Font stylesheet URL.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string The filtered CSS paths list.
 */ /*
function twentythirteen_mce_css( $mce_css ) {
	$fonts_url = twentythirteen_fonts_url();

	if ( empty( $fonts_url ) )
		return $mce_css;

	if ( ! empty( $mce_css ) )
		$mce_css .= ',';

	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $fonts_url ) );

	return $mce_css;
}
add_filter( 'mce_css', 'twentythirteen_mce_css' );
*/

/**
 * Enqueues scripts and styles for front end.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_scripts_styles() {
	
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support sites with
	 * threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );

	// Loads JavaScript file with functionality specific to Twenty Thirteen.
	wp_enqueue_script( 'twentythirteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20130423', true );

	// Loads our main stylesheet.
	wp_enqueue_style( 'twentythirteen-style', get_stylesheet_uri() );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentythirteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentythirteen-style' ), '20130213' );
	$wp_styles->add_data( 'twentythirteen-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentythirteen_scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */ /*
function twentythirteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentythirteen_wp_title', 10, 2 );
*/
/**
 * Registers two widget areas.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */ /*
function twentythirteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Secondary Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentythirteen_widgets_init' );
*/ 
if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */ 
function twentythirteen_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text visuallyhidden"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'twentythirteen_post_nav' ) ) :
/**
 * Displays navigation to next/previous post when applicable.
*
* @since Twenty Thirteen 1.0
*
* @return void
*/ 
function twentythirteen_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text visuallyhidden"><?php _e( 'Post navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'twentythirteen' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'twentythirteen' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'twentythirteen' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		twentythirteen_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'twentythirteen_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own twentythirteen_entry_date() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param boolean $echo Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function twentythirteen_entry_date( $echo = true ) {
	$format_prefix = ( has_post_format( 'chat' ) || has_post_format( 'status' ) ) ? _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' ): '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

/**
 * Returns the URL from the post.
 *
 * @uses get_the_post_format_url() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string The Link format URL.
 */
function twentythirteen_get_link_url() {
	$has_url = get_the_post_format_url();

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Sets the image size in featured galleries to large.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param array $atts Combined and filtered attribute list.
 * @return array The filtered attribute list.
 */
function twentythirteen_gallery_atts( $atts ) {
	if ( has_post_format( 'gallery' ) && ! is_single() )
		$atts['size'] = wp_is_mobile() ? 'thumbnail' : 'medium';

	return $atts;
}
add_filter( 'shortcode_atts_gallery', 'twentythirteen_gallery_atts' );

/**
 * Extends the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Custom fonts enabled.
 * 2. Single or multiple authors.
 * 3. Active widgets in the sidebar to change the layout and spacing.
 * 4. When avatars are disabled in discussion settings.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentythirteen_body_class( $classes ) {

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'twentythirteen-fonts', 'enqueued' ) )
		$classes[] = 'custom-font';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	return $classes;
}
add_filter( 'body_class', 'twentythirteen_body_class' );

/**
 * Adjusts content_width value for video post formats and attachment templates.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_content_width() {
	if ( has_post_format( 'video' ) || is_attachment() ) {
		global $content_width;
		$content_width = 724;
	}
}
add_action( 'template_redirect', 'twentythirteen_content_width' );

/**
 * Adjusts content_width value for video shortcodes in video post formats.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param array $atts The attribute list.
 * @return array The filtered attribute list.
 */
function twentythirteen_video_width( $atts ) {
	if ( ! is_admin() && has_post_format( 'video' ) ) {
		$new_width = 724;
		$atts['height'] = round( ( $atts['height'] * $new_width ) / $atts['width'] );
		$atts['width'] = $new_width;
	}

	return $atts;
}
add_action( 'embed_defaults',       'twentythirteen_video_width' );
add_action( 'shortcode_atts_video', 'twentythirteen_video_width' );

/**
 * Switches default core markup for search form to output valid HTML5.
 *
 * @param string $format Expected markup format, default is `xhtml`
 * @return string Twenty Thirteen loves HTML5.
 */
function twentythirteen_search_form_format( $format ) {
	return 'html5';
}
add_filter( 'search_form_format', 'twentythirteen_search_form_format' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function twentythirteen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentythirteen_customize_register' );

/**
 * Binds JavaScript handlers to make Customizer preview reload changes
 * asynchronously.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_customize_preview_js() {
	wp_enqueue_script( 'twentythirteen-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'twentythirteen_customize_preview_js' );



if (is_admin()) :

	function hrld_remove_meta_boxes() {

		// Post Types
		$sections = array("news","oped","sports","artsetc","blog","multimedia");

		foreach ($sections as $section) {

			if( !current_user_can('manage_options') ) {
				remove_meta_box('linktargetdiv', $section, 'normal');
				remove_meta_box('linkxfndiv', $section, 'normal');
				remove_meta_box('linkadvanceddiv', $section, 'normal');
				remove_meta_box('trackbacksdiv', $section, 'normal');
				remove_meta_box('postcustom', $section, 'normal');
				remove_meta_box('commentstatusdiv', $section, 'normal');
				remove_meta_box('commentsdiv', $section, 'normal');
				remove_meta_box('sqpt-meta-tags', $section, 'normal');
			}
		}
	
	}

	add_action( 'admin_menu', 'hrld_remove_meta_boxes' );

endif;



/**
 * Registeres a taxanomy used to select the "importance" of a post.
 *
 * Added: July 2013
 * 
 * @return void
 */
function exa_register_importance_taxanomy() {

	register_taxonomy("importance",$taxanomies,array( 
							'hierarchical' => true,
							'label' => 'Importance',
							'public' => 'true',
							'show_in_nav_menus' => false,
							'show_admin_column' => false,
							'query_var' => true,
							'show_in_menu' => 'false',
							'singular_label' => 'Importance') 
	);

}

/**
 * Registers each section as a custom post type.
 *
 * Added: July 2013
 * 
 * @param Array $sections array of section names 
 * @return void
 */
function register_sections() {

	$sections = array("News","Oped","Sports","ArtsEtc","Blogs","Multimedia");
	$taxanomies = array();

	exa_register_importance_taxanomy();

	foreach ($sections as $section) {

		$slug = strtolower($section);

		register_taxonomy("$slug-beats",$slug,array( 
							'hierarchical' => true,
							'label' => 'Beats',
							'show_ui' => true,
							'show_admin_column' => true,
							'query_var' => true,
							'rewrite' => array(
									"slug" => "$slug/beats",
									"with_front" => false,
									"hierarchical" => true,
									"ep_mask" => EP_NONE,
								),
							'singular_label' => 'Beat') 
		);

		$taxanomies[] = $slug;


		$labels = array(
			'name'                => _x( $section, 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Posts', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( $section, 'text_domain' ),
			'parent_item_colon'   => __( 'Parent Post', 'text_domain' ),
			'all_items'           => __( 'All Posts', 'text_domain' ),
			'view_item'           => __( 'View Post', 'text_domain' ),
			'add_new_item'        => __( 'Add New Post', 'text_domain' ),
			'add_new'             => __( 'New Post', 'text_domain' ),
			'edit_item'           => __( 'Edit Post', 'text_domain' ),
			'update_item'         => __( 'Update Post', 'text_domain' ),
			'search_items'        => __( 'Search posts', 'text_domain' ),
			'not_found'           => __( 'No posts found', 'text_domain' ),
			'not_found_in_trash'  => __( 'No posts in trash', 'text_domain' ),
		);
		$rewrite = true;
		$capabilities = array(
			'edit_post'           => 'edit_posts',
			'read_post'           => 'read_post',
			'delete_post'         => 'delete_post',
			'edit_posts'          => 'edit_posts',
			'edit_others_posts'   => 'edit_others_posts',
			'publish_posts'       => 'publish_posts',
			'read_private_posts'  => 'read_private_posts',
		);
		$args = array(
			'label'               => __( $section, 'text_domain' ),
			'description'         => __( $section, 'text_domain' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'post-formats', ),
			'taxonomies'          => array( 'post_tag', 'importance' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => '',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capabilities'        => $capabilities,
			'query_var'			  => $slug
		);

		register_post_type( $section, $args );

		
	}




}

/**
 * Changes the default exerpt tag to include a permalink, and class of class="exerpt-more"
 *
 * Added: July 2013
 * 
 * @param $more 
 * @return Anchor tag exerpt link 
 */
function new_excerpt_more( $more ) {
	return ' <a class="excerpt-more" href="'. get_permalink( get_the_ID() ) . '">...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


/**
 * Alters the query
 *
 */
function alter_queries( $query ) {

	/* Return if this is not the main query, or if it is a back end query */
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( is_front_page() ) {
 		$query->set( 'post_type', array( 'news', 'oped', 'artsetc', 'sports' )  );
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
    	$query->set( 'post_type', array( 'news', 'oped', 'artsetc', 'sports' )  );
    }

    if ( is_search() ) {
        $refine = $_GET['search_refined'];
        if ($refine) {
            if ($query->is_search) {
                $query->set('s', $refine . ' ' . $query->get('s') );
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

function exa_properize($name) {
	return $name.'\''.($name[strlen($name) - 1] != 's' ? 's' : '');
}


function custom_excerpt_length( $length ) {
	return 24;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function exa_human_time_diff( $from, $to = '' ) {
	if ( empty( $to ) )
		$to = time();
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


/*
 * Correct all badgerherald.com links to the site root.
 * By Will Haynes - 9/8/13
 *
 */
 
function remove_badgerherald_com($content) {
	$content = preg_replace("#http://badgerherald.com/#","http://218.70.82.28/" . "/",$content );
	// $content = preg_replace("\[/media-credit\]","",$content );
	return $content;

} 
 
add_filter( 'the_content', 'remove_badgerherald_com' );

/*
 * Add extra custom fields to user profiles
 *
 */
function exa_user_custom_fields( $user ){
	?>
	<h3>Extra Information</h3>
    <table class="form-table">
    	<tr>
        	<th><label for="twiter">Twitter</label></th>
            <td>@<input type="text" name="twitter" id="user-meta-twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br /><span class="description">Please enter your Twitter username.</span></td>
        </tr>
        <tr>
        	<th><label for="position">Position</label></th>
            <td><input type="text" name="position" id="user-meta-position" value="<?php echo esc_attr( get_the_author_meta( 'position', $user->ID ) ); ?>" class="regular-text" /><br /><span class="description">Please enter your staff Position.</span></td>
        </tr>
    </table>
<?php }

add_action('show_user_profile', 'exa_user_custom_fields');
add_action('edit_user_profile', 'exa_user_custom_fields');

/*
 * Save the extra user custom fields
 *
 */
function save_exa_user_custom_fields( $user_id ){
	if (!current_user_can('edit_user', $user_id))
		return false;
	
	update_user_meta($user_id, 'twitter', $_POST['twitter']);
	update_user_meta($user_id, 'position', $_POST['position']);
}

add_action('personal_options_update', 'save_exa_user_custom_fields');
add_action('edit_user_profile_update', 'save_exa_user_custom_fields');

/**
 * Returns whether the site is a production site or not.
 * as defined (currently) in the WP_CONFIG file.
 *
 * @since Sept 11, 2013
 * @author Will Haynes
 */
function hrld_is_production() {
	return true;
	return HRLD_PRODUCTION;
}

require_once('inc/ads.php');