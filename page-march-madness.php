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


get_header("just-head");
?>

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.1/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.1/angular-resource.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.1/angular-route.min.js"></script>
        <script src="<?php echo get_template_directory_uri()?>/march_madness_app/march-madness.js"></script>

		<div id="page" class="page-container-fixed-inside">

		<div class="header-sca-2014">
            <a href="http://badgerherald.com"><div class="student-herald-logo">
               
            </div></a>
		</div>

		</div> <!-- #page -->

		<div id="page" class="march-madness-content" ng-app="marchMadness">
		<div id="wrapper">
		<div id="primary">
		<div id="main" class="site-main">

		<div id="content" class="site-content" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> ng-view>
			</article><!-- #post -->
		</div><!-- #content -->
<?php get_footer(); ?>
