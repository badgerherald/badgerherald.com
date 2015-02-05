<?php

/**
 * Global homepage object.
 */
$homepage = new Homepage();

/**
 * Class to deal with laying the river
 * on the homepage.
 * 
 * @since 0.2
 * 
 */
Class Homepage {

	public $loadedStories;

	/**
	 * Query & find a recent cover story.
	 * 
	 * @return WP_Query
	 */
	public function queryCover() {

		$args = array();
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'importance',
				'field' => 'slug',
				'terms' => array('cover'),
				'operator' => 'IN'
				)
			);
		$args['posts_per_page'] = 1;
		$query = new WP_Query( $args );

		return $query;

	}

	/**
	 * Query & find recent columns.
	 * 
	 * @return WP_Query
	 */
	public function queryColumns($num = 5) {

		$args = array();
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => array('opinion'),
				'operator' => 'IN'
				)
			);
		$args['posts_per_page'] = $num;
		$query = new WP_Query( $args );

		return $query;

	}

	/**
	 * Generate a random number based on the time of day.
	 * 
	 * The number will stay the same for the given hours passed in,
	 * before changing to something new.
	 * 
	 * There is no way to control when these changes happen. But allow for us
	 * to make decisions that don't change "randomly" as much as on a "rotation"
	 * 
	 * @param int $num generate a number between 0-$num.
	 * @param int $hours how often the random number should change (in hours)
	 * @return int a random number netween 0 and $num.
	 */
	public function rand($num,$hours = 3) {
		$seed = floor(time()/(60*60*$hours));
		srand($seed);
		$num = rand(0,$num);
		return $num;
	}

}

