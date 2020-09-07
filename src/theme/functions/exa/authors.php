<?php

/**
 * Removes things the kids don't even remember
 */
function _exa_user_profiles_contact_methods( $contactmethods ) {
	$contactmethods['twitter'] = __( 'Twitter Username' );
	unset($contactmethods['yim']);
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	return $contactmethods;
}
add_filter('user_contactmethods','_exa_user_profiles_contact_methods',10,1);

/**
 * Hack to remove website from user profiles too. We don't use it anywhere.
 */
function _exa_user_profiles_remove_website() {
    echo '<style>tr.user-url-wrap{ display: none; }</style>';
}
add_action( 'admin_head-user-edit.php', '_exa_user_profiles_remove_website' );
add_action( 'admin_head-profile.php',   '_exa_user_profiles_remove_website' );

/**
 * Returns a badger herald email, if the user has one.
 */
function exa_author_email($userID) {
	$user = get_userdata( $userID );
	$user_email = $user->user_email;
	return strpos($user_email, '@badgerherald.com') ? $user_email : "";
}

/**
 * Returns an author's current twitter handle
 */
function exa_author_twitter($user) {
	$twitter = get_the_author_meta('twitter',$user);
	return $twitter ? $twitter : get_hrld_author("hrld_twitter_handle",$user);
}

/**
 * Returns true if the user has a twitter handle
 */
function exa_author_has_twitter($user) {
	$twitter = exa_author_twitter($user);
	return $twitter ? true : false;
}


/**
 * The stuff below works but should be refactored:
 */

$extra_fields = array();

$extra_fields[] = array(
	"title" => "Author Page Banner Image",
	"key"	=> "_hrld_staff_banner",
	"name"	=> "hrld_staff_banner",
	"description" => "Select a banner image for your author page",
	"type"	=> "image"
	);

/**
 * Add extra custom fields to user profiles
 *
 * @author Matt Neil
 * @since Oct 2013
 * @return void
 */
 
function hrld_user_custom_fields_image( $hook){
	if ( 'profile.php' != $hook ) {
        return;
    }
	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'hrld_user_custom_fields_image' );

function hrld_user_custom_fields( $user ){
	?>
	
	<script language="JavaScript">
		var file_frame;
		jQuery(document).ready(function() {
			
			
			jQuery('#user-meta-hrld_staff_banner_button').click(function() {
				
				var custom_uploader = wp.media({
    					title: "Select Image",
    					multiple: false,
    					frame: 'select',
    					library: { type: 'image' },
    					orientation: 'landscape'
					});
					custom_uploader.on('select', function(){
						var media_attachment = custom_uploader.state().get('selection').first().toJSON();
						console.log(media_attachment);
						var preview_img = jQuery('#user-meta-hrld_staff_banner_img');
						if( preview_img.length == 0)
							jQuery( '#user-meta-hrld_staff_banner'). parent().append('<img id="user-meta-hrld_staff_banner_img" src='+media_attachment.sizes.thumbnail.url+' /><br /><button type="button" class="button delete_button">Delete Banner</button>');
							
							
							
						else
							jQuery('#user-meta-hrld_staff_banner_img').attr('src', media_attachment.sizes.thumbnail.url);
						jQuery('#user-meta-hrld_staff_banner').val(media_attachment.id);
					});
					custom_uploader.open();
			});
			jQuery('.delete_button').click(function(){
				jQuery(this).parent().children('img').remove();
				jQuery('#user-meta-hrld_staff_banner').val();
				jQuery(this).parent().children('br').last().remove();
				jQuery(this).remove();
			
			});
		});
	</script>

	<h3>Extra Information</h3>

	<table class="form-table">
		<?php global $extra_fields; foreach($extra_fields as $field) : if( $field["type"] == 'text') : ?>
		
		<tr>
			<th><label for="<?php echo $field["name"] ?>"><?php echo $field["title"] ?></label></th>
			<td><?php if($field["name"]=="hrld_twitter_handle") echo "@"; ?><input type="<?php echo $field["type"] ?>" name="<?php echo $field["name"] ?>" id="user-meta-<?php echo $field["name"] ?>" value="<?php echo esc_attr( get_the_author_meta( $field["key"], $user->ID ) ); ?>" class="regular-text" /><br /><span class="description"><?php echo $field["description"]; ?></span></td>
		</tr>
		<?php elseif( $field["type"] == 'image') : ?>
		<tr>
			<th><label for="<?php echo $field["name"] ?>"><?php echo $field["title"] ?></label></th>
			<td>
				<input type="hidden" name="<?php echo $field["name"] ?>" id="user-meta-<?php echo $field["name"] ?>" value="<?php echo esc_attr( get_the_author_meta( $field["key"], $user->ID ) ); ?>" class="regular-text" />
				<button type="button" name="<?php echo $field["name"] ?>-button" id="user-meta-<?php echo $field["name"] ?>_button" class="button" data-title="Choose Banner Image: <?php echo $user->display_name; ?>"/>Choose Image</button><br /><span class="description"><?php echo $field["description"]; ?></span><br /><br />
				<?php if( get_the_author_meta( $field["key"], $user->ID ) != '') : ?>
					<img id="user-meta-<?php echo $field["name"] ?>_img" src="<?php echo current(wp_get_attachment_image_src(get_the_author_meta( $field["key"], $user->ID ), 'thumbnail')); ?>" />
					<br />
					<button type="button" class="button delete_button">Delete Banner</button>
				<?php endif; ?>		
			</td>
		</tr>
		<?php elseif( $field["type"] == 'multi-select') : ?>
		<tr>
			<th><label for="<?php echo $field["name"] ?>"><?php echo $field["title"] ?></label></th>
			<td>
				<?php if($field["key"] = "_hrld_staff_best_posts") : ?>
					<script>
						jQuery(document).ready(function(){
							<?php
								$best_posts = get_the_author_meta( $field["key"], $user->ID );
								foreach($best_posts as $best_post):
							?>
									jQuery('option[value=<?php echo $best_post; ?>]').prop('selected', true);
							<?php
								endforeach;
							?>
						})
					</script>
					<select multiple name="<?php echo $field["name"].'[]' ?>" id="user-meta-<?php echo $field["name"] ?>" style="min-height: 160px;">
					<?php
						$args = array(
							'author' => get_the_author_meta('ID', $user->ID),
							'post_type' => 'post',
							'post_status' => array('publish', 'inherit'),
							'posts_per_page' => -1,
							'orderby' => 'type modified',
							'order' => 'ASC',
						);
						$query = new WP_Query( $args );
						$types_shown = array();
						$firstpost = true;
						if( $query->have_posts()):
							while( $query->have_posts()): $query->the_post();
								if(!in_array(get_post_type(), $types_shown)):
									$types_shown[] = get_post_type();
									if(!$firstpost)
										echo '</optgroup>';
									echo '<optgroup label='.ucfirst(get_post_type()).'>';
								endif;
								echo '<option value='.get_the_ID().'>'.exa_get_time().' - '.get_the_title().'</option>';
								$firstpost = false;
							endwhile;

						else:
							echo "<option>blank</option>";
						endif;
					?>
					</select>
				<?php endif; ?>
				<br /><span class="description"><?php echo $field["description"]; ?></span>
			</td>
		</tr>
		<?php endif; ?>
		<?php endforeach; ?>
	</table>

<?php }

