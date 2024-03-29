<?php

/**
 * Exa Functions file
 */

/* Setup */
include(__DIR__ . '/inc/enqueue.php');		/* Base CSS & JS enqueues */

/* Taxonomies */
include(__DIR__ . '/inc/topics.php');
include(__DIR__ . '/inc/layout.php');
include(__DIR__ . '/inc/importance.php');
include(__DIR__ . '/inc/sections.php');

/* Infrastructure */
include(__DIR__ . '/inc/html-tags.php');
include(__DIR__ . '/inc/containers.php');
include(__DIR__ . '/inc/images.php');
include(__DIR__ . '/inc/dates-and-times.php');
include(__DIR__ . '/inc/authors.php');
include(__DIR__ . '/inc/embeds.php');
include(__DIR__ . '/inc/gutenberg.php');

/* Features */
include(__DIR__ . '/inc/inline-links.php');
include(__DIR__ . '/inc/mastheads.php');
include(__DIR__ . '/inc/galleries.php');
include(__DIR__ . '/inc/headlines.php');
include(__DIR__ . '/inc/pullquotes.php');
include(__DIR__ . '/inc/social.php');
include(__DIR__ . '/inc/admin.php');
include(__DIR__ . '/inc/services.php');
include(__DIR__ . '/inc/ads.php');
include(__DIR__ . '/inc/redirects.php');
include(__DIR__ . '/inc/user-management.php');
include(__DIR__ . '/inc/dirty-bird.php');
include(__DIR__ . '/inc/donate.php');
include(__DIR__ . '/inc/search.php');

add_action('customize_preview_init', function () {
	die("The customizer is disabled. Please save and preview your site on the frontend.");
}, 1);

/**
 * Turn comments on by default for posts
 */
function hrld_default_comments_on($data)
{

	if ($data['post_type'] == 'post') {
		$data['comment_status'] = 'open';
	}

	return $data;
}
add_filter('wp_insert_post_data', 'hrld_default_comments_on');


function post_status($new_status, $old_status, $post)
{
	global $custom_post_types, $max_archive_pages;

	if (($new_status === "publish" || $old_status === "publish")) {
		wp_cache_delete("exa_homepage-html", '');
		wp_cache_delete("exa_list-and-banter", '');
		wp_cache_delete("exa_list-and-banter-banter", '');

		wp_cache_delete("exa_old-homepage-featured-sports", '');
		wp_cache_delete("exa_old-homepage-featured-news", '');
		wp_cache_delete("exa_old-homepage-featured-artsetc", '');
		wp_cache_delete("exa_old-homepage-featured-sports", '');

		wp_cache_delete("exa_old-homepage-sidebar-sports", '');
		wp_cache_delete("exa_old-homepage-sidebar-news", '');
		wp_cache_delete("exa_old-homepage-sidebar-artsetc", '');
		wp_cache_delete("exa_old-homepage-sidebar-sports", '');

		wp_cache_delete("exa_feature-widget-query", '');
		wp_cache_delete("exa_homepage-breaking", '');
		wp_cache_delete("exa_ad-two-dominant", '');
	}
}
add_action('transition_post_status',  'post_status', 10, 3);


function bust_cache_on_save_post($post_id)
{
	// If this is a revision, get real post ID
	if ($parent_id = wp_is_post_revision($post_id))
		$post_id = $parent_id;

	if (get_post_status($post_id) !== 'publish') {
		return;
	}

	wp_cache_delete("exa_homepage-html", '');
	wp_cache_delete("exa_list-and-banter", '');
	wp_cache_delete("exa_list-and-banter-banter", '');

	wp_cache_delete("exa_old-homepage-featured-sports", '');
	wp_cache_delete("exa_old-homepage-featured-news", '');
	wp_cache_delete("exa_old-homepage-featured-artsetc", '');
	wp_cache_delete("exa_old-homepage-featured-sports", '');

	wp_cache_delete("exa_old-homepage-sidebar-sports", '');
	wp_cache_delete("exa_old-homepage-sidebar-news", '');
	wp_cache_delete("exa_old-homepage-sidebar-artsetc", '');
	wp_cache_delete("exa_old-homepage-sidebar-sports", '');

	wp_cache_delete("exa_feature-widget-query", '');
	wp_cache_delete("exa_homepage-breaking", '');
	wp_cache_delete("exa_ad-two-dominant", '');
}
add_action('save_post', 'bust_cache_on_save_post');

