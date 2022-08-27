<?php 

/**
 * Registers post image sizes.
 * 
 * Larger sizes have been defined in 2022 to better
 * support retina screens and larger post content formats.
 * 
 * Note that newer sizes might not exist < 2022.
 * 
 * Another complexity: older images may have image specific crops
 * (done by a plugin) that might get borked if thumbnails get 
 * totally regenerated.
 *
 * @since 0.1
 */
function _bh_images_register_sizes() {
    /* This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages. */
	add_theme_support( 'post-thumbnails' );

	/* Register custom image size for image post formats. */
	add_image_size( 'post-thumbnail', 690, 450, true );             // pre-2022
	add_image_size( 'cover', 1290, 600, true );                     // pre-2022
	add_image_size( 'square', 160, 160, true );                     // pre-2022

	/* Register retina sizes for all image formats */
	add_image_size( 'post-thumbnail-@0.5x', (690 / 2), (450 / 2), true );
    add_image_size( 'post-thumbnail-@2x', (690 * 2), (450 * 2), true);
	add_image_size( 'post-thumbnail-@3x', (690 * 3), (450 * 3), true);
	add_image_size( 'post-thumbnail-@4x', (690 * 4), (450 * 4), true);

	add_image_size( 'cover-@2x', (1290 * 2), (600 * 2), true );
	add_image_size( 'cover-@3x', (1290 * 3), (600 * 3), true );
	add_image_size( 'cover-@4x', (1290 * 4), (600 * 4), true );

	add_image_size( 'square-@2x', (160 * 2), (160 * 2), true );
	add_image_size( 'square-@3x', (160 * 3), (160 * 3), true );
	add_image_size( 'square-@4x', (160 * 4), (160 * 4), true );

	/* Set standard sizes for non-constrained image crops */
	add_image_size( 'small', 336, 9999, false );
	add_image_size( 'medium', 336 * 2, 9999, false );
	add_image_size( 'medium-large', 336 * 3, 9999, false );
	add_image_size( 'large', 336 * 4, 9999, false );
	add_image_size( 'extra-large', 336 * 5, 9999, false );
	add_image_size( 'jumbo', 336 * 6, 9999, false );
	add_image_size( 'extra-jumbo', 336 * 7, 9999, false );
}
add_action( 'after_setup_theme', '_bh_images_register_sizes' );

// HACK: Remove wordpress directory install:
add_filter( 'the_content', function( $the_content ) {
    return str_replace( '/wordpress/wp-content/uploads', '/wp-content/uploads', $the_content );
});


function bhrld_image_size_names_choose_filter( $sizes ) {
	return array(
		'small' => __( 'Tiny' ),
		'medium' => __( 'Small' ),
        'large' => __( 'Medium' ),
        'full' => __( 'Full' ),
    );
}
add_filter( 'image_size_names_choose', 'bhrld_image_size_names_choose_filter' );