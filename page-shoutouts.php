<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

include("shoutouts/functions.php");
get_header(); 



if(isset($wp_query->query_vars['so_page'])) {

	$so_page = $wp_query->query_vars['so_page'];

} // End if

if(!$so_page) {
	$so_page = 1;
}

$shoutouts = new ShoutoutList($so_page,40);


?>
	
<div id="ad-leaderboard">
	<a href="#"><img src="<?php bloginfo('template_url'); ?>/img/temp/charter.728x90.jpg"></a>
</div>


	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header shoutout-header">
				<h1 class="entry-title"> <?php the_title(); ?></h1>
				<h2 class="shoutout-tagline">Madison's other daily page since 2004</h2>
			</header><!-- .entry-header -->

  <?php echo $shoutouts->getNav('?page='); ?>
			
			
	<?php
		if (!$shoutouts->hasShoutouts()) { 
			echo '<p>HMFASO to there not being any shoutouts yet.  Why not submitting one?</p>';
		}
		else {
			$count=1;
			$pos = rand(1,2)*8;
			foreach($shoutouts->getArray() as $shoutout) {
	 ?>
				
				<!-- THIS IS WHERE EACH SHOUTOUT LIVES -->

				<div class="shoutout-container" id="<?php echo $shoutout->getNum() ?>">
					<p class="shout-out-title" >
						<?php echo "<a class='shoutout-number-link' href='" . SITE_ROOT . SHOUTOUT_ROOT  . "so.php?id=" . $shoutout->getID() . "' title='Shoutout #" . $shoutout->getNum() . "'>"; ?>#<?php echo $shoutout->getNum(); ?></a>
						<?php echo $shoutout->getDate() ?>
					</p>
					<p><?php echo $shoutout->getText(); ?></p>
					<!--<fb:like href="http://"<?php echo (SITE_ROOT . SHOUTOUT_ROOT); ?>/so.php?id=<?php echo $soid; ?>" send="false" layout="button_count" width="100" show_faces="true"></fb:like> -->
				</div><!-- shoutout container -->
	<hr/>

				

				<?php
				$count+=1;
			} /* For each shoutout */
		} /* else */
	?>
	
	<?php echo $shoutouts->getNav('?page='); ?>
	
	<div class="clearfix"></div>




	<?php endwhile; // Wordpress while ?>


<?php get_footer(); ?>