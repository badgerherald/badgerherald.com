<?php 

if(exa_hero_style() == "cover" && exa_hero_media() == "video") {
	get_template_part('templates/article-video');
} else if(exa_hero_style() == "cover") {
	get_template_part('templates/article-cover');	
} else {
	get_template_part('templates/article');
}