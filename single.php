<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); 
?>
<script>
    disqus_shortname = 'badgerherald'; // Required - Replace example with your forum shortname
    disqus_identifier = '48467';
</script>
	
		

<?php /* The loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>


	<?php get_template_part( 'content', get_post_format() ); ?>
	

	<?php comments_template(); ?>

<?php endwhile; ?>

		


<?php get_footer(); ?>