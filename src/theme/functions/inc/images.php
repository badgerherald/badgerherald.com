<?php 

/**
 * Set up for various features of exa.
 *
 * @since 0.1
 */
function _exa_images_register_sizes() {
	/* Register custom image size for image post formats. */
	add_image_size( 'cover', 1290, 600, true );
	add_image_size( 'feature', 860, 470, true );
	add_image_size( 'small-thumbnail', 345, 225, true );
	add_image_size( 'large-thumbnail', 690, 450, true );

	add_image_size( 'square', 160, 160, true );

	/* For Mugs */
	add_image_size( 'jumbo', 2200, 9999, false );
}
add_action( 'after_setup_theme', '_exa_images_register_sizes' );
add_action( 'init', '_exa_images_register_sizes' );

add_filter( 'the_content', function( $the_content ) {
    return str_replace( '/wordpress/wp-content/uploads', '/wp-content/uploads', $the_content );
});
