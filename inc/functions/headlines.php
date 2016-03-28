<?php 
/**
 * 
 * 
 * 
 */

/** 
 * Get the deck
 */
function hrld_get_subhead($post = null) {
	$post = get_post($post);
	return apply_filters('hrld_the_subhead', get_post_meta($post->ID, '_hrld_subhead', TRUE));
}

/**
 * Display deck
 */
function hrld_the_subhead() {
	echo hrld_get_subhead(get_the_ID());
}

/**
 * Returns true if the post has a subhead
 */
function hrld_has_subhead($post = null) {
	return hrld_get_subhead($post);
}

if (is_admin()) :

	/**
	 * Prints aftertitlediv content that inclues the "alternate headlines" and
	 * subhead input
	 */
	function hrld_extra_headlines($post) {
	
		$post_types = array("post","page");
		if (!in_array($post->post_type, $post_types)) {
			return;
		}
	
		$subhead = get_post_meta($post->ID, '_hrld_subhead', true);
		
		$althead_array = get_post_meta($post->ID, '_exa_altheads', true);
		$altheads = "";
		foreach($althead_array as $head) {

			$altheads .= $head . "\n";
		}
	
		wp_nonce_field(basename(__FILE__),'_hrld_subhead_meta_box');
	
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
			<label for="_hrld_subhead">Subheading: </label>
			<input id="subhead" class="exa-subhead" type="text" autocomplete="off" value="<?php echo 	esc_attr($subhead); ?>" name="_hrld_subhead" placeholder="Optional">
		</div>
	
		<?php
		
	}
	add_action('edit_form_after_title', 'hrld_extra_headlines');
	
	/** 
	 * Save our custom data when the post is saved
	 */
	function hrld_subhead_save_postdata($post_id) {
	
		// 1: Verify nonce

		if(!wp_verify_nonce($_POST['_hrld_subhead_meta_box'], basename(__FILE__)))
			return;
	
		// 2: Save new subhead

		$new_subhead = sanitize_text_field( $_POST['_hrld_subhead'] );
	
		if($new_subhead == '') {
			delete_post_meta($post_id, '_hrld_subhead');
		} else {
			update_post_meta($post_id, '_hrld_subhead', $new_subhead);
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
	add_action('save_post', 'hrld_subhead_save_postdata');
	

	/**
 	 * Enqueues headline admin script.
 	 * 
 	 * @since v0.5
 	 */
	function exa_headline_admin_script() {

		if ( 'edit.php' != $hook ) return;
		wp_enqueue_style('exa-admin-style', get_template_directory_uri() . '/css/admin/headlines.css');
    	wp_enqueue_script( 'exa-headline-script', get_template_directory_uri() . '/js/admin/headlines.js' );

	}
	add_action('admin_enqueue_scripts', 'exa_headline_admin_script');

	/**
	 * Removes meta boxes that editors don't need from posts
	 * Should be considered 'beta', until we fully figure out permissions.
	 *
	 * @since v0.1
	 */
	function hrld_remove_meta_boxes() {
	
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
	
	add_action( 'admin_menu', 'hrld_remove_meta_boxes' );

endif;
