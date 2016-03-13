<?php
/**
 * The default template for displaying content. Used for single. 
 *
 * @package WordPress 
 * @subpackage Twenty_Thirteen 
 * @since Twenty Thirteen 1.0 
 */

global $AnalyticBridge;
global $post;

get_template_part('header'); 

if(exa_hero_media_type() == 'video') : 
?>

	<div class="black" style="padding-top:18px;">
		<?php 
		exa_block('leaderboard');
		exa_block('menu-search-bar',array('background'=>'black'));
		exa_block('header',array('background'=>'black'));
		exa_block('hero-video');
		?>
	</div>

<?php 
else :
	exa_block('header',array('breakpoints' => array('mobile')));
	get_template_part('inc/blocks/cover-hero');
endif;

if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
get_template_part('inc/blocks/content','two-column');
	endwhile; 
else :
	_e( '<p>Something went wrong.</p>' );
endif;
?>



<?php get_template_part('footer');
