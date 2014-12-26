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

    <?php /* Chartbeat Part 1 */ ?>
	<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>

	<title><?php echo wp_title("&middot;",true,"right"); ?>

	<?php
	/*
	if( is_404() ) {
		echo "404 &middot; " . bloginfo('name');
	} else if( is_home() ) {
		echo bloginfo('name') . " &middot " . bloginfo('description') . "."; 
	} else {
		echo wp_title('') . " &middot " . bloginfo('name'); 
	} */

	?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<!-- 
		Google fonts 
		TODO: move to wordpress enque
	-->
	<link href='http://fonts.googleapis.com/css?family=Noto+Serif:400,700,400italic,700italic|Yanone+Kaffeesatz:400,300,700|Open+Sans|PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>

	<?php dfp::hrld_dfp_header() ?>

	<link rel="icon" 
     	type="image/png" 
     	href="favicon.png?v=exa6">

</head>

<body <?php body_class(); ?>>

	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=293002107472228";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>



	<div id="page" class="page-container-content">
	<div id="wrapper">
	<a id="logo" href="<?php bloginfo('url'); ?>" style="float:none; width: inherit;">
		<div>&#8592;Return to BadgerHerald.com</div>
	</a>

	<div id="primary" style="margin-top:5px;">

	<div id="main" class="site-main">
