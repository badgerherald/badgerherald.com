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

<?php /* The loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content', get_post_format() ); ?>
	<div class="clearfix"></div>

    <div class="bottom-inhouse badger-like-inhouse">
    	<div class="badger-like-inhouse-content">
    	<h2>Strut your stuff.</h2>
    	<h3>'Like' The Badger Herald on Facebook for campus news and entertainment.</h3>
    	<div class="like-box">
    		<div class="fb-like" data-href="https://facebook.com/badgerherald" data-width="300" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div>
    		<div class="clearfix"></div>
    	</div>
    	</div>
    </div>

	<?php comments_template(); ?>
    <?php exa_get_tweets_API(); ?>
    <div class="clearfix"></div>

<?php endwhile; ?>

<?php get_footer(); ?>