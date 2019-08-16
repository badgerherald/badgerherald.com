<?php

/**
 * 
 * Modified from:
 * 
 * Plugin Name: WP_Query Route To REST API
 * Description: Adds new route /wp-json/wp_query/args/ to REST API
 * Author: Aucor
 * Author URI: https://www.aucor.fi/
 * Version: 1.1.1
 * License: GPL2+
 * 
 * 
 * 
 **/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
class WP_Query_Route_To_REST_API extends WP_REST_Posts_Controller {
  /**
   * Constructor
   */
  public function __construct() {
    // Plugin compatibility
    add_filter( 'wp_query_route_to_rest_api_allowed_args', array( $this, 'plugin_compatibility_args' ) );
    add_action( 'wp_query_route_to_rest_api_after_query', array( $this, 'plugin_compatibility_after_query' ) );
    // register REST route
    $this->register_routes();
  }
  
  /**
   * Register read-only /wp_query/args/ route
   */
  public function register_routes() {
    register_rest_route( 'exa/v1', 'route/', array(
      'methods'             => WP_REST_Server::READABLE,
      'callback'            => array( $this, 'get_items' ),
      'permission_callback' => array( $this, 'get_items_permissions_check' ),
    ) );
  }
  /**
   * Check if a given request has access to get items
   *
   * @param WP_REST_Request $request Full data about the request.
   *
   * @return WP_Error|bool
   */
  public function get_items_permissions_check( $request ) {
    return apply_filters( 'wp_query_route_to_rest_api_permissions_check', true, $request );
  }
  /**
   * Get a collection of items
   *
   * @param WP_REST_Request $request Full data about the request.
   */
  public function get_items( $request ) {
        
    // Script start
    $rustart = getrusage();

    $parameters = $request->get_query_params();

    $forceQuery = false;

    if (array_key_exists("resolve",$parameters) && $parameters["resolve"]) {
      $forceQuery = true;
    }

    $default_args = array(
      'post_status'     => 'publish',
      'posts_per_page'  => 10,
      'has_password'    => false
    );
  
    $default_args = apply_filters( 'wp_query_route_to_rest_api_default_args', $default_args );
    // allow these args => what isn't explicitly allowed, is forbidden
    $allowed_args = array(
      'p',
      'name',
      'title',
      'page_id',
      'pagename',
      'post_parent',
      'post_parent__in',
      'post_parent__not_in',
      'post__in',
      'post__not_in',
      'post_name__in',
      'post_type', // With restrictions
      'posts_per_page', // With restrictions
      'offset',
      'paged',
      'page',
      'ignore_sticky_posts',
      'order',
      'orderby',
      'year',
      'monthnum',
      'w',
      'day',
      'hour',
      'minute',
      'second',
      'm',
      'date_query',
      'inclusive',
      'compare',
      'column',
      'relation',
      'post_mime_type',
      'lang', // Polylang
    );

      $allowed_args[] = 'author';
      $allowed_args[] = 'author_name';
      $allowed_args[] = 'author__in';
      $allowed_args[] = 'author__not_in';


      $allowed_args[] = 'meta_key';
      $allowed_args[] = 'meta_value';
      $allowed_args[] = 'meta_value_num';
      $allowed_args[] = 'meta_compare';
      $allowed_args[] = 'meta_query';


      $allowed_args[] = 's';


      $allowed_args[] = 'cat';
      $allowed_args[] = 'category_name';
      $allowed_args[] = 'category__and';
      $allowed_args[] = 'category__in';
      $allowed_args[] = 'category__not_in';
      $allowed_args[] = 'tag';
      $allowed_args[] = 'tag_id';
      $allowed_args[] = 'tag__and';
      $allowed_args[] = 'tag__in';
      $allowed_args[] = 'tag__not_in';
      $allowed_args[] = 'tag_slug__and';
      $allowed_args[] = 'tag_slug__in';
      $allowed_args[] = 'tax_query';
    
    // let themes and plugins ultimately decide what to allow
    $allowed_args = apply_filters( 'wp_query_route_to_rest_api_allowed_args', $allowed_args );
    // args from url
    $query_args = array();
    foreach ( $parameters as $key => $value ) {
      // skip keys that are not explicitly allowed
      if( in_array( $key, $allowed_args ) ) {
        switch ( $key ) {
          // Posts type restrictions
          case 'post_type':
            // Multiple values
            if( is_array( $value ) ) { 
              foreach ( $value as $sub_key => $sub_value ) {
                // Bail if there's even one post type that's not allowed
                if( !$this->check_is_post_type_allowed( $sub_value ) ) {
                  $query_args[ $key ] = 'post';
                  break;
                }
              }
            // Value "any"
            } elseif ( $value == 'any' ) {
              $query_args[ $key ] = $this->_get_allowed_post_types();
              break;
            // Single value
            } elseif ( !$this->check_is_post_type_allowed( $value ) ) {
              $query_args[ $key ] = 'post';
              break;
            }
            $query_args[ $key ] = $value;
            break;
          // Posts per page restrictions
          case 'posts_per_page':
            $max_pages = apply_filters( 'wp_query_route_to_rest_api_max_posts_per_page', 50 );
            if( $value <= 0 || $value > $max_pages ) {
              $query_args[ $key ] = $max_pages;
              break;
            }
            $query_args[ $key ] = $value;
            break;
          // Posts per page restrictions
          case 'posts_status':
            // Multiple values
            if( is_array( $value ) ) { 
              foreach ( $value as $sub_key => $sub_value ) {
                // Bail if there's even one post status that's not allowed
                if( !$this->check_is_post_status_allowed( $sub_value ) ) {
                  $query_args[ $key ] = 'publish';
                  break;
                }
              }
            // Value "any"
            } elseif ( $value == 'any' ) {
              $query_args[ $key ] = $this->_get_allowed_post_status();
              break;
            // Single value
            } elseif ( !$this->check_is_post_status_allowed( $value ) ) {
              $query_args[ $key ] = 'publish';
              break;
            }
            $query_args[ $key ] = $value;
            break;
          // Set given value
          default:
            $query_args[ $key ] = $value;
            break;
        }
      }
    }

    // combine defaults and query_args
    $args = wp_parse_args( $query_args, $default_args );

    // filter values
    foreach ($args as $key => $value) {
      $args[$key] = apply_filters( 'exa_route_arg_value', $value, $key, $args );
    }
    do_action( 'exa_route_query_args', $args );
    $wp_query = new WP_Query($args);
      $wp_query->have_posts();
    if($forceQuery && !$wp_query->have_posts()) {
      $wp_query->is_404 = true;
    }
    do_action( 'exa_route_query', $wp_query );

    return $this->get_response( $request, $args, $wp_query);
  }

