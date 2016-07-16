<?php 
/**
 * A little API to make native WordPress plugins suck less
 * 
 * functions:
 * 		- exa_register_options_group
 * 		- 
 * 
 * @since v0.5
 * @author Will Haynes



$exa_options_groups = array();

function exa_register_options_group($identifier,$page,$title,$inputCallback,$savingCallback) {
	
	global $exa_options_groups;

	$exa_options_groups['exa_options_group_' . $identifier	] = array(
			'inputCallback' => $inputCallback,
			'savingCallback' => $savingCallback,
			'page' => $page,
			'title' => $title
		);

	add_settings_section(
		'exa_options_group_' . $identifier, // ID
		'Exa Settings', // Title
		'_exa_options_group_section_input_section_description_callback',
		$page // Page
	);

	add_settings_field(
		'exa_options_group_setting_' . $identifier, // ID
		'Staff Assignments', // Title 
		'_exa_options_group_section_input_callback', // Callback
		$page, // Page
		'exa_options_group_' . $identifier      
	);

	register_setting(
		'exa_staff_assignments', 
		'Register Section', 
		'exa_staff_admin_save_staff_assignments'
	);  

}

function _exa_options_group_section_input_section_description_callback( $args) {
	// echo "section!";
}

function _exa_options_group_section_input_callback( $args ) {

	global $exa_options_groups;

	$id = $args['id'];
	$groupId = $id;
	$group = $exa_options_groups[$groupId];
	$inputCallback = $group['inputCallback'];

	call_user_func( $inputCallback );
	
}

function _exa_options_group_section_saving_callback( $args ) {

	global $exa_options_groups;

	$id = $args['id'];
	$groupId = $id;
	$group = $exa_options_groups[$groupId];
	$savingCallback = $group['savingCallback'];

	call_user_func( $savingCallback );
	
}

 * 
 */	
