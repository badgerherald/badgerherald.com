<?php
/**
 * Functions for dealing with grabbing block content.
 *
 * @since v0.2
 */

/**
 * Includes the requested block template.
 * @param  string           $name Name of block template to include.
 * @param  array|WP_Query   $args Optional argument to instantiate variables for template.
 */
function exa_block($name, $args = null) {
    if ($args instanceof WP_Query) {
        $args = array('query' => $args);
    }
    $path = dirname(__FILE__).'/block-'.$name.'.php';
    if (file_exists($path)) {
        require($path);
    }
}