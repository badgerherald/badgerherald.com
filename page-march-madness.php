<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
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

    <title><?php 

    if(is_404()) {
        echo "4-doge-4 · The Badger Herald";
    } else {
        bloginfo('name'); ?> · <?php is_home() ? bloginfo('description') : wp_title(''); 
    }

    ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
    <![endif]-->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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




<div id="page" class="page-container-masthead">
    <div id="wrapper">
    

    <div id="main-header">
    <div id="masthead">

        <nav role="main">
        
        <div class="nav-bar">

            <a href="<?php echo bloginfo("url"); ?>"><div class="bar-logo">

            </div></a>
            
            <?php /* container for the mobile hamburger icon */ ?>
            <div class="nav-control" alt="Menu">
                 <div class="nav-icon" ></div>
            </div>
            
            <div class="nav-container">

                <div class="nav-drop-tagline">The University of Wisconsin's Premier Independent Student Newspaper &mdash; <strong>Since 1969</strong></div>

                <ul id="main-nav" class="dropdown-border">
                    <li><a href="<?php echo (is_home() ? '#news' : get_bloginfo('url').'/news/'); ?>">News</a></li>
                    <li><a href="<?php echo (is_home() ? '#opinion' : get_bloginfo('url').'/oped/'); ?>">Opinion</a></li>
                    <li><a href="<?php echo (is_home() ? '#artsetc' : get_bloginfo('url').'/artsetc/'); ?>">ArtsEtc.</a></li>
                    <li><a href="<?php echo (is_home() ? '#sports' : get_bloginfo('url').'/sports/'); ?>">Sports</a></li>
                    <li><a href="<?php bloginfo('url'); ?>/shoutouts/">Shoutouts</a></li>
                    <li class="about-off"><a href="<?php bloginfo('url'); ?>/about/">About</a></li>
                    <li><a href="http://themadisonmisnomer.com/">Misnomer</a></li>
                    <li><a href="<?php bloginfo('url'); ?>/advertise/">Advertise</a></li>
                <li>
                        <a class="search-link" href="<?php bloginfo('url'); ?>/search/">Search</a>
                        <?php /*<input type="text" placeholder="Search..." value="SEARCH" /> */ ?>
                        <?php get_search_form( true );  ?>
                    </li> 
                </ul>


                <div class="clearfix"></div>

            </div>

        </div><!-- class="nav-bar" -->
        
        </nav>

    </div> <!-- #masthead -->
    </div><!-- #main-header -->

    
    </div> <!-- #wrapper -->
    </div> <!-- #page -->
       
        <!--
		<div id="page" class="page-container-fixed-inside">

		<div class="header-sca-2014">
            <a href="http://badgerherald.com"><div class="student-herald-logo">
               
            </div></a>
		</div>

		</div> <!-- #page -->

		<div id="page" class="march-madness-content" ng-app="marchMadness">
		<div id="wrapper">
		<div id="primary">
        <div class="header-mm-2014">
            <div class="triangle-up-container"><div class="triangle-up"></div></div>
            <div class="herald-logo"><img src="<?php echo get_template_directory_uri() ?>/img/march-madness/hrld-logo-mm.png"></div>
            <h1 class="mm-title">March Madness Top Picks</h1>
        </div>
		<div id="main" class="site-main">

		<div id="content" class="site-content" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class('view-animate'); ?> ng-view>
			</article><!-- #post -->
		</div><!-- #content -->

         

<div class="clearfix"></div>
        </div> <!-- #main -->


                    <div class="colophon" style:"font-family:'pt sans'">
    All Content &copy; The Badger Herald, 2013

     <div class="triangle-down-container"><div class="triangle-down"></div></div>
    </div>
    <div class="sponsor-logos">
        <h3>Sponsors</h3>
        <ul class="sponsor-logos">
            <li class="madness-sponsor-ians"><a href="#"><span>Ian's Pizza</span></a></li>
            <li class="madness-sponsor-anytime"><a href="#"><span>Anytime Fitness</span></a></li>
            <li class="madness-sponsor-fontana"><a href="#"><span>Fontana Sports</span></a></li>
            <li class="madness-sponsor-cyc"><a href="#"><span>CYC Fitness</span></a></li>
            <li class="madness-sponsor-sett"><a href="#"><span>The Sett</span></a></li>
            <li class="madness-sponsor-toppers"><a href="#"><span>Toppers Pizza</span></a></li>
        </ul>
    </div>
    </div><!-- #primary -->



    </div><!-- #page -->


    </div><!-- id="wrapper" -->


<?php /* TODO:  Do this in a WP way */ ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/exa.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.1/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.1/angular-resource.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.1/angular-route.min.js"></script>
    <script src="<?php echo get_template_directory_uri()?>/march_madness_app/march-madness.js"></script>
    <?php wp_footer(); ?> 

    <?php /* TODO:  Only load this on the homepage */ ?>
    <script type="text/javascript">

        <?php 
        global $homepageSlider;
        if($homepageSlider == true) :
        /**
         * Setup
         * 
         * Setup for swipe library.
         */ ?>
        var speed = 600;
        var auto = 5000;
        window.mySwipe = new Swipe(document.getElementById('swipe'), {
            startSlide: 0,
            speed: speed,
            auto: auto,
            continuous: true,
            disableScroll: false,
            stopPropagation: false,
            callback: swiped,
            transitionEnd: function(index, elem) {}
        });

        swiped(0,document.getElementById('slider'));

        <?php 
        /**
         * Function: swiped
         * 
         * Callback function that highlights the new slider 
         * position on the slider navigation.
         *
         * @param index the index of the now active slider 
         * @param elem DOM element of the slider
         */ ?>
        function swiped(index,elem) {
            $(".slider-nav").find('li').removeClass("active").eq(index).addClass("active");
        }

        <?php 
        /**
         * Listener
         * 
         * Listens for clicks on the slider nav to change
         * slider position.
         */ ?>
        $(".slider-nav li").click(function() {

            var index = $(".slider-nav").find("li").index($(this));

            window.mySwipe.slide(index,speed);

        });

        <?php endif; /* homepageSlider */ ?>
        

    </script>


    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-2337436-1']);
        _gaq.push(['_trackPageview']);

        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
</body>
</html>
