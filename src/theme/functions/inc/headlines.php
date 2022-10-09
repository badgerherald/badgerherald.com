<?php

/**
 * Adds subheadline support to Exa
 * 
 * @package Exa
 * @since v0.3
 */


/**
 * Returns true if the post has a subhead
 *
 * @since v0.5
 * 
 * @param $post (optional) if empty, the current global $post will be used.
 */
function exa_has_subhead($post = null)
{
	return exa_get_subhead($post = null) ? true : false;
}

/**
 * Prints the post subhead
 *
 * @since v0.5
 * 
 * @param $post (optional) if empty, the current global $post will be used.
 */
function exa_subhead($post = null)
{
	echo exa_get_subhead($post);
}

/**
 * Returns the post subhead
 *
 * @since v0.5
 * 
 * @param $post (optional) if empty, the current global $post will be used.
 */
function exa_get_subhead($post = null)
{
	$post = get_post($post);
	return apply_filters('exa_subhead', get_post_meta($post->ID, '_exa_subhead', TRUE));
}