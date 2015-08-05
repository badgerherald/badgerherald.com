<?php
/**
 * The Header for our theme.
 */
include('macros.php');

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
	<?php get_template_part('inc/block','leaderboard'); ?>
	<?php get_template_part('inc/blocks/mobile-header'); ?>
	<?php get_template_part('inc/blocks/header'); ?>