/**
 * Holds static global information about the theme and page loading.
 *
 * @since v0.3
 */
class Exa
{

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
	public static function addShownId($ids)
	{
		if (is_array($ids)) {
			self::$shownIds = array_merge(self::$shownIds, $ids);
		} else {
			self::$shownIds[] = $ids;
		}
	}

	public static function postHasBeenSeen($postID)
	{
		return in_array($postID, Exa::shownIds());
	}

	/**
	 * Returns an array of WordPress ids already loaded on
	 * the page.
	 * 
	 * @since v0.3
	 * @return array List of ids shown on the page.
	 */
	public static function shownIds()
	{
		return self::$shownIds;
	}
}


/**
 * Sets up the content width value based on the theme's design.
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if (!isset($content_width))
	$content_width = 690;

global $shortcode_tags;
if (!array_key_exists('media-credit', $shortcode_tags))
	add_shortcode('media-credit', 'ignore_media_credit_shortcode');

/**
 * Set up for various features of exa.
 *
 * @since 0.1
 */
function exa_setup()
{

	/* Register different size thumbnail images */
	add_theme_support('post-thumbnails');
	add_theme_support('editor-styles');

	/* Include custom editor styles, so the backend looks like
	 * the front end. */
	add_editor_style('assets/css/fontastic/styles.css');
	add_editor_style('editor-style.css');

	/* Adds RSS feed links to <head> for posts and comments. */
	add_theme_support('automatic-feed-links');

	/* This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages. */
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(860, 470, true);
}
add_action('after_setup_theme', 'exa_setup');
add_action('init', 'exa_setup');

/**
 * Switches default core markup for search form to output valid HTML5.
 *
 * @param string $format Expected markup format, default is `xhtml`
 * @since 0.1
 */
function exa_search_form_format($format)
{
	return 'html5';
}
add_filter('search_form_format', 'exa_search_form_format');


/**
 * Changes the default exerpt tag to include a permalink, and class of class="exerpt-more"
 * 
 * @param $more 
 * @since 0.1
 * @return Anchor tag excerpt link 
 */
