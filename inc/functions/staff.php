<?php

/**
 */
function exa_staff_admin_init() {

	/* Register our script. */
	// wp_register_script( 'exa-staff-plugin-script', plugins_url( 'js/logic.js', __FILE__ ), array( 'jquery' ), 1, false );
	// wp_register_style( 'exa-staff-plugin-style' , plugins_url( 'css/css.css', __FILE__ ) );

}
add_action( 'admin_init', 'exa_staff_admin_init' );

/**
 * Registers 'Find staff' (Writer API) admin page.
 *
 * This adds a menu item under 'users' for users who have permissions to edit_users.
 * It also registers the function 'exa_staff_admin_options()' as the source for this content.
 *
 * @since v0.5
 */
function exa_staff_admin_menu() {
	$page_hook_suffix = add_submenu_page( 'users.php', 'Staff', 'Staff', 'edit_users', 'staff', 'exa_staff_admin_options_page' );

	/* Creates a new action that calls a function to enqueue scripts if this page is loaded */
	add_action('admin_print_scripts-' . $page_hook_suffix, 'exa_staff_plugin_enqueue');

}
add_action( 'admin_menu', 'exa_staff_admin_menu' );

/**
 * Part 3: Enqueues the previously registered scripts and styles for 'Find staff' admin page.
 *
 * This function is called by the hook previously attached in exa_staff_admin_menu(), and enqueues
 * the script and style previously registered in exa_staff_admin_init().
 *
 * @author Will Haynes
 */
function exa_staff_plugin_enqueue() {
	wp_enqueue_script( 'exa-staff-plugin-script' );
	wp_enqueue_style( 'exa-staff-plugin-style' );
}
/**
 * Part 4: Prints content for 'Find staff' admin page.
 * 
 * Called by Wordpress when the admin page is loaded.
 *
 * @author Will Haynes
 */
function exa_staff_admin_options_page() {
	if ( !current_user_can( 'edit_posts' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	?>
	<div class='wrap'>
	<h2>Staff</h2>
		<?php
			exa_staff_admin_options_page_section_editors_form_section();
		?>
	</div>
	</div>
	<?php
}

function exa_staff_admin_options_page_section_editors_form_section() {
	$categories = get_terms(
				array(
    				'taxonomy' => 'category',
    				'hide_empty' => true,
    				'parent' => 0
					));
	?>
	<hr />
	<h3>Section Staff</h3>
 	<?php
	foreach($categories as $category) :
	?>
		<h4><?php echo $category->name ?></h4>
		<pre><?php print_r($category); ?></pre>

	<?php
	endforeach;
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

		/*
		echo "<pre>";

		$result = $wpdb->get_results($query);

		print_r($result);

		echo "</pre>";
		*/

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



