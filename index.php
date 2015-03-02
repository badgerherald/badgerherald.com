<?php
/**
 *
 * BH Homepage Theme.
 * 
 */


global $DoubleClick;

get_header();

?>

	<?php // include('inc/homepage.php'); ?>

	<?php //$q = $homepage->queryCover(); ?>

	<?php //while( $q->have_posts() ) : $q->the_post();?>

		<?php // get_template_part('inc/block','cover'); ?>

	<?php //endwhile; ?>

	<?php get_template_part('inc/block','old-homepage'); ?>

<?php get_footer(); ?>