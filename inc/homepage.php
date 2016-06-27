<?php
/**
 * Work in progress. This probably isn't used anywhere right now.
 */

/**
 * Global homepage object.
 */
$homepage = new Homepage();

/**
 * Global container class that contains
 * args for the currently displayed container. 
 */
$container;

/**
 * Class to deal with laying the river
 * on the homepage.
 * 
 * @since v0.2
 * 
 */
Class Homepage {

	public $loadedStories;

	private $query;

	private $containers;

	public function __construct() {

		global $container;

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 40
			);

		$this->query = new WP_Query( $args );

		echo "<pre>";

		$features = array();
		$cover = array();
		$stream = array();

		$containerCount = 0;

		if ( $this->query->have_posts() ) : while ( $this->query->have_posts() ) : $post = $this->query->the_post();

			if(exa_is_cover()) {
				echo "<b>// cover // </b>";
				$cover[] = $post;
			}
			else if(exa_is_featured()) {
				echo "<b>// featured // </b>";
				$features[] = get_post();
			} else {
				echo "<b>// stream // </b>";
				$stream[] = get_post();
			}


			// Display the top most container,
			// always a cover container with either one cover
			// or two feature objects next to it.
			if( ($containerCount == 0) && ( sizeof($cover) == 1 || sizeof($features) == 3 ) ) {

				$newcontainer = new container();
				$newcontainer->identifier = 'most-recent';
				$newcontainer->query = new WP_Query();

				if( sizeof($cover) == 1 ) {
					$newcontainer->query->posts = $cover;
					$cover = array();
					$newcontainer->query->post_count = 1; 
					$newcontainer->args['display'] = 'cover';
				} else {
					$newcontainer->query->posts = $features;
					$features = array();
					$newcontainer->query->post_count = 3; 
					$newcontainer->args['display'] = 'feature';
				}

				// Add the container

				$this->containers[] = $newcontainer;
				$containerCount = $containerCount + 1;

			} 

			// Add a billboard container after the second 
			// container.
			else if ($containerCount == 2) {

				$newcontainer = new container();
				$newcontainer->identifier = 'billboard';

				$this->containers[] = $newcontainer;
				$containerCount = $containerCount + 1;

			}

			the_title();

			echo "\n";

		endwhile; endif;

		echo "</pre>";

		// Display the containers;
		foreach($this->containers as $b) {
			exa_container($b->identifier);
		}

		
	
	}

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
	 * @since v0.2
	 * 
	 * @param int $num generate a number between 0-$num.
	 * @param int $hours how often the random number should change (in hours)
	 * 
	 * @return int a random number netween 0 and $num.
	 */
	public function rand($num,$hours = 3) {
		$seed = floor(time()/(60*60*$hours));
		srand($seed);
		$num = rand(0,$num);
		return $num;
	}

}