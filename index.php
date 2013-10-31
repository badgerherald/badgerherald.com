<?php
/**
 *
 * BH Homepage Theme.
 * 
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); 
hrld_top_leaderboard_ad();

?>

<div class="twitter-box">

<h2>Follow us on Twitter</h2>
<p>Don't miss a beat by following us on twitter</p>
<a href="https://twitter.com/badgerherald" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @badgerherald</a>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

</div>


	<div id="stream">

	<?php if ( have_posts() ) : ?>

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php if(exa_is_featured()) : ?>
				<?php get_template_part( 'content', 'summary-featured' ); ?>
			<?php elseif(exa_is_instream()) : ?>
				<?php get_template_part( 'content', 'summary-instream' ); ?>
			<?php endif; ?>
			<hr />
			
		<?php endwhile; ?>

		<?php twentythirteen_paging_nav(); ?>

	<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>

	</div><!-- id="stream" -->

	<?php get_sidebar(); ?>

	<div id="clearfix"></div>



<?php get_footer(); ?>