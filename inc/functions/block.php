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
function exa_block($name, $type = null, $args = null) {

    $block = new Block($name,$type,$args);
    $GLOBALS['block'] = $block;
    get_template_part('./inc/blocks/' . $name,$type);
    $GLOBALS['block'] = null;

}

Class Block {

    public $name;
    public $type;

    public $identifier;
    public $query;
    public $args;

    public function __construct($name,$type = null,$args = null) {
        $this->name = $name;
        $this->type = $type;
        $this->args = $args ? $args : array();
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
        
        return $str;

    }

    public function option($option) {
        return array_key_exists($option,$this->args) ? $this->args[$option] : false;
    }

}

