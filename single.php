<?php 

if(exa_layout() == "video") {
	get_template_part('inc/templates/article-video');
} else if(exa_layout() == "cover") {
	get_template_part('inc/templates/article-cover');	
}  else {
	get_template_part('inc/templates/article');
}