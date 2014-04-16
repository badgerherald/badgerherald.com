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

if ($_POST) {


	/* Next, grab the text from the post */
	$sotext = mysql_real_escape_string($_POST['shoutout_text']);
	$date = new DateTime(); 	
	if($_SERVER['REMOTE_ADDR']=="89.248.165.134"||$_SERVER['REMOTE_ADDR']=="89.248.165.143"||$_SERVER['REMOTE_ADDR']=="218.86.50.114") {
		$error['success'] = false;
		$error['message'] = "There was an error";
	}
	else if(strlen($sotext) != strlen(strip_tags($sotext))) {
		$error['success'] = false;
		$error['message'] = "HTML tags are not allowed";
	}
	else if(strpos($sotext, 'SO') === false) {
		$error['success'] = false;
		$error['message'] = "<b>There was an error.</b>";		
	}
	else if( ((($date->getTimestamp())*3) + 3000) - $_SERVER['so_nonce'] > 60 ) {
		$error['success'] = false;
		$error['message'] = "<b>There was an error: </b>" . (((($date->getTimestamp())*3) + 3000) - $_SERVER['so_nonce']) ;
	}
	else {
		if(mysql_query("INSERT INTO shoutouts_new (setid,text,date,ip,approved,sonum) VALUES ('$setid','$sotext',NOW(),'".$_SERVER['REMOTE_ADDR']."',0,'NULL')"))
			$error['success'] = true;
			$error['message'] = "Shoutout successfully submitted";
	}
} else {
	$error = array();
	$error['success'] = true;	
}

if ($_POST&&$error['success']){
echo '
<script type="text/javascript">
location.reload();
</script>';
}


get_header(); 

?>

	
	<?php 

	if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/fold/fold.php")) {
		include($_SERVER["DOCUMENT_ROOT"] . "/fold/fold.php");
	}

	?>
	
	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
		<div class="so-header-wrap">
			<header <?php if(!$error['success']) { ?> style="display:none" <?php } ?> class="entry-header shoutout-header">
				<h1 class="entry-title"><a href="<?php bloginfo('url'); ?>/shoutouts/"> <?php the_title(); ?></a></h1>
				<h2 class="shoutout-tagline"></h2>
				<a style="display:none" class="so-button add-so-button" href="http://badgerherald.com/shoutouts/add">Add a Shoutout</a>
			</header><!-- .entry-header -->

			<?php if(!$error['success']) { ?>
			<div class="so-error">
				<b>ERROR:</b> <?php echo $error['message']; ?>
			</div>
			<?php } ?>

		</div>

<div id="stream">

	<?php if(!$singleSO) : ?>


		<hr/>
  	<?php echo $shoutouts->getNav('?page='); ?>
			<div class="clearfix"></div>
			<hr/>
	<?php
		if (!$shoutouts->hasShoutouts()) { 
			echo '<p>HMFASO to there not being any shoutouts yet.  Why not submitting one?</p>';
		}
		else {
			$count=1;
			$pos = rand(1,2)*6;
			foreach($shoutouts->getArray() as $shoutout) {
	 ?>
				
				<!-- THIS IS WHERE EACH SHOUTOUT LIVES -->

				<div class="shoutout-container" id="<?php echo $shoutout->getNum() ?>">
					<p class="shout-out-title" >
						<?php echo "<a class='shoutout-number-link' href='" . SITE_ROOT . SHOUTOUT_ROOT  . "so/" . $shoutout->getID() . "' title='Shoutout #" . $shoutout->getNum() . "'>"; ?>#<?php echo $shoutout->getNum(); ?></a>
						<?php echo $shoutout->getDate() ?>
					</p>
					<p><?php echo $shoutout->getText(); ?></p>
					<!--<fb:like href="http://"<?php echo (SITE_ROOT . SHOUTOUT_ROOT); ?>/so/<?php echo $soid; ?>" send="false" layout="button_count" width="100" show_faces="true"></fb:like> -->
				</div><!-- shoutout container -->


			<?php if(false && $count == $pos) : ?>
		<hr/>

				<!-- THIS IS WHERE EACH SHOUTOUT LIVES -->

				<div class="shoutout-container" id="<?php echo $shoutout->getNum() ?>">
					<p class="shout-out-title" >
						<?php echo "<a class='shoutout-number-link' href='#'>"; ?>Sponsored</a>
					</p>
					<p>Interested in Sports Media? Join @prssauwmadison to hear from #PR professionals #TouchBaseTouchdown! Register here <a href="http://bit.ly/1hon9ln">http://bit.ly/1hon9ln</a></p>
				</div><!-- shoutout container -->


			<?php endif; ?>


	<hr/>

				<?php
				$count+=1;
			} /* For each shoutout */
		} /* else */
	?>
	
	<?php echo $shoutouts->getNav('?page='); ?>
	
	<div class="clearfix"></div>


	<?php else : // Single ?>

<?php

/* We make sure there is only one result */
//if(mysql_num_rows($result)!=1) {
//	echo "<p>Either that shoutout does not exist, or something got messed up in the tube.</p>";
//}

/* Else we only have one row */	
//else {
	
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
	
	
//}
	
	
/* Get basic information about the shoutout */

	if(!$indexed&&!$lastset) {
				$shoutout = $result;
			  $shoutout = new Shoutout($shoutout['id'],$shoutout['sonum'],$setid,$shoutout['text'],$shoutout['date']);
			  // $shoutout = $result;
				// echo "<p id=\"$num\" class=\"postinfo\"><strong>$num.</strong> $date:</p>\n<p>$text</p>\n";
				?>
				
				<div class="shoutout-container" id="<?php echo $shoutout->getNum() ?>">
					<p class="shout-out-title" >
						<?php echo "<a class='shoutout-number-link' href='" . SITE_ROOT . SHOUTOUT_ROOT  . "so/" . $shoutout->getID() . "' title='Shoutout #" . $shoutout->getNum() . "'>"; ?>#<?php echo $shoutout->getNum(); ?></a>
						<?php echo $shoutout->getDate() ?>
					</p>
					<p><?php echo $shoutout->getText(); ?></p>
					<!--<fb:like href="http://"<?php echo (SITE_ROOT . SHOUTOUT_ROOT); ?>/so/<?php echo $soid; ?>" send="false" layout="button_count" width="100" show_faces="true"></fb:like> -->
				</div><!-- shoutout container -->

<?php } /* last set/index */ ?>

	<?php endif // $soSingle ?>


	<?php endwhile; // Wordpress while ?>

</div>



<div class="so-sidebar">
<div class="so-sidebar fixed-sidebar-container">
		<h2>Submit a Shoutout:</h2>	
	<form id="shoutout-form" method="POST">

		<textarea class="so-text" name="shoutout_text" wrap="virtual" placeholder="SO/ASO to..."><?php echo strip_tags($sotext); ?></textarea>
		<input type="hidden" style="display:none" value="<?php $date = new DateTime(); echo ((($date->getTimestamp())*3) + 3000); ?>" name="so_nonce" />
		<input class="so-button submit-so-button" name="" type="submit" value="Shout it out"/>


	</form>
	<img class="so-avatar" src="<?php bloginfo('template_url') ?>/img/icons/shoutout.png" />
	<br/><br/>
	<?php dfp::hrld_sidebar_ad(); ?>
</div>
</div><!-- id="sidebar" -->



<?php get_footer(); ?>