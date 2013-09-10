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
	<title><?php bloginfo('name'); ?> · <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<!-- Google fonts -->
	<link href='http://fonts.googleapis.com/css?family=Noto+Serif:400,700,400italic,700italic|Yanone+Kaffeesatz:400,300,700|Open+Sans' rel='stylesheet' type='text/css'>

	<script type='text/javascript'>
var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];
(function() {
var gads = document.createElement('script');
gads.async = true;
gads.type = 'text/javascript';
var useSSL = 'https:' == document.location.protocol;
gads.src = (useSSL ? 'https:' : 'http:') + 
'//www.googletagservices.com/tag/js/gpt.js';
var node = document.getElementsByTagName('script')[0];
node.parentNode.insertBefore(gads, node);
})();
</script>

<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/8653162/front-leaderboard', [728, 90], 'div-gpt-ad-1378705451226-0').addService(googletag.pubads());
googletag.defineSlot('/8653162/sitewide.leaderboard.top.728x90', [728, 90], 'div-gpt-ad-1378705451226-1').addService(googletag.pubads());
googletag.defineSlot('/8653162/Sitewide.Rectangle.Sidebar.336x280', [[300, 250], [336, 280]], 'div-gpt-ad-1378705451226-2').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>

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
			<li><a href="<?php bloginfo('url'); ?>/about/">About</a></li>
			<li class="search-button">
				<a href="<?php bloginfo('url'); ?>/search/">Search</a>
				<?php /*<input type="text" placeholder="Search for..." value="SEARCH" /> */ ?>
				<?php get_search_form( true ); ?>
			</li>
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

