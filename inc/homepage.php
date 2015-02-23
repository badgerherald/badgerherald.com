<?php

/**
 * Global homepage object.
 */
$homepage = new Homepage();

/**
 * Global block class that contains
 * args for the currently displayed block. 
 */
$block;

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

	private $blocks;

	public function __construct() {

		global $block;

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 40
			);

		$this->query = new WP_Query( $args );

		echo "<pre>";

		$features = array();
		$cover = array();
		$stream = array();

		$blockCount = 0;

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


			// Display the top most block,
			// always a cover block with either one cover
			// or two feature objects next to it.
			if( ($blockCount == 0) && ( sizeof($cover) == 1 || sizeof($features) == 3 ) ) {

				$newBlock = new Block();
				$newBlock->identifier = 'most-recent';
				$newBlock->query = new WP_Query();

				if( sizeof($cover) == 1 ) {
					$newBlock->query->posts = $cover;
					$cover = array();
					$newBlock->query->post_count = 1; 
					$newBlock->args['display'] = 'cover';
				} else {
					$newBlock->query->posts = $features;
					$features = array();
					$newBlock->query->post_count = 3; 
					$newBlock->args['display'] = 'feature';
				}

				// Add the block

				$this->blocks[] = $newBlock;
				$blockCount = $blockCount + 1;

			} 

			// Add a billboard block after the second 
			// block.
			else if ($blockCount == 2) {

				$newBlock = new Block();
				$newBlock->identifier = 'billboard';

				$this->blocks[] = $newBlock;
				$blockCount = $blockCount + 1;

			}

			the_title();

			echo "\n";

		endwhile; endif;

		echo "</pre>";

		// Display the blocks;
		foreach($this->blocks as $b) {
			$GLOBALS['block'] = $b;
			exa_block($b->identifier, null);
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

Class Block {

	public $identifier;
	public $query;
	public $args;

	public function __construct() {
		echo "hi";
	}

	public function __toString() {

		$s = "## " . $this->identifier . " block.\n";


		$s .= "  \$args = " . print_r($this->args,true) . "";

		foreach($this->query->posts as $p) {
			$s .= "  - " . $p->post_title . "\n";
		}

		return $s . "\n\n";
	}

}

