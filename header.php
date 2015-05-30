<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
include('macros.php');

global $DoubleClick;

?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	
	<meta name="viewport" content="width=device-width, 
	minimum-scale=1.0, maximum-scale=1.0">

	<?php /* Remove 300ms tap delay for mobile zoom */ ?>
	<meta name="viewport" content="width=device-width, user-scalable=no">

	<!-- Chartbeat timestamp -->
	<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>

	<title><?php echo wp_title("&middot;",true,"right"); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php /* Facebook like button javascript tag */ ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=293002107472228";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php get_sidebar('pullout'); ?>

<?php /* #page opened here, closed in footer.php */ ?>
<div id="page">

	<?php get_template_part('inc/block','fixed-bar'); ?>

	<div class="standing-head-block block">
		
		<div class="wrapper">
			
			<a id="logo" href="<?php bloginfo('url'); ?>">
				<div class="logo-image"><img src="<?php bloginfo('template_url') ?>/img/logo/header-7.png" /></div>
			</a>

			<div class="tagline">
				UW-Madison's Premier Independent Student Newspaper.  <span class="since"><strong>Since 1969</strong></span>
			</div>
			<div id='ad-leaderboard' class='top-leaderboard'>
				<?php $DoubleClick->place_ad('bh:leaderboard','728x90',array('desktop','xl','tablet')); ?>
			</div>
			<a class="advertise-plug" href="http://advertise.badgerherald.com/">Student Org? Local Business? Advertise with the Herald.</a>
			
			<div class="social-buttons">

				<div class="twitter">
					<a href="https://twitter.com/badgerherald" class="twitter-follow-button" data-show-count="false">Follow @badgerherald</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				</div><!-- .twitter -->

				<div class="facebook">
					<div class="fb-like" data-href="http://facebook.com/badgerherald" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
				</div><!-- .facebook -->

			</div><!-- .social-buttons -->
		</div>

	</div><?php /* masthead */ ?>