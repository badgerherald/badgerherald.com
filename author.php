<?php

get_header();

$banner_id = exa_author_banner_attachment_id();
exa_container('menu-search-bar',array('breakpoints' => array('desktop','tablet','xl')));

if($banner_id) {
    exa_container('masthead',array('breakpoints' => array('mobile')));
    exa_container('cover-hero',array('attachmentID' => $banner_id)); 
} else {
    exa_container('masthead');
}

exa_container('stream');
get_footer(); 