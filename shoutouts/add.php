<?php include('/var/www/phi/components/header.php'); ?>

<div id="top-duck" class="duck duck-bottom-12">
<?include("/var/www/phi/ads/leaderboard.top.728x90.php");?>

</div>

<?php include("functions.php") ?>
<?php 

$page = mysql_real_escape_string($_GET['page']);

$blacklist = array();
$blacklist[] = "89.248.165.134";
$blacklist[] = "89.248.165.143";
$blacklist[] = "218.86.50.114";
$blacklist[] = "27.159.254.223";
$blacklist[] = "178.33.223.85";
$blacklist[] = "120.43.27.2";
$blacklist[] = "113.212.69.114"; // huge
$blacklist[] = "27.159.192.244";
$blacklist[] = "113.212.69.114";
$blacklist[] = "120.37.234.76";
$blacklist[] = "62.210.122.209";
$blacklist[] = "27.159.197.45";
$blacklist[] = "117.26.252.138";
$blacklist[] = "192.99.4.25";
$blacklist[] = "91.207.7.141";
$blacklist[] = "62.210.142.7";
$blacklist[] = "93.115.94.85";





if($page==NULL)
	$page = 1;
$shoutouts = new ShoutoutList($page,40); 

$page = mysql_real_escape_string($_GET['page']);

if ($_POST) {

	/* First, we fetch the current set of shoutouts 'setid', from the export date table */
	$setid = mysql_fetch_assoc(mysql_query('SELECT MAX(setidofexported) as "setid" FROM shoutouts_exports'));
	$setid = (int)$setid[setid];

	/* Next, grab the text from the post */
	$text = mysql_real_escape_string($_POST['shoutout_text']);
	$date = new DateTime(); 
	if(in_array($_SERVER['REMOTE_ADDR'],$blacklist)) {
		$error['success'] = false;
		$error['message'] = "<b>There was an error</b>";
	}
	else if(strlen($text) != strlen(strip_tags($text))) {
		$error['success'] = false;
		$error['message'] = "<b>HTML tags are not allowed</b>";
	}
	else if( ((($date->getTimestamp())*3) + 3000) - $_SERVER['nonce'] > 60 ) {
		$error['success'] = false;
		$error['message'] = "<b>There was an error</b>";
	}
	else {
		if(mysql_query("INSERT INTO shoutouts_new (setid,text,date,ip,approved,sonum) VALUES ('$setid','$text',NOW(),'".$_SERVER['REMOTE_ADDR']."',0,'NULL')"))
			$error['success'] = true;
			$error['message'] = "<b>Could not save to database</b>";
	}
}


?>

<div class="full-width" id="content-box">

<div id="shoutout-header">
	<div class="shoutout-num"><?php echo $shoutouts->numShoutouts(); ?></div>
	
	<div class="shoutout-title">
	
		<span class="shoutout-tagline">Shoutouts this week</span><br />
		<span class="shoutout-sub-tag">Submit a Shoutout</span>
	
	</div>

	<a href="<?php echo SITE_ROOT . SHOUTOUT_ROOT; ?>" class="button" id="new-shoutout-link">Back to Browsing</a>	
	
	<div style="clearfix"></div>
</div> 



<article id="article-page">

<br />
	 <?php if ($error['success']) { ?>
	 <p>Your shout-out has been successfully submitted and is awaiting approval by the Shout-Out Overlords. Thanks for coming!</p>
	 <?php } else { ?>
	 <form id="shoutoutform" method="POST">
		<?php if (!$error['success']&&$_POST) { ?>
			<p id="shoutoutError">There was the following error: <?php echo $error['message']; ?></p>
			<?php } ?>
			<textarea id="shoutoutText" name="shoutout_text" cols="48" rows="10" wrap="virtual" placeholder="SO/ASO to..."></textarea>
			<p><strong>Tip</strong>: Reference already posted shoutouts with a pound (#) sign to create a permalink</p><hr />
			<p>All approved shout-outs will appear online. Your shout-out will not appear immediately, but we approve shout-outs as quickly as we can. <strong>Please understand we receive hundreds of shout-outs on a daily basis, and most shout-outs are posted based on their entertainment value.</strong> Each Wednesday, a handful of shout-outs will be printed on the Classifieds page of the printed edition.  Shout-outs may be rejected if they include personal attacks, personal information or offensive language. Please <a href="mailto&#58;soc&#64;badgerherald.com">contact the shout-out controller</a> if you feel a shout-out appearing online should not have been approved.</p><p><font color='red'><b>NEW:</b></font> Every Monday, a handful of <strong>Weekend Wins</strong> will be published in the paper. Weekend Wins are the successes, failures and crazy weekend stories you'll recount for decades to come as proof of your wild college days. Mark your stories with "WW:" and submit them in the shout-out box.</p><p>Every Thursday a hand full of shout-outs with the title <strong>2nd Chance</strong> get published in the paper.  2nd Chance gives students a chance to tie those kite lines with someone that they saw on campus that they want to see again!</p>

<p>Note:  Publication does not imply endorsement </p>
	


<?php
	$sotext = rand(0,1);
	if($sotext==0)
		$sotext = "Shout it out";
	else if($sotext==1)
		$sotext = "Make it happen";



?>
			<input name="" type="submit" value="<?php echo $sotext; ?>" />
		</form>
		<?php } ?>


  
  </article>

<div id='page-sidebar'>




<div id="sidebar-ducks">

	<div id="sidebar-square-duck" class="duck">
	
		<a href="#">
			<?include("/var/www/phi/ads/rect.336x280.php");?>
	
		</a>
	</div>
	
	<div id="sidebar-duck-column" class="duck">
	
		<a href="#">
			<?include("/var/www/phi/ads/skyscraper.160x600.php");?>
		</a>
	
	</div>
	
	<div id="sidebar-duck-column" class="duck-left-margin">
		<div class="duck duck-bottom-12">
			<a href="#">
				<?include("/var/www/phi/ads/square.160x160.php");?>
			</a>
		</div>
		
		<a href="http://badgerherald.com/ads" class="duck-link">Advertise With The Herald</a>
		
		<div class="duck">
			<a href="#">
				<?include("/var/www/phi/ads/skyscraper.160x400.php");?>
			</a>
		</div>
			
	</div>
	
	<div class="clearfix"></div>
	
	<div id="sidebar-duck-text" class="duck">
<?include("/var/www/phi/ads/ads.text.php");?>
	</div>
	
</div>




<div class="clearfix" style="clear:both;"> </div>
</div><!-- Sidebar -->

  <div class="clearfix"></div>
  </div><!-- full-width -->
  </div><!-- Wrap -->

<br />
<div id="top-duck" class="duck duck-bottom-12">
<?include("/var/www/phi/ads/leaderboard.bottom.728x90.php");?>
</div>
  
  <?php include('/var/www/phi/components/footer.php'); ?>
  </body>
</html>
