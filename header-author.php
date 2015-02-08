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


	<title><?php bloginfo('name'); ?> · <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
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


    <?php get_sidebar('pullout'); ?>
		<div id="page">

			<div id="masthead">
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
			                    } elseif (is_author()) {
    								$author = get_user_by('id', get_query_var('author'));
    								echo $author->display_name;
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
				<div class="inner-masthead">

					<script>
					jQuery(document).ready(function(){
						var banner = jQuery('#hrld_author_top_banner'),
							target_width = banner.parent().width(),
							target_height = (banner.attr('banner_ratio')) * target_width;
						
						banner.css( 'width', '100%');
						banner.css( 'height', target_height);
						
						
						var sidebar_height = jQuery('#sidebar').css('height');
						jQuery('#stream').css('min-height',sidebar_height);
						
					});

					</script>
					<?php 
						$img_src_id = get_the_author_meta( '_hrld_staff_banner', get_query_var('author') );
						if ($img_src_id != '')	{
							$img_src = wp_get_attachment_image_src($img_src_id, 'author-banner');
							if( $img_src == false)
								$img_src = wp_get_attachment_image_src($img_src_id, 'full');
							$url = $img_src[0];
							$width = $img_src[1];
							$height = $img_src[2];
							$hwRatio = $height/$width;
							if( $hwRatio > 0.31 )
								$hwRatio = 0.31;
							/**
							*
							* This is now being taken care of through jQuery.
							*
							* if ( isset( $content_width ) ) {
							* 	$width = $content_width - 10;
							* 	$height = $hwRatio * $width;
							* }
							*
							**/
							echo '<div id="hrld_author_top_banner" banner_ratio="'.$hwRatio.'" class="hrld_author_top_banner" style="background: linear-gradient(to bottom, rgba(0,0,0,0),rgba(0,0,0,0.4)), url(\''.$url.'\'); background-position: center; background-repeat: no-repeat; background-position: center; background-size: cover; width: 100%; height: '.$height.'px"> </div>';
						}
					?>
				</div>
			</div>


			<div id="primary" class="wrapper">

<?php /*
			</div> <!-- END div#primary -->
		</div> <!-- END div#page -->
    </body>
</html>
*/
?>


