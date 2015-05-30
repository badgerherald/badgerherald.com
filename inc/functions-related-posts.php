<?php
/*

This is an old plugin that we used to manage related posts.
It's no longer really used, but some theme stuff relies on the functions.

It should be considered depricated and either refactored and improved or removed.

- Will



Plugin Name: 	Herald Related Posts
Description: 	Allows users to input up to three related posts on the edit screen, and offers an api to fetch those posts back.
Author: 		Will Haynes for The Badger Herald
Author URI: 	http://badgerherald.com
License: 		Copyright (c) 2013 The Badger Herald
Code modified from:
http://wp.smashingmagazine.com/2011/10/04/create-custom-post-meta-boxes-wordpress/

*/
?><?php
/* ========================================================================
 * BACKEND 
 * ===================================================================== */
/* adding the meta box */
function hrld_related() {
	add_meta_box("hrld_related","Related Posts", "hrld_related_html", "post", "side");
}
add_action( 'add_meta_boxes', 'hrld_related' );
function hrld_related_scripts($hook) {
	if( 'post.php' == $hook ) {
   		wp_enqueue_script( 'hrld_related_scripts', plugin_dir_url( __FILE__ ) . '/js/script.js' );
   		wp_register_style( 'hrld_related_style', plugin_dir_url( __FILE__ ) . '/css/admin.css' );
		wp_enqueue_style( 'hrld_related_style' );
	}
}
add_action( 'admin_enqueue_scripts', 'hrld_related_scripts' );
function hrld_related_html() {
	global $post;
	echo "<div id='hrld-related-box'>";
	/* nonce field for varification. */
	wp_nonce_field( basename( __FILE__ ), 'hrld_related_posts_nonce' );
	
	
	//echo "<div class='tagchecklist'>";
	
	/* Topic */
	$meta_value = get_post_meta( $post->ID, "_hrld_related_topic", true );
	echo "<div class='hrld-related-box-section'>";
	if ($meta_value == '') {
		echo "<p><input class='hrld_related_topic_input' type='text' name='hrld_related_topic' placeholder='topic' /></p>";
	} else {
		echo "<p><input class='hrld_related_topic_input' type='hidden' name='hrld_related_topic' value='$meta_value' />";
		echo "<span>Topic: <strong>" . $meta_value . "</span></strong> <a href='#' class='hrld-related-edit'>Edit</a></p>";
	}
	echo "</div>";
	$num = 1;
	echo "<div class='hrld-related-box-section'>";
	$meta_value = unserialize(get_post_meta( $post->ID, "_hrld_related", true ));
	if($meta_value) :
		foreach ($meta_value as $related) {
			$p = get_post($related);
			echo "<p><input class='hrld_related_input' type='hidden' name='hrld_related_$num' value='$related' />";
			echo "<span>" . $p->post_title . " </span><a href='#' class='hrld-related-edit'>Edit</a></p>";
			$num+=1;
		}
	endif;
	for($num;$num<=3;$num+=1) {
		echo "<p><input  class='hrld_related_input' type='text' name='hrld_related_$num' placeholder='Related $num' /></p>";
	}
	echo "</div>";
	echo "</div>"; // hrld-related-box
	/* Input Boxes */
}
/* save fields on post save. */
function hrld_related_save_post( $post_id, $post ) {
	/* Don't update on autosave, was someone's advice in a thread */
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return $post_id;
	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['hrld_related_posts_nonce'] ) || !wp_verify_nonce( $_POST['hrld_related_posts_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );
	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;
	/* Get the posted data and sanitize it for use as an HTML class. */
	$related_1 = ( isset( $_POST['hrld_related_1'] ) ? $_POST['hrld_related_1'] : '' );
	$related_2 = ( isset( $_POST['hrld_related_2'] ) ? $_POST['hrld_related_2'] : '' );
	$related_3 = ( isset( $_POST['hrld_related_3'] ) ? $_POST['hrld_related_3'] : '' );
	/* Get rid of any of the values that were not all digits */
	$related_1 = ctype_digit($related_1) ? $related_1 : '';
	$related_2 = ctype_digit($related_2) ? $related_2 : '';
	$related_3 = ctype_digit($related_3) ? $related_3 : '';
	/* Create a new array of related values */
	$new_meta_value = array();
	// TODO: Check that related are valid post_ids.
	if($related_1 != '') {
		$post_1 = get_post($related_1);
		$related_1 = $post_1->post_type != 'attachment' ? $related_1 : '';
		if($related_1 != '') {
			$new_meta_value[] = $related_1;
		}
	}
	if($related_2 != '') {
		$post_2 = get_post($related_2);
		$related_2 = $post_2->post_type != 'attachment' ? $related_2 : '';
		if($related_2 != '') {
			$new_meta_value[] = $related_2;
		}
	}
	if($related_3 != '') {
		$post_3 = get_post($related_3);
		$related_3 = $post_3->post_type != 'attachment' ? $related_3 : '';
		if($related_3 != '') {
			$new_meta_value[] = $related_3;
		}
	}
	/* Serialize the array */
	$new_meta_value = count($new_meta_value) != 0 ? serialize($new_meta_value) : '';
	/* Get the meta key. */
	$meta_key = '_hrld_related';
	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );
	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
	/** ============
	Insert the topic 
	============= */
	$new_meta_value = ( isset( $_POST['hrld_related_topic'] ) ? $_POST['hrld_related_topic'] : '' );
		/* Get the meta key. */
	$meta_key = '_hrld_related_topic';
	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );
	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
}
add_action( 'save_post', 'hrld_related_save_post', 10, 2 );
/* ========================================================================
 * FRONT END API 
 * ===================================================================== */
function hrld_related_topic($post = null) {
	
	echo get_hrld_related_topic($post);
}
function get_hrld_related_topic($post = null) {
	if($post == null) {
		global $post;
	}
	$meta = get_post_meta( $post->ID, "_hrld_related_topic", true );
	return $meta == '' ? "Related" : $meta;
}
function hrld_related_post_ids($post = null) {
	if($post == null) {
		global $post;
	}
	return unserialize(get_post_meta( $post->ID, "_hrld_related", true ));
}
function hrld_related_has_posts($post = null) {
	if($post == null) {
		global $post;
	}
	return get_post_meta($post->ID, "_hrld_related",true) == '' ? false : true;
}
function hrld_related_post_count($post = null) {
	echo get_hrld_related_post_count($post);
}
function get_hrld_related_post_count($post = null) {
		if($post == null) {
		global $post;
	}
	return sizeof(unserialize(get_post_meta( $post->ID, "_hrld_related", true )));
}