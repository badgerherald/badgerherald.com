<?php
/**
 * Fun ajax-y stuff.
 * 
 * This is currently just a framework, written by Will Haynes but
 * then never used.
 * 
 * There's some good stuff in here though, I tried to document it as
 * best I could so that someday it might get used.
 * 
 * @since v0.2
 */ 

/**
 * Registers the script that does the ajax calls on pageload.
 * 
 * This script is then localized with variables that the page can pass back to the server. These
 * values are namespaced as `exa`. 
 * 
 * ex:   var exa.ajaxurl = http://<domain>/wp-admin/admin-ajax.php
 * 		 var exa.id = <post-id>
 * 		 &c.
 * 
 * note: This function is never called — the action that calls it is commented out.
 * 
 * @see /js/ajax.js
 * @since v0.2
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


} 
// No need to register scripts that don't get used yet.
// add_action( 'wp_enqueue_scripts', 'exa_ajax_setup' );


function exa_ajax() {

	// Silence is golden...

}
add_action( 'wp_ajax_ajax-exa_ajax', 'exa_ajax' );
add_action( 'wp_ajax_nopriv_ajax-exa_ajax', 'exa_ajax' );


/**
 * This function is supposed to mirror the functionality of get_template_part().
 * 
 * Pass in the name of the template part, and it will be loaded via ajax when the post loads.
 * 
 * @since v0.2
 * 
 * @param String $name name of the template section to load.
 */
function exa_ajax_template_part($name, $type = '') {

	/* comments not actually implemented at the moment 

	if($name === 'comments'):

		echo "<div class='exa-ajax-comments'></div>";
		add_action( 'wp_ajax_ajax-exa_ajax_comments', '_exa_ajax_comments' );
		add_action( 'wp_ajax_nopriv_ajax-exa_ajax', '_exa_ajax_comments' );

	endif;

	*/

	trigger_error('exa_ajax_template_part() not yet implemented.');

}

/**
 * Function that would be called by /js/ajax.php and return the 
 * comment template part.
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


