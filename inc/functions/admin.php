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
 * @see /js/admin/user-select.js
 * @since v0.2
 */
function exa_admin_user_select_script( $hook ) {

	wp_enqueue_script('exa-admin-initailize', get_template_directory_uri().'/js/admin/initalize.js', array('jquery','jquery-ui-autocomplete'));
	wp_enqueue_script('exa-admin-user-select', get_template_directory_uri().'/js/admin/user-select.js?v=1', array('jquery','jquery-ui-autocomplete'));


	$userObjects = get_users( array( 
							'role__in' => array('editor','administrator'),
							'fields' => array('ID','display_name'),
							// todo: job title meta.
						)
					);

	$users;

	foreach ($userObjects as $u) {
		$users[] = array(
			'label' => $u->display_name,
			'value' => $u->ID
			);
	}
	wp_localize_script('exa-admin-user-select', 'exa_user_select', array('users' => $users));
} 
add_action( 'admin_enqueue_scripts', 'exa_admin_user_select_script' );

/**
 * Prints a user select box
 * 
 * @since v0.5
 */
function exa_admin_user_select_dropdown( $inputName, $userid = '', $id = null ) {
	$user = get_userdata( $userid );
	$username = $user ? $user->display_name : '';
	$id = $id ? $id : $inputName;
	$id = preg_replace("/^[^a-z]+|[^\w:.-]+/i","",$id);
	echo "<input id='exa-user-select-{$id}-input' name='{$inputName}' type='hidden' value='{$userid}' />";
	echo "<input id='exa-user-select-{$id}' class='exa-user-select' type='text' value='{$username}' placeholder='user'>";
}

/**
 * Prints several user select boxes
 * 
 * @since v0.5
 */
function exa_admin_user_select_multi_dropdown( $id, $inputName, $userids = null, $args = null ) {
	$defaults = array(
		'number' => 4,
	);

	$args = wp_parse_args( $args, $defaults );

	for( $i = 0; $i < $args['number']; $i++ ) {
		$userid = ( $userids && array_key_exists($i,$userids) ) ? $userids[$i] : null;
		exa_admin_user_select_dropdown("$id-$i","{$inputName}[]",$userid);
	}
}