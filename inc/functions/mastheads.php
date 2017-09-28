<?php

// Constants
define( 'EXA_MASTHEAD_POST_TYPE', 'exa_masthead' );

/**
 * Registers the masthead post type
 */
function exa_masthead_post_type() {

	$labels = array(
		'name'                  => _x( 'Mastheads', 'Post Type General Name', 'exa' ),
		'singular_name'         => _x( 'Masthead', 'Post Type Singular Name', 'exa' ),
		'menu_name'             => __( 'Mastheads', 'exa' ),
		'name_admin_bar'        => __( 'Masthead', 'exa' ),
		'archives'              => __( 'Masthead Archive', 'exa' ),
		'attributes'            => __( 'Masthead Attributes', 'exa' ),
		'parent_item_colon'     => __( 'Parent Item:', 'exa' ),
		'all_items'             => __( 'All Mastheads', 'exa' ),
		'add_new_item'          => __( 'Add New Masthead', 'exa' ),
		'add_new'               => __( 'Add New', 'exa' ),
		'new_item'              => __( 'New Masthead', 'exa' ),
		'edit_item'             => __( 'Edit Masthead', 'exa' ),
		'update_item'           => __( 'Update Masthead', 'exa' ),
		'view_item'             => __( 'View Masthead', 'exa' ),
		'view_items'            => __( 'View Mastheads', 'exa' ),
		'search_items'          => __( 'Search Masthead', 'exa' ),
		'not_found'             => __( 'Not found', 'exa' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'exa' ),
		'featured_image'        => __( 'Featured Image', 'exa' ),
		'set_featured_image'    => __( 'Set featured image', 'exa' ),
		'remove_featured_image' => __( 'Remove featured image', 'exa' ),
		'use_featured_image'    => __( 'Use as featured image', 'exa' ),
		'insert_into_item'      => __( 'Insert into masthead', 'exa' ),
		'uploaded_to_this_item' => __( 'Uploaded to this masthead', 'exa' ),
		'items_list'            => __( 'Masthead list', 'exa' ),
		'items_list_navigation' => __( 'Masthead list navigation', 'exa' ),
		'filter_items_list'     => __( 'Filter Masthead list', 'exa' ),
	);
	$rewrite = array(
		'slug'                  => 'masthead',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Masthead', 'exa' ),
		'description'           => __( 'A masthead of staff members', 'exa' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( EXA_MASTHEAD_POST_TYPE, $args );

}
add_action( 'init', 'exa_masthead_post_type', 0 );


function _exa_masthead_enqueue_admin_scripts( $hook ) {
    global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( EXA_MASTHEAD_POST_TYPE === $post->post_type ) {     
            wp_enqueue_script( 'exa_masthead_js', get_template_directory_uri().'/js/admin/masthead.js' );
            wp_enqueue_style( 'exa_masthead_css', get_template_directory_uri().'/css/admin/masthead.css' );
        }
    }
}
add_action( 'admin_enqueue_scripts', '_exa_masthead_enqueue_admin_scripts', 10, 1 );


function _exa_masthead_print_form($post) {
	if($post->post_type != EXA_MASTHEAD_POST_TYPE) {
		return;
	}
	wp_nonce_field( basename(__FILE__), '_exa_masthead' );
	
	$masthead = exa_masthead_postmeta($post);

	?>

	<ol class="exa_masthead_form_list">
	
	<?php 

	$lastIndex = -1;
	foreach( $masthead as $section_index => $section ) {
		_exa_masthead_print_section( $section_index, $section["title"], $section["staff"]);
		$lastIndex = $section_index;
	}

	_exa_masthead_print_section( $lastIndex + 1 );

	?>

	</ol>

	<?php
	
}
add_action('edit_form_after_title', '_exa_masthead_print_form');


function _exa_masthead_print_section( $section_index, $current_title = null, $staff = array() ) {
	echo "<li class='exa_masthead_section' data-section-index='$section_index'>";

	_exa_masthead_section_title_field( $section_index, $current_title );
	echo "<br/>";

	echo "<ol class='exa_masthead_staff_list'>";
	
	$lastStaffIndex = 0;
	foreach($staff as $staff_index => $staffer) {
		$userId = array_key_exists('uid',$staffer) ? $staffer["uid"] : null;
		$position = array_key_exists('position',$staffer) ? $staffer["position"] : null;

		_exa_masthead_assignment_row( $section_index, $staff_index, $userId, $staffer["position"] );
		$lastStaffIndex = $staff_index;
	}

	_exa_masthead_assignment_row( $section_index, $lastStaffIndex + 1, "", "" );

	echo "</ol>";

	echo "<div class='exa_masthead_section_details'>";
	
	_exa_masthead_section_toggles();
	echo "</div>";

	echo "<div class='clearfix'></div>";
	echo "</li>";
}

function _exa_masthead_section_title_field( $section_index, $current_title = null) {
	echo "<input class='exa_masthead_section_title_field' name='exa_masthead_assignments[$section_index][title]'' value='$current_title' type='text' placeholder='Title' />";
}

function _exa_masthead_assignment_row( $section_index, $staff_index, $current_user_id = null, $current_position = null, $id = null ) {
	echo "<li class='masthead-assignment-row' data-staff-index='$staff_index'>";
	_exa_masthead_user_id_field( $section_index, $staff_index, $current_user_id, $id );
	_exa_masthead_user_position_field( $section_index, $staff_index, $current_position );
	_exa_masthead_assignment_toggles();
	echo "</li>";
}


function _exa_masthead_section_toggles() {
	echo "<ul class='exa-masthead-section-toggles'>";
	echo "<li><a class='exa_masthead_section_toggle' data-masthead-assignment-action='remove'>&times; Delete Section</a></li>";
	echo "<li><a class='exa_masthead_section_toggle' data-masthead-assignment-action='up'>&uarr; Move Up</a></li>";
	echo "<li><a class='exa_masthead_section_toggle' data-masthead-assignment-action='down'>&darr; Move Down</a></li>";
	echo "<li><a class='exa_masthead_section_toggle' data-masthead-assignment-action='add'>&plus; Add Section</a></li>";
	echo "</ul>";
}

function _exa_masthead_assignment_toggles() {
	echo "<ul class='exa-masthead-assignment-toggles'>";
	echo "<li><a class='exa_masthead_assignment_toggle' data-masthead-assignment-action='remove'>&times;</a></li>";
	echo "<li><a class='exa_masthead_assignment_toggle' data-masthead-assignment-action='up'>&uarr;</a></li>";
	echo "<li><a class='exa_masthead_assignment_toggle' data-masthead-assignment-action='down'>&darr;</a></li>";
	echo "<li><a class='exa_masthead_assignment_toggle' data-masthead-assignment-action='add'>&plus;</a></li>";
	echo "</ul>";
}


function _exa_masthead_user_id_field( $section_index, $staff_index, $current_user_id = null ) {
	exa_admin_user_select_dropdown( "exa_masthead_assignments[$section_index][staff][$staff_index][uid]", $current_user_id );
}

function _exa_masthead_user_position_field( $section_index, $staff_index, $current_position = null ) {
	echo "<input class='exa_masthead_user_position_field' name='exa_masthead_assignments[$section_index][staff][$staff_index][position]' value='$current_position' type='text' placeholder='position' />";
}


//** MARK: AJAX **//

/**
 * Returns an input field for the given index. Called in admin/masthead.js
 * 
 * @access private
 * @since v0.6
 */
function _exa_masthead_user_fields_ajax($data) {
	$section_index = intval( $_POST['section_index'] );
	$staff_index = intval( $_POST['staff_index'] );
	$id = $_POST['user_select_id'];
	_exa_masthead_assignment_row( $section_index, $staff_index, null, null, $id );
	wp_die();
}
add_action( 'wp_ajax_exa_masthead_user_field_html', '_exa_masthead_user_fields_ajax' );

/**
 * Returns an input field for the given index. Called in admin/masthead.js
 * 
 * @access private
 * @since v0.6
 */
function _exa_masthead_section_ajax($data) {
	$section_index = intval( $_POST['section_index'] );
	_exa_masthead_print_section( $section_index );
	wp_die();
}
add_action( 'wp_ajax_exa_masthead_section_html', '_exa_masthead_section_ajax' );


//** MARK: SAVING **//

/** 
 * Sanitize and save custom data from the masthead form
 * 
 * @access private
 * @since v0.6
 */
function _exa_masthead_sanitize_and_save($post) {

	if( !array_key_exists('_exa_masthead',$_POST)) {
		return;
	}

	if( !wp_verify_nonce( $_POST['_exa_masthead'], basename(__FILE__) ) ) {
		return;
	}

	$post = get_post($post);

	$assignments = array_key_exists( 'exa_masthead_assignments', $_POST ) ? $_POST['exa_masthead_assignments'] : array();
	$assignments = array_values( $assignments );

	$sanitized_assignments = _exa_masthead_sanitize($post,$assignments);
	_exa_masthead_save($post,$sanitized_assignments);

}
add_action( 'save_post', '_exa_masthead_sanitize_and_save' );

/**
 * Sanitizes new masthead assignments from $_POST form
 */
function _exa_masthead_sanitize($post,$assignments) {
	foreach( $assignments as $section_index => &$section ) {
		$section_staff = array_key_exists( 'staff', $section ) ? $section['staff'] : array();
		foreach( $section_staff as $staff_index => &$staff ) {
			$userid = array_key_exists( 'uid',$staff ) ? $staff['uid'] : null;
			if( !get_user_by('id',$userid) ) {
				unset( $section_staff[$staff_index] );
			}
		}
		$section['staff'] = array_values($section_staff);
		if( empty( $section['staff'] ) && empty( $section['title'] ) ) {
			unset( $assignments[$section_index] );
		}
	}
	return empty($assignments) ? null : $assignments;
}

/**
 * Saves new masthead assignments to the post_meta. Data should be sanitized 
 * before calling thus function
 */
function _exa_masthead_save($post,$assignments) {
	$post = get_post($post);

	if( empty($assignments) ) {
		delete_post_meta($post->ID, '_exa_masthead');
	} else {
		update_post_meta($post->ID, '_exa_masthead', $assignments);
	}
}

/**
 * Returns a role from the most recent masthead. If the user is not included
 * in the masthead, will return null
 * 
 * @access public
 * @since v0.6
 */
function exa_masthead_current_role($user_id = null) {
	global $post;
	$user_id = $user_id ? $user_id : $post->post_author;
	$masthead = exa_masthead_most_recent();
	return exa_masthead_role_from_masthead($masthead,$user_id);
}

/**
 * Returns the most recent role for the given masthead.
 */
function exa_masthead_role_from_masthead( $post, $user_id ) {
	$masthead = exa_masthead_postmeta($post);
	foreach ($masthead as $section) {
		foreach ($section['staff'] as $staffer) {
			if( $staffer['uid'] == $user_id) {
				return $staffer['position'];
			}
		}
	}
}

/**
 * Returns the most recent masthead posts to have been published 
 */
function exa_masthead_most_recent() {
	$args = array(
		'numberposts' => 1,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_type' => EXA_MASTHEAD_POST_TYPE,
		'post_status' => 'publish',
		'suppress_filters' => true
	);
	
	$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
	return $recent_posts[0]['ID'];
}

/** 
 * Returns the masthead postmeta field for the given post. If not defined
 * will return an empty array
 * 
 * @access public
 * @since v0.6
 */
function exa_masthead_postmeta( $post = null ) {
	$post = get_post($post);
	$masthead = get_post_meta($post->ID, '_exa_masthead', true);
	return $masthead ? $masthead : array();
}
