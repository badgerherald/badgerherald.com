<?php


/**
 * Returns an array of user ids corresponding to the defined editors for 
 * a category
 * 
 * @since v0.5
 * 
 * @param $category category id or category object 
 * @return array of editors defined for the section
 */
function exa_staff_editors_for_category($category = null) {
	global $post;

	if($category) {
		$category = get_category($category);
	} else if($post) {
		$category = get_the_category($post);
	}

	$slug = $category->slug;
	$staff = get_option( 'exa_staff_assignments', array() );

	if( array_key_exists('editorial',$staff) && array_key_exists($slug,$staff['editorial']) ) {
		return array_key_exists('editors',$staff['editorial'][$slug]) ? $staff['editorial'][$slug]['editors'] : array() ;
	}
}

/**
 * Returns an array of user ids corresponding to the defined associates for 
 * a category
 * 
 * @since v0.5
 * 
 * @param $category category id or category object 
 * @return array of editors defined for the section
 */
function exa_staff_associates_for_category($category = null) {
	global $post;

	if($category) {
		$category = get_category($category);
	} else if($post) {
		$category = get_the_category($post);
	}

	$slug = $category->slug;
	$staff = get_option( 'exa_staff_assignments' );

	if( array_key_exists('editorial',$staff) && array_key_exists($slug,$staff['editorial']) ) {
		return array_key_exists('associates',$staff['editorial'][$slug]) ? $staff['editorial'][$slug]['associates'] : array() ;
	}

}

class ExaStaff {

	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Holds the values to be used in the masthead fields callbacks
	 */
	private $mastheadOptions;

	private $callback;

