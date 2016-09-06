<?php
/**
 * Functions for dealing with grabbing a containers content.
 *
 * @since v0.2
 */

/**
 * Includes the requested container template.
 * 
 * @since v0.2
 * 
 * @param string $name Name of container template to include.
 * @param array|WP_Query $args Optional argument to instantiate variables for template.
 */
function exa_container($name, $args = null) {

	$container = new Container($name,$args);
	$container->output();

}



function hexa_is_banter($post = null) {
	$post = get_post($post);
	return in_category("banter",$post);
}

Class Container {

	
	public static $container;
	public $name;
	public $identifier;
	public $query;
	public $args;
	
	private $output;
	private static $prevContainer;

	private $error;

	public function __construct($name,$args = null) {
		$this->name = $name;
		$this->args = is_array($args) ? $args : array();
		$this->executeTemplate();
	}

	public function __toString() {
		$s = "## " . $this->identifier . " container.\n";

		$s .= "  \$args = " . print_r($this->args,true) . "";

		foreach($this->query->posts as $p) {
			$s .= "  - " . $p->post_title . "\n";
		}

		return $s . "\n\n";
	}

	public function classes($classes = null) {
		$classes = "container " . $this->nameClass() . " " . $this->breakpointClasses() . " " . $this->backgroundClass();
		$classes = apply_filters("exa_container_classes",$classes,$this);
		return $classes;
	}

	/**
	 * Returns the container's class name.
	 */
	private function nameClass() {
		return empty($this->type) ? "{$this->name}" : " {$this->name}-{$this->type}";
	}

	/**
	 * Returns a string of classes used to selectively hide the container
	 * on certian css breakpoints
	 */
	private function breakpointClasses() {
		$classes = "";
		if(array_key_exists('breakpoints',$this->args)) {
			foreach($this->args['breakpoints'] as $breakpoint ) {
				$classes .= " $breakpoint";
			}
		}
		return $classes;
	}

	/**
	 * Returns a class to convert the background
	 */
	private function backgroundClass() {
		return array_key_exists('background',$this->args) ? $this->args['background'] : "";
	}

	public function default_args($args) {
		$this->args = array_merge($args,$this->args);
	}

	public function option($option) {
		return array_key_exists($option,$this->args) ? $this->args[$option] : false;
	}

	public function output() {
		if( $this->error ) {
			echo "<div class='block error'><div class='wrapper' style='text-align:center;'>{$this->error}</div></div>\n";
		} else {
			echo $this->output;
		}
	}

	public function executeTemplate() {

		$this->error = null;

		if( locate_template( './inc/containers/' . $this->name . '.php' ) == '' ) {
			$this->error = "Template file <tt>{$this->name}.php</tt> not found";
		}
		else {
			$curContainer = array_key_exists('container', $GLOBALS) ? $GLOBALS['container'] : null;
			$GLOBALS['container'] = $this;

			ob_start();
			get_template_part('./inc/containers/' . $this->name);
			$this->output = ob_get_contents();
			ob_end_clean();
			
			$GLOBALS['container'] = $curContainer;
		}

	}

}

