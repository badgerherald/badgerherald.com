<?php

function open_db($dbstr, $username, $password, $options) {
	$dbh = new PDO($dbstr, $username, $password);
	$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	return $dbh;
}

function find_participant($dbh, $email, $quiz_name) {
	$participant_stmt = $dbh->prepare("SELECT * FROM Participants WHERE email = ? AND quiz = ?");
	$participant_stmt->execute(array($email, $quiz_name));
	$results = $participant_stmt->fetchAll();
	if (count($results) < 1) {
		return NULL;
	}
	return $results[0]["id"];
}

function create_participant($dbh, $email, $quiz_name) {
	$index_stmt = $dbh->prepare("SELECT MAX(id) FROM Participants");
	$index_stmt->execute(array());
	$new_id = $index_stmt->fetchAll()[0][0] + 1;
	$add_stmt = $dbh->prepare("INSERT INTO Participants (id, email, quiz) VALUES (?, ?, ?)");
	$add_stmt->execute(array($new_id, $email, $quiz_name));
	// Ugly hack
	return find_participant($dbh, $email, $quiz_name);
}

function add_vote($dbh, $participant_id, $option_id) {
	if ($option_id === null) {
		return;
	}
	$index_stmt = $dbh->prepare("SELECT MAX(id) FROM Votes");
	$index_stmt->execute(array());
	$new_id = $index_stmt->fetchAll()[0][0] + 1;
	$add_stmt = $dbh->prepare("INSERT INTO Votes (id, participant_id, option_id) VALUES (?, ?, ?)");
	$add_stmt->execute(array($new_id, $participant_id, $option_id));
}

function process_team($dbh, $participant_id, $team) {
	$option_id = ($team->regionIdx * 16) + $team->teamIdx;
	//add_vote($dbh, $participant_id, $option_id);
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$data = $request->userChoices;

	$quiz_name = "march-madness-2014";
	$dbstr = "mysql:host=localhost;dbname=hrld_wp";
	$username = DB_USER;
	$password = DB_PASSWORD;
	$options = array();
	//$dbh = open_db($dbstr, $username, $password, $options);

	echo "here\n";
	$name = $data->name;
	echo "Name: $name\n";
	$email = $data->email;
	echo "Email: $email\n";
	//$participant = find_participant($dbh, $email, $quiz_name);
	$participant = NULL;
	if ($participant === NULL) {
		//$participant = create_participant($dbh, $email, $quiz_name);
		$participant = 1;
		foreach($data->mainTeams as $team) {
			process_team($dbh, $participant, $team);
			$name = $team->name;
			echo "Team: $name\n";
		}

		foreach($data->finalTeams as $team) {
			process_team($dbh, $participant, $team);
			$name = $team->name;
			echo "Final team: $name\n";
		}

		foreach($data->winningTeam as $team) {
			process_team($dbh, $participant, $team);
			$name = $team->name;
			echo "Winning team: $name\n";
		}
	} else {
		echo "Not valid!";
	}

} else {

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
    <div class="mm-backdrop">

    </div>
<div id="page" class="page-container-masthead" >



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





		<div id="page" class="march-madness-content" ng-app="marchMadness">

		<div id="wrapper" style="background:none">
		<div id="primary" style="background:none">
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
        <div class="triangle-down-container">
            <div class="triangle-down"></div>
        </div>
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
        All Content &copy; The Badger Herald, 2014
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


<?php get_footer("just-foot");

} // endif

?>