  /**
   * Get response
   *
   * @access protected
   *
   * @param WP_REST_Request $request Full details about the request
   * @param array $args WP_Query args
   * @param WP_Query $wp_query
   *
   * @return WP_REST_Response
   */
  protected function get_response( $request, $args, $wp_query) {
    // Prepare data
    $responseObject = array(
                "args" => $args,
                "route" => array(
                    "isArchive" => $wp_query->is_archive,
                    "isSingle" => $wp_query->is_single,
                    "isPage" => $wp_query->is_page,
                    "isHome" => $wp_query->is_home,
                    "is404" => $wp_query->is_404,
                    "isSearch" => $wp_query->is_search
                ),
                "query" => $wp_query
            );
    $response = new WP_REST_Response( $responseObject, 200 );
    return $response;
  }

  /**
   * Get allowed post status
   *
   * @access protected
   *
   * @return array $post_status
   */
  protected function _get_allowed_post_status() {
    $post_status = array( 'publish' );
    return apply_filters( 'wp_query_route_to_rest_api_allowed_post_status', $post_status );
  }
  /**
   * Check is post status allowed
   *
   * @access protected
   *
   * @return abool
   */
  protected function check_is_post_status_allowed( $post_status ) {
    return in_array( $post_status, $this->_get_allowed_post_status() );
  }
  /**
   * Get allowed post types
   *
   * @access protected
   *
   * @return array $post_types
   */
  protected function _get_allowed_post_types() {
    $post_types = get_post_types( array( 'show_in_rest' => true ) );
    return apply_filters( 'wp_query_route_to_rest_api_allowed_post_types', $post_types );
  }
  /**
   * Check is post type allowed
   *
   * @access protected
   *
   * @return abool
   */
  protected function check_is_post_type_allowed( $post_type ) {
    return in_array( $post_type, $this->_get_allowed_post_types() );
  }
  /**
   * Post is allowed
   *
   * @access protected
   *
   * @return bool
   */
  protected function check_is_post_allowed( $post ) {
    
    // Is allowed post_status
    if( !$this->check_is_post_status_allowed( $post->post_status ) ) {
      return false;
    }
    // Is allowed post_type
    if( !$this->check_is_post_type_allowed( $post->post_type ) ) {
      return false;
    }
    return apply_filters( 'wp_query_route_to_rest_api_post_is_allowed', true, $post );
  }
  /**
   * Plugin compatibility args
   *
   * @param array $args 
   *
   * @return array $args
   */
  public function plugin_compatibility_args( $args ) {
    // Polylang compatibility
    $args[] = 'lang';
    return $args;
  }
  /**
   * Plugin compatibility after query
   *
   * @param WP_Query $wp_query 
   */
  public function plugin_compatibility_after_query( $wp_query ) {
    // Relevanssi compatibility
    if( function_exists( 'relevanssi_do_query' ) && !empty( $wp_query->query_vars[ 's' ] ) ) {
      relevanssi_do_query( $wp_query );
    }
  }
}
/**
 * Init only when needed
 */
function wp_query_route_to_rest_api_init() {
  new WP_Query_Route_To_REST_API();
}
add_action( 'rest_api_init', 'wp_query_route_to_rest_api_init' );
