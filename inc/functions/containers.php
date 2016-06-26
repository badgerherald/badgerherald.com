<?php
/**
 * Functions for dealing with grabbing a containers content.
 *
 * @since v0.2
 */

global $container;

/**
 * Includes the requested container template.
 * 
 * @since v0.2
 * 
 * @param string $name Name of container template to include.
 * @param array|WP_Query $args Optional argument to instantiate variables for template.
 */
function exa_container($name, $args = null) {

    // store current container
    $curContainer = $GLOBALS['container'];

    $container = new Container($name,$args);
    $GLOBALS['container'] = $container;

    if(!locate_template('./inc/containers/' . $name)) {
        get_template_part('./inc/containers/' . $name);
    } else {
        echo "<div class='container'><div class='wrapper'>";
        echo "<p>Container $name not found</p>";
        echo "</div></div>";
    }

    // restore current container;
    $GLOBALS['container'] = $curContainer;

}

/**
 * Filter banter container classes
 */
function exa_banter_container_classes($classes,$container) {
    global $post;
    if($container->name == "headline" && hexa_is_banter()) {
        $classes .= " banter";
    }
    return $classes;
}
add_filter("exa_container_classes","exa_banter_container_classes",10,2);

function hexa_is_banter($post = null) {
    $post = get_post($post);
    return in_category("banter",$post);
}

Class Container {

    public $name;

    public $identifier;
    public $query;
    public $args;

    public function __construct($name,$args = null) {
        $this->name = $name;
        $this->args = is_array($args) ? $args : array();
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
        
        $str = "container";

        if(empty($this->type)) {
            $str .= " {$this->name}";
        } else {
            $str .= " {$this->name}-{$this->type}";
        }
        if(array_key_exists('breakpoints',$this->args)) {
            foreach($this->args['breakpoints'] as $breakpoint ) {
                $str .= " $breakpoint";
            }
        }
        
        $str = apply_filters("exa_container_classes",$str,$this);

        return $str;

    }

    public function default_args($args) {
        $this->args = array_merge($args,$this->args);
    }

    public function option($option) {
        return array_key_exists($option,$this->args) ? $this->args[$option] : false;
    }

}