function new_excerpt_more($more)
{

	return ' <span class="excerpt-more">...</span>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * This function fixes a bug with the default image src.
 * 
 * @since v0.2
 */
function _fix_wpua_src($image_src_array, $attachment_id, $size = 'thumbnail', $icon = 0)
{

	global $wpua_avatar_default, $wpua_functions;

	// if we have a default avatar.
	if (!empty($wpua_avatar_default) && $wpua_functions->wpua_attachment_is_image($wpua_avatar_default)) {

		if (is_array($size) && is_string($size[0])) {
			$size = $size[0];
			$image = wp_get_attachment_image_src($attachment_id, $size, $icon);
			return $image;
		}
	}
	return $image_src_array;
}
add_filter('wpua_get_attachment_image_src', '_fix_wpua_src', 10, 4);


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
function exa_properize($name)
{

	if (strlen($name) == 0)
		return $name;
	else {
		return $name . '\'' . ($name[strlen($name) - 1] != 's' ? 's' : '');
	}
}

/**
 * Filters the excerpt length to 24 words. 
 * 
 * @since 0.1
 * @param int $length current length passed by filter.
 * @return int 24
 */
function exa_custom_excerpt_length($length)
{
	return 24;
}
add_filter('excerpt_length', 'exa_custom_excerpt_length', 999);



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
function hrld_responsive_embed_oembed_html($html, $url, $attr, $post_id)
{

	// Search for:
	//  - youtube.com
	//  - youtu.be
	if (strpos($url, 'youtu')) {
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
function exa_TinyMCE_customformat($settings)
{

	// Add block format elements you want to show in dropdown
	$settings['block_formats'] = 'Paragraph=p;Top Header (h2)=h2;Subhead (h3)=h3;Explainer (h4)=h4';
	return $settings;
}
add_filter('tiny_mce_before_init', 'exa_TinyMCE_customformat');


/**
 * Remove Attachment Link-To and set to value 'none'
 * 
 * Uses javascript to remove some of the options on the instert media screen.
 * 
 * @author Frank Bueltge
 * @see https://wordpress.stackexchange.com/questions/76214/set-media-upload-attachment-link-to-none-and-hide-it-in-wp-v3-5
 * @since 0.1
 */
function exa_remove_media_link_to()
{
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('li.attachment').live('click', function(event) {
        $(".link-to > [value='none']").attr("selected", true); // selected none in select field
        $(".link-to-custom").val(''); // clear input field for target of link
        $('.media-sidebar div.setting').remove(); // remove link field
    });
});
</script>
<?php
}
add_action('admin_footer-post-new.php', 'exa_remove_media_link_to');
add_action('admin_footer-post.php', 'exa_remove_media_link_to');


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
function exa_send_to_editor($html, $id, $attachment)
{

	$html = preg_replace('@\<a([^>]*)>(.*?)\<\/a>@i', '$2', $html);

	return $html;
}
add_filter('media_send_to_editor', 'exa_send_to_editor', 10, 3);


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
function exa_short_url($post = null)
{

	$post = get_post($post);
	global $bitly;

	if (isset($bitly)) {
		$url = $bitly->get_bitly_link("", $post->ID);
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
function exa_filter_wp_title($title, $sep = "&middot;")
{
	global $page, $paged;

	if (is_feed())
		return $title;

	$site_description = get_bloginfo('description');

	$filtered_title = $title . get_bloginfo('name');
	$filtered_title .= (!empty($site_description) && (is_home() || is_front_page())) ? $sep . $site_description : '';
	$filtered_title .= (2 <= $paged || 2 <= $page) ? $sep . sprintf(__('Page %s'), max($paged, $page)) : '';

	return $filtered_title;
}
add_filter('wp_title', 'exa_filter_wp_title');


/**
 * Adds the favicon link to wp_head.
 * 
 * favicon.ico can be compiled using imagemagick using:
 * 
 * 		$ cd ./assets/img/favicons/
 * 		$ convert -strip *.png favicon.ico
 * 
 * @since v0.2
 */
function exa_favicon()
{
	echo "<link rel='icon' href='" . get_template_directory_uri() . "/assets/img/favicons/favicon.ico' type='image/x-icon' />";
}
add_action('wp_head', 'exa_favicon');


/**
 *
 *
 *
 * @deprecated v0.6 this whole hrld_html_tag thing is silly.
 */
function hrld_html_tag_open($tag = "", $id = "", $class = array(''), $content = "", $close = false, $misc = array())
{
	$result = "";
	if ($tag != "") {
		$result = "<$tag id=\"$id\" ";
		if (!empty($class)) {
			$result .= "class=\"";
			foreach ($class as $class_name) {
				$result .= $class_name . " ";
			}
			$result .= "\" ";
		}
		if (!empty($misc)) {
			foreach ($misc as $attr => $value) {
				$result .= "$attr=\"$value\" ";
			}
		}
		if ($content != "") {
			$result .= " >";
			$result .= $content;
			if ($close)
				$result .= get_hrld_html_tag_close($tag);
		} else
			$result .= " >";
	} else
		$result = "";

	echo $result;
	return;
}

/**
 * Up the number of posts on banter pages
 * 
 * @since v0.5
 */
function banter_post_count($query)
{
	if (!is_admin() && $query->is_main_query()) {

		if ($query->is_category && $query->query_vars["category_name"] == "banter") {
			$query->set('posts_per_page', (2 * 3) * 3);
		}
	}
	return $query;
}
add_action('pre_get_posts', 'banter_post_count');

/**
 * Remove p tag from around images
 * 
 * @see http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
 */
function filter_ptags_on_images($content)
{
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

function exa_add_media_credit_showcase($attachments)
{
	foreach ($attachments as &$attachment) {
		$credit = function_exists("get_hrld_media_credit") ? get_hrld_media_credit($attachment['ID']) : "";
		if ($credit == null) {
			$attachment['media_credit'] = '';
		}
		if ($user = get_user_by('login', $credit)) {
			$attachment['media_credit'] = $user->display_name . '/The Badger Herald';
		} else {
			$attachment['media_credit'] = $credit;
		}
	}
	return $attachments;
}
add_filter('hrld_showcase_image_data', 'exa_add_media_credit_showcase');


global $AnalyticBridge;


/**
 * Filter banter container classes
 */
function hexa_banter_container_classes($classes, $container)
{
	global $post;
	if ($container->name == "headline" && hexa_is_banter()) {
		$classes .= " banter-headline";
	}
	return $classes;
}
add_filter("exa_container_classes", "hexa_banter_container_classes", 10, 2);