<?php
/**
 * Class for registering & displaying ads from
 * the On Campus web server
 * 
 * @package exa
 * @since v0.4
 */


function hexa_humpdate_ad_removal( $query ) {
	if( $query->is_main_query() && $query->is_single()  ) {
		if(has_term('Hump Day','topic',$query->posts[0]->ID)) {
			OnCampus::$enabled = false;
		}
	}
	return $query;
}
add_filter( 'loop_start', 'hexa_humpdate_ad_removal' , 10, 1 );


Class OnCampus {
	

	/**
	 * OnCampus ID
	 * 
	 */
	public static $auid;

	/**
	 * Disable output (for say humpday purposes)
	 */
	public static $enabled = true;

	/**
	 * Defined at units
	 */
	private $adunits;

	/**
	 * Ads already placed on the page
	 */
	private $displayads;

	/**
	 * Whether we have hooked enqueue of the script
	 * to wp head.
	 *
	 * @var boolean
	 */
	private static $enqueued = false;

	/**
	 * Array of defined breakpoints
	 *
	 * @var Array
	 */
	public $breakpoints = array();

	function __construct() {

		// Script enqueue is static because we only ever want to print it once.
		if(!$this::$enqueued) {
			add_action('wp_footer', array($this, 'scripts'));
			$this::$enqueued = true;
		}
		add_action('wp_print_footer_scripts', array($this, 'footer'));
		
		$this->register_breakpoint('__all',-1);
		$this->displayads = array();

	}

	public function scripts() {
		wp_enqueue_script('oncampus','//oncampusweb-d.openx.net/w/1.0/jstag',array(),'v1.0',true);
	}

	/**
	 * Register Breakpoint
	 * 
	 */
	public function register_breakpoint($identifier,$minWidth) {
		$this->breakpoints[] = new OnCampusBreakpoint($identifier,$minWidth);
		usort($this->breakpoints,array("OnCampusBreakpoint","compare"));
	}

	/**
	 * Register ad
	 * 
	 * @param String $name name of adslot to register
	 * @param String|Array $ids to use for different breakpoints
	 */
	public function register_ad($name,$id,$size) {

		// Ensure $id is a string and add it to ads.
		$this->adunits[$name] = "$id";

	}

	/**
	 * Places an ad.
	 * 
	 * $ads String|Array $ads  	The name of the ad (as passed to "register_ad")
	 * 							to show for all breakpoints.
	 * 
	 * 							// todo:
	 * 							For different ads at different breakpoints, pass
	 * 							in an array/dictionary of names defined for 
	 * 							different breakpoints.
	 * 					
	 * 								e.g.
	 * 									$ads = array(
	 * 												"mobile" => "mobile-leaderboard",
	 * 												"tablet" => "desktop-leaderboard"			
	 * 											);
	 * 							
	 * 							This function will determine the largest breakpoint
	 * 							who's width fits on the screen and display this
	 * 							ad. If only a single ad string is passed in, this
	 * 							will be displayed for all breakpoints.
	 */
	public function place_ad($ads) {

		echo $this->get_ad_placement($ads);

	}

	public function get_ad_placement($ads) {

		$str = "";

		if(is_string($ads)) {
			$ads = array(
							"__all" => $ads
						);
		}

		foreach($ads as $breakpoint => $ad) {
			$str .= "<div id='ad-$ad'></div>";
		}
		
		$this->displayads[hash("md5",serialize($ads))] = $ads;

		return $str;
	
	}

	public function footer() {


		// Load others:
		if(OnCampus::$enabled) :

			echo "<script type='text/javascript'>\n";
	
			echo "\tvar w = window.innerWidth;\n";
			echo "\tvar OX_4d6552943f5a4 = OX();\n";

			foreach ($this->displayads as $i=>$adspot) {
				$first = true;
				foreach ($this->breakpoints as $bp) {
					$width = $bp->minWidth;
					foreach ($adspot as $breakpoint=>$ad) {
						if($breakpoint == $bp->identifier) {
							echo $first ? "\n\tif" : " else if"; $first = false;
							echo "(w > $width) {\n";
							if($ad != "") {
								echo "\tOX_4d6552943f5a4.addAdUnit('{$this->adunits[$ad]}');\n";
  								echo "\tOX_4d6552943f5a4.setAdUnitSlotId('{$this->adunits[$ad]}','ad-$ad');\n";
  							}
							echo "\t}";
						}
					}
				}
			} 
			echo "\n\n\tOX_4d6552943f5a4.load();\n";
			echo "</script>";

		endif;

	}

}

class OnCampusBreakpoint {
	/**
	 * Slug of the breakpoint
	 *
	 * @var string
	 */
	public $identifier = '';
	
	/**
	 * Maximum width for the breakpoint
	 *
	 * @var integer
	 */
	public $minWidth;


	public function __construct($identifier,$minWidth) {
		$this->identifier = $identifier;
		$this->minWidth = $minWidth;
	}
	/**
	 * Prints a javascript boolean statement for this breakpoint
	 *
	 */
	public function js_logic() {
		echo $this->get_js_logic();
	}
	/**
	 * Returns a string with the boolean logic for the breakpoint.
	 *
	 * @return String boolean logic for breakpoint.
	 */
	public function get_js_logic() {
		return "($this->minWidth <= document.documentElement.clientWidth && document.documentElement.clientWidth < $this->minWidth)";
	}

	public static function compare($a,$b) {
		return ($a->minWidth < $b->minWidth);
	}
}

// Global OnCampus object
$OnCampus = new OnCampus();

// Standard breakpoints:
$OnCampus->register_breakpoint('mobile',0);
$OnCampus->register_breakpoint('tablet',740);
$OnCampus->register_breakpoint('desktop',1040);
$OnCampus->register_breakpoint('xl',1180);

// Register OnCampus Ads:
$OnCampus->register_ad('leaderboard','538215136','728x90');
$OnCampus->register_ad('upper-sidekick','538215223','300x250');
$OnCampus->register_ad('lower-sidekick','538270652','300x250');
$OnCampus->register_ad('homepage-sidekick','538295845','300x50');
$OnCampus->register_ad('mobile-leaderboard','538295843','300x50');
$OnCampus->register_ad('article-bottom','538309619','300x50');



// Preflight breakpoints:
$OnCampus->register_breakpoint('preflight-mobile',0);
$OnCampus->register_breakpoint('preflight-tablet',740);
$OnCampus->register_breakpoint('preflight-desktop',1040);

// Register Preflight Ads:
$OnCampus->register_ad('preflight-mobile','538309497','');
$OnCampus->register_ad('preflight-tablet','538309498','');
$OnCampus->register_ad('preflight-desktop','538309499','');

/**
 * 
 * 
 * Ads:
 * 
 * Desktop:
 *    - Top Leaderboard (728x90): 538215136
 *    - Upper Sidekick (300x250): 538215223
 *    - Lower Sidekick (300x250): 537234628
 * 	  - Mobile Leaderboard (300x50): 538295843
 * 
 */



