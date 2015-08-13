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

global $wp_query;



/**** A bunch of old stuff (that works?) **/

include("shoutouts/functions.php");

if(isset($wp_query->query_vars['so_page'])) {

	$so_page = $wp_query->query_vars['so_page'];

} // End if

if(isset($wp_query->query_vars['so_num'])) {

	$singleSO = true;
	$soNum = $wp_query->query_vars['so_num'];

} // End if

if(!$so_page) {
	$so_page = 1;
}

$shoutouts = new ShoutoutList($so_page,40);

	/* First, we fetch the current set of shoutouts 'setid', from the export date table */
	$setid = mysql_fetch_assoc(mysql_query('SELECT MAX(setidofexported) as "setid" FROM shoutouts_exports'));
	$setid = (int)$setid[setid];

$error = false;


	$success = get_query_var('success',0);

if ($_POST && !$success) {

	/* Next, grab the text from the post */
	$sotext = mysql_real_escape_string($_REQUEST['text']);
	$date = new DateTime(); 
	$error = array();	
	if($_SERVER['REMOTE_ADDR']=="89.248.165.134"||$_SERVER['REMOTE_ADDR']=="89.248.165.143"||$_SERVER['REMOTE_ADDR']=="218.86.50.114") {
		$errors['success'] = false;
		$errors['message'] = "There was an error";
		$error = true;
	}
	else if(strlen($sotext) != strlen(strip_tags($sotext))) {
		$errors['success'] = false;
		$errors['message'] = "HTML tags are not allowed";
		$error = true;
	}
	else if(strlen($sotext) > 300 ) {
		$errors['success'] = false;
		$errors['message'] = "Your shoutout is too long";
		$error = true;
	}
	else {
		if(mysql_query("INSERT INTO shoutouts_new (setid,text,date,ip,approved,sonum) VALUES ('$setid','$sotext',NOW(),'".$_SERVER['REMOTE_ADDR']."',0,'NULL')"))
			goBack();
	}
}



function goBack() {

	if($so_page = 1 ){
		$url = "" . get_bloginfo('url') . "/shoutouts/?success";
	} else {
		$url = "" . get_bloginfo('url') . "/shoutouts/page/$so_page/?success";
	}
	
	echo '<script>window.setTimeout(function(){window.location.replace("' . $url . '");}, 0);</script>';
	exit;

}

/**** ^^^^ That's a bunch of old stuff (that works?) **/















global $DoubleClick;
global $post;

?>

