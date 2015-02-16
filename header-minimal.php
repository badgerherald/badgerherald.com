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
	<div id="page">

		<div id="masthead" class="block header-block">

			<div class="fixed-bar">

				<?php /* container for the mobile hamburger icon */ ?>
		        <div class="nav-control" alt="Menu"></div>
		        <div class="wrapper bar-content">
		        	<a href="<?php echo bloginfo("url"); ?>"><div class="bar-logo">The Badger Herald</div></a>
		        	<div class="nav-category">
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
		        </div>
		        <?php
			    if (is_single()) { ?>
			        <div class="progress">
			          <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
			          </div>
			        </div>
			    <?php } ?>

			</div>

			<div class="fixed-bar-placeholder"></div>

		</div><?php /* masthead */ ?>