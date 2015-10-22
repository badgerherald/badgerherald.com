<?php 

if(has_term('video','exa_layout')) {
	get_template_part('inc/templates/video');
} else {
	get_template_part('inc/templates/article');
}