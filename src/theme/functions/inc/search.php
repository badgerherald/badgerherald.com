<?php
/**
 * Plugin Name: Relevanssi REST API Endpoint
 * Description: Adds REST API Endpoint for Relevanssi queries
 * Author: Aucor Oy
 * Author URI: https://www.aucor.fi/
 * Version: 1.0
 * License: GPL2+
 *
 * Usage: /wp-json/relevanssi/v1/search?s=query
 *        /wp-json/relevanssi/v1/search?s=query&posts_per_page=5
 **/

defined( 'ABSPATH' ) or die( '' );

add_action( 'rest_api_init', 'relevanssi_rest_api_filter_add_filters' );

// Add filter to posts
function relevanssi_rest_api_filter_add_filters() {

  // Register new route for search queries
  register_rest_route( 'webpress/v1', 'search', array(
    'methods'             => WP_REST_Server::READABLE,
    'callback'            => 'relevanssi_search_route_callback',
    'permission_callback' => '__return_true',
  ) );

}

/**
 * Generate results for the /wp-json/relevanssi/v1/search route.
 *
 * @param WP_REST_Request $request Full details about the request.
 *
 * @return WP_REST_Response|WP_Error The response for the request.
 */
function relevanssi_search_route_callback( WP_REST_Request $request ) {

  $parameters = $request->get_query_params();

  // Force the posts_per_page to be no more than 10
  if ( isset( $parameters['posts_per_page'] ) && ( (int) $parameters['posts_per_page'] >= 1 && (int) $filter['posts_per_page'] <= 10 ) ) {
    $posts_per_page = intval( $parameters['posts_per_page'] );
  } else {
    $posts_per_page = 10;
  }

    // default search args
    $args = array(
      's'               =>  $parameters['s'],
      'posts_per_page'  =>  $posts_per_page,
    );

    // run query
    $search_query = new WP_Query();
    $search_query->parse_query( $args );
    if ( function_exists( 'relevanssi_do_query' ) ) {
      relevanssi_do_query( $search_query );
    }

    $controller = new WP_REST_Posts_Controller('post');
    $posts = array();

    while ( $search_query->have_posts() ) : $search_query->the_post();
      $data    = $controller->prepare_item_for_response( $search_query->post, $request );
      $posts[] = $controller->prepare_response_for_collection( $data );
    endwhile;

  // return results
  if( ! empty( $posts ) ) {
    return new WP_REST_Response( $posts, 200 );
  } else {
    return new WP_Error( 'No results', 'Nothing found' );
  }

}