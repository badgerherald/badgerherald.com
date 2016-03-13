<?php
/**
 * Functions for dealing with grabbing block content.
 *
 * @since v0.2
 */

global $block;

/**
 * Includes the requested block template.
 * 
 * @since v0.2
 * 
 * @param string $name Name of block template to include.
 * @param array|WP_Query $args Optional argument to instantiate variables for template.
 */
function exa_block($name, $args = null) {

    // store current block
    $curBlock = $GLOBALS['block'];

    $block = new Block($name,$args);
    $GLOBALS['block'] = $block;
    get_template_part('./inc/blocks/' . $name);

    // restore current block;
    $GLOBALS['block'] = $block;

}

/**
 * Filter banter block classes
 */
function exa_banter_block_classes($classes,$block) {
    global $post;
    if($block->name == "headline" && hexa_is_banter()) {
        $classes .= " banter";
    }
    return $classes;
}
add_filter("exa_block_classes","exa_banter_block_classes",10,2);

function hexa_is_banter($post = null) {
    $post = get_post($post);
    return in_category("banter",$post);
}

Class Block {

    public $name;

    public $identifier;
    public $query;
    public $args;

    public function __construct($name,$args = null) {
        $this->name = $name;
        $this->args = is_array($args) ? $args : array();
    }

    public function __toString() {

        $s = "## " . $this->identifier . " block.\n";

        $s .= "  \$args = " . print_r($this->args,true) . "";

        foreach($this->query->posts as $p) {
            $s .= "  - " . $p->post_title . "\n";
        }

        return $s . "\n\n";
    }

    public function classes($classes = null) {
        
        $str = "block";

        if(empty($this->type)) {
            $str .= " {$this->name}-block";
        } else {
            $str .= " {$this->name}-{$this->type}-block";
        }
        if(array_key_exists('breakpoints',$this->args)) {
            foreach($this->args['breakpoints'] as $breakpoint ) {
                $str .= " $breakpoint";
            }
        }
        
        $str = apply_filters("exa_block_classes",$str,$this);

        return $str;

    }

    public function default_args($args) {
        $this->args = array_merge($this->args,$args);
    }

    public function option($option) {
        return array_key_exists($option,$this->args) ? $this->args[$option] : false;
    }

}

