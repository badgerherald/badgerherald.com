<?php
/**
 * Loads a query for misnomer articles.
 * 
 * Notes:
 * 
 *   - if we ever child theme, this functions file should move to that
 *     child.
 * 
 */


function misnomer_query() {

	$feed = "http://themadisonmisnomer.com/category/from-the-herald/feed/";

	$mmQuery = new WP_Query();




	return $mmQuery();

}
