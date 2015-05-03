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

get_header('minimal');
?>
<div class="block full-width-cover-image full-width-aspect-3by1 pos-bottom" style="background-image:url(<?php echo get_template_directory_uri(); ?>/img/about/protest.jpg)">
	<div class="about-home-header">	
		<div class="header-box">
			<h1>The Badger Herald</h1>
			<h2>A thorn in their side since 1969</h2>
		</div>
	</div> <!-- #wrapper -->
</div>

	<div class="about-nav wrapper">
		<ul class="fixed-sidebar-container">
			<li class="active"><a href="<?php bloginfo("url") ?>/about/">About</a></li>
			<li><a href="<?php bloginfo("url") ?>/about/staff/">Staff</a></li>
			<li><a href="<?php bloginfo("url") ?>/about/get-involved/">Get Involved</a></li>
			<li><a href="<?php bloginfo("url") ?>/about/history/">History</a></li>
			<li style="display: none;"><a href="<?php bloginfo("url") ?>/about/colophon/">Colophon</a></li>
			<li><a href="<?php bloginfo("url") ?>/about/copyright/">Copyright</a></li>
		</ul>
	</div>
	
	<div id="content" class="site-content article-content wrapper" role="main">

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					
				<div class="entry-content">

					<h2 class="entry-title">Founded and powered by Students, The Badger Herald provides an alternative voice on The University of Wisconsin's flagship campus</h2>

					<p>Debuting in fall of 1969, the Herald was born to cover and combat the turmoil of Vietnam protests. The Herald has maintained its maverick spirit to become the widest read paper on campus.</p>

					<p>The Herald remains completely independent of university funding. We are supported by advertising and powered entirely by students. We take great pride in reflecting the tastes and perspectives that are unique to students on the University of Wisconsin-Madison campus.</p>

					<p>The Herald strives to present objective news, entertaining sports and arts coverage and insightful editorial stances that reflect the interests and tastes of UW-Madison’s student community. In the process, we also hope to train the next generation of student journalists for success in any of life’s paths.<p>

					<p>We are a family, dedicated and enthusiastic. As we pursue our goals, we invite you to join us by writing a letter, purchasing an ad, applying for a job or just taking the time to read the paper, online and off.</p>

					<h2>Contact Us</h2>

					<p>Please reach out to us with any feedback, suggestions or concerns.</p>



					<div class="contact-container">
					<h3>Office</h3>
					<p>
					The Badger Herald<br/>
					152 W. Johnson St. Suite 202<br/>
					Madison, Wis 53703-2017<br class="extra-br" />
					<i>Phone:</i> 608-257-4712<br/>
					<i>Fax:</i> 608-258-3029
					</p>

					</div>

					<div class="clearfix"></div>
					<div class="contact-container">
					<h3>Editorial</h3>
					<p>
					Tara Golshan<br/>
					<i>Editor-in-Chief</i><br class="extra-br"/>
					<a href="mailto:editor@badgerherald.com">editor@badgerherald.com</a><br/>
					608-257-4712 x101
					</p>
					</div>

					<div class="contact-container">
					<h3>Business</h3>
					<p>
					John Batterman<br/>
					<i>Publisher</i><br class="extra-br"/>
					<a href="mailto:publisher@badgerherald.com">publisher@badgerherald.com</a><br/>
					608-257-4712 x201
					</p>
					</div>

					<div class="contact-container">
					<h3>Advertising</h3>
					<p>
					Nick Rush<br/>
					<i>Advertising Director</i><br class="extra-br"/>
					<a href="mailto:addirector@badgerherald.com">addirector@badgerherald.com</a><br/>
					608-257-4712 x301
					</p>
					</div>

					<p>For contact information of all editors, photographers and advertising representatives, please see our <a href="<?php bloginfo("url"); ?>/about/staff">staff page</a>.


					<h2>Letters to the Editor</h2>
					<p>Letters to the editor are welcome at <a href="mailto:opinion@badgerherald.com">opinion@badgerherald.com</a>. Letters should be 300-500 words and provide name, relevant position information and student year, status and major if applicable. Publication is based on available space and takes into account relevance and quality. Submissions may be edited by the Herald accordingly. Unsigned letters will not be published. Please include your reply e-mail address with your submission.</p>
				</div><!-- .entry-content -->
			</article><!-- #post -->
		<?php endwhile; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
