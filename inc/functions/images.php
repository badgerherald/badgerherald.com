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

/**
 * Resize images dynamically using wp built in functions
 * 
 * @param int $attach_id
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array

function _exa_image_resize_if_neccessary( $attach_id, $width, $height, $crop = false ) {

	$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
	$file_path = get_attached_file( $attach_id );
	
	$file_info = pathinfo( $file_path );
	$extension = '.' . $file_info['extension'];

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

 */