<div class="block article-display-block showcase-block">
	
	<div class="wrapper">
	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php
		/**
		 * Retrieve and display feature-image (hero).
		 * 
		 */
		?>
		<div class="hero">

			<div class="shoutout-bubble">

			<?php if(!$singleSO&&!$success) : ?>

				<?php if($error) { ?>
					<h2 class="error">ERROR: <?php echo $errors['message']; ?><h2>
				<?php } else { ?>
					<h2>Submit a Shoutout:<h2>	
				<?php } ?>

				<form id="shoutout-form" method="POST">
			
					<textarea class="so-text" name="text" wrap="virtual" placeholder="SO/ASO to..."><?php echo strip_tags($sotext); ?></textarea>
					<input type="hidden" style="display:none" value="<?php $date = new DateTime(); echo ((($date->getTimestamp())*3) + 3000); ?>" name="so_nonce" />
					<input class="so-button submit-so-button" name="" type="submit" value="Shout it out" />
			
				</form>

			<?php elseif ($success): ?>

				<h2>Your Shoutout has been submitted<h2>
				<p>Your shoutout has been submitted and is pending approval from the shoutout coordinator. Check back later</p>

			<?php else: ?>



				<?php /* Print shoutout logic */ ?>
			
				<?php
				
				/* We write a query to fetch all APPROVED shoutouts from the current SETID */

					$sql = "SELECT text, `date`, `id`, `sonum`, `setid` FROM shoutouts_new WHERE id='$soNum' AND approved=1 ORDER BY `date` DESC";
				
					$result = mysql_query($sql);
				
					$result = mysql_fetch_array($result);
					
					if($result[setid]==($setid-1)) {
						$lastset = true;
					}
					
					else if($result[setid]!=($setid)) {
						echo "<p>This shoutout has been indexed</p>";
						$indexed = true;
					}					
					
				/* Get basic information about the shoutout */
				
					if(!$indexed&&!$lastset) {
						
						$shoutout = $result;
						$shoutout = new Shoutout($shoutout['id'],$shoutout['sonum'],$setid,$shoutout['text'],$shoutout['date']);
					?>
								
							<h2 class="shout-out-title" >
								#<?php echo $shoutout->getNum(); ?> | 
								<?php echo $shoutout->getDate() ?>
							</h2>
							<h1><?php echo $shoutout->getText(); ?></h1>
				
				<?php } /* last set/index */ ?>

				<?php /* End print shoutout logic */ ?>


			<?php endif; ?>

			</div><!-- shoutout bubble -->

			<aside class="hero-aside">

				<div class="hero-ad">

					<?php $DoubleClick->place_ad('bh:leaderboard','300x250',array('desktop','xl')); ?>
					
				</div>


			</aside>  

			<div class="clearfix"></div>


		</div><!-- hero -->


			<main>

				<?php 
				/**
			 	 * Header
				 */ 
				?>
				<header class="article-header">

					<!-- <a class="article-section"><?php echo exa_section(); ?></a> -->

					<?php echo exa_get_tweet_link(get_the_title(),null,'article-title',1); ?>
				
				<?php if( hrld_has_subhead(get_the_ID()) ) : ?>
				
					<h2 class="article-subhead"><?php hrld_the_subhead(); ?></h2>
				
				<?php endif; ?>

					<div class="article-meta">

						<aside class="aside-pane aside-author aside-pane-slim" style="margin-left: -560px; top: 728px; display: none;">
								
								<?php exa_round_mug( get_the_author_meta('ID') ); ?>
								<h3>Also by <?php the_author() ?></h3>



						</aside>
						<div class="article-mug-box open-author-pane">
							<?php exa_mug(get_the_author_meta('ID'),'small-thumbnail') ?>
						</div>
						
						<span class="meta-author">
							by 
							<a class="author-link" href="<?php exa_the_author_link() ?>" title="<?php echo exa_properize(get_the_author()); ?> Profile">
								<?php the_author() ?>
							</a>
						</span> &middot;

						<span class="meta-time">
							<?php the_time("M j, Y") ?>
						</span>

					</div>

				</header>

				<?php 
				/**
			 	 * The sidebar to the post.
				 */ 
				?>
				<section class="lede-sidebar">
					
					<div class="ad sidebar-thing">
						<?php $DoubleClick->place_ad('bh:leaderboard','300x250',array('tablet','xl','desktop')); ?>
					</div>

					<div class="popular-posts sidebar-thing">
						<?php the_widget( "Popular_Post_Widget"); ?>
					</div>

					<div class="ad sidebar-thing">
						<?php $DoubleClick->place_ad('bh:leaderboard','300x250',array('xl','desktop','tablet')); ?>
					</div>

					<div class="ad sidebar-thing">
						<?php $DoubleClick->place_ad('bh:leaderboard','300x250',array('xl','desktop')); ?>
					</div>


				</section>

				<?php 
				/**
			 	 * The article text.
				 */ 
				?>
				<section class="article-text">

					
					
  					


						<?php 

						/* Shoutout Loop */

						if($singleSO) : 

							echo "<p><a href='javascript:history.back(1);'>&#8592; Back</a></p>";

						else :

							if (!$shoutouts->hasShoutouts()) { 
								echo '<p>HMFASO to there not being any shoutouts yet. Why not submitting one?</p>';
							}
							else {
								
								echo $shoutouts->getNav('?page=');

								$count=1;
								$pos = rand(1,2)*6;
								foreach($shoutouts->getArray() as $shoutout) {
						?>
				
						<!-- Shoutout Dom -->

						<div class="shoutout-container" id="<?php echo $shoutout->getNum() ?>">
						
							<p class="so-title" >
								<?php echo "<a class='shoutout-number-link' href='" . SITE_ROOT . SHOUTOUT_ROOT  . "so/" . $shoutout->getID() . "' title='Shoutout #" . $shoutout->getNum() . "'>"; ?>#<?php echo $shoutout->getNum(); ?></a>
								<?php echo $shoutout->getDate() ?>
							</p>
							<p class="so-text"><?php echo $shoutout->getText(); ?></p>
							<!--<fb:like href="http://"<?php echo (SITE_ROOT . SHOUTOUT_ROOT); ?>/so/<?php echo $soid; ?>" send="false" layout="button_count" width="100" show_faces="true"></fb:like> -->
						
						</div>

					<?php
								} /* For each shoutout */
								$shoutouts->getNav('?page=');
							} /* else */
						endif;
					?>
	
					

					<div class="clearfix"></div>

				</section>

				<div class="clearfix"></div>


				<section class="article-footnotes">

					<?php exa_sharebar(); ?>

					<hr/>

					<p>This article was published <strong><?php the_time("M j, Y") ?></strong> at <strong><?php the_time("g:i a"); ?></strong>, and last updated <strong><?php the_modified_time("M j, Y") ?></strong> at <strong><?php the_modified_time("g:i a"); ?></strong>.<p>
					
				</section>

			</main>
			
		</article><!-- #post-xx -->

	</div><!-- .wrapper -->

</div><!-- .block -->

