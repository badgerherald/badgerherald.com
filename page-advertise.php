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

get_header(); ?>

	<div class="content-area" style:"width:100%;position:relative;">
		

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

<div style="width:100%;position:absolute;top:20;font-family:Yanone Kaffeesatz;color:#000;font-size:120%;padding:20px;">
<h3>For advertising inquiries, please contact:</h3>
<strong>Nick Rush</strong><br />
<span style="font-weight:300;font-size:80%">ADVERTISING DIRECTOR
608.257.6899<br />
<a href="mailto:addirector@badgerherald.com" style="font-size:90%">addirector@badgerherald.com</a>
</div>
			
<div class="full-width" id="content-box" style:"width:100%;position:absolute;">
<div style="width:100%;float:left">
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/1.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/3.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/4.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/5.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/6.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/7.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/8.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/9.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/10.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/11.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/12.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/13.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/14.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/15.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/16.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/17.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/18.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/19.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/20.png" width="100%" />
<img src="<?php bloginfo('template_directory'); ?>/img/mediakit/21.png" width="100%" />
</div>



  <div class="clearfix" ></div>
  </div><!-- full-width -->










			
			<?php endwhile; ?>


	</div>
<?php get_footer(); ?>
