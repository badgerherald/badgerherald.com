<?php 

if(exa_is_video_post()) {
	get_template_part('inc/templates/video');
} else {
	get_template_part('inc/templates/article');
}