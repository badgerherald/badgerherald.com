<?php

/** REQUIRE the config file.  This differs from including, because it
 *  makes sure only one instance is included.  (If two config files are
 *  loaded, shit fucks up).
 */
require("config.php");

/* The shoutout # that was requested (from the URL ?s=) */
$soid = $_GET['id'];

/* First, we fetch the current set of shoutouts 'setid', from the export date table */
$setid = mysql_fetch_assoc(mysql_query('SELECT MAX(setidofexported) as "setid" FROM shoutouts_exports'));
$setid = (int)$setid[setid];

/* We write a query to fetch all APPROVED shoutouts from the current SETID */
$sql = "SELECT text, `date`, `id`, `sonum`, `setid` FROM shoutouts_new WHERE id='$soid' AND approved=1 ORDER BY `date` DESC";

$result = mysql_query($sql);

$lastset = false;
$indexed = false;


?>



<?php include('/var/www/phi/components/header.php'); ?>

<div id="top-duck" class="duck duck-bottom-12">
<?include("/var/www/phi/ads/leaderboard.top.728x90.php");?>
</div>

<?php include("functions.php") ?>
<?php 

$page = mysql_real_escape_string($_GET['page']);

if($page==NULL)
	$page = 1;
$shoutouts = new ShoutoutList($page,40); 

?>

<div class="full-width" id="content-box">

<div id="shoutout-header">
	<div class="shoutout-num"><?php echo $shoutouts->numShoutouts(); ?></div>
	
	<div class="shoutout-title">
	
		<span class="shoutout-tagline">Shoutouts</span><br />
		<span class="shoutout-sub-tag">Keep 'Em Coming</span>
	
	</div>

	<a href="<?php echo SITE_ROOT . SHOUTOUT_ROOT; ?>" class="button" id="new-shoutout-link">Back to Browsing</a>	
	
	<div style="clearfix"></div>
</div> 


<article id="article-page">

			
			
<?php


/* We make sure there is only one result */
if(mysql_num_rows($result)!=1) {
	echo "<p>Either that shoutout does not exist, or something got messed up in the tube.</p>";
}

/* Else we only have one row */	
else {
	
	$result = mysql_fetch_array($result);
	
	if($result[setid]==($setid-1)) {
		$lastset = true;
	}
	
	else if($result[setid]!=($setid)) {
		echo "<p>This shoutout has been indexed</p>";
		$indexed = true;
	}
	
	
}
	
	
/* Get basic information about the shoutout */

	if(!$indexed&&!$lastset) {
				$shoutout = $result;
			  $shoutout = new Shoutout($shoutout['id'],$shoutout['sonum'],$setid,$shoutout['text'],$shoutout['date']);
			  // $shoutout = $result;
				// echo "<p id=\"$num\" class=\"postinfo\"><strong>$num.</strong> $date:</p>\n<p>$text</p>\n";
				?>
				
				<div class="shoutout-container" id="<?php echo $shoutout->getNum() ?>">
					<p class="shout-out-title" >
						<?php echo "<a class='shoutout-number-link' href='" . SITE_ROOT . SHOUTOUT_ROOT  . "so.php?id=" . $shoutout->getID() . "' title='Shoutout #" . $shoutout->getNum() . "'>"; ?>#<?php echo $shoutout->getNum(); ?></a>
						<?php echo $shoutout->getDate() ?>
					</p>
					<p><?php echo $shoutout->getText(); ?></p>
					<!--<fb:like href="http://"<?php echo (SITE_ROOT . SHOUTOUT_ROOT); ?>/so.php?id=<?php echo $soid; ?>" send="false" layout="button_count" width="100" show_faces="true"></fb:like> -->
				</div><!-- shoutout container -->

<?php } /* last set/index */ ?>
			
			
			
			
			

	
	<div class="clearfix"></div>
	</article>
  
<div id='page-sidebar'>




<div id="sidebar-ducks">

	<div id="sidebar-square-duck" class="duck">
	
		<a href="#">
			<?include("/var/www/phi/ads/rect.336x280.php");?>
	
		</a>
	</div>
	<?php /*
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
	*/ ?>
	<div class="clearfix"></div>
	
	<div id="sidebar-duck-text" class="duck">
<?include("/var/www/phi/ads/ads.text.php");?>
	</div>
	
</div>




<div class="clearfix" style="clear:both;"> </div>
</div><!-- Sidebar -->
  <script>
  $(document).ready(function() {
	  
	  /* Event that binds click to submit SO to open new box */
	  
	//  $("#new-shoutout-link").click(function(e) {
	//	  e.preventDefault();

	//	  $(this).siblings('#new-shoutout-box').slideDown();
		  
	//	  $(this).html("Post it");
		  /* we must now bind this button to submit the form */
	//	  $(this).click(function(f) {
			  
	//		  f.preventDefault();
	//		  addShoutout();
			  
	//	  });

	//  });
	  
	  /* Event that binds close to close the box */
	  
	//  $("#shoutout-box-close").click(function(e) {
	//	  e.preventDefault();

	//	  $(this).parent('#new-shoutout-box').slideUp();

	//  });
	  
	  /* Function that makes the call to add the shoutout. */

	//  function addShoutout() {
	//	  $.ajax({
	//		  type: 'POST',
	//		  url: 'add.php',
	//		  dataType: 'text',
	//		  data: { shoutout_text:$('form[name=newshoutout]').find("textarea[name=shoutout_text]").val()},
	//		  success: function(data) {
	//			  data = $.parseJSON(data);
	//			 if(data.success) {
	//				 alert('sent!');
	//			 }
	//			 else
	//			 	 alert("Message Not Sent");
	//			} // FUNCTION
	//   });	// AJAX
	// }
	   
	  
	  /* Function the updates necessary elements on ajax return */
	  
	  
	  /* Function that inserts social media links */
	  
	  
  });
  

  </script>
  
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