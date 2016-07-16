<?php

class ExaStaff {

    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    private $callback;

    /**
     * Start up
     */
    public function __construct()
    {
    	$this->options = get_option( 'exa_staff_assignments' );
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
    public function page_init()
    {        
        register_setting(
            'exa_staff_assignments', // Option group
            'exa_staff_assignments', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Staff Assignments', // Title
            array( $this, 'print_section_info' ), // Callback
            'staff' // Page
        );  

		$categories = get_terms(
				array(
					'taxonomy' => 'category',
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
					exa_admin_user_select_multi_dropdown( "editorial-$categorySlug", "exa_staff_assignments[editorial][$categorySlug][editors]", $editors, array('number' => 5)  );
					echo '</div>';
					echo '<div class="exa-staff-assignment-box">';
					echo '<label>Associates:</label> ';
					exa_admin_user_select_multi_dropdown( "editorial-$categorySlug", "exa_staff_assignments[editorial][$categorySlug][editors]", $associates, array('number' => 7) );
					echo '</div>';
				},
				'staff', // Page
				'setting_section_id' // Section
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
        return $input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Use these settings to specify editors for section pages and other staff roles';
    }

}

if( is_admin() )
	$ExaStaff = new ExaStaff();



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



