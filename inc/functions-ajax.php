<?php
/**
 * Fun ajax-y stuff.
 */ 


function exa_ajax_setup() {

	global $post;

	// Count the clicks.
	wp_enqueue_script( 'exa_ajax', get_template_directory_uri() . '/js/ajax.js', array( 'jquery' ));

	// When enqueueing the script, provide some js variables.
    wp_localize_script( 'exa_ajax', 'exa', array(
        'ajaxurl'       => admin_url( 'admin-ajax.php' ),
        'id'			=> $post->ID,
        'nonce'    	 	=> wp_create_nonce( 'exa' ))
    );


} add_action( 'wp_enqueue_scripts', 'exa_ajax_setup' );


function exa_ajax() {

	error_log("called!");
	echo "hi";

}
add_action( 'wp_ajax_ajax-exa_ajax', 'exa_ajax' );
add_action( 'wp_ajax_nopriv_ajax-exa_ajax', 'exa_ajax' );


/**
 * Setup to make template parts load via ajax.
 * 
 * Creates an empty div that then gets replaced with the
 * ajax call return
 * 
 * @since v0.2
 */
function exa_ajax_template_part($name) {

	if($name === 'comments'):

		echo "<div class='exa-ajax-comments'></div>";
		add_action( 'wp_ajax_ajax-exa_ajax_comments', '_exa_ajax_comments' );
		add_action( 'wp_ajax_nopriv_ajax-exa_ajax', '_exa_ajax_comments' );

	endif;

}

/**
 * Returns the actual comment template part.
 * 
 * @since v0.2
 */
function _exa_ajax_comments() {

	$nonce = $_GET['nonce']; 	
	if ( ! wp_verify_nonce( $nonce, 'exa' ) )
		die ( 'Unable to load comments. Nonce does not match.' );

	$pid = $_POST['id'];

	get_template_part('comments');
}


