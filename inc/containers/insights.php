<?php 
/**
 * Block: menu search bar block
 * Description: Things my block does.
 *
 */

if (is_single()) :
	
global $block;
if(!$block) {
	$block = new Block('insights');
}

?>

<div class="<?php echo $block->classes() ?>">
	<div class="wrapper">


	</div>
</div>

<?php
endif;