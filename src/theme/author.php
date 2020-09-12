<?php

get_header();

exa_container('nameplate');

$banner_id = exa_author_banner_attachment_id();
if($banner_id) {
	exa_container('cover-hero',array('attachmentID' => $banner_id));
}

exa_container('stream');
get_footer(); 