<?php
/**
 * The Header for our theme.
 */
define('WEBPRESS_STENCIL_NAMESPACE', 'badgerherald');
?><!DOCTYPE html>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

	<?php /* Remove 300ms tap delay for mobile zoom */ ?>
	<meta name="viewport" content="width=device-width, user-scalable=no" />

	<!-- Chartbeat timestamp -->
	<script type="text/javascript"> var _sf_startpt=(new Date()).getTime() </script>

	<title><?php echo wp_title("&middot;",true,"right"); ?></title>

	<style> 
	.grecaptcha-badge { opacity: 0; } 
	</style>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>