	/**
	 * Start up
	 */
	public function __construct() {
		$this->options = get_option( 'exa_staff_assignments' ) ?: array() ;
		$this->mastheadOptions = get_option( 'exa_masthead_assignments' ) ?: array() ;
		add_action( 'admin_menu', array( $this, 'add_staff_admin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );

		$callback = function() {
			return function() { echo __FUNCTION__; };
		};

	}

	/**
	 * Registers 'Staff' admin page and adds javascript to load for the page
	 *
	 * This adds a menu item under 'Users' for users who have permissions to edit_users.
	 * It also registers the function 'exa_staff_admin_options()' as the source for this content.
	 *
	 * @since v0.5
	 */
	public function add_staff_admin_page() {

		// 1: add the page
		$menu_title = "Staff";
		$page_title = "Staff";
		$capability = "edit_users";
		$menu_slug = 'staff';
		$function = array( $this, 'create_staff_admin_page' );
		$page_hook_suffix = add_submenu_page( 	
									'users.php', 
									$menu_title , 
									$page_title, 
									$capability, 
									$menu_slug, 
									$function );

		// 2: register javascript for the page
		add_action('admin_print_scripts-' . $page_hook_suffix, array( $this, 'staff_admin_page_enqueue'));
	}

	/**
	 * Options page callback
	 */
	public function create_staff_admin_page()
	{

		?>
		<div class="wrap">
			<h2>Staff</h2>
			<h2 class="nav-tab-wrapper">
				<a href="#" class="nav-tab">Masthead</a>
				<a href="#" class="nav-tab">Editors</a>
			</h2>           
			<form method="post" action="options.php">
			<?php

				// This prints out all hidden setting fields
				settings_fields( 'exa_staff_assignments' );   
				do_settings_sections( 'staff' );

				submit_button(); 
			?>
			</form>
		</div>
		<?php
	}

	/**
	 * Enqueues style for 'staff' admin page.
	 */
	function staff_admin_page_enqueue() {
		wp_register_style( 'exa-staff-assignments-style', get_template_directory_uri() . '/css/admin/staff-assignments.css', false, '1.0.0' );
		wp_enqueue_style( 'exa-staff-assignments-style' );
	}

	/**
	 * Register and add settings
	 */
	public function page_init() { 
		$this->register_masthead_assignment_option();
		$this->register_staff_assignment_option();
	}

	/**
	 * Registers the staff assignment option (staff to categories)
	 */
	private function register_masthead_assignment_option() {        
		register_setting(
			'exa_masthead_assignments', // Option group
			'exa_masthead_assignments', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		add_settings_section(
			'exa_masthead_assignments_section', // ID
			'Masthead Assignments', // Title
			array( $this, 'print_masthead_section_info' ), // Callback
			'staff' // Page
		);  

		$categories = get_terms(
				array(
					'taxonomy' => array('category', 'topic'),
					'slug' => array('news', 'sports', 'artsetc', 'opinion', 'visuals', 'features'),
					'hide_empty' => true,
					'parent' => 0
					)
				);

		$mastheadOptions = $this->mastheadOptions;
		$mastheadSize = max( 4, sizeof( $this->mastheadOptions ) + 2 );

		for( $i = 0 ; $i < $mastheadSize ; $i++ ) :

			$typeInput = "<select data-masthead-index='$i' class='exa-masthead-toggle' name='exa_masthead_assignments[$i][type]''>";
			$typeInput .= "<option value='title' selected='selected'>Department Title</option>";
			$typeInput .= "<option value='subtitle'>Section Title</option>";
			$typeInput .= "<option value='staff-list'>Staff List</option>";
			$typeInput .= "</select>";

			add_settings_field(
				'exa_masthead_assignment__' . $i, // ID
				$typeInput, // Title 
				function() use ($i,$mastheadOptions) {
					$staff = null;
					if ( array_key_exists($i, $mastheadOptions) ) {
						$staff = $mastheadOptions[$i];
					}
					echo "<div data-masthead-index='$i' class='exa-masthead-inputs'>";
					echo "<input name='exa_masthead_assignments[$i][index]' type='hidden' value='$i' />";

					echo '<div class="exa-staff-assignment-box" data-hide=\'["subtitle","title"]\'>';
					echo '<label></label> ';
					exa_admin_user_select_multi_dropdown( "masthead-$i", 
															"exa_masthead_assignments[$i]", 
															$staff, array('number' => 5)  
															);
					echo '</div>';

					echo '<div class="exa-staff-assignment-box" data-hide=\'["subtitle","staff-list"]\'>';
					echo '<label></label> ';
					echo "<input name='exa_masthead_assignments[$i]' type='text' value='' />";
					echo '</div>';

					echo '<div class="exa-staff-assignment-box" data-hide=\'["title","staff-list"]\'>';
					echo '<label></label> ';
					echo "<input name='exa_masthead_assignments[$i]' type='text' value='' />";
					echo '</div>';

					echo '<div class="exa-masthead-controls ">';
					echo '<a class="exa-masthead-up-control">up</a> ';
					echo '<a class="exa-masthead-down-control">down</a> ';
					echo '<a class="exa-masthead-add-control">add</a> ';
					echo '<a class="exa-masthead-delete-control">delete</a> ';
					echo '</div>';
					echo '</div>';
				},
				'staff', // Page
				'exa_masthead_assignments_section' // Section
			);     
		endfor;

	}

	/**
	 * Registers the staff assignment option (staff to categories)
	 */
	private function register_staff_assignment_option() {        
		register_setting(
			'exa_staff_assignments', // Option group
			'exa_staff_assignments', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		add_settings_section(
			'exa_staff_assignments_section', // ID
			'Staff Assignments', // Title
			array( $this, 'print_editors_section_info' ), // Callback
			'staff' // Page
		);  

		$categories = get_terms(
				array(
					'taxonomy' => array('category', 'topic'),
					'slug' => array('news', 'sports', 'artsetc', 'opinion', 'visuals', 'features'),
					'hide_empty' => true,
					'parent' => 0
					)
				);

		$options = $this->options;
		
		foreach($categories as $category) :
			add_settings_field(
				'exa_staff_assignments__' . $category->slug, // ID
				$category->name, // Title 
				function() use ($category,$options) {
					$categorySlug = $category->slug;
					$editors = null;
					$associates = null;
					if ( array_key_exists('editorial', $options) && array_key_exists($categorySlug, $options['editorial']) ) {
						$editors = array_key_exists('editors',$options['editorial'][$categorySlug]) ? $options['editorial'][$categorySlug]['editors'] : null;
						$associates = array_key_exists('associates',$options['editorial'][$categorySlug]) ? $options['editorial'][$categorySlug]['associates'] : null;
					}
					echo '<div class="exa-staff-assignment-box">';
					echo '<label>Editors:</label> ';
					exa_admin_user_select_multi_dropdown( "editorial-$categorySlug-editors", "exa_staff_assignments[editorial][$categorySlug][editors]", $editors, array('number' => 5)  );
					echo '</div>';
					echo '<div class="exa-staff-assignment-box">';
					echo '<label>Associates:</label> ';
					exa_admin_user_select_multi_dropdown( "editorial-$categorySlug-associates", "exa_staff_assignments[editorial][$categorySlug][associates]", $associates, array('number' => 7) );
					echo '</div>';
				},
				'staff', // Page
				'exa_staff_assignments_section' // Section
			);     
		endforeach;

	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input )
	{
		// todo: loop through, if not valid user id, then don't save.
		return _exa_recursive_array_filter($input);
	}

	/** 
	 * Print the Section text
	 */
	public function print_editors_section_info() {
		print 'Specify editor roles for sections';
	}

	/** 
	 * Print the Section text
	 */
	public function print_masthead_section_info() {
		print 'Specify roles for masthead';
	}

}

if( is_admin() )
	$ExaStaff = new ExaStaff();


function _exa_recursive_array_filter(&$array) {
	foreach( $array as $key => $item ) {
		is_array( $item ) && $array[$key] = _exa_recursive_array_filter( $item );
		if ( empty( $array[$key] ) )
			unset( $array[$key] );
	}
	return $array;
}


class exa_get_staff {

	private $selects;
	private $results;

	private $queried;

	function __construct() {
		$this->selects = array();
		$this->queried = false;
	}

	/**
	 * Filters returned results to users whos first article was published between start date
	 * and end date.
	 *
	 * Using the passed section, time period, and story number this function
	 * returns a list of all staff who have written for that time period.
	 *
	 * @author Will Haynes
	 *
	 * @param Int $num Required. The number of articles to query for.
	 * @param String $operator Required. Either "more" or "less"
	 * @param Date $startdate Optional. (Default: Beginning of time) The date to start looking from.
	 * @param Date $enddate Optional. (Default: Today) The date to end looking at. Defaults to current time.
	 *
	 */
	public function first_article($startdate = null,$enddate = null) {

		global $wpdb;

		// Start Date

		if($startdate === null) {
			// Set date to start of CE.
			$startdate = new DateTime("0001/1/1");
		}   $startdate = $startdate->format('Y/m/d');

		// End Date
	
		if($enddate === null) {
			// Set date to current time.
			$enddate = new DateTime();
		}   $enddate = $enddate->format('Y/m/d');

		$query = $wpdb->prepare("
			SELECT DISTINCT `post_author`, $wpdb->users.display_name as `display_name`, $wpdb->users.user_email as `user_email` FROM $wpdb->posts
			LEFT JOIN $wpdb->term_relationships ON
				($wpdb->posts.ID = $wpdb->term_relationships.object_id)
			LEFT JOIN $wpdb->term_taxonomy ON
				($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
			LEFT JOIN $wpdb->users ON
				($wpdb->posts.post_author = $wpdb->users.id)
			WHERE $wpdb->posts.post_status = 'publish'
				AND $wpdb->posts.post_type = 'post'
			GROUP BY $wpdb->posts.post_author
			HAVING MIN($wpdb->posts.post_date) > %s
			AND MAX($wpdb->posts.post_date) < %s 
		", $startdate,$enddate);

		$this->selects[] = $query;

		$this->queried = false;


	}

	/**
	 * Filter users by whether they have a post in a certain section.
	 *
	 * @author Will Haynes
	 *
	 * @param String $slug Required. The slug of the category to search in.
	 */
	public function section($slug) {

		global $wpdb;

		$query = $wpdb->prepare("
			SELECT DISTINCT `post_author`, wp_users.display_name as `display_name`, wp_users.user_email as `user_email` FROM wp_posts
			LEFT JOIN wp_term_relationships ON
			(wp_posts.ID = wp_term_relationships.object_id)
			LEFT JOIN wp_term_taxonomy ON
			(wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id)
			LEFT JOIN wp_terms ON
			(wp_term_taxonomy.term_id = wp_terms.term_id)
			LEFT JOIN wp_users ON
			(wp_posts.post_author = wp_users.id)
			WHERE wp_posts.post_status = 'publish'
			AND wp_posts.post_type = 'post'
			AND wp_terms.slug = %s
			GROUP BY wp_posts.post_author
			HAVING COUNT(DISTINCT wp_posts.id) > 3
			", $slug);

		$this->selects[] = $query;

		$this->queried = false;
	}

	/**
	 * Filter users by number of posts for a period of time.
	 *
	 * Using the passed $num and $operator, (and optional start and end date), this
	 * function filters the returned results to only the authors that have the appropriate
	 * number of posts.
	 *
	 * @author Will Haynes
	 *
	 * @param Int $num Required. The number of articles to query for.
	 * @param String $operator Required. Either "more" or "less"
	 * @param Date $startdate Optional. (Default: Beginning of time) The date to start looking from.
	 * @param Date $enddate Optional. (Default: Today) The date to end looking at. Defaults to current time.
	 *
	 */
	public function num_published($num, $operator, $startdate = null, $enddate = null) {

		global $wpdb;

		// Convert operator

		$operator = $operator === 'more' ? '>' : '<';

		// Start Date

		if($startdate === null) {
			// Set date to start of CE.
			$startdate = new DateTime("0001/1/1");
		}   $startdate = $startdate->format('Y/m/d');

		// End Date
	
		if($enddate === null) {
			// Set date to current time.
			$enddate = new DateTime();
		}   $enddate = $enddate->format('Y/m/d');

		$query = $wpdb->prepare("
			SELECT DISTINCT `post_author`, $wpdb->users.display_name as `display_name`, $wpdb->users.user_email as `user_email` FROM $wpdb->posts
			LEFT JOIN $wpdb->term_relationships ON
			($wpdb->posts.ID = $wpdb->term_relationships.object_id)
			LEFT JOIN $wpdb->term_taxonomy ON
			($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
			LEFT JOIN $wpdb->users ON
			($wpdb->posts.post_author = $wpdb->users.id)
			WHERE $wpdb->posts.post_status = 'publish'
			AND $wpdb->posts.post_type = 'post'
			AND $wpdb->posts.post_date > %s
			AND $wpdb->posts.post_date < %s
			GROUP BY $wpdb->posts.post_author
			HAVING COUNT(DISTINCT $wpdb->posts.id) $operator %d
		", $startdate,$enddate,$num);

		$this->selects[] = $query;

		$this->queried = false;

	}

	public function query() {

		global $wpdb;

		if(!$queried) {

			// If no selects registered, return empty array and set result varaibles.
			if( sizeof($this->selects) == 0 ) {
				$this->results = array();
				$this->queried = true;
				return $this->results;
			}
			// If only one select, just run that select
			else if( sizeof($this->selects) == 1 ) {
				$query = $this->selects[0] . ";";
			}
			// If more than one select, union all selects.
			else {
				$query = "SELECT t3.post_author as user_id, t3.display_name, t3.user_email from (";
				for( $i = 0; $i < sizeof($this->selects); $i+=1 ) :

					$query .= $this->selects[$i];

					if ($i != sizeof($this->selects)-1) {
						$query .= " UNION ALL ";
					}

				endfor;


				$query .= ") AS t3 GROUP BY t3.post_author HAVING COUNT(*) > " . (sizeof($this->selects) - 1) . ";";
			}
			
			
			$this->result = $wpdb->get_results($query,OBJECT);
			$this->queried = true;

		}

		return $this->result;

	}

}



