<?php

/**
 * Generates the html for galleries in posts
 * 
 * @since 0.6
 * @return string filtered html output for the gallery. 
 */
function _exa_gallery_link_html($output, $attr) {
	$post = get_post();

	// Load js for showing the gallery:
	if( !is_admin() ) {
		wp_enqueue_script( 'exa_galleries_script');
		add_action( 'wp_footer', '_exa_galleries_bind_click_event_in_footer' );
	}

	$imageIdAttr = $attr['ids'];

	$_attachments = explode(",", $attr['ids']);
 
    if ( empty( $_attachments ) ) {
        return '';
    }

    $gallery_cover = intval($_attachments[0]);
    $output = "<a href='#gallery' class='exa-gallery-link' data-image-ids='{$imageIdAttr}'>";
    $output .= '<div class="gallery-block">';
    $output .= wp_get_attachment_image($gallery_cover, 'image-post-size', false, array(
        'class'=>'showcase-thumb',
        'data-showcase-index' => '0'
    ));
    $output .= '<span href="#" class="open-gallery">View Gallery ('.count($_attachments).' Photos)</span>';
    $output .= '</div></a>';

	return $output;
}
add_filter('post_gallery', '_exa_gallery_link_html', 10, 2);

/**
 * Returns html for galleries loaded via ajax
 * 
 * @access private
 * @since v0.6
 */
function _exa_galleries_load_gallery_html($data) {
	$ids = $_POST['images'];
	$ids = explode(',',$ids);

	error_log(print_r($ids,true));

	$query_args = array(
		'post__in' => $ids, 
        'post_status' => 'inherit', 
        'post_type' => 'attachment', 
        'post_mime_type' => 'image', 
        'order' => 'menu_order ID', 
        'orderby' => 'post__in',
	);
	query_posts( $query_args );
	
	exa_container("gallery");

	wp_die();
}
add_action( 'wp_ajax_exa-galleries-load', '_exa_galleries_load_gallery_html' );


/**
 * Enqueue the gallery javascript
 */
function _exa_galleries_enqueue() {
	wp_register_script( 'exa_galleries_script', get_template_directory_uri() . '/js/galleries.js', array( 'jquery' ));
	wp_localize_script('exa_galleries_script', 'exa_galleries', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
	));
}
add_action( 'wp_enqueue_scripts', '_exa_galleries_enqueue' );

/**
 * Enqueue the gallery javascript
 */
function _exa_galleries_bind_click_event_in_footer() { ?>
	<script type="text/javascript">
	jQuery( function($) {
		$('.exa-gallery-link').exaGalleryLink();
	});
	</script>
	<?php
}

/**
 * Override the "Gallery Settings" template.
 * 
 * @see: /wp-includes/js/media-views.js
 */    
function _exa_galleries_override_gallery_attachment_template() { ?>

	<script>
	alert('hi');
	/* Replace the default gallery settings */
	jQuery(document).ready( function($) {
		if( typeof wp.media.view.Settings.Gallery != 'undefined' ){
			wp.media.view.Settings.Gallery.prototype.template = wp.template( 'exa-gallery-settings' );
		}
	});
	</script>
	<script type="text/html" id="tmpl-exa-gallery-settings">
	<!-- Default gallery settings suppressed -->


	</script>

	<?php
}
add_action( 'admin_footer-post.php', '_exa_galleries_override_gallery_attachment_template' );
add_action( 'admin_footer-post-new.php', '_exa_galleries_override_gallery_attachment_template' );