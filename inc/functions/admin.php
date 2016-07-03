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
 * @see /js/ajax.js
 * @since v0.2
 */
function exa_admin_author_select_script() {

	global $post;

    if (is_author()) {
        $author = get_user_by('id', get_query_var('author'));
        wp_enqueue_script('exa_author_ajax', get_template_directory_uri().'/js/author-select.js', array('jquery', 'hrld-showcase-script-class'));
        wp_localize_script('exa_author_ajax', 'hrld_author', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'user_nicename' => $author->user_login
        ));
    }

} 
add_action( 'wp_enqueue_scripts', 'exa_admin_author_select_script' );

