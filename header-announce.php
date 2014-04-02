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

    <?php /* Chartbeat Part 1 */ ?>
	<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>


	<title><?php bloginfo('name'); ?> · <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<!-- Google fonts -->
	<link href='http://fonts.googleapis.com/css?family=Noto+Serif:400,700,400italic,700italic|Yanone+Kaffeesatz:400,300,700|Open+Sans' rel='stylesheet' type='text/css'>

	<?php hrld_dfp_header() ?>

<link rel="icon" 
      type="image/png" 
      href="favicon.png?v=exa6">

</head>

<body <?php body_class(); ?>>

	<div id="masthead">
		<div id="tagline">
			UW-Madison's Premier Independent Student Newspaper <strong> &mdash; since 1969</strong>.
		</div>
		<a href="<?php bloginfo('url'); ?>">
			<img id="logo" src="<?php bloginfo('template_url') ?>/img/logo/header-2.png" />
		</a>

		<nav role="main">
		<ul id="nav">
			<li><a href="<?php bloginfo('url'); ?>/news/">News</a></li>
			<li><a href="<?php bloginfo('url'); ?>/oped/">Opinion</a></li>
			<li><a href="<?php bloginfo('url'); ?>/artsetc/">ArtsEtc.</a></li>
			<li><a href="<?php bloginfo('url'); ?>/sports/">Sports</a></li>
			<li><a href="<?php bloginfo('url'); ?>/shoutouts/">Shoutouts</a></li>
			<li><a href="http://themadisonmisnomer.com/">Misnomer</a></li>
			<li><a href="<?php bloginfo('url'); ?>/advertise/">Advertise</a></li>
			<li class="about-off"><a href="<?php bloginfo('url'); ?>/about/">About</a></li>
			<li>
				<a href="<?php bloginfo('url'); ?>/search/">Search</a>
				<?php /*<input type="text" placeholder="Search..." value="SEARCH" /> */ ?>
				<?php /*get_search_form( true ); */ ?>
			</li> 
		</ul>
		</nav>

	</div>

	<div id="page">
	<div id="page-inner">
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


		<style type="text/css">
		#alert {
			background: #BA0F0F;

			color: #fff;
			margin-top:24px;
			padding: 20px;
		}
		#alert h2 {
			font-family: "Yanone Kaffeesatz";
			text-transform: uppercase;	
			margin-bottom: 6px;
			font-weight: 300;
		}
		#alert hr {
			opacity: .4;
		}
		#alert .time {
			opacity: .6;
		}
		.more-updates a {
			color: #000;
			font-family: "open sans";
			font-weight: bold;
		}
		.more-updates a:hover {
			opacity:.6;
		}
		</style>

		<div id="alert">
			<h2><strong>Breaking</strong>:  Shots fired on Langdon</h2>
			<hr />
			<p> WiscAlert reports shots fired at 130 Langdon Street. Suspect seen heading towards Memorial Union. <span class="time">6:40p.m.</span></p>
			<hr />
			<p> WiscAlert reports suspect in shots fired. Last seen heading west on lake path towards lakeshore residence halls. Shelter in place. <span class="time">6:48p.m.</span></p>
			<hr />
			<p>Suspect is a black male wearing black clothing, black/white baseball cap and dark backpack. <span class="time">7:14p.m.</span></p>
			<hr />
			<p>Police still searching west of Memorial Union on lakeshore path for suspect in Langson St shots fired. Shelter in place. <span class="time">7:50p.m.</span></p>
			<hr />
			<p class="more-updates"><a href="http://badgerherald.com/news/2013/09/18/developing-shots-reported-at-130-langdon-suspects-at-large/" />More Updates <img src="http://badgerherald.com/wordpress/wp-content/themes/exa/img/icons/arrow-right-black.png" /></a></p>

			
		</div>

