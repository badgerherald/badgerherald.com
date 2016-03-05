<?php
/**
 * Class for registering & displaying ads from
 * the On Campus web server
 * 
 * @package exa
 * @since v0.5
 */


Class OnCampus {
	
	private $ads;

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
			add_action('wp_footer', array($this, 'enqueue_scripts'));
			$this->enqueued = true;
		}

		add_action('wp_print_footer_scripts', array($this, 'footer_script'));

	}

	public function enqueue_scripts() {

	}

	public function footer_script() {

	}

	/**
	 * Register Breakpoint
	 *
	 * @param DoubleClickBreakpoint
	 */
	public function register_breakpoint($identifier,$args = null) {
		$this->breakpoints[$identifier] = new DoubleClickBreakpoint($identifier,$args);
	}

	public function registerAdSlot($name,$id) {

	}

	public function placeAd($name) {

	}

	function footer() {

	}

}

$OnCampus = new OnCampus();

$OnCampus->registerAdSlot(
	'top-leaderboard',
	array(728,90),
	'538215136'
	);

$OnCampus->registerAdSlot(
	'upper-sidekick',
	array(300,250),
	'538215223'
	);

$OnCampus->registerAdSlot(
	'upper-sidekick',
	array(300,250),
	'537234628'
	);

/**
 * 
 * 
 * Ads:
 * 
 * Desktop:
 *    - Top Leaderboard (728x90): 538215136
 *    - Upper Sidekick (300x250): 538215223
 *    - Lower Sidekick (300x250): 537234628
 * 
 */



