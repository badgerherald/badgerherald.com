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

// Add a body class to target styling.

function about_class($classes) {
	$classes[] = 'about-page';
	return $classes;
} add_filter('body_class','about_class');

function displayStaff($staffArray) {

	$i = 0;
	foreach($staffArray as $staff) :
		$classes = "";
		if($i%2!=0) {
			$classes .= "odd ";
		} $i+=1;
		echo "<div class='staff-box'>";

		if( is_string($staff) ) {
			$user = get_userdatabylogin($staff);
			$staff = $user->ID;
		}

		$aMug = hrld_resize(null,get_wp_user_avatar_src($staff, 'original'),400,280,true);
		
		// Mug
		echo "<div class='staff-about-mug-box'><img src='{$aMug['url']}' /></div>";

		// Name
		echo "<span class='staff-box-name'>" . get_the_author_meta("display_name",$staff) . "</span>";
		
		// Position
		echo "<span class='staff-box-current-position'>";
		hrld_author("hrld_current_position",$staff);
		echo "</span>";

		// Twitter and more.

		echo "<span class='staff-box-twitter-more'>";
			// If twitter
			if(hrld_author_has("hrld_twitter_handle",$staff)) {
				$twitter_handle = get_hrld_author("hrld_twitter_handle",$staff);
				echo "<a href='https://twitter.com/$twitter_handle' class='twitter-follow-button' data-show-count='false' data-show-screen-name='false'>Follow @$twitter_handle</a>";
				echo "<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>";
			}
			// More
			echo "<div class='staff-box-more'>";
				echo "<span class='staff-box-more-button'>More<span class='staff-box-more-arrow'></span></span>";
				echo "<div class='staff-box-more-hover $classes'>";
				echo "<div class='staff-box-more-hover-card'>";
					if(hrld_author_has("hrld_staff_description",$staff)) {
						echo "<p class='staff-box-more-description'>";
							hrld_author("hrld_staff_description",$staff);
						echo "</p>";
					}

					if(hrld_author_has("hrld_staff_semesters",$staff)) {
						echo "<p> Semesters at the Herald: ";
						hrld_author("hrld_staff_semesters",$staff);
						echo ".</p>";
					}
					
					echo "<p class='staff-box-more-email'>";
						echo "<a href='mailto:" . get_the_author_meta( "email", $staff ) . "'>" . get_the_author_meta( "email", $staff ) . "</a>";
						if(hrld_author_has("hrld_staff_extension",$staff)) {
							echo "<br/>608-257-4712 " . get_hrld_author("hrld_staff_extension",$staff);
						}
					echo "</p>";
				echo "</span>";
				echo "</div>";
				echo "</div>";
			echo "</div>";
		echo "</span>";
			
		echo "</div>";

	endforeach;
}

function listWriters($section,$exclude = null) {

	// people like staff, editorial board, &c.
	$globalExclude = array(1023,4,2792,2857,2858);
	if(!$exclude) {
		$exclude = array();
	}
	$exclude = array_merge($globalExclude,$exclude);

	/* Last four months */ 
	$sdate = new DateTime();				// Time now.
	$sdate->sub(new DateInterval('P4M'));	// Subtract 4 months.


	if( class_exists('hrld_get_writers') ) {

		echo "Writers: ";
		$newsWriters = new hrld_get_writers();
		$newsWriters->section($section);
		$newsWriters->num_published(3,'more',$sdate);
		$writers = $newsWriters->query();
		$first = true;
		foreach($writers as $w) {
			if( !in_array($w->user_id,$exclude) ) :
				if(!$first) {
					echo ", ";
				} $first = false;
				echo "<a href='" . get_author_posts_url( $w->user_id ) . "'>$w->display_name</a>";
			endif;
		}
	}

}

