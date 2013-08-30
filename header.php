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
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="masthead">
		<div id="tagline">
			UW-Madison's Premier Independent Student Newspaper <strong> &mdash; since 1969</strong>.
		</div>
		<a href="<?php bloginfo('url'); ?>">
			<img id="logo" src="<?php bloginfo('template_url') ?>/img/logo/header.png" />
		</a>

		<nav role="main">
		<ul id="nav">
			<li><a href="<?php bloginfo('url'); ?>/news/">News</a></li>
			<li><a href="<?php bloginfo('url'); ?>/oped/">Oped</a></li>
			<li><a href="<?php bloginfo('url'); ?>/artsetc/">ArtsEtc.</a></li>
			<li><a href="<?php bloginfo('url'); ?>/sports/">Sports</a></li>
			<li><a href="<?php bloginfo('url'); ?>/shoutouts/">Shoutouts</a></li>
		</ul>
		</nav>

	</div>

	<div id="page">
		<div id="primary">
		<?php /*
		<header id="masthead" class="site-header" role="banner">
			<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</a>

			<div id="navbar" class="navbar">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					<h3 class="menu-toggle"><?php _e( 'Menu', 'twentythirteen' ); ?></h3>
					<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentythirteen' ); ?>"><?php _e( 'Skip to content', 'twentythirteen' ); ?></a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
					<?php get_search_form(); ?>
				</nav><!-- #site-navigation -->
			</div><!-- #navbar -->
		</header><!-- #masthead --> */ ?>

		<div id="main" class="site-main">

		<div id="ad-leaderboard">
		<a href="#"><img src="<?php bloginfo('template_url'); ?>/img/temp/charter.728x90.jpg"></a>
		</div>

