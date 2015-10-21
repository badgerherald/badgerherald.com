<?php

/**
 * Returns a media credit tag for the current posts feature image.
 * 
 */
function exa_hero_media_credit_tag() {
	
	global $post;

	$thumb_id = get_post_thumbnail_id($post->ID);
	$args = array(
		'post_type' => 'attachment',
		'post_status' => null,
		'post_parent' => $post->ID,
		'include'  => $thumb_id
	); 

	$thumb_image = get_post($thumb_id);

	$credit = get_hrld_media_credit($thumb_id);
	$excerpt = $thumb_image->post_excerpt;

	if($credit != "") :

	 	if(get_user_by('login', $credit)){
			$hrld_user = get_user_by('login', $credit);
			$html_text = '<span class="hrld-media-credit"><span class="hrld-media-credit-name"><a href="'.get_bloginfo('url').'/author/'.$credit.'">'.$hrld_user->display_name.'</a></span><span class="hrld-media-credit-org">/The Badger Herald</span></span>'; 
		} else{
			$hrld_credit_name_org = explode("/", $credit);
			if(array_key_exists(1,$hrld_credit_name_org) && $hrld_credit_name_org[1]){
				$html_text = '<span class="hrld-media-credit"><span class="hrld-media-credit-name">'.$hrld_credit_name_org[0].'</span><span class="hrld-media-credit-org">/'.$hrld_credit_name_org[1].'</span></span>';
			}
			else{
				$html_text = '<span class="hrld-media-credit"><span class="hrld-media-credit-org">'.$hrld_credit_name_org[0].'</span></span>';
			}
		}

	endif;

	return $html_text;
	
}

function exa_hero_caption_text() {
	
	global $post;

	$thumb_id = get_post_thumbnail_id($post->ID);

	$args = array(
		'post_type' => 'attachment',
		'post_status' => null,
		'post_parent' => $post->ID,
		'include'  => $thumb_id
	); 

	$thumb_image = get_post($thumb_id);
	$excerpt = $thumb_image->post_excerpt;

	return $excerpt;

}

function exa_hero_caption() {
	echo "<p class='hero-caption'>" . exa_hero_caption_text() . exa_hero_media_credit_tag() ."</p>";
}

/**
 * Outputs <img> tag mug for a user.
 * 
 * ex.
 *   <img src="http://.../upload/..." classes=" $classes" />
 * 
 * @since 0.2
 * 
 * @param int $user_id the user id to print a mug for.
 * @param string $classes class string to be added to the <img> tag.
 */
function exa_mug($user_id, $size = 'square', $classes = '') {

	global $wpua_functions;
	if(!has_wp_user_avatar($user_id)) {
		$src = $wpua_functions->wpua_default_image($size);
		$src = $src['src'];
	} else {
		$src = get_wp_user_avatar_src($user_id, $size);
	}
	echo "<img src='$src' classes='mug $classes' />";

}

/**
 * Outputs <div><img></div> tag mug for a user.
 * 
 * The div is rounded with css to make the mug round.
 * 
 * ex.
 * <div class='mug round-mug $classes'>
 *   <img src="http://.../upload/..." classes=" $classes" />
 * </div>
 * 
 * @since 0.2
 * 
 * @param int $user_id the user id to print a mug for.
 * @param string $classes class string to be added to the <img> tag.
 */
function exa_round_mug($user_id,$size = 'square',$classes = '') {

	global $wpua_functions;
	if(!has_wp_user_avatar($user_id)) {
		$src = $wpua_functions->wpua_default_image($size);
		$src = $src['src'];
	} else {
		$src = get_wp_user_avatar_src($user_id, $size);
	}
	echo "<div class='mug round-mug $classes'>";
		echo "\t<img src='$src' />";
	echo "</div>";
}

function exa_full_width_cover_image($url, $classes = array()) {
	echo '<div class="block full-width-cover-image full-width-aspect-3by1 '.implode(' ', $classes).'" style="background-image:url('.$url.')"></div>';
}

/**
 * Returns a sharebar with facebook, twitter and shorturl
 * 
 */
function exa_sharebar() { ?>

	<div class="sharebar">

		<span class="sharetag">Share</span>
		<input class="sharebarurl" type="text" onclick="$(this).select()" value="<?php echo exa_short_url() ?>"/>
		

		
		<div class="sharebarfb">
		<div  class="fb-like" 
			  data-href="<?php echo exa_social_url(get_permalink($post->ID), false); ?>" 
			  data-layout="button_count" 
			  data-action="like" 
			  data-width="90"
			  data-show-faces="false" 
			  data-share="true">
		</div>
		</div>
		<div class="sharebartwitter">
		<a  href="https://twitter.com/share" 
			class="twitter-share-button " 
			data-url="<?php echo exa_social_url(get_permalink($post->ID), false); ?>" 
			data-text="<?php echo the_title(); ?>." 
			data-via="badgerherald" 
			data-related="badgerherald">Tweet</a>
		</div>

		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		
	</div>


<?php } 
