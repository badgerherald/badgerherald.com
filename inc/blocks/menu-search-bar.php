<?php
/**
 * Block: menu search bar block
 * Description: Things my block does.
 *
 */
?>
<div class="block menu-search-bar-block">
    <div class="wrapper">
		<?php 
			wp_nav_menu( array(
				'theme_location' => 'fixed-bar'
				)
			);
		?>
		<div style="clear:both"></div>
		
		<form class="search" action="/" method="get">
			<?php $query = get_search_query(); ?>
			<input type="text" name="s" placeholder="Search..." value="<?php echo $query ?>"></input>
			<input type="submit" value="Submit"></input>
		</form>
		
    </div>
</div>
