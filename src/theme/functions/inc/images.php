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

if ( defined( 'BHRLD_DEBUG' ) && BHRLD_DEBUG ) {
    // Replace src paths
    add_filter('wp_get_attachment_url', function ($url) {
        if(file_exists($url)) {
			return $url;
        }
        return str_replace('://badgerherald.test', '://badgerherald.com/wordpress/', $url);
    });

    // Replace srcset paths
    add_filter('wp_calculate_image_srcset', function($sources) {
        foreach($sources as &$source) {
            if(!file_exists($source['url'])) {
                $source['url'] = str_replace('://badgerherald.test/', '://badgerherald.com/wordpress/', $source['url']);
            }
        }
        return $sources;
    });
}