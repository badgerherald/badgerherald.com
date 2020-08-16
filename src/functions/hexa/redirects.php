<?php
/*
Description: 	Addresses problems with redirects on badgerherald.com

				This file attempts to address the following problems that
				the Herald has had migrating between different systems:

				1. Resolve Movable Type URLs to WordPress URLs. 

					When we migrated from Movable Type to WordPress 
					every URL on our site changed. We try to resolve 
					old urls if they're followed.

                    Movable Type URLs should be saved as a postmeta value
                    with the key _mt_url. The _mt_entry_id is also saved but
                    doesn't really relate to anything anymore.

                    If you're curious, the database we used to do the final 
                    migrate is on dropbox at: ~/Dropbox/web/archive/final.sql

                    The actual import script we ran are at: 
                    https://github.com/badgerherald/wp-import

*/

function hexa_template_redirect_override() {
    global $wp_query;

    // check: is this a 404 ?
    if ($wp_query->is_404) {

        $pageURL = $_SERVER["REQUEST_URI"];
        if( $postID = hexa_id_from_mt_url("http://badgerherald.com" .$pageURL) ) {
            

            header('Location: ' . site_url("?p=$postID"),true,301 );
            exit;
        }
        
        // status_header( 200 );
        // $wp_query->is_404=false;
    }

}
add_filter('template_redirect', 'hexa_template_redirect_override' );


function hexa_id_from_mt_url($url) {

    /* check if they weren't looking for an old school url */

    $args = array(
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => '_mt_url',
                'value' => $url,
                'compare' => '='
            )
        ),
        'post_type' => 'any'
    );
    $postID = null;
    // The Query
    $the_query = new WP_Query( $args );

    if( $the_query->have_posts() ) {
        $the_query->the_post();
        $postID = $the_query->post->ID;
    }

    wp_reset_postdata();
    return $postID;

}