get_header('about'); ?>


	<div class="about-nav fixed-sidebar-container">
		<ul>
			<li><a href="<?php bloginfo("url") ?>/about/">About</a></li>
			<li class="active"><a href="<?php bloginfo("url") ?>/about/staff/">Staff</a></li>
			<li><a href="<?php bloginfo("url") ?>/about/get-involved/">Get Involved</a></li>
			<li><a href="<?php bloginfo("url") ?>/about/history/">History</a></li>
			<li style="display: none;"><a href="<?php bloginfo("url") ?>/about/colophon/">Colophon</a></li>
			<li><a href="<?php bloginfo("url") ?>/about/copyright/">Copyright</a></li>
		</ul>
	</div>

	<div id="content" class="site-content article-content" role="main">

		<?php /* The loop */ ?>


		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
				<div class="entry-content">
				<h2>The Newsroom</h2>
				
				<?php


					$mgmt = array('tgolshan','kcaron','procha');
					$news = array('aarriaga', 'rlallensack', 'dmckay', 'nkravinsky', 'mcarney', 'lreigstad','sporps-hummell' );
					// Brianna, Maddie
					$opinion   = array(2785, 2807);
					// Dan, Eric, Chris
					$sports   = array(2609, 2682, 2801);
					// Erik, Selena 
					$arts   = array(2602, 2794);
					// Joey, Hayley
					$photo   = array(2948, 2966);
					// Emily, Kenna 
					$design   = array(2963, 2964);
					// Maddy, Audrey 
					$copy   = array(2780, 2806);
					// Matt 
					$web   = array(2779);

					// editorial staff excude.
					$exclude = array_merge($mgmt,$news,$opinion,$sports,$arts,$photo,$design,$copy,$web);
				?>

				<div class="staff-container">
					<h3>Editorial Management</h3>
					<?php displayStaff($mgmt); ?>
					<div class="clearfix"></div>
				</div>

				<div class="staff-container">
					<h3>News</h3>
					<?php displayStaff($news); ?>
					<div class="clearfix"></div>
				</div>

				<p class="staff-writers"><?php listWriters('news',$exclude);?></p>

				<div class="staff-container">
					<h3>Opinion</h3>
					<?php displayStaff($opinion); ?>
					<div class="clearfix"></div>
				</div>
				
				<p class="staff-writers"><?php listWriters('oped',$exclude);?></p>
				
				<div class="staff-container">
					<h3>Sports</h3>
					<?php displayStaff($sports); ?>
					<div class="clearfix"></div>
				</div>

				<p class="staff-writers"><?php listWriters('sports',$exclude);?></p>

				<div class="staff-container">
					<h3>ArtsEtc</h3>
					<?php displayStaff($arts); ?>
					<div class="clearfix"></div>
				</div>

				<p class="staff-writers"><?php listWriters('artsetc',$exclude);?></p>

				<div class="staff-container">
					<h3>Photo</h3>
					<?php displayStaff($photo); ?>
					<div class="clearfix"></div>
				</div>

				<div class="staff-container">
					<h3>Design</h3>
					<?php displayStaff($design); ?>
					<div class="clearfix"></div>
				</div>

				<div class="staff-container">
					<h3>Copy</h3>
					<?php displayStaff($copy); ?>
					<div class="clearfix"></div>
				</div>

				<div class="staff-container">
					<h3>Web</h3>
					<?php displayStaff($web); ?>
					<div class="clearfix"></div>
				</div>

				<h2>Business Staff</h2>
				
				<div class="staff-container">
					<h3>Business Department</h3>

					<?php
						// John, Tyler
						$mgmt = array(2945, 2971);
						displayStaff($mgmt);
					?>
					<div class="clearfix"></div>
				</div>
				<div class="staff-container">
					<h3>Advertising</h3>

					<?php
						// Nick, David, Jordan, Zach, Nisha, Emily
						$mgmt = array(2965, 2972, 2973, 2974, 2975, 2976);
						displayStaff($mgmt);
					?>
					<?php /*
					<div class="clearfix"></div>
					<h3>Marketing</h3>

					<?php
						// Katherine Krueger, Katie Caron, Will Haynes.
						$mgmt = array(2274,2420,2608,2274,2420,2608);
						displayStaff($mgmt);
					*/ ?>
		

				</div>

				</div><!-- .entry-content -->

			</article><!-- #post -->
		<?php endwhile; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
