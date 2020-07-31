<?php 
/**
 * Adds subheadline support to Exa
 * 
 * @package Exa
 * @since v0.3
 */


/**
 * Returns true if the post has a subhead
 *
 * @since v0.5
 * 
 * @param $post (optional) if empty, the current global $post will be used.
 */
function exa_has_subhead($post = null) {
	return exa_get_subhead($post = null) ? true : false;
}

/**
 * Prints the post subhead
 *
 * @since v0.5
 * 
 * @param $post (optional) if empty, the current global $post will be used.
 */
function exa_subhead($post = null) {
	echo exa_get_subhead($post);
}

/**
 * Returns the post subhead
 *
 * @since v0.5
 * 
 * @param $post (optional) if empty, the current global $post will be used.
 */
function exa_get_subhead($post = null) {
	$post = get_post($post);
	return apply_filters('exa_subhead', get_post_meta($post->ID, '_exa_subhead', TRUE));
}

if (is_admin()) :

	/**
	 * Prints aftertitlediv content that inclues the "alternate headlines" and
	 * subhead input
	 */
	function exa_extra_headlines($post) {
	
		$post_types = array("post","page");
		if (!in_array($post->post_type, $post_types)) {
			return;
		}
	
		$subhead = get_post_meta($post->ID, '_exa_subhead', true);
		
		$althead_array = get_post_meta($post->ID, '_exa_altheads', true) ?: array();
		$altheads = "";

		foreach($althead_array as $head) {

			$altheads .= $head . "\n";
		}
	
		wp_nonce_field(basename(__FILE__),'_exa_subhead_meta_box');
	
		/* Form field to display */
		?>
	
		<div class="aftertitlediv">
	
			<hr/>
			<div id="altheads" class="altheads">
				<label for="_exa_altheads">Alternate Headlines: </label>
				<a class="edit" href="#">Edit</a>
				<textarea name="_exa_altheads"><?php echo $altheads;?></textarea>
			</div>
			<hr/>
			<label for="_exa_subhead">Subheading: </label>
			<input id="subhead" class="exa-subhead" type="text" autocomplete="off" value="<?php echo 	esc_attr($subhead); ?>" name="_exa_subhead" placeholder="Optional">
		</div>
	
		<?php
		
	}
	add_action('edit_form_after_title', 'exa_extra_headlines');
	
	/** 
	 * Save our custom data when the post is saved
	 */
	function exa_subhead_save_postdata($post_id) {
	
		if(!array_key_exists("_exa_subhead",$_POST)) {
			return;
		}

		if(array_key_exists("_exa_subhead_meta_box",$_POST) && !wp_verify_nonce($_POST['_exa_subhead_meta_box'], basename(__FILE__))) {
			return;
		}
	
		// 2: Save new subhead

		$new_subhead = sanitize_text_field( $_POST['_exa_subhead'] );
	
		if($new_subhead == '') {
			delete_post_meta($post_id, '_exa_subhead');
		} else {
			update_post_meta($post_id, '_exa_subhead', $new_subhead);
		}
	
		// 3: Save new alt heads
	
		$new_altheads = preg_split("/\r\n|\n|\r/", $_POST['_exa_altheads'] ?: '');
		$sanitized_new_altheads = array();

		if($new_altheads == '') {
			delete_post_meta($post_id, '_exa_altheads');
		} else {
			foreach($new_altheads as $head) {
				if($head != '') $sanitized_new_altheads[] = sanitize_text_field($head);
			}
			update_post_meta($post_id, '_exa_altheads', $sanitized_new_altheads);
		}
	
	}
	add_action('save_post', 'exa_subhead_save_postdata');
	

	/**
 	 * Enqueues headline admin script.
 	 * 
 	 * @since v0.5
 	 */
	function exa_headline_admin_script($hook) {
		global $post;

		if ( !('post.php' == $hook) ) { 
			return;
		}
		    
        if ( 'post' === $post->post_type ) {    
			wp_enqueue_style('exa-admin-style', get_template_directory_uri() . '/assets/css/admin/headlines.css');
    		wp_enqueue_script( 'exa-headline-script', get_template_directory_uri() . '/js/admin/headlines.js' );
    	}
	}
	add_action('admin_enqueue_scripts', 'exa_headline_admin_script');

	/**
	 * Removes meta boxes that editors don't need from posts
	 * Should be considered 'beta', until we fully figure out permissions.
	 *
	 * @since v0.1
	 */
	function exa_remove_meta_boxes() {
	
		// Post Types
		$sections = array("news","opinion","sports","artsetc","blog","multimedia","post");
	
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
	
				remove_menu_page('link-manager.php'); 
				remove_menu_page('tools.php'); 
				remove_menu_page('edit-comments.php');
			}
		}
	
	}
	
	add_action( 'admin_menu', 'exa_remove_meta_boxes' );

endif;
