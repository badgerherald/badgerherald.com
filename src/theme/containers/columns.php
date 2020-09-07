<?php

/**
 * Template: Five columns in a row with mug.
 * 
 * On mobile, only three of the five stories are shown with a "load more"
 *
 * @since 0.2
 * 
 */

global $homepage; 
$container = $GLOBALS['container'] ?: new container('column-container');
?>

<div class="<?php echo $container->classes(); ?>">
	<div class="wrapper">

	<header class="column-container-header">
		<h2>Columnists</h2>
	</header>

		<?php 
		$q = $homepage->queryColumns(); 
		$i = 1;
		?>
	
		<?php while( $q->have_posts() ) : $q->the_post();?>
	
			<?php
			
			$classes = "column-container-article";
			$classes .= $i%2 == 0 ? " even" : " odd"; 
			$classes .= " article-" . $i++;

			?>
			<div class="<?php echo $classes; ?>">
				
				<a href="<?php the_author_link(); ?>" class="author-link">
					<?php the_author(); ?>
				</a>

				<a href="<?php the_permalink(); ?>" class="article-link column-container-article-link">
					<?php exa_round_mug( get_the_author_meta('ID') ); ?>
					<h2><?php the_title(); ?></h2>
					<span class="read">Read</span>
				</a>
			
			</div>
	
		<?php endwhile; ?>
	
		<div class="clearfix"></div>

	</div>

</div>