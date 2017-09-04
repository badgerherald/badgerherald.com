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

	wp_enqueue_script('exa-admin-user-select', get_template_directory_uri().'/js/admin/user-select.js', array('jquery','jquery-ui-autocomplete'));

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
function exa_admin_user_select_dropdown( $id, $inputName, $userid = null ) {
	$user = get_userdata( $userid );
	$username = $user ? $user->display_name: '';
	echo "<input id='exa-user-select-{$id}-input' name='$inputName' type='hidden' value='$userid' />";
	echo "<input id='exa-user-select-{$id}' class='exa-user-select' value='{$username}'>";
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

/**
 * Changes wordpress outbound email sender to Badger Herald Web Dept.
 *
 * @since v0.6
 */
function exa_mail_name( $email ){
  return 'Badger Herald Web Dept.'; // new email name from sender.
}
add_filter( 'wp_mail_from_name', 'exa_mail_name' );

/**
 * Changes wordpress outbound email sender address to web@badgerherald.com
 *
 * @since v0.6
 */
function exa_mail_address( $email ){
  return str_replace('wordpress','web',$email); // new email name from sender.
}
add_filter( 'wp_mail_from', 'exa_mail_address' );


 
