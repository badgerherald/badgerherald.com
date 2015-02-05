<?php

/**
 * Template: Five columns in a row with mug.
 * 
 * On mobile, only three of the five stories are shown with a "load more"
 *
 * @since 0.2
 * 
 */
?>

<?php global $homepage; ?>

<div class="block column-block">
<span class="context-label">COLUMN BLOCK</span>
	<div class="wrapper">

		<?php 
		$q = $homepage->queryColumns(); 
		$i = 1;
		?>
	
		<?php while( $q->have_posts() ) : $q->the_post();?>
	
			<div class="column-block-article article-<?php echo $i++ ?>">
			
				<?php the_title(); ?>
			
			</div>
	
		<?php endwhile; ?>
	
		<div class="clearfix"></div>

	</div>

</div>