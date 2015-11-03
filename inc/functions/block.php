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
function exa_block($name, $b = null) {
    
    // Wrap WP_Query arguement into array we expect.
    if ($b instanceof WP_Query) {
        $newBlock = new Block();
        $newBlock->identifier = $name;
        $newBlock->query = $b;
        $b = $newBlock;
    }

    $GLOBALS['block'] = $b;
    $path = dirname(__FILE__).'/block-'.$name.'.php';

    if (file_exists($path)) {
        require($path);
    }

}

Class Block {

    public $identifier;
    public $query;
    public $args;

    public function __construct() {
        $args = array();
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

