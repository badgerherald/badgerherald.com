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

    <?php /* Chartbeat Part 1 */
    	if (hrld_is_production()) {
    ?>
	<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>

	<?php } ?>

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


	<?php /* Facebook like button javascript tag */ ?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=293002107472228";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<div id="page" class="page-container-masthead">
	<div id="wrapper">
	

	<div id="main-header">
	<div id="masthead">

		<nav role="main">
		
		<div class="nav-bar">

			<a href="<?php echo bloginfo("url"); ?>"><div class="bar-logo"><span>The Badger </span>Herald</div></a>
			
			<?php /* container for the mobile hamburger icon */ ?>
	        <div class="nav-control" alt="Menu">
	        </div>

			<div class="nav-container">
				<?php get_search_form( true );  ?>
				<div class="nav-drop-tagline">The University of Wisconsin's Premier Independent Student Newspaper &mdash; <strong>Since 1969</strong></div>

				<ul id="main-nav" class="dropdown-border">
					<li><a href="<?php echo (is_home() ? '#news' : get_bloginfo('url').'/news/'); ?>">News</a></li>
					<li><a href="<?php echo (is_home() ? '#opinion' : get_bloginfo('url').'/oped/'); ?>">Opinion</a></li>
					<li><a href="<?php echo (is_home() ? '#artsetc' : get_bloginfo('url').'/artsetc/'); ?>">ArtsEtc.</a></li>
					<li><a href="<?php echo (is_home() ? '#sports' : get_bloginfo('url').'/sports/'); ?>">Sports</a></li>
		            <?php /* <li><a href="<?php bloginfo('url'); ?>">Comics</a></li> */ ?>
					<li><a href="<?php bloginfo('url'); ?>/shoutouts/">Shoutouts</a></li>
					<li class="about-off"><a href="<?php bloginfo('url'); ?>/about/">About</a></li>
					<li><a href="http://themadisonmisnomer.com/">Misnomer</a></li>
					<li><a href="<?php bloginfo('url'); ?>/advertise/">Advertise</a></li>
				</ul>

				<div class="clearfix"></div>

			</div>

			<div class="current-nav">
				<?php
					if (!is_page()) {
						echo ucfirst($wp_query->query_vars['category_name']);
					} else {
						echo ucfirst($wp_query->query_vars['name']);
					}
				?>
			</div>

			<div class="title">
				<?php
					if (is_single()) {
						$post_author = get_userdata($post->post_author);
						echo $post->post_title;
						echo '<span class="byline"> <i>by</i> '.$post_author->display_name.'</span>';
					}
				?>
			</div>

			<div class="exit-nav-open sm-only"></div>

		</div><!-- class="nav-bar" -->
		
		</nav>

	</div> <!-- #masthead -->
	</div><!-- #main-header -->
	</div> <!-- #wrapper -->
	<?php
	if (is_single()) { ?>
		<div class="progress">
		  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
		  </div>
		</div>
	<?php } ?>
	</div> <!-- #page -->

	<div id="page" class="page-container-inner-masthead">
	<div id="wrapper">
	
	<a id="logo" href="<?php bloginfo('url'); ?>">
		<div class="logo-image"><img src="<?php bloginfo('template_url') ?>/img/logo/header-7.png" /></div>
	</a>
	<?php /* inner-masthead contains elements 'framed' by the logo and the navbar */ ?>
	<div id="inner-masthead">

		<div class="inner-mast-tagline">
			UW-Madison's Premier Independent Student Newspaper.  <span class="since"><strong>Since 1969</strong></span>
		</div>
		<?php dfp::hrld_top_leaderboard_ad(); ?>
		<a class="advertise-plug" href="http://badgerherald.com/advertise/">Student Org? Local Business? Advertise with the Herald.</a>
		
		<div class="social-buttons">

			<div class="twitter">
				<a href="https://twitter.com/badgerherald" class="twitter-follow-button" data-show-count="false">Follow @badgerherald</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			</div><!-- .twitter -->

			<div class="facebook">
				<div class="fb-like" data-href="http://facebook.com/badgerherald" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
			</div><!-- .facebook -->

		</div><!-- .social-buttons -->

	</div> <!-- #inner-masthead -->


	
	</div> <!-- #wrapper -->
	</div> <!-- #page -->

	<div id="page" class="page-container-content">
	<div id="wrapper">
	

	<div id="primary">

	<div id="main" class="site-main">

