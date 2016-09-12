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

if(exa_hero_media() == 'video') : 
?>

	<div class="black" style="padding-top:18px;">
		<?php 
		exa_container('leaderboard');
		exa_container('menu-search-bar',array('background'=>'black'));
		exa_container('header',array('background'=>'black'));
		exa_container('hero-video');
		?>
	</div>

<?php 
else :
	exa_container('header',array('breakpoints' => array('mobile')));
	exa_container('cover-hero');
endif;

if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
		exa_container('content-two-column',array('layout'=>exa_layout()));
	endwhile; 
else :
	_e( '<p>Something went wrong.</p>' );
endif;
?>



<?php get_template_part('footer');
