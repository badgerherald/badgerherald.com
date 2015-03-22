<?php

/**
 * SSL for video embeds.
 */
function add_secure_video_options($html) {
   if (strpos($html, "<iframe" ) !== false) {
    	$search = array('src="http://www.youtu','src="http://youtu');
		$replace = array('src="https://www.youtu','src="https://youtu');
		$html = str_replace($search, $replace, $html);

   		return $html;
   } else {
        return $html;
   }
}
add_filter('the_content', 'add_secure_video_options', 10);