add_action('show_user_profile', 'hrld_user_custom_fields');
add_action('edit_user_profile', 'hrld_user_custom_fields');

/**
 * Save the extra user custom fields
 *
 * @since v0.5
 */
function hrld_save_user_custom_fields( $user_id ){

	if (!current_user_can('edit_user', $user_id))
		return false;

	global $extra_fields;

	foreach ($extra_fields as $field) :
	/* Insert the twitter value */

	$new_value = $_POST[$field["name"]];

	$key = $field["key"];

	/* Get the meta value of the custom field key. */
	$value = get_the_author_meta($key, $user_id);

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_value && '' ==  $value )
		add_user_meta( $user_id, $key, $new_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_value && $new_value != $value )
		update_user_meta( $user_id, $key, $new_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_value && $value )
		delete_user_meta( $user_id, $key, $value );

	endforeach;

}

add_action('personal_options_update', 'hrld_save_user_custom_fields');
add_action('edit_user_profile_update', 'hrld_save_user_custom_fields');



/**
 * @deprecated
 */
function hrld_author_has($key, $author_id = null) {

	global $post;

	if($author_id == null) {
		$author_id = $post->post_author;
	}

	$val = get_the_author_meta("_" . $key,$author_id);

	return $val != '';
}

/**
 * @deprecated
 */
function hrld_author($key, $author_id = null) {
	echo get_hrld_author($key, $author_id);
}

/**
 * @deprecated
 */
function get_hrld_author($key, $author_id = null) {
	
	global $post;
	
	if( $author_id == null ) {
		$author_id = $post->post_author;
	}

	return get_the_author_meta("_" . $key,$author_id);

}


/**
 * Outputs <img> tag mug for a user.
 * 
 * ex.
 *   <img src="http://.../upload/..." classes=" $classes" />
 * 
 * @since v0.2
 * 
 * @param int $author_id the user id to print a mug for.
 * @param string $classes class string to be added to the <img> tag.
 */
function exa_mug($author_id = null, $size = 'square', $classes = '') {
	global $wpua_functions;
	$src = exa_mug_src($author_id, $size);
	if( $src)
		echo "<img src='$src' classes='mug $classes' />";
}

function exa_mug_src($author_id = null, $size = 'square') {
	global $post;
	global $wpua_functions;
	if( !$author_id ) {
		$author_id = is_author() ? get_query_var('author') : $post->post_author;
	}
	if(function_exists('has_wp_user_avatar') && has_wp_user_avatar($author_id)) {
		$src = get_wp_user_avatar_src($author_id, $size);
	} else {
		$src = false;
	}
	return $src;
}


/**
 * Returns the attachment id for the author's banner, if one
 * exists. Otherwise, returns nil.
 */
function exa_author_banner_attachment_id($author_id = null) {
	if(!$author_id) {
		$author_id = is_author() ? get_query_var('author') : $GLOBAL['post']->post_author;
	}
	$attachment_id = get_the_author_meta( '_hrld_staff_banner', get_query_var('author') );
	return $attachment_id != '' ? $attachment_id : null;
}

function exa_author_bio($author_id = null) {
	if( !$author_id ) {
		$author_id = is_author() ? get_query_var('author') : $GLOBAL['post']->post_author;
	}
	if( get_the_author_meta('description') != "" ) {
		return get_the_author_meta('description');
	}
	else if( get_the_author_meta('_hrld_staff_description',$author_id) != null ) {
		return get_the_author_meta('_hrld_staff_description',$author_id);
	}
	